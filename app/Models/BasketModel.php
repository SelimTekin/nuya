<?php

namespace App\Models;

use CodeIgniter\Model;

helper("googleTranslate");

class BasketModel extends Model
{

    protected $table = 'basket';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'basketNumber', 'userId', 'productId', 'productCount', 'addressId', 'variantId', 'cargoId', 'paymentSelection', 'installmentSelection'];

    public $joined;

    public function __construct($tr = "")
    {
        helper("googleTranslate");

        $language = detectedLanguage();
        if ($tr == "") {
            if ($language) {
                $this->joined = "productdetails" . $language . " as pd";
            } else {
                $this->joined = "productdetailstr as pd";
            }
        } else {
            $this->joined = "productdetails" . $tr . " as pd";
        }
    }

    public function getLastRow() {
        $db = \Config\Database::connect();
        $result = $db->table("basket")->orderBy('id', 'DESC')->get()->getRowArray();

        return $result;
    }

    public function getBasket($data)
    {
        $db = \Config\Database::connect();
        $result = $db->table("basket")->where($data)->orderBy('id', 'DESC')->get()->getRow();

        return $result;
    }

    public function getBasketFUserId($id)
    {
        $db = \Config\Database::connect();
        $result = $db->table("basket")->where(["userId" => $id, "finishInfo" => "0"])->orderBy('id', 'DESC')->get()->getResult();

        return $result;
    }

    public function getBasketFinisheds()
    {
        $db = \Config\Database::connect();
        $result = $db->table("basket")->where(["finishInfo" => "1"])->orderBy('id', 'DESC')->get()->getResult();

        return $result;
    }
    public function getProductsInBasket($userId)
    {
        $db = \Config\Database::connect();
        $data = array(
            "basket.userId" => $userId,
            "basket.finishInfo" => "0",
        );

        // Sorguyu güncelle
        $result = $db->table("basket")
            ->select("p.id as productId, p.*, pd.id, pd.name, basket.*")
            ->join("product as p", "p.id = basket.productId")
            ->join("productdetailstr as pd", "pd.productId = p.id")
            ->where($data)
            ->groupBy('p.id') // Aynı ürün id'lerini gruplandır
            ->get()
            ->getResultArray();

        $totalProductCount = 0;
        $totalProductPrice = 0;
        foreach($result as $item) {
            $totalProductCount += $item['productCount'];
            $totalProductPrice += $item['price'] * $item['productCount'];
        }

        return ['result' => $result, 'totalProductCount' => $totalProductCount, 'totalProductPrice' => $totalProductPrice];
    }
    public function getProductsInBasketFinish($userId){
        
        $db = \Config\Database::connect();
        $data = array(
            "basket.userId" => $userId,
            "basket.finishInfo" => "1",
        );

        // Sorguyu güncelle
        $result = $db->table("basket")
            ->select("p.id as productId, p.*, pd.id, pd.name, basket.*")
            ->join("product as p", "p.id = basket.productId")
            ->join("productdetailstr as pd", "pd.productId = p.id")
            ->where($data)
            ->groupBy('p.id') // Aynı ürün id'lerini gruplandır
            ->get()
            ->getResultArray();

        $totalProductCount = 0;
        $totalProductPrice = 0;
        foreach($result as $item) {
            $totalProductCount += $item['productCount'];
            $totalProductPrice += $item['price'] * $item['productCount'];
        }

        return ['result' => $result, 'totalProductCount' => $totalProductCount, 'totalProductPrice' => $totalProductPrice];
    }

    public function getTotalPriceInBasket($userId) {
        $db = \Config\Database::connect();
        $data = array(
            "basket.userId" => $userId,
            "basket.finishInfo" => "0",
        );

        $result = $db->table("basket")->select("SUM(productCount * price) as totalProductPrice")->join("product as p", "p.id = basket.productId")->where($data)->groupBy("basket.userId")->get()->getRow();

        return $result;
    }

    public function getTotalCountInBasket($userId) {
        $db = \Config\Database::connect();
        $data = array(
            "basket.userId" => $userId,
            "basket.finishInfo" => "0",
        );

        $result = $db->table("basket")->select("SUM(productCount) as totalProductCount")->join("product as p", "p.id = basket.productId")->where($data)->groupBy("basket.userId")->get()->getRow();

        return $result;
    }

    public function addBasket($data)
    {
        $db = \Config\Database::connect();
        $insert = $db->table("basket")->insert($data);

        if ($insert) {
            return true;
        }

        return false;
    }

    public function removeBasket(Array $data)
    {
        $db = \Config\Database::connect();
        $delete = $db->table("basket")->delete($data);

        if ($delete) {
            return true;
        }

        return false;
    }

    public function updateBasket($id, $data) {
        $db = \Config\Database::connect();
        $result = $db->table("basket")->where(["id" => $id])->update($data);
        return $result;
    }
    public function deleteBasket($id) {
        return $this->delete($id);
    }

}
