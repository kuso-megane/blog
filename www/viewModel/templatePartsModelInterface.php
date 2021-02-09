<?php

namespace myapp\viewModel;

interface TemplatePartsModelInterface
{
    /**
     * get Data for views from Model
     * @param array|NULL $vars
     * 
     * @return TemplatePartsModelInterface
     */
    public function getDataFromModel(): TemplatePartsModelInterface;
}