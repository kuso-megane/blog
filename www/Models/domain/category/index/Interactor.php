<?php

namespace domain\category\index;

use domain\category\index\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\components\categorySearchList\RepositoryPort\CategorySearchListRepositoryPort;
use domain\category\index\Presenter;

class Interactor
{

    private $recentArtclInfosRepository;
    private $categorySearchList;

    /*
    public function __construct(RecentArtclInfosRepositoryPort $recentArtclInfosRepository,
    CategorySearchListRepositoryPort $categorySearchList)
    {
        $this->recentArtclInfosRepository = $recentArtclInfosRepository;
        $this->categorySearchList = $categorySearchList;
    }
    */


    /**
     * @param array|NULL $var
     * 
     * @return array
     */
    public function interact(?array $var):array
    {
        //sample data
        $recentArtclInfos = [

            ['artclId' => 1, 'title' => 'sampleTitle1ああああああああああ', 'updateDate' => '2021-2-10',
                'thumbnailImg' => '/asset/img/test_img.jpg'],

            ['artclId' => 2, 'title' => 'sampleTitle2いいいいいいいいいいいいい', 'updateDate' => '2021-2-10',
            'thumbnailImg' => '/asset/img/test_img.jpg'],

            ['artclId' => 3, 'title' => 'sampleTitle3ふぁ', 'updateDate' => '2021-2-10',
            'thumbnailImg' => '/asset/img/test_img.jpg']
            
        ];
        $categoryArtclCount = ['プログラミング' => 6, '読書' => 5];
        $subCategoryArtclCount = ['プログラミング' => ['web' => 4, 'game' => 2], '読書' => ['マンガ' => 3, '小説' => 2]];

        return (new Presenter())->present($recentArtclInfos, $categoryArtclCount, $subCategoryArtclCount);
    }
}