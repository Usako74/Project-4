<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 10:26
 */

namespace App\Controller;

// Loading Class
use \App\Model\PostManager;
use \App\Model\CommentManager;
use \App\Model\MembersManager;
use \App\Controller\Twig;
//require_once('../src/model/PostManager.php');
//require_once('../src/model/CommentManager.php');
//require_once ('../src/model/MembersManager.php');
//require_once ('../src/controller/Twig.php');


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

    public function checkPseudo($login)
    {
        $membersManager = new MembersManager();
        $infos = $membersManager->checkPseudo($login);
        return $infos;
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

    public function moderate()
    {
        $getReportComment = new CommentManager();
        $infos = $getReportComment->getReportsComments();
        echo $this->twig->render('backend/moderate.twig',
            array('comments'=>$infos));
    }

    public  function deleteComment($id)
    {
        $getReportComment = new CommentManager();
        $infos = $getReportComment->deleteComment($id);
        echo $this->twig->render('backend/moderate.twig',
            array('delete'=>$infos));
    }

    public function addPost($title, $content)
    {
        $addPost = new PostManager();
        $infos = $addPost->addPost($title, $content);
        if ($infos === false) {
            throw new Exception('Impossible de créer l\'article, veuillez rééssayer');
        }
    }

    public function reportComment($report, $id)
    {
        $reportComment = new CommentManager();
        $infos = $reportComment->reportComment($report, $id);
    }

}
