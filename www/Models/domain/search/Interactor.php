<?php

namespace domain\search;

use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\search\Presenter;
use domain\search\validator\Validator;
use myapp\config\AppConfig;
use myapp\myFrameWork\SuperGlobalVars as GVars;

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
     * @param array|NULL $var
     * 
     * @return array
     */
    public function interact(?array $vars):array
    {
        $artclNum = (new AppConfig)::ARTCL_NUM;

        $input = (new Validator)->validate($vars)->toArray();

        $isLastPageAndRecentArtclInfos = $this->recentArtclInfosRepository->getIsLastPageAndRecentArtclInfos($input, $artclNum);
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

        $breadCrumbData = $container->get('domain\components\breadCrumb\Interactor')->interact($vars);
        $mainSidebarData = $container->get('domain\components\mainSidebar\Interactor')->interact($vars);

        return (new Presenter())->present($input, $currentUrl, $recentArtclInfos, $isLastPage, $breadCrumbData, $mainSidebarData);
    }
}
