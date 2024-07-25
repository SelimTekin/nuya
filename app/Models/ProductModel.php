<?php
namespace App\Models;

use CodeIgniter\Model;

helper("googleTranslate");

class ProductModel extends Model {
    protected $table = 'product';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'link', 'price', 'count', 'image'];

    // Product Model
    public $joined;
        /* Select */
    public function __construct($tr = "")
    {
        helper("googleTranslate");

        $language = detectedLanguage();
        if($tr == ""){
            if($language){
                $this->joined = "productdetails" . $language . " as pd";
            }else{
                $this->joined = "productdetailstr as pd";
            }
        }else{
            $this->joined = "productdetails" . $tr . " as pd";
        }
    }

    public function getProduct($id){
        $db = \Config\Database::connect();
        $data = array(
            "product.id" => $id
        );
        $result = $db->table("product")->join($this->joined, "pd.ProductID = product.id")->where($data)->get()->getRow();
        return $result;
    }
    public function getProducts(){
        $db = \Config\Database::connect();
        $result = $db->table("product")->join($this->joined, "pd.ProductID = product.id")->orderBy("product.id", "ASC")->get()->getResult();
        return $result;
    }
    public function getProductDetails($ProductID, $language){
        $db = \Config\Database::connect();
        $lastData = array(
            "ProductID"  => $ProductID,
        );
        $result = $db->table("productdetails" . $language)->where($lastData)->get()->getRow();
        return $result;
    }
    public function getProductsFM($MenuID){
        $db = \Config\Database::connect();
        $data = array(
            "product.MenuID" => $MenuID
        );
        $result = $db->table("product")->join($this->joined, "pd.ProductID = product.id")->where($data)->orderBy("product.id", "ASC")->get()->getResult();
        return $result;
    }

    public function getProductsFOne(){
        $db = \Config\Database::connect();
        $dataf = array(
            "AltID !=" => 0
        );
        $menuData = $db->table("menu")->where($dataf)->limit(1)->get()->getRow();
        $data = array(
            "product.MenuID" => $menuData->id
        );
        $result = $db->table("product")->join($this->joined, "pd.ProductID = product.id")->orderBy("product.id", "ASC")->where($data)->get()->getResult();
        return $result;
    }
    public function getProductLink($link){
        $db = \Config\Database::connect();
        $data = array(
            "product.link" => $link
        );
        $result = $db->table("product")->join($this->joined, "pd.ProductID = product.id")->where($data)->get()->getRow();
        return $result;
    }
    public function getProductKey($word){
        $db = \Config\Database::connect();
        
        $result = $db->table("product")->join($this->joined, "pd.ProductID = product.id")->like("product.name", $word, "both")->orderBy("product.id", "ASC")->get()->getResult();
        return $result;
    }
    public function getProductsMenuID($MenuID)
    {
        $db = \Config\Database::connect();
        $result = $db->table("product")->join($this->joined, "pd.ProductID = product.id")->where("product.MenuID", $MenuID)->orderBy("product.id", "ASC")->get()->getResult();
        return $result;
    }
    public function getCategoriesforProduct()
    {
        $db = \Config\Database::connect();
        $result = $db->table("menu")->where("rumuz", 1)->orderBy("AltID", "ASC")->get()->getResult();
        return $result;
    }
    public function getLikeProduct($query){
        $db = \Config\Database::connect();
        $result = $db->table("product")->join($this->joined, "pd.ProductID = product.id")->like("pd.name", $query)->orderBy("product.id", "ASC")->get()->getResult();
        return $result;
    }

    public function updateProduct($productId, $data) {

        return $this->update($productId, $data);
    }

    public function decreaseProductCount($productId) {
        
    }
}
