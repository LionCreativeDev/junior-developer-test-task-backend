<?php

use src\Controller as controller;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require __DIR__ . "/src/inc/bootstrap.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
 
if ((isset($uri[3]) && $uri[3] != 'products') || !isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
 
require PROJECT_ROOT_PATH . "/Controller/ProductsController.php";
 
$objFeedController = new controller\ProductsController();
$strMethodName = $uri[4] . 'Action';
$objFeedController->{$strMethodName}();
?>