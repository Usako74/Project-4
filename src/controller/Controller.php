<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 10:26
 */

namespace App\Controller;

// Loading Class
use App\Model\PostManager;
use App\Model\CommentManager;
use App\Model\MembersManager;

class Controller extends Twig
{
    public function listPosts()
    {
        $postManager = new PostManager(); // Create Object
        $posts = $postManager->getPosts(); // Call function of this Object
        echo $this->twig->render('frontend/listPostsView.twig',
            array('articles'=>$posts));
    }

    public function addPost($author, $title, $content)
    {
        $addPost = new PostManager();
        $addPost->addPost($author, $title, $content);
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

    public function modifyPost()
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);
        echo $this->twig->render('backend/modify.twig',
            array('post'=>$post));
    }

    public function updatePost($title, $content, $id)
    {
        $postManager = new PostManager();
        $post = $postManager->updatePost($title, $content, $id);
    }

    public function addComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
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
            throw new \Exception('Impossible de créer un compte, veuillez recommencer');
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

    public function reportComment($report, $id)
    {
        $reportComment = new CommentManager();
        $reportComment->reportComment($report, $id);
    }

}
