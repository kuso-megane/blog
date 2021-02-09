<?php

namespace myapp\viewModel\templateParts;

use myapp\viewModel\TemplatePartsModelInterface;


class MainSidebarVM implements TemplatePartsModelInterface
{
    /*
    array $artclNumOnCategories = ['programming' => int, 'books' => int, ...]
    */
    private $artclNumOnCategories; 

    /*
    array $artclNumOnSubCategories = ['php' => int, 'manga' => int, ...]
    */
    private $artclNumOnSubCategories;


    public function getDataFromModel(): MainSidebarVM
    {
        //from model
        $artclNumOnCategories = ['sampleK' => 'sampleV'];
        $artclNumOnSubCategories = ['sampleK' => 'sampleV'];

        $this->artclNumOnCategories = $artclNumOnCategories;
        $this->artclNumOnSubCategories = $artclNumOnSubCategories;

        return $this;
    }


    public function getArtclNumOnCategory():array
    {
        return $this->artclNumOnCategories;
    }


    public function getArtclNumOnSubCategory():array
    {
        return $this->artclNumOnSubCategories;
    }

}
