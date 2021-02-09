<?php

namespace myapp\viewModel;

interface ViewPartsModelInterface
{
    /**
     * get Data for views from Model
     * @param array|NULL $vars
     * 
     * @return ViewModelInterface
     */
    public function getDataFromModel(): ViewPartsModelInterface;
}