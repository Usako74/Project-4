<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 11/05/2019
 * Time: 19:50
 */

namespace App\Controller;

require_once '../vendor/autoload.php';

/**
 * Class Twig
 * @package App\Controller
 */
class Twig
{
    /**
     * @var \Twig\Environment
     */
    protected $twig;

    /**
     * Twig constructor.
     */
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
        $this->twig->addFilter( new \Twig\TwigFilter('nl2br', 'nl2br', ['is_safe' => ['html']]));
    }

}