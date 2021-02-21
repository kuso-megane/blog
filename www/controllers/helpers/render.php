<?php 

use domain\BaseViewModel;

const VIEW_FILE_PATH = '/var/www/html/views/';

/**
 * This renders views/{controller}/{action}.php via views/templates/{controller}Template.php
 * 
 * @param BaseViewModel $vm used in viewFile
 * @param string $controller
 * @param string $action
 * 
 * @return void
 */
function render(BaseViewModel $vm, string $controller, string $action)
{
    
    $mainView = VIEW_FILE_PATH. $controller. '/'. $action. '.php'; // absolute path to main view file, used in viewFile
    
    require VIEW_FILE_PATH. 'templates/'. $controller. 'Template.php';
}