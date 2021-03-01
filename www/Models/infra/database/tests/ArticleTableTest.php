<?php

use PHPUnit\Framework\TestCase;
use infra\database\src\CategoryTable;
use infra\database\src\SubCategoryTable;
use infra\database\src\ArticleTable;
use infra\database\helpers\DBConnection;
use infra\database\helpers\DBHMyLib;
use myapp\config\AppConfig;
use phpDocumentor\Reflection\Types\Float_;

class ArticleTableTest extends TestCase
{
    const TABLENAME = 'Article';
    const PARENT1_TABLENAME = 'Category';
    const PARENT2_TABLENAME = 'SubCategory';
    const SAMPLE_TIME = '2020-01-01 00:00:00';
    const SAMPLE_TIME_NEWER = '2020-02-01 00:00:00';

    private $dbh;
    private $table;
    private $dbhHelper;
    private $maxNum;


    protected function setUp():void
    {
        $this->dbh = (new DBConnection(TRUE))->connect();
        $this->table = new ArticleTable(TRUE);
        $this->parentTable1 = new CategoryTable(TRUE);
        $this->parentTable2 = new SubCategoryTable(TRUE);
        $this->dbhHelper = new DBHMyLib($this->dbh);
        $this->maxNum = (new AppConfig)::ARTCL_NUM;

        $this->dbhHelper->truncate($this::TABLENAME);
        $this->dbhHelper->truncate($this::PARENT2_TABLENAME);
        $this->dbhHelper->truncate($this::PARENT1_TABLENAME);

        $this->dbh->exec('INSERT INTO ' . $this::PARENT1_TABLENAME . " VALUES(0, 'category1', 0)");
        $this->dbh->exec('INSERT INTO ' . $this::PARENT1_TABLENAME . " VALUES(0, 'category2', 0)");
        $this->dbh->exec('INSERT INTO ' . $this::PARENT2_TABLENAME . " VALUES(0, 'subCategory1', 1, 0)");
        $this->dbh->exec('INSERT INTO ' . $this::PARENT2_TABLENAME . " VALUES(0, 'subCategory2', 1, 0)");
        $this->dbh->exec('INSERT INTO ' . $this::PARENT2_TABLENAME . " VALUES(0, 'subCategory3', 2, 0)");
        $this->dbh->exec('INSERT INTO ' . $this::PARENT2_TABLENAME . " VALUES(0, 'subCategory4', 2, 0)");

    }


    /**
     * @dataProvider providerForFindRecentOnesInfos
     */
    public function testFindRecentOnesInfos(int $pageId, bool $isSetC_id, bool $isSetSubc_id, bool $isSetWord)
    {
        $isLastPage = (bool)NULL;
        if ($isSetWord == FALSE) {
            if ($isSetC_id == FALSE && $isSetSubc_id == FALSE) {

                $c_id = 1;
                $subc_id = 1;
    
                $command = 'INSERT INTO ' . $this::TABLENAME . 
                " VALUES(0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate)";
    
                $sth = $this->dbhHelper->prepare($command);
    
                // 1ページで表示できる最大数の記事を作成
                for ($i = 0; $i < $this->maxNum; ++$i) {
                    $this->dbh->beginTransaction();
                    $this->insertSampleArticle($sth, $c_id, $subc_id, 'sampleTitle', $this::SAMPLE_TIME);
                    $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = ' . $c_id);
                    $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = ' . $subc_id);
                    $this->dbh->commit();
                }
                
                // 1つ、他より新しいデータを追加
                $this->dbh->beginTransaction();
                $this->insertSampleArticle($sth, $c_id, $subc_id, 'sampleTitle', $this::SAMPLE_TIME_NEWER);
                $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = ' . $c_id);
                $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = ' . $subc_id);
                $this->dbh->commit();
    
    
                if ($pageId == 1) {
    
                    $expected = [
                        ['id' => $this->maxNum + 1, 'c_id' => $c_id, 'subc_id' => $subc_id, 'title' => 'sampleTitle',
                        'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME_NEWER]
                    ];
    
                    for ($i = 0; $i < $this->maxNum - 1; ++$i) {
                        $expected[$i + 1] = ['id' => $i + 1, 'c_id' => $c_id, 'subc_id' => $subc_id, 'title' => 'sampleTitle',
                        'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME];
                    }
    
                    $this->assertSame($expected, $this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId));
                    $this->assertFalse($isLastPage); //該当記事が1ページに収まらない
                    
                }
                
    
                if ($pageId == 2) {
    
                    $expected = [
                        ['id' => $this->maxNum, 'c_id' => $c_id, 'subc_id' => $subc_id, 'title' => 'sampleTitle',
                        'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME]
                    ];
    
                    $this->assertSame($expected, $this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId));
                    $this->assertTrue($isLastPage); //該当記事が2ページに収まる
                }
            }
            else if ($isSetC_id == TRUE && $isSetSubc_id == FALSE) {

                $c_id = 1;
                $fake_c_id = 2;
                $subc_id1 = 1;
                $subc_id2 = 2;
                $fake_subc_id = 3;


                $command = 'INSERT INTO ' . $this::TABLENAME . 
                " VALUES(0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate)";
    
                $sth = $this->dbhHelper->prepare($command);

                //指定されたカテゴリの記事を2つ作成
                $this->dbh->beginTransaction();
                $this->insertSampleArticle($sth, $c_id, $subc_id1, 'sampleTitle', $this::SAMPLE_TIME);
                $this->insertSampleArticle($sth, $c_id, $subc_id2, 'sampleTitle', $this::SAMPLE_TIME_NEWER);
                $this->dbh->exec('UPDATE Category SET num = num + 2 WHERE id = ' . $c_id);
                $this->dbh->exec('UPDATE SubCategory SET num = num + 2 WHERE id = ' . $subc_id1);
                $this->dbh->commit();


                //指定されていないカテゴリの記事を作成
                $this->dbh->beginTransaction();
    
                $this->insertSampleArticle($sth, $fake_c_id, $fake_subc_id, 'sampleTitle', $this::SAMPLE_TIME);
                $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = ' . $fake_c_id);
                $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = ' . $fake_subc_id);

                $this->dbh->commit();


                $expected = [
                    ['id' => 2, 'c_id' => $c_id, 'subc_id' => $subc_id2, 'title' => 'sampleTitle',
                    'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME_NEWER],
                    ['id' => 1, 'c_id' => $c_id, 'subc_id' => $subc_id1, 'title' => 'sampleTitle',
                    'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME]
                ];
                $this->assertSame($expected, $this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId, $c_id));
                $this->assertTrue($isLastPage); //該当記事が1ページに収まる

            }
            else if ($isSetC_id == TRUE && $isSetSubc_id == TRUE) {

                $c_id = 1;
                $subc_id = 2;
                $fake_subc_id = 1;

                $command = 'INSERT INTO ' . $this::TABLENAME . 
                " VALUES(0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate)";
    
                $sth = $this->dbhHelper->prepare($command);

                //指定されたカテゴリ、サブカテゴリの記事を２つ作成
                $this->dbh->beginTransaction();
                $this->insertSampleArticle($sth, $c_id, $subc_id, 'sampleTitle', $this::SAMPLE_TIME);
                $this->insertSampleArticle($sth, $c_id, $subc_id, 'sampleTitle', $this::SAMPLE_TIME_NEWER);
                $this->dbh->exec('UPDATE Category SET num = num + 2 WHERE id = ' . $c_id);
                $this->dbh->exec('UPDATE SubCategory SET num = num + 2 WHERE id = ' . $subc_id);
                $this->dbh->commit();

                //指定されていないサブカテゴリの記事を１つ作成
                $this->dbh->beginTransaction();
                $this->insertSampleArticle($sth, $c_id, $fake_subc_id, 'sampleTitle', $this::SAMPLE_TIME);
                $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = ' . $c_id);
                $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = ' . $fake_subc_id);
                $this->dbh->commit();

                $expected = [
                    ['id' => 2, 'c_id' => $c_id, 'subc_id' => $subc_id, 'title' => 'sampleTitle',
                    'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME_NEWER],
                    ['id' => 1, 'c_id' => $c_id, 'subc_id' => $subc_id, 'title' => 'sampleTitle',
                    'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME]
                ];

                $this->assertSame($expected,
                $this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId, $c_id, $subc_id));
                
                $this->assertTrue($isLastPage); //該当記事が1ページに収まる
                
            }
        }
        else if ($isSetWord == TRUE) {
            $word = 'searched';
            $c_id = 1;
            $subc_id = 1;

            $command = 'INSERT INTO ' . $this::TABLENAME . 
                " VALUES(0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate)";
    
                $sth = $this->dbhHelper->prepare($command);

                //指定された検索ワードに該当するタイトルの記事を2つ作成
                $this->dbh->beginTransaction();
                $this->insertSampleArticle($sth, $c_id, $subc_id, 'a:searchedA', $this::SAMPLE_TIME);
                $this->insertSampleArticle($sth, $c_id, $subc_id, 'b:searchedB', $this::SAMPLE_TIME_NEWER);
                $this->dbh->exec('UPDATE Category SET num = num + 2 WHERE id = ' . $c_id);
                $this->dbh->exec('UPDATE SubCategory SET num = num + 2 WHERE id = ' . $subc_id);
                $this->dbh->commit();

                //指定された検索ワードを含まないタイトルの記事を1つ作成
                $this->dbh->beginTransaction();
                $this->insertSampleArticle($sth, $c_id, $subc_id, 'sampleTitle', $this::SAMPLE_TIME);
                $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = ' . $c_id);
                $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = ' . $subc_id);
                $this->dbh->commit();

                $expected = [
                    ['id' => 2, 'c_id' => $c_id, 'subc_id' => $subc_id, 'title' => 'b:searchedB',
                    'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME_NEWER],
                    ['id' => 1, 'c_id' => $c_id, 'subc_id' => $subc_id, 'title' => 'a:searchedA',
                    'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $this::SAMPLE_TIME]
                ];

                $this->assertSame($expected,
                $this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId, $c_id, $subc_id, $word));

                $this->assertTrue($isLastPage); //該当記事が1ページに収まる
        }
        
        

        


    }


    public function providerForFindRecentOnesInfos():array
    {
        return [
            'when $pageId = 1, others not set' => [1, FALSE, FALSE, FALSE],
            'when $pageId = 2, others not set' => [2, FALSE, FALSE, FALSE],
            'when $c_id is set, others not set($pageId = 1)' => [1, TRUE, FALSE, FALSE],
            'when $c_id and $subc_id are set, others not set($pageId = 1)' => [1, TRUE, TRUE, FALSE],
            'when $word is set' => [1, FALSE, FALSE, TRUE]
        ];
    }


    public function insertSampleArticle(PDOStatement $sth, int $c_id, int $subc_id, string $title, string $date):array
    {
        $sth->execute([':c_id' => $c_id, ':subc_id' => $subc_id, ':title' => $title,
        ':thumbnailName' => 'sampleThumnail.jpg', ':content' => '<p>This is Sample.</p>',
        ':updateDate' => $date]);

        return  $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
