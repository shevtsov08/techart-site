<?php 

require __DIR__ . '/../vendor/autoload.php';
require "../config/config.php";
require_once __DIR__ . '/bootstrap.php';
require CORE . '/function.php';



$router = new \techart\Router();
require CONFIG . '/routes.php';
$router->match();