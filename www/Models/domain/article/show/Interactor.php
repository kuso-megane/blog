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
     * @return array|int refer to Presenter
     */
    public function interact(array $vars)
    {
        
        try {
            $input = (new Validator)->validate($vars)->toArray();
        }
        catch (ValidationFailException $e) {
            return (new Presenter)->reportInValidParams($e->getMessage());
        }
        

        $id = $input['id'];
        
        $article = $this->articleRepository->getArticleContent($id);

        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        try {
            $mainSidebarData = $container->get(MainSidebarInteractor::class)->interact();
        }
        catch (ValidationFailException $e) {
            return (new Presenter)->reportInValidParams($e->getMessage());
        }
        

        if ($article != NULL) {

            try {
                $breadCrumbData = $container->get(BreadCrumbInteractor::class)
                ->interact([
                    'c_id' => $article->toArray()['c_id'],
                    'subc_id' => $article->toArray()['subc_id']
                ]);
            }
            catch (ValidationFailException $e) {
                return (new Presenter)->reportInValidParams($e->getMessage());
            }
            
        }
        else {
            $breadCrumbData = [];
        }

        return (new Presenter())->present($article, $breadCrumbData, $mainSidebarData);
    }
}
