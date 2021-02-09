<?php

namespace myapp\viewModel;

interface ViewModelInterface
{
    // const VIEW_FILE = '{class}/{action}.php';

    /**
     * get Data for views from Model
     * @param array|NULL $vars
     * 
     * @return ViewModelInterface
     */
    public function getDataFromModel(?array $vars): ViewModelInterface;
}