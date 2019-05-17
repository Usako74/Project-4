<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 08/05/2019
 * Time: 08:32
 */

use \App\Controller\Router;
session_start();

//autoload
require_once dirname(__DIR__).'/vendor/autoload.php';

//require_once('../src/controller/Router.php');



$router = new Router();
$router->run();