<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 10:26
 */

//namespace Usako\Source\Controller;

// Loading Class
require_once('../src/model/PostManager.php');
require_once('../src/model/CommentManager.php');
require_once ('../src/model/MembersManager.php');
require_once ('../src/controller/Twig.php');


class Controller extends Twig
{
    public function listPosts()
    {
        $postManager = new PostManager(); // Create Object
        $posts = $postManager->getPosts(); // Call function of this Object
        echo $this->twig->render('frontend/listPostsView.twig',
            array('articles'=>$posts));
    }

    public function post()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        echo $this->twig->render('frontend/postView.twig',
            array('post'=>$post, 'comments'=>$comments));
    }

    public function addComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }

    public function login()
    {
        // require('../src/view/frontend/login.php');
        echo $this->twig->render('frontend/login.twig');
    }

    public function connect($login)
    {
        $membersManager = new MembersManager();
        $infos = $membersManager->connectInfos($login);
        return $infos;
    }

    public function register()
    {
        echo $this->twig->render('frontend/register.twig');
    }

    public function registered($pseudo, $password, $email)
    {
        $membersManager = new MembersManager();
        $infos = $membersManager->createMember($pseudo, $password, $email);
        if ($infos === false) {
            throw new Exception('Impossible de créer un compte, veuillez recommencer');
        }
    }

    public function admin()
    {
        echo $this->twig->render('backend/admin.twig');
    }

    public function addPost($title, $content)
    {
        $addPost = new PostManager();
        $infos = $addPost->addPost($title, $content);
        if ($infos === false) {
            throw new Exception('Impossible de créer l\'article, veuillez rééssayer');
        }
    }
}
