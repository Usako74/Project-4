<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 10:26
 */
// Loading Class
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once ('model/MembersManager.php');

function listPosts()
{
    $postManager = new PostManager(); // Create Object
    $posts = $postManager->getPosts(); // Call function of this Object
    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function login()
{
    require('view/backend/login.php');
}

function connect($login)
{
    $membersManager = new MembersManager();
    $infos = $membersManager->connectInfos($login);

    return $infos;
}

function register() {
    require('view/backend/register.php');
}

function registered($pseudo, $password, $email) {
    $membersManager = new MembersManager();
    $infos = $membersManager->createMember($pseudo, $password, $email);
    if ($infos === false) {
        throw new Exception('Impossible de créer un compte, veuillez recommencer');
    }
}

function admin() {
    require('view/backend/admin.php');
}

function addPost($title, $content) {
    $addPost = new PostManager();
    $infos = $addPost->addPost($title, $content);
    if ($infos === false) {
        throw new Exception('Impossible de créer l\'article, veuillez rééssayer');
    }
}

