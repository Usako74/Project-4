<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 30/04/2019
 * Time: 17:22
 */

namespace App\Model;

use Conf\Manager;

class CommentManager extends Manager
{
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, comment_report) VALUES(?, ?, ?, NOW(), 0)');
        $comments->execute(array($postId, $author, $comment));
    }

    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, comment_report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function getReportsComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, comment_report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE comment_report = 1 ORDER BY comment_date DESC');
        $comments->execute();
        return $comments;
    }

    public function reportComment($report, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment_report = ? WHERE id = ?');
        $req->execute(array($report, $id));
    }

    public function deleteComment($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?;');
        $req->execute(array($id));
        $infos = $req->fetch();
        return $infos;
    }
}
