<?php
namespace App\Models\Admin;

use CodeIgniter\Model;

class ALoginModel extends Model {
    // Admin Login Model

        /* Select */
        
    public function getLogin($userName,$password){
        $db = \Config\Database::connect();
        $MD5using					=	md5($password);
        $data = array(
            "userName" => $userName,
            "password" => $MD5using,
        );
        $result = $db->table("owner")->where($data)->countAllResults();
        if($result){
            $this->securityLoginClear($userName, $password);
        }
        return $result;
    }
    public function securityLogin($userName){
        $db = \Config\Database::connect();
        $data = array(
            "userName" => $userName,
        );
        $result = $db->table("owner")->select("securityStatus")->where($data)->get()->getRow();
        return $result;
    }

        /* Update */

    public function lastSecurityStatus($userName, $lastSecuritySum){
        $db = \Config\Database::connect();
        $data = array(
            "userName" => $userName,
        );
        $dataUp = array(
            "securityStatus" => $lastSecuritySum + 1
        );
        $result = $db->table("owner")->where($data)->update($dataUp);
        $result = $db->affectedRows();
        return $result;
    }
    public function securityLoginClear($userName,$password){
        $db = \Config\Database::connect();
        $MD5using					=	md5($password);
        $data = array(
            "userName" => $userName,
            "password" => $MD5using,
        );
        $dataUp = array(
            "securityStatus" => 0
        );
        $result = $db->table("owner")->where($data)->update($dataUp);
        $result = $db->affectedRows();
        return $result;
    }

        /* Check */

    public function securityLoginUp($lastSecurityStatus){
        $db = \Config\Database::connect();
        $data = array(
            "securityStatus" => ($lastSecurityStatus + 1),
        );
        $result = $db->table("owner")->where($data)->countAllResults();
        return $result;
    }
    public function checkSecurityLogin($userName){
        $db = \Config\Database::connect();
        $data = array(
            "userName" => $userName,
            "securityStatus<=" => 15
        );
        $result = $db->table("owner")->where($data)->countAllResults();
        return $result;
    }
}
