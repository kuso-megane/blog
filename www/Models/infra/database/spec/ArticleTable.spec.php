<?php

use infra\database\src\ArticleTable;
use infra\database\helpers\DBConnection;
use infra\database\spec\helpers\ArticleTableSpecHelper;
use myapp\config\AppConfig;

use function Kahlan\expect;

describe('ArticleTable:', function() {

    given('dbh', function () {
        return (new DBConnection(TRUE))->connect();
    });

    given('helper', function () {
        return new ArticleTableSpecHelper;
    });
    
    given('table', function() {
        return new ArticleTable(TRUE);
    });

    given('tablename', function () {
        return 'Article';
    });

    given('parentTablename1', function() {
        return  'Category';
    });

    given('parentTablename2', function () {
        return 'SubCategory';
    });
    
    
    given('sampleTimestampNewer', function () {
        return '2020-02-01 00:00:00';
    });

    given('sampleTimestamp', function () {
        return '2020-01-01 00:00:00';
    });

    given('maxNum', function () {
        return(new AppConfig)::ARTCL_NUM;
    });


    beforeAll(function () {

        $this->dbh->exec('set foreign_key_checks=0');
        $this->dbh->exec('TRUNCATE TABLE ' . $this->parentTablename1);
        $this->dbh->exec('TRUNCATE TABLE ' . $this->parentTablename2);
        $this->dbh->exec('set foreign_key_checks=1');
        
        $this->dbh->exec('INSERT INTO ' . $this->parentTablename1 . " VALUES(0, 'category1', 0)");
        $this->dbh->exec('INSERT INTO ' . $this->parentTablename1 . " VALUES(0, 'category2', 0)");
        $this->dbh->exec('INSERT INTO ' . $this->parentTablename2 . " VALUES(0, 'subCategory1', 1, 0)");
        $this->dbh->exec('INSERT INTO ' . $this->parentTablename2 . " VALUES(0, 'subCategory2', 1, 0)");
        $this->dbh->exec('INSERT INTO ' . $this->parentTablename2 . " VALUES(0, 'subCategory3', 2, 0)");
        
    });


    describe('findRecentOnesInfos():', function() {

        context('when search word is not specified:', function () {

            context('when only $pageId is specified:', function () {

                beforeEach(function() {

                    $this->dbh->exec('set foreign_key_checks=0');
                    $this->dbh->exec('TRUNCATE TABLE ' . $this->tablename);
                    $this->dbh->exec('set foreign_key_checks=1');

                    $command = 'INSERT INTO ' . $this->tablename . 
                    " VALUES(0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate)";
        
                    try {
                        $sth = $this->dbh->prepare($command);
                    } catch (PDOException $e) {
                        echo "given command: {$command};\n\t {$e->getMessage()}\n";
                    }
                    
                    // 1ページで表示できる最大数
                    for ($i = 0; $i < $this->maxNum; ++$i) {
                        $id = $i + 1;
                        $this->helper->insertSampleArticle($sth, $id, $this->sampleTimestamp);
                        $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = 1');
                        $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = 1');
                    }
    
                    // 1つ、他より新しいデータを追加
                    $this->helper->insertSampleArticle($sth, $this->maxNum, $this->sampleTimestampNewer);
                    $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = 1');
                    $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = 1');
                });
                    
    
                context('$pageId == 1:', function () {
                    it('return maxNum of recent articles of all categories and $isLastPage will be FALSE:', function () {
    
                        $isLastPage = (bool)NULL;
                        $pageId = 1;
    
                        expect($this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId))->toBe([
                            $this->helper->sampleArticleInfo($this->maxNum + 1, $this->sampleTimestampNewer),
                            $this->helper->sampleArticleInfo(1, $this->sampleTimestamp),
                            $this->helper->sampleArticleInfo(2, $this->sampleTimestamp),
                            $this->helper->sampleArticleInfo(3, $this->sampleTimestamp),
                            $this->helper->sampleArticleInfo(4, $this->sampleTimestamp),
                            $this->helper->sampleArticleInfo(5, $this->sampleTimestamp),
                            $this->helper->sampleArticleInfo(6, $this->sampleTimestamp),
                            $this->helper->sampleArticleInfo(7, $this->sampleTimestamp),
                            $this->helper->sampleArticleInfo(8, $this->sampleTimestamp)
                        ]);
    
                        expect($isLastPage)->toBe(FALSE);
                    });
                });
    
                /*
                context('$pageId == 2:', function () {
                    it('return the rest of article and $isLastPage will be TRUE:', function () {
    
                        $isLastPage = (bool)NULL;
                        $pageId = 2;
    
                        expect(($this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId)))->toBe([
                            $this->helper->sampleArticleInfo($this->maxNum, $this->sampleTimestamp)
                        ]);
    
                        expect($isLastPage)->toBe(TRUE);
                    });
                });
                */
      
            });

            context('when category is specified but subCategory not:', function () {
                
            });
    
            /*
            context('when both category and subCategory are specified:', function () {
    
                beforeEach(function () {

                    $this->dbh->exec('set foreign_key_checks=0');
                    $this->dbh->exec('TRUNCATE TABLE ' . $this->tablename);
                    $this->dbh->exec('set foreign_key_checks=1');
    
                    $command = 'INSERT INTO ' . $this->tablename . 
                    " VALUES(0, :c_id, :subc_id, :title, :thumbnailName, :content, :updateDate)";
        
                    try {
                        $sth = $this->dbh->prepare($command);
                    } catch (PDOException $e) {
                        echo "given command: {$command};\n\t {$e->getMessage()}\n";
                    }
    
                    $this->helper->insertSampleArticle($sth, 1, $this->sampleTimestamp, 1, 1);
                    $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = 1');
                    $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = 1');
    
                    $this->helper->insertSampleArticle($sth, 1, $this->sampleTimestamp, 1, 2);
                    $this->dbh->exec('UPDATE Category SET num = num + 1 WHERE id = 1');
                    $this->dbh->exec('UPDATE SubCategory SET num = num + 1 WHERE id = 2');
                });
    
                it('return articles of specified category, subCategory:', function () {
    
                    $isLastPage = (bool)NULL;
                    $pageId = 1;
                    $c_id = 1;
    
                    $subc_id = 1;
                    expect($this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId, NULL, $c_id, $subc_id))
                    ->toBe([
                        $this->helper->sampleArticleInfo(1, $this->sampleTimestamp, 1, 1)
                    ]);
    
                    $subc_id = 2;
                    expect($this->table->findRecentOnesInfos($this->maxNum, $isLastPage, $pageId, NULL, $c_id, $subc_id))
                    ->toBe([
                        $this->helper->sampleArticleInfo(1, $this->sampleTimestamp, 1, 2)
                    ]);
                });
            });
            */
        });
        
        context('when search word is specified', function () {
            // 未実装
        });

    });

    
    describe('findById():', function () {
        // 未実装
    });

});

