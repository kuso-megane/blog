<?php

namespace domain\search;

use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\search\Presenter;
use domain\search\validator\Validator;
use myapp\config\AppConfig;
use myapp\myFrameWork\SuperGlobalVars as GVars;
use domain\components\breadCrumb\Interactor as BreadCrumbInteractor;
use domain\components\mainSidebar\Interactor as MainSidebarInteractor;

class Interactor
{

    private $recentArtclInfosRepository;

    
    public function __construct(
        RecentArtclInfosRepositoryPort $recentArtclInfosRepository
    ) 
    {
        $this->recentArtclInfosRepository = $recentArtclInfosRepository;
    }
    


    /**
     * @param array $var
     * 
     * @return array
     */
    public function interact(array $vars):array
    {
        $artclNum = (new AppConfig)::ARTCL_NUM;

        $input = (new Validator)->validate($vars)->toArray();

        $pageId = $input['pageId'];
        $searched_c_id = $input['searched_c_id'];
        $searched_subc_id = $input['searched_subc_id'];
        $searched_word = $input['searched_word'];

        $isLastPageAndRecentArtclInfos = $this->recentArtclInfosRepository
        ->getIsLastPageAndRecentArtclInfos($artclNum, $pageId, $searched_c_id, $searched_subc_id, $searched_word);
        $isLastPage = $isLastPageAndRecentArtclInfos[0];
        $recentArtclInfos = $isLastPageAndRecentArtclInfos[1];


        //現在のurl
        $server = (new Gvars)->getServer();
        $uri = $server['REQUEST_URI'];
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $currentUrl = rawurldecode($uri);

        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $breadCrumbData = $container->get(BreadCrumbInteractor::class)->interact($vars);
        $mainSidebarData = $container->get(MainSidebarInteractor::class)->interact();

        return (new Presenter())->present($input, $currentUrl, $recentArtclInfos, $isLastPage, $breadCrumbData, $mainSidebarData);
    }
}
