<?php

namespace infra\database\spec\helpers;

use PDOStatement;
use PDO;

class ArticleTableSpecHelper
{

    public function insertSampleArticle(PDOStatement $sth, int $id, string $date, int $c_id = 1, int $subc_id = 1, ?string $title = NULL):array
    {
        if ($title = NULL) {
            $sampleTitle = "sampleTitle{$id}";
        }
        else {
            $sampleTitle = $title;
        }

        $sth->execute([':c_id' => $c_id, ':subc_id' => $subc_id, ':title' => $sampleTitle,
        ':thumbnailName' => 'sampleThumnail.jpg', ':content' => '<p>This is Sample.</p>',
        ':updateDate' => $date]);

        return  $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    // for findRecentOnesInfos() test
    public function sampleArticleInfo(int $id, string $date, int $c_id = 1, int $subc_id = 1, ?string $title = NULL):array
    {
        if ($title = NULL) {
            $sampleTitle = "sampleTitle{$id}";
        }
        else {
            $sampleTitle = $title;
        }

        return ['id' => $id, 'c_id' => $c_id, 'subc_id' => $subc_id, 'title' => $sampleTitle,
        'thumbnailName' => 'sampleThumnail.jpg', 'updateDate' => $date];
    }
}