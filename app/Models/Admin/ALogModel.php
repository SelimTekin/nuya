<?php
namespace App\Models\Admin;

use CodeIgniter\Model;
use DateTime;

class ALogModel extends Model {
    // Admin Log Model
    public $ownerCanNums   = ["Giriş Yaptı", "Okuyor", "Güncelledi", "Ekledi", "Sildi", "Çıkış yaptı."];

        /* Select */
        
    public function getLogs(){
        $db = \Config\Database::connect();
        $result = $db->table("log")->orderBy("ownerWhen","DESC")->get()->getResult();
        return $result;
    }  
    public function getLog($ownerName){
        $db = \Config\Database::connect();
        $data = array(
            "ownerName" => $ownerName
        );
        $result = $db->table("log")->where($data)->orderBy("ownerWhen","desc")->get()->getResult();
        return $result;
    }  

        /* Add */
        
    public function setLog(){ // Login: 0, Read: 1, Update: 2, İnsert: 3, Delete: 4, Leave: 5
        $db             = \Config\Database::connect();
        date_default_timezone_set('Europe/Istanbul');
        $time           = new DateTime();
        $ownerCan       = "Sitesinde Geziyor..."; 


        $ownerWhere     = $_SERVER["PHP_SELF"]; 
        $expOwnerWhere  = explode("/", $ownerWhere);
        $expOwnerOne     = $expOwnerWhere[(count($expOwnerWhere)-1)];
        $expOwnerTwo     = $expOwnerWhere[(count($expOwnerWhere)-2)];
        $expOwnerThree   = $expOwnerWhere[(count($expOwnerWhere)-3)];

        // fix show log
        if($expOwnerOne == "add_result"){
            $ownerCan = "Sitesinde bir şey ekledi...";
        }else if($expOwnerTwo == "update_result"){
            $ownerCan = "Sitesinde bir şeyi güncelledi...";
        }else if($expOwnerTwo == "delete_result"){
            $ownerCan = "Sitesinde bir şeyi sildi...";
        }else if($expOwnerTwo == "board"){
            $ownerCan = "Giriş yaptı.";
        }else if($expOwnerOne == "leave"){
            $ownerCan = "Çıkış yaptı.";
        }

        // fix show log
        if($expOwnerThree == "index.php"){
            $expOwnerThree = "";
        }else if($expOwnerTwo == "index.php"){
            $expOwnerThree = "";
            $expOwnerTwo = "";
        }

        // fix show log
        if(isset($_SESSION["Fowner"])){
            $ownerName = $_SESSION["Fowner"];
        }else{
            $ownerName = $_SERVER["REMOTE_ADDR"];
            $ownerCan  = "Sitesine girmeye çalıştı...";
        }
        $data = array(
            "ownerName"     => $ownerName,
            "ownerWhere"    => $ownerWhere,
            "ownerCan"      => "'". $expOwnerThree . " " . $expOwnerTwo . " " . $expOwnerOne . "' " . $ownerCan,
            "ownerWhen"     => $time->format('Y-m-d H:i:s')
        );
        $result = $db->table("log")->insert($data);
        return $result;
    }

        /* Delete */
  
    public function delLog($ownerName){ 
        $db = \Config\Database::connect();
        $data = array(
            "ownerName" => $ownerName
        );
        $result = $db->table("log")->where($data)->delete();
        $result = $db->affectedRows();
        return $result;
    }
    public function delLogs(){ 
        $db = \Config\Database::connect();
        $data = array(
            "id>" => 0
        );
        $result = $db->table("log")->where($data)->delete();
        $result = $db->affectedRows();
        return $result;
    }
}

?>