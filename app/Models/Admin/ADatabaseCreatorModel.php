<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ADatabaseCreatorModel extends Model
{
    // Admin Database Creator Model

    /* Product */

    public function createDatabaseProduct($language)
    {
        $forge = \Config\Database::forge();

        $fields = [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'text' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ProductID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                "unieuq"         => true
            ],
        ];
        $forge->addField($fields);
        $forge->addKey("id", TRUE);
        $forge->createTable('productdetails' . $language);

        return $this->databaseEnjectProduct();
    }
    public function databaseEnjectProduct()
    {
        $db = \Config\Database::connect();

        $result = $db->table("productdetailstr")->get()->getResult();
        return $result;
    }
    public function newDatabaseInsertProduct($language, $data)
    {
        $db = \Config\Database::connect();

        $result = $db->table("productdetails" . $language)->insert($data);
        return $result;
    }

    /* Menu */

    public function createDatabaseMenu($language)
    {
        $forge = \Config\Database::forge();

        $fields = [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'MenuID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                "unieuq"         => true
            ],
        ];
        $forge->addField($fields);
        $forge->addKey("id", TRUE);
        $forge->createTable('menudetails' . $language);

        return $this->databaseEnjectMenu();
    }
    public function databaseEnjectMenu()
    {
        $db = \Config\Database::connect();

        $result = $db->table("menudetailstr")->get()->getResult();
        return $result;
    }
    public function newDatabaseInsertMenu($language, $data)
    {
        $db = \Config\Database::connect();
        $result = $db->table("menudetails" . $language)->insert($data);
        return $result;
    }


    /* Min Language */

    public function addDatabaseMinLanguage($language)
    {
        $forge = \Config\Database::forge();

        $fields = [
            $language => [
                'type'           => 'TEXT',
            ],
        ];
        $forge->addColumn("minlanguage", $fields);

        return $this->databaseEnjectMinLanguage();
    }
    public function databaseEnjectMinLanguage()
    {
        $db = \Config\Database::connect();

        $result = $db->table("minlanguage")->select("tr as default")->get()->getResult();
        return $result;
    }
    public function newDatabaseInsertMinLanguage($id, $data)
    {
        $db = \Config\Database::connect();
        $result = $db->table("minlanguage")->where("id", $id)->update($data);
        return $result;
    }

    /* Deleted */

    public function deleteDatabase($language)
    {
        if (!($language == "tr")) {
            $forge = \Config\Database::forge();

            if ($result = $forge->dropTable('menudetails' . $language)) {
                if ($result = $forge->dropTable('productdetails' . $language)) {
                    if ($result = $forge->dropTable('extraproductdetails' . $language)) {
                        if ($result = $forge->dropColumn("minlanguage", $language)) {
                            return $result;
                        }
                    }
                }
            }
            return $result;
        } else {
            return "2";
        }
    }
}
