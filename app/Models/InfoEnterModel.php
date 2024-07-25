<?php
namespace App\Models;

use CodeIgniter\Model;

class InfoEnterModel extends Model {
    // Info Enter Model

        /* Select */

    public function getInfoUniqueUserForDay(){
        $db = \Config\Database::connect();
        date_default_timezone_set('Europe/Istanbul');
        $timeStart = mktime(0,0,0,date("m", time()),date("d", time()),date("Y", time()));

        $data = array(
            "userTime >" => $timeStart,
            "userTime <" => $timeStart + 86400,
        );
        $result = $db->table("infoenter")->select("userIP")->distinct()->where($data)->countAllResults();
        return $result;
    }
    public function getInfoUserForDay(){
        $db = \Config\Database::connect();
        date_default_timezone_set('Europe/Istanbul');
        $timeStart = mktime(0,0,0,date("m", time()),date("d", time()),date("Y", time()));

        $data = array(
            "userTime >" => $timeStart,
            "userTime <" => $timeStart + 86400,
        );
        $result = $db->table("infoenter")->where($data)->countAllResults();
        return $result;
    }
    public function getInfoUsers(){
        $db = \Config\Database::connect();

        $result = $db->table("infoenter")->countAllResults();
        return $result;
    }
    public function getInfoUniqueUsers(){
        $db = \Config\Database::connect();

        $result = $db->table("infoenter")->select("userIP")->distinct()->countAllResults();
        return $result;
    }


        /* Update */
    public function setInfo($userIP, $userWhere, $userBrowser, $userTime){
        $db = \Config\Database::connect();
        $data = array(
            "userIP"        => $userIP,
            "userWhere"     => $userWhere,
            "userBrowser"   => $userBrowser,
            "userTime"      => $userTime,
        );
        $result = $db->table("infoenter")->insert($data);
        return $result;
    }
}

?>