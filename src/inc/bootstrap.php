<?php

define("PROJECT_ROOT_PATH", str_replace("\\","/",__DIR__) . "/../");
//define("PROJECT_ROOT_PATH", realpath(__DIR__ . '/..'));
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "/Controller/BaseController.php";
 
// include the use model file
require_once PROJECT_ROOT_PATH . "/Model/ProductsModel.php";
?>