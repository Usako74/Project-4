<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 09:22
 */
require('controller/frontend.php');
try {
    if (isset($_GET['action'])) {


        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }


        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }


        elseif ($_GET['action'] == 'login') {
            login();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                    $infos = connect($_POST['pseudo']);
                    $passwordOk = password_verify($_POST['password'], $infos['password']);

                    if (!$passwordOk) {
                        throw new Exception( 'Mauvais identifiant ou mot de passe ! erreur 1');
                    } else {
                        if ($passwordOk) {
                            $_SESSION['id'] = $infos['id'];
                            $_SESSION['pseudo'] = $infos['pseudo'];
                            echo 'Vous êtes connecté en tant que ' . $_SESSION['pseudo'] . ' !';
                        } else {
                            throw new Exception('Mauvais identifiant ou mot de passe ! erreur 2');
                        }
                    }
                }
            }
        }


        elseif ($_GET['action'] == 'register') {
            register();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])) {

                    $passwordOk = ($_POST['password'] === $_POST['password2']);
                    if (!$passwordOk) {
                        throw new Exception( 'Les mots de passe ne sont pas identiques');
                    } else {
                        if ($passwordOk) {
                            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            $infos = registered($_POST['pseudo'], $passwordHash, $_POST['email']);
                            $infos2 = connect($_POST['pseudo']);
                            $_SESSION['id'] = $infos2['id'];
                            $_SESSION['pseudo'] = $infos2['pseudo'];
                            echo 'Enregistrement Réussi ! <br> Vous êtes connecté en tant que ' . $_SESSION['pseudo'] . ' !';
                        } else {
                            throw new Exception('Une erreur est survenue, veuillez recommencer');
                        }
                    }
                }
            }
        }


        elseif ($_GET['action'] == 'disconnect') {
            session_start();
            $_SESSION = array();
            session_destroy();
            setcookie('login', '');
            setcookie('password_hache', '');
            listPosts();
        }


        elseif ($_GET['action'] == 'admin') {
            admin();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    addPost($_POST['title'], $_POST['content']);
                    echo 'Article envoyé !';
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }


        else {
            listPosts();
        }
    }


    else {
        listPosts();
    }
}
catch (Exception $e) {
    echo 'Une erreur s\'est produite : <br>' . $e->getMessage();
}