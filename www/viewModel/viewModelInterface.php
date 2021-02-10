<?php

namespace myapp\viewModel;

interface ViewModelInterface
{
    // These consts must be defined in concrete class except templateParts viewModel
    /*
    const TEMPLATE_FILENAME = string;
    const MAIN_FILENAME = string;
    */

    public function __construct(array $data);
}