<?php

namespace domain\article\show;

use domain\article\show\RepositoryPort\ArticleContentRepositoryPort;
use domain\article\show\validator\Validator;
use domain\components\breadCrumb\Interactor as BreadCrumbInteractor;
use domain\components\mainSidebar\Interactor as MainSidebarInteractor;
use domain\Exception\ValidationFailException;
use myapp\config\AppConfig;

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
     * @return array|int refer to Presenter->present()
     * 
     * if validation fails, this return (int)AppConfig::INVALID_PARAMS
     */
    public function interact(array $vars)
    {
        
        try {
            $input = (new Validator)->validate($vars)->toArray();
        }
        catch (ValidationFailException $e) {
            echo $e->getMessage();
            return AppConfig::INVALID_PARAMS;
        }
        

        $id = $input['id'];
        
        $article = $this->articleRepository->getArticleContent($id);

        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();
        $mainSidebarData = $container->get(MainSidebarInteractor::class)->interact();

        if ($article != NULL) {
            $breadCrumbData = $container->get(BreadCrumbInteractor::class)
            ->interact([
                'c_id' => $article->toArray()['c_id'],
                'subc_id' => $article->toArray()['subc_id']
            ]);
        }
        else {
            $breadCrumbData = [];
        }

        return (new Presenter())->present($article, $breadCrumbData, $mainSidebarData);
    }
}
