<?php
namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model {
    // Category Model

    // Product Model
    public $joined;
        /* Select */
    public function __construct($tr = "")
    {
        helper("googleTranslate");

        $language = detectedLanguage();
        if($tr == ""){
            if($language){
                $this->joined = "menudetails" . $language . " as md";
            }else{
                $this->joined = "menudetailstr as md";
            }
        }else{
            $this->joined = "menudetails" . $tr . " as md";
        }
    }
        /* Select */

    public function getCategory($id){
        $db = \Config\Database::connect();
        $data = array(
            "menu.id" => $id
        );
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->where($data)->limit(1)->get()->getRow();
        return $result;
    }
    public function getCategories(){
        $db = \Config\Database::connect();
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->orderBy("menu.AltID ASC, menu.id ASC")->get()->getResult();
        return $result;
    }
    public function getCategoryDetails($MenuID, $language){
        $db = \Config\Database::connect();
        $lastData = array(
            "MenuID"  => $MenuID,
        );
        $result = $db->table("menudetails" . $language)->where($lastData)->get()->getRow();
        return $result;
    }
    public function getOurPackagesID($id){
        $db = \Config\Database::connect();
        $data = array(
            "menu.AltID" => $id
        );
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->orderBy("menu.id", "ASC")->where($data)->get()->getResult();
        return $result;
    }
    public function getOurAll($id = 1){
        $Product = new ProductModel();

        $menus = $this->getOurPackagesID($id);
        $menuAll = [];
        foreach($menus as $menu){
            if($menu->rumuz == 1){
                $products = $Product->getProductsFM($menu->id);
                $menuProducts = [];
                foreach($products as $product){
                    $menuProducts[] = $product;
                }
                $menuAll[] = ["Menu" => $menu, "Content" => $menuProducts];
            }else{
                $menuMenu =  $this->getOurAll($menu->id);
                $menuAll[] = ["Menu" => $menu, "Content" => $menuMenu];
            }
        }
        return $menuAll;
    }
    public function getOurPackages(){
        $db = \Config\Database::connect();
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->orderBy("menu.id", "ASC")->get()->getResult();
        return $result;
    }
    public function getOurPackageLink($link){
        $db = \Config\Database::connect();
        $data = array(
            "menu.link" => $link
        );
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->where($data)->get()->getRow();
        return $result;
    }
    public function getProductTopID($id){
        $db = \Config\Database::connect();
        $data = array(
            "MenuID" => $id
        );
        $result = $db->table("product")->where($data)->get()->getResult();
        return $result;
    }
    public function getLikeProduct($query){
        $db = \Config\Database::connect();
        $result = $db->table("product")->like("name",$query)->get()->getResult();
        return $result;
    }
    public function getCategoriesAltID($AltID){
        $db = \Config\Database::connect();
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->where("menu.AltID", $AltID)->orderBy("menu.id", "ASC")->get()->getResult();
        return $result;
    }
    public function getCategoriesforCategory(){
        $db = \Config\Database::connect();
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->where("menu.rumuz",0)->orderBy("menu.AltID", "ASC")->get()->getResult();
        return $result;
    }
    public function getCategoriesforProduct(){
        $db = \Config\Database::connect();
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->where("menu.rumuz",1)->orderBy("menu.AltID", "ASC")->get()->getResult();
        return $result;
    }

    public function getCategoriesOnlyProducts(){
        $db = \Config\Database::connect();
        $data = array(
            "rumuz" => "1"
        );
        $result = $db->table("menu")->join($this->joined, "md.MenuID = menu.id")->orderBy("menu.AltID ASC, menu.id ASC")->where($data)->get()->getResult();
        return $result;
    }
}

?>