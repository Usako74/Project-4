<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 18:02
 */

//namespace Usako\Source\Model;

require_once("../config/Manager.php");
//use \Usako\Config;

class PostManager extends Manager
{
    public function addPost($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(author, title, content, created_date_time) VALUES(\'Usako\', ?, ?, NOW())');
        $req->execute(array($title, $content));
        $infos = $req->fetch();
        return $infos;
    }

    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, title, content, DATE_FORMAT(created_date_time, \'%d/%m/%Y à %Hh%imin%ss\') AS create_date_fr FROM posts ORDER BY created_date_time DESC LIMIT 0, 5');
        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(created_date_time, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public function updatePost($title, $content, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, created_date_time = NOW() WHERE id = ?');
        $req->execute(array($title, $content, $id));
        $infos = $req->fetch();
        return $infos;
    }
}