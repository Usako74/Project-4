<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 08/05/2019
 * Time: 08:32
 */

//use \Usako\Source\Controller;
session_start();
require_once('../src/controller/Router.php');

$router = new Router();
$router->run();