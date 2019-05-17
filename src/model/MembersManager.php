<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 02/05/2019
 * Time: 09:35
 */

namespace App\Model;

use Conf\Manager;


class MembersManager extends Manager
{
    public function createMember($pseudo, $password, $email)
    {
        $db = $this->dbConnect();
        $register = $db->prepare('INSERT INTO members(pseudo, password, email, inscription_date, group_id) VALUES(?, ?, ?, CURRENT_DATE, 0)');
        $register->execute(array($pseudo, $password, $email));
    }

    public function connectInfos($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, password, pseudo, group_id FROM members WHERE pseudo = ?');
        $req->execute(array($login));
        $infos = $req->fetch();
        return $infos;
    }

    public function checkPseudo($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(pseudo) from members where pseudo = ?');
        $req->execute(array($login));
        $infos = $req->fetch();
        return $infos;
    }
}