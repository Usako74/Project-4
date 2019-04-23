<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 10:26
 */
// Loading Class
require_once('model/PostManager.php');

function listPosts()
{
    $postManager = new PostManager(); // Create Object
    $posts = $postManager->getPost(); // Call function of this Object
    require('view/frontend/listPostsView.php');
}