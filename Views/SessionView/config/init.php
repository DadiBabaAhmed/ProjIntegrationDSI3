<?php

//session start
session_start();
//helper
require_once 'helpers/system_helper.php';


require_once '../../DataBase/config/config.php';
//autoload function
function my_autoload_register ($class_name) {
    $filename = '../../DataBase/' .$class_name. '.php';
    //$filename2 = '../../Classes/' .$class_name. '.php';
    
    if (file_exists($filename) == false) {
        return false;
    }
    require_once ($filename);
    //require_once ($filename2);
}

//Register the autoloader
spl_autoload_register('my_autoload_register');

// echo "spl_autoload_register is working";