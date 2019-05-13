<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 11/05/2019
 * Time: 19:50
 */

require_once '../vendor/autoload.php';

class Twig
{
    protected $twig;

    function __construct()
    {
        // Twig Configuration
        $loader = new \Twig\Loader\FilesystemLoader('../src/view/');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false
        ]);

        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('post', $_POST);
        $this->twig->addGlobal('get', $_GET);
    }

}