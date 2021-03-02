<?php 


const VIEW_FILE_PATH = '/var/www/html/views/';

/**
 * This renders views/{controller}/{action}.php 
 * 
 * @param array $vm used in viewFile
 * @param string $controller
 * @param string $action
 * 
 * @return void
 */
function render(array $vm, string $controller, string $action)
{
    
    
    
    require VIEW_FILE_PATH. $controller. '/'. $action. '.php';
}