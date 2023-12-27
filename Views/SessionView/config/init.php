<?php

//session start
session_start();
//helper
require_once 'helpers/system_helper.php';


require_once 'config/config.php';
//autoload function
function my_autoload_register ($class_name) {
    $filename = 'lib/' .$class_name. '.php';
    
    if (file_exists($filename) == false) {
        return false;
    }
    require_once ($filename);
}

//Register the autoloader
spl_autoload_register('my_autoload_register');

// echo "spl_autoload_register is working";