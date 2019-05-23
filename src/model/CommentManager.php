<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 30/04/2019
 * Time: 17:22
 */

namespace App\Model;

use Conf\Manager;

/**
 * Class CommentManager
 * @package App\Model
 */
class CommentManager extends Manager
{
    /**
     * @param $postId
     * @param $author
     * @param $comment
     */
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, comment_report) VALUES(?, ?, ?, NOW(), 0)');
        $comments->execute(array($postId, $author, $comment));
    }

    /**
     * @param $postId
     * @return bool|\PDOStatement
     */
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, comment_report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    /**
     * @return bool|\PDOStatement
     */
    public function getReportsComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, comment, comment_report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE comment_report = 1 ORDER BY comment_date DESC');
        $comments->execute();
        return $comments;
    }

    /**
     * @param $report
     * @param $id
     * @param $postId
     */
    public function reportComment($report, $id, $postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment_report = ? WHERE id = ? AND post_id = ?');
        $req->execute(array($report, $id, $postId));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?;');
        $req->execute(array($id));
        $infos = $req->fetch();
        return $infos;
    }

    /**
     * @param $postId
     * @return mixed
     */
    public function deleteComments($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE post_id = ?;');
        $req->execute(array($postId));
        $infos = $req->fetch();
        return $infos;
    }
}
