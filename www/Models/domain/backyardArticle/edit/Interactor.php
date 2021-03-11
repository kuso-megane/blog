<?php

namespace domain\backyardArticle\edit;

use domain\backyardArticle\edit\RepositoryPort\OldArticleContentRepositoryPort;
use domain\backyardArticle\edit\Validator\Validator;
use domain\backyardArticle\edit\Presenter;
use domain\backyardArticle\edit\RepositoryPort\SubCategoryListRepositoryPort;
use domain\backyardArticle\edit\RepositoryPort\CategoryListRepositoryPort;
use domain\Exception\ValidationFailException;
use myapp\config\AppConfig;

class Interactor
{
    private $oldArticleContentRepository;
    private $categoryListRepository;
    private $subCategoryListRepository;

    public function __construct(
        OldArticleContentRepositoryPort $oldArticleContentRepository,
        CategoryListRepositoryPort $categoryListRepository,
        SubCategoryListRepositoryPort $subCategoryListRepository
    )
    {
        $this->oldArticleContentRepository = $oldArticleContentRepository;
        $this->categoryListRepository = $categoryListRepository;
        $this->subCategoryListRepository = $subCategoryListRepository;
    }


    /**
     * @param array $vars
     * 
     * @return array|int refer to Presenter->present()
     * 
     * if validation fails, this returns AppConfig::INVALID_PARAMS
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
        

        $artcl_id = $input['artcl_id'];

        if ($artcl_id == NULL) {
            $isNew = TRUE;
            $oldArticleContent = NULL;
        }
        elseif ($artcl_id != NULL) {
            $isNew = FALSE;
            $oldArticleContent = $this->oldArticleContentRepository->getOldArticleContent($artcl_id);
        }

        $categoryList = $this->categoryListRepository->getCategoryList();
        $subCategoryList = $this->subCategoryListRepository->getSubCategoryList();

        
        return (new Presenter)->present($isNew, $oldArticleContent, $categoryList, $subCategoryList);
    }
}
