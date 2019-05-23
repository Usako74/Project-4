<?php
namespace App\Model;

use Conf\Manager;

/**
 * Class MembersManager
 * @package App\Model
 */
class MembersManager extends Manager
{
    /**
     * @param $pseudo
     * @param $password
     * @param $email
     */
    public function createMember($pseudo, $password, $email)
    {
        $db = $this->dbConnect();
        $register = $db->prepare('INSERT INTO members(pseudo, password, email, inscription_date, group_id) VALUES(?, ?, ?, CURRENT_DATE, 0)');
        $register->execute(array($pseudo, $password, $email));
    }

    /**
     * @param $login
     * @return mixed
     */
    public function connectInfos($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, password, pseudo, group_id FROM members WHERE pseudo = ?');
        $req->execute(array($login));
        $infos = $req->fetch();
        return $infos;
    }

    /**
     * @param $login
     * @return mixed
     */
    public function checkPseudo($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(pseudo) AS result from members where pseudo = ?');
        $req->execute(array($login));
        $infos = $req->fetch();
        return $infos;
    }
}