<?php
namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model {
    // Language Model

        /* Select */

    public $table       = "language";
    public $minTable    = "minlanguage";

    public function getLanguage($id){
        $db = \Config\Database::connect();
        $data = array(
            "id" => $id
        );
        $result = $db->table($this->table)->where($data)->get()->getRow();
        return $result;
    }
    public function getLanguages(){
        $db = \Config\Database::connect();
        $result = $db->table($this->table)->get()->getResult();
        return $result;
    }
    public function getsActiveLanguage(){
        $db = \Config\Database::connect();
        $data = array(
            "active" => 1
        );
        $result = $db->table($this->table)->where($data)->get()->getResult();
        return $result;
    }
    /*
        Min Language
    */

    public function getMinLanguage($id, $selectData){
        $db = \Config\Database::connect();
        $data = array(
            "id" => $id
        );
        $result = $db->table($this->minTable)->select("$selectData as nameSet")->where($data)->get()->getRow();
        return $result;
    }
    public function getMinLanguages(){
        $db = \Config\Database::connect();
        $result = $db->table($this->minTable)->get()->getResult();
        return $result;
    }

}
