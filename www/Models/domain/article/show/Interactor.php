<?php

namespace domain\article\show;

use domain\article\show\RepositoryPort\ArticleRepositoryPort;
use domain\article\show\validator\Validator;


class Interactor
{
    private $articleRepository;

    
    public function __construct(ArticleRepositoryPort $articleRepository)
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

        
        $article = $this->articleRepository->getArticle($input);
        

        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $breadCrumbData = $container->get('domain\components\breadCrumb\Interactor')->interact($vars);
        $mainSidebarData = $container->get('domain\components\mainSidebar\Interactor')->interact($vars);

        return (new Presenter())->present($article, $breadCrumbData, $mainSidebarData);
    }
}
