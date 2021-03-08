<?php

namespace domain\article\show;

use domain\article\show\RepositoryPort\ArticleContentRepositoryPort;
use domain\article\show\validator\Validator;
use domain\components\breadCrumb\Interactor as BreadCrumbInteractor;
use domain\components\mainSidebar\Interactor as MainSidebarInteractor;


class Interactor
{
    private $articleRepository;

    
    public function __construct(ArticleContentRepositoryPort $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    


    /**
     * @param array $var
     * 
     * @return array
     */
    public function interact(array $vars):array
    {
        

        $input = (new Validator)->validate($vars)->toArray();
        
        $article = $this->articleRepository->getArticleContent($input)->toArray();
        

        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $breadCrumbData = $container->get(BreadCrumbInteractor::class)
        ->interact([
            'c_id' => $article['c_id'],
            'subc_id' => $article['subc_id']
        ]);
        $mainSidebarData = $container->get(MainSidebarInteractor::class)->interact();

        return (new Presenter())->present($article, $breadCrumbData, $mainSidebarData);
    }
}
