<?php

namespace myapp\viewModel;

interface ViewModelInterface
{
    // These consts must be defined in concrete class except templateParts viewModel
    /*
    const TEMPLATE_FILE = 'template/{class}Template.php';
    const CLASSNAME = {class};
    const ACTION = {action};
    */

    public function __construct(array $data);
}