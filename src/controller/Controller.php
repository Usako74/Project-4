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

/**
 * Class Controller
 * @package App\Controller
 */
class Controller extends Twig
{
    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function listPosts()
    {
        $postManager = new PostManager(); // Create Object
        $posts = $postManager->getPosts(); // Call function of this Object
        echo $this->twig->render('frontend/listPostsView.twig',
            array('articles'=>$posts));
    }

    /**
     * @param $author
     * @param $title
     * @param $content
     */
    public function addPost($author, $title, $content)
    {
        $addPost = new PostManager();
        $addPost->addPost($author, $title, $content);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function post()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        echo $this->twig->render('frontend/postView.twig',
            array('post'=>$post, 'comments'=>$comments));
    }


    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function modifyPost()
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);
        echo $this->twig->render('backend/modify.twig',
            array('post'=>$post));
    }

    /**
     * @param $title
     * @param $content
     * @param $id
     */
    public function updatePost($title, $content, $id)
    {
        $postManager = new PostManager();
        $postManager->updatePost($title, $content, $id);
    }

    /**
     * @param $id
     * @param $postId
     */
    public function deletePost($id, $postId)
    {
        $deletePost = new PostManager();
        $deletePost-> deletePost($id);
        $deleteComments = new CommentManager();
        $deleteComments->deleteComments($postId);
    }

    /**
     * @param $postId
     * @param $author
     * @param $comment
     * @throws \Exception
     */
    public function addComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();

        $postComment = $commentManager->postComment($postId, $author, $comment);

        if ($postComment === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id='.$postId.'#comments');
        }
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function login()
    {
        echo $this->twig->render('frontend/login.twig');
    }

    /**
     * @param $login
     * @return mixed
     */
    public function connect($login)
    {
        $membersManager = new MembersManager();
        $infos = $membersManager->connectInfos($login);
        return $infos;
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function register()
    {
        echo $this->twig->render('frontend/register.twig');
    }

    /**
     * @param $login
     * @return mixed
     */
    public function checkPseudo($login)
    {
        $membersManager = new MembersManager();
        $infos = $membersManager->checkPseudo($login);
        return $infos;
    }

    /**
     * @param $pseudo
     * @param $password
     * @param $email
     * @throws \Exception
     */
    public function registered($pseudo, $password, $email)
    {
        $membersManager = new MembersManager();
        $infos = $membersManager->createMember($pseudo, $password, $email);
        if ($infos === false) {
            throw new \Exception('Impossible de créer un compte, veuillez recommencer');
        }
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function admin()
    {
        echo $this->twig->render('backend/admin.twig');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function moderate()
    {
        $getReportComment = new CommentManager();
        $infos = $getReportComment->getReportsComments();
        echo $this->twig->render('backend/moderate.twig',
            array('comments'=>$infos));
    }

    /**
     * @param $id
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public  function deleteComment($id)
    {
        $getReportComment = new CommentManager();
        $infos = $getReportComment->deleteComment($id);
        echo $this->twig->render('backend/moderate.twig',
            array('delete'=>$infos));
    }

    /**
     * @param $report
     * @param $id
     * @param $postId
     */
    public function reportComment($report, $id, $postId)
    {
        $reportComment = new CommentManager();
        $reportComment->reportComment($report, $id, $postId);
    }

    public function contact(){
        echo $this->twig->render('frontend/contact.twig');

        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $name = htmlentities($_POST['name']);
            $firstname = htmlentities($_POST['firstname']);
            $email = htmlentities($_POST['email']);
            $subject = htmlentities($_POST['subject']);
            $message = nl2br(htmlentities($_POST['message']));
            $to = 'ophelie.bourdon@gmail.com';
            $content = '<html lang="fr"><head></head><body><p>Vous avez reçu un message du site Billet Simple pour L\'Alaska.<br> Voici les informations et le contenu:</p><p>Nom: '.$name.'<br>Prénom: '.$firstname.'<br>E-Mail: '.$email.'<br>Sujet: '.$subject.'<br>Message: <br>'.$message.'</p></body></html>';

            $header = 'MIME-Version: 1.0'."\r\n";
            $header .= 'Content-type: text/html; charset=utf-8'."\r\n";
            $header .= 'From: <ophelie.bourdon@gmail.com>'."\r\n";

            mail($to, $subject, $content, $header);
            echo htmlspecialchars('Votre méssage a été envoyé');
        }
    }
}
