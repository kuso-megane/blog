<?php

namespace domain\search;

use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\search\Presenter;
use domain\search\validator\Validator;
use myapp\config\AppConfig;
use myapp\myFrameWork\SuperGlobalVars as GVars;
use domain\components\breadCrumb\Interactor as BreadCrumbInteractor;
use domain\components\mainSidebar\Interactor as MainSidebarInteractor;
use domain\Exception\ValidationFailException;

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
     * @return array|int
     */
    public function interact(array $vars)
    {
        $artclNum = (new AppConfig)::ARTCL_NUM;

        try {
            $input = (new Validator)->validate($vars)->toArray();
        }
        catch (ValidationFailException $e) {
            return (new Presenter)->reportValidationFailure($e->getMessage());
        }

        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        try {
            $mainSidebarData = $container->get(MainSidebarInteractor::class)->interact();
            $breadCrumbData = $container->get(BreadCrumbInteractor::class)->interact($vars);
        }
        catch (ValidationFailException $e) {
            return (new Presenter)->reportValidationFailure($e->getMessage());
        }
        

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


        return (new Presenter())->present($input, $currentUrl, $recentArtclInfos, $isLastPage, $breadCrumbData, $mainSidebarData);
    }
}
