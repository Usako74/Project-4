<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 02/05/2019
 * Time: 09:35
 */

require_once("model/Manager.php");

class MembersManager extends Manager
{
    public function createMember($pseudo, $password, $email)
    {
        $db = $this->dbConnect();
        $register = $db->prepare('INSERT INTO members(pseudo, password, email, inscription_date) VALUES(?, ?, ?, CURRENT_DATE)');
        $register->execute(array($pseudo, $password, $email));
    }

    public function connectInfos($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, password, pseudo FROM members WHERE pseudo = ?');
        $req->execute(array($login));
        $infos = $req->fetch();
        return $infos;
    }
}