<?php

use PHPUnit\Framework\TestCase;
use infra\database\src\CategoryTable;
use infra\database\src\SubCategoryTable;
use infra\database\src\ArticleTable;
use myapp\myFrameWork\DB\Connection;
use myapp\config\AppConfig;
use myapp\myFrameWork\DB\MyDbh;

class ArticleTableTest extends TestCase
{
    const TABLENAME = 'Article';
    const PARENT1_TABLENAME = 'Category';
    const PARENT2_TABLENAME = 'SubCategory';
    const SAMPLE_TIME = '2020-01-01 00:00:00';
    const SAMPLE_TIME_NEWER = '2020-02-01 00:00:00';

    private $dbh;
    private $table;
    private $maxNum;


    protected function setUp():void
    {
        $this->dbh = (new Connection(TRUE))->connect();
        $this->table = new ArticleTable(TRUE);
        $this->parentTable1 = new CategoryTable(TRUE);
        $this->parentTable2 = new SubCategoryTable(TRUE);
        $this->maxNum = (new AppConfig)::ARTCL_NUM;

        $this->dbh->truncate($this::TABLENAME);
        $this->dbh->truncate($this::PARENT2_TABLENAME);
        $this->dbh->truncate($this::PARENT1_TABLENAME);

        $sth1 = $this->dbh->insert($this::PARENT1_TABLENAME, ':id, :name, :num', [], MyDbh::ONLY_PREPARE);
        $sth1->execute([':id' => 0, ':name' => 'category1', ':num' => 0]);
        $sth1->execute([':id' => 0, ':name' => 'category2', ':num' => 0]);

        $sth2 = $this->dbh->insert($this::PARENT2_TABLENAME, ':id, :name, :c_id, :num', [], MyDbh::ONLY_PREPARE);
        $sth2->execute([':id' => 0, ':name' => 'subCategory1', ':c_id' => 1, ':num' => 0]);
        $sth2->execute([':id' => 0, ':name' => 'subCategory2', ':c_id' => 1, ':num' => 0]);
        $sth2->execute([':id' => 0, ':name' => 'subCategory3', ':c_id' => 2, ':num' => 0]);
        $sth2->execute([':id' => 0, ':name' => 'subCategory4', ':c_id' => 2, ':num' => 0]);

    }


    /**
     * @dataProvider providerForFindRecentOnesInfos
     */
    public function testFindRecentOnesInfos(int $pageId, bool $isSetC_id, bool $isSetSubc_id, bool $isSetWord)
    {
        $isLastPage = (bool)NULL;

        $title = 'sampleTitle';
        $thumbnailName = 'sampleThumnail.jpg';
        $content = '<p>This is Sample.</p>';

        if ($isSetWord == FALSE) {
            if ($isSetC_id == FALSE && $isSetSubc_id == FALSE) {

                $c_id = 1;
                $subc_id = 1;
    
    
                $sth = $this->dbh->insert(
                    $this::TABLENAME,
                    ':id, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate',
                    [
                        ':id' => 0,
                        ':c_id' => $c_id,
                        ':subc_id' => $subc_id,
                        ':title' => $title,
                        ':thumbnailName' => $thumbnailName,
                        ':content' => $content
                    ],
                    MyDbh::ONLY_PREPARE
                );


                // 1ページで表示できる最大数の記事を作成
                for ($i = 0; $i < $this->maxNum; ++$i) {
                    $this->dbh->beginTransaction();
                    $sth->bindValue(':updateDate', $this::SAMPLE_TIME);
                    $sth->execute();
                    $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 1', 'id = :id',
                    [':id' => $c_id]);
                    $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :id',
                    [':id' => $subc_id]);
                    $this->dbh->commit();
                }
                
                
                // 1つ、他より新しいデータを追加
                $this->dbh->beginTransaction();
                $sth->bindValue(':updateDate', $this::SAMPLE_TIME_NEWER);
                $sth->execute();
                $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 1', 'id = :id',
                [':id' => $c_id]);
                $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :id',
                [':id' => $subc_id]);
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

    
                $sth = $this->dbh->insert(
                    $this::TABLENAME,
                    ':id, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate',
                    [],
                    MyDbh::ONLY_PREPARE
                );

                //指定されたカテゴリの記事を2つ作成
                $this->dbh->beginTransaction();
                $sth->execute([
                    ':id' => 0,
                    ':c_id' => $c_id,
                    ':subc_id' => $subc_id1,
                    ':title' => $title,
                    ':thumbnailName' => $thumbnailName,
                    ':content' => $content,
                    ':updateDate' => $this::SAMPLE_TIME
                ]);
                $sth->execute([
                    ':id' => 0,
                    ':c_id' => $c_id,
                    ':subc_id' => $subc_id2,
                    ':title' => $title,
                    ':thumbnailName' => $thumbnailName,
                    ':content' => $content,
                    ':updateDate' => $this::SAMPLE_TIME_NEWER
                ]);
                $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 2', 'id = :id', [':id' => $c_id]);
                $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :id', [':id' => $subc_id1]);
                $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :id', [':id' => $subc_id2]);
                $this->dbh->commit();


                //指定されていないカテゴリの記事を作成
                $this->dbh->beginTransaction();
                $sth->execute([
                    ':id' => 0,
                    ':c_id' => $fake_c_id,
                    ':subc_id' => $fake_subc_id,
                    ':title' => $title,
                    ':thumbnailName' => $thumbnailName,
                    ':content' => $content,
                    ':updateDate' => $this::SAMPLE_TIME
                ]);
                $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 1', 'id = :id', [':id' => $fake_c_id]);
                $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :id', [':id' => $fake_subc_id]);
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

                $sth = $this->dbh->insert(
                    $this::TABLENAME,
                    '0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate',
                    [
                        ':c_id' => $c_id,
                        ':subc_id' => $subc_id,
                        ':title' => $title,
                        ':thumbnailName' => $thumbnailName,
                        ':content' => $content
                    ],
                    MyDbh::ONLY_PREPARE
                );

                //指定されたカテゴリ、サブカテゴリの記事を２つ作成
                $this->dbh->beginTransaction();
                
                $sth->bindValue(':updateDate', $this::SAMPLE_TIME);
                $sth->execute();
                $sth->bindValue(':updateDate', $this::SAMPLE_TIME_NEWER);
                $sth->execute();
                $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 2', 'id = :c_id', [':c_id' => $c_id]);
                $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 2', 'id = :subc_id', [':subc_id' => $subc_id]);
                $this->dbh->commit();

                //指定されていないサブカテゴリの記事を１つ作成
                $this->dbh->beginTransaction();
                $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 1', 'id = :c_id', [':c_id' => $c_id]);
                $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :subc_id', [':subc_id' => $fake_subc_id]);
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

            $sth = $this->dbh->insert(
                $this::TABLENAME,
                '0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate',
                [
                    'c_id' => $c_id,
                    ':subc_id' => $subc_id,
                    ':thumbnailName' => $thumbnailName,
                    ':content' => $content,
                ],
                MyDbh::ONLY_PREPARE
            );

            //指定された検索ワードに該当するタイトルの記事を2つ作成
            $this->dbh->beginTransaction();
            $sth->bindValue(':title', 'a:searchedA');
            $sth->bindValue(':updateDate', $this::SAMPLE_TIME);
            $sth->execute();
            $sth->bindValue(':title', 'b:searchedB');
            $sth->bindValue(':updateDate', $this::SAMPLE_TIME_NEWER);
            $sth->execute();
            $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 2', 'id = :c_id', [':c_id' => $c_id]);
            $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 2', 'id = :subc_id', [':subc_id' => $subc_id]);
            $this->dbh->commit();

            //指定された検索ワードを含まないタイトルの記事を1つ作成
            $this->dbh->beginTransaction();
            $sth->bindValue(':title', $title);
            $sth->bindValue(':updateDate', $this::SAMPLE_TIME);
            $sth->execute();
            $this->dbh->update($this::PARENT1_TABLENAME, 'num = num + 1', 'id = :c_id', [':c_id' => $c_id]);
            $this->dbh->update($this::PARENT2_TABLENAME, 'num = num + 1', 'id = :subc_id', [':subc_id' => $subc_id]);
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


    /**
     * 
     */
    public function testFindById()
    {
        $id = 1;
        $c_id = 1;
        $subc_id = 1;
        $title = 'sampleTitle';
        $thumbnailName = 'sampleThumnail.jpg';
        $content = '<p>This is Sample.</p>';

        //id = 1とid = 2の記事データを作成,
        $sth = $this->dbh->insert(
            $this::TABLENAME,
            '0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate',
            [':c_id' => $c_id, ':subc_id' => $subc_id, ':title' => $title, ':thumbnailName' => $thumbnailName,
            ':content' => $content, ':updateDate' => $this::SAMPLE_TIME],
            MyDbh::ONLY_PREPARE
        );
        $sth->execute();
        $sth->execute();


        $expected = [
            'id' => $id,
            'c_id' => $c_id,
            'subc_id' => $subc_id,
            'title' => $title,
            'thumbnailName' => $thumbnailName,
            'content' => $content,
            'updateDate' => $this::SAMPLE_TIME
        ];

        $this->assertSame($expected, $this->table->findById($id));
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
}
