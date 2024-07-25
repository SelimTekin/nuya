<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ALanguageModel extends Model
{
    // Admin Language Model


        /* Update */
        
    public function updLanguageActiveted($id){
        $db = \Config\Database::connect();

        $data = array(
            "active" => 1
        );

        $result = $db->table("language")->where("id", $id)->update($data);
        return $result;
    }
    public function updLanguageDeActiveted($id){
        $db = \Config\Database::connect();

        $data = array(
            "active" => 0
        );

        $db = \Config\Database::connect();
        $result = $db->table("language")->where("id", $id)->update($data);
        return $result;
    }

    // Min Language
    public function updMinLanguage($id, $newText, $languageCode){
        $db = \Config\Database::connect();

        $data = array(
            $languageCode => $newText
        );

        $result = $db->table("minlanguage")->where("id", $id)->update($data);
        return $result;
    }

}

