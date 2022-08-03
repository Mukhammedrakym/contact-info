<?php
require 'app/lib/debug.php';
use app\core\Router;
use app\lib\Database;

spl_autoload_register(function ($sClass) {
    $sPath = str_replace('\\', '/', $sClass . '.php');
    if (file_exists($sPath)) {
        require $sPath;
    }
});

session_start();

$oRouter = new Router();
$oRouter->run();