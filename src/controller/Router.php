<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 09:22
 */

namespace App\Controller;
use \App\Controller\Controller;

//require('Controller.php');

class Router extends Controller
{
    public function run()
    {
        try {
            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'listPosts') {
                    $this->listPosts();
                } elseif
                ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->post();
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            $this->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                        } else {
                            throw new Exception('Tous les champs ne sont pas remplis !');
                        }
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif ($_GET['action'] == 'login') {
                    if (isset($_SESSION['pseudo'])) {
                        $this->listPosts();
                    } else {
                        $this->login();
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                                $infos = $this->connect($_POST['pseudo']);
                                $passwordOk = password_verify($_POST['password'], $infos['password']);

                                if (!$passwordOk) {
                                    throw new Exception('Mauvais identifiant ou mot de passe !');
                                } else {
                                    if ($passwordOk) {
                                        $_SESSION['id'] = $infos['id'];
                                        $_SESSION['pseudo'] = $infos['pseudo'];
                                        $_SESSION['group_id'] = $infos['group_id'];
                                        header('Location: index.php');
                                    }
                                }
                            }
                        }
                    }
                } elseif ($_GET['action'] == 'register') {
                    if (isset($_SESSION['pseudo'])) {
                        $this->listPosts();
                    } else {
                        $this->register();
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])) {
                                if ($this->checkPseudo($_POST['pseudo']) == 0){
                                    $passwordOk = ($_POST['password'] === $_POST['password2']);
                                    if (!$passwordOk) {
                                        throw new Exception('Les mots de passe ne sont pas identiques');
                                    } else {
                                        if ($passwordOk) {
                                            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                            $infos = $this->registered($_POST['pseudo'], $passwordHash, $_POST['email']);
                                            $infos2 = $this->connect($_POST['pseudo']);
                                            $_SESSION['id'] = $infos2['id'];
                                            $_SESSION['pseudo'] = $infos2['pseudo'];
                                            $_SESSION['group_id'] = $infos2['group_id'];
                                            header('Location: index.php');
                                        }
                                    }
                                } else {
                                    throw new Exception('Cet identifiant existe déjà');
                                }
                            } else {
                                throw new Exception('Une erreur est survenue, veuillez recommencer');
                            }
                        }
                    }
                } elseif ($_GET['action'] == 'disconnect') {
                    if (isset($_SESSION['pseudo'])) {
                        $_SESSION = array();
                        session_destroy();
                        setcookie('login', '');
                        setcookie('password_hache', '');
                        header('Location: index.php');
                    } else {
                        $this->listPosts();
                    }
                } elseif ($_GET['action'] == 'createarticle') {
                    if (isset($_SESSION['pseudo']) && $_SESSION['group_id'] == 1) {
                        $this->admin();
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                                $this->addPost($_POST['title'], $_POST['content']);
                                echo 'Article envoyé !';
                            } else {
                                throw new Exception('Tous les champs ne sont pas remplis !');
                            }
                        }
                    } else {
                        $this->listPosts();
                    }
                } elseif ($_GET['action'] == 'moderate') {
                    if (isset($_SESSION['pseudo']) && $_SESSION['group_id'] == 1) {
                        $this->moderate();
                    } else {
                        $this->listPosts();
                    }
                }elseif ($_GET['action'] == 'deleteComment') {
                    if (isset($_SESSION['pseudo']) && $_SESSION['group_id'] == 1) {
                        $this->deleteComment($_GET['id']);
                    } else {
                        $this->listPosts();
                    }
                } elseif ($_GET['action'] == 'report') {
                    $this->reportComment($_GET['report'], $_GET['id']);
                    header('Location: index.php');
                } else {
                    $this->listPosts();
                }
            } else {
                $this->listPosts();
            }
        } catch (Exception $e) {
            echo 'Une erreur s\'est produite : <br>' . $e->getMessage();
        }
    }
}