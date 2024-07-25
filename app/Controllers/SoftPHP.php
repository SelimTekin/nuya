<?php

namespace App\Controllers;

// USE 
use CodeIgniter\Controller;

use App\Models\CategoryModel;
use App\Models\BasketModel;
use App\Models\ProductModel;

// EXTRA USE  
helper(["fonksiyonlar", "curl", "googleTranslate"]);

class SoftPHP extends Controller
{

    /* JS Select */

    public function index()
    {
        header('Content-type: application/json');
        if (isset($_POST["queryString"])) {
            $incomingQuery =    $_POST["queryString"];
        } else {
            $incomingQuery =    "";
        }
        if (isset($_POST["Language"])) {
            $incomingLanguage =    SecurityFilter($_POST["Language"]);
        } else {
            $incomingLanguage =    "";
        }

        $Product = new ProductModel($incomingLanguage);
        $Category = new CategoryModel();

        if ($incomingQuery != "") {
            $incomingData = $Product->getLikeProduct($incomingQuery);
        } else {
            $incomingData = $Product->getProductsFM($Category->getCategories()[1]->MenuID);
        }

        if ($incomingData) {
            $data = [];

            foreach ($incomingData as $value) {
                $dataE = [];

                $data[] = [
                    "productDetails"    => ["productName" => $value->name, "productLink" => $value->link, "productImg" => $value->image, "productPrice" => $value->price, "productCount" => $value->count, "productId" => $value->ProductID, "productText" =>  $value->text, "productCreateDate" => $value->createDate],
                    "productExtra"      => $dataE
                ];
            }
            echo json_encode($data);
            die();
        } else {
            echo json_encode("Not Found");
            die();
        }
    }
    public function getProduct()
    {
        header('Content-type: application/json');
        if (isset($_POST["ProductID"])) {
            $incomingProductID =    $_POST["ProductID"];
        } else {
            $incomingProductID =    "";
        }
        if (isset($_POST["Language"])) {
            $incomingLanguage =    SecurityFilter($_POST["Language"]);
        } else {
            $incomingLanguage =    "";
        }

        $Product = new ProductModel($incomingLanguage);
        if ($incomingProductID != "") {
            $incomingData = $Product->getProduct($incomingProductID);
            if ($incomingData) {
                $data = [
                    "productDetails"    => ["productName" => $incomingData->name, "productLink" => $incomingData->link, "productImg" => $incomingData->image, "productPrice" => $incomingData->price, "productCount" => $incomingData->count,  "productId" => $incomingData->ProductID, "productText" =>  $incomingData->text, "productCreateDate" => $incomingData->createDate],
                ];

                echo json_encode($data);
                die();
            } else {
                echo json_encode("Not Found");
                die();
            }
        } else {
            echo json_encode("Not Found");
            die();
        }
    }
    public function getProducts()
    {
        header('Content-type: application/json');
        if (isset($_POST["Language"])) {
            $incomingLanguage =    SecurityFilter($_POST["Language"]);
        } else {
            $incomingLanguage =    "";
        }

        $Product    = new ProductModel($incomingLanguage);

        $incomingData = $Product->getProducts();

        if ($incomingData) {
            $data = [];

            foreach ($incomingData as $value) {
                if (strlen($value->text) > 500) {
                    $productText = mb_substr($value->text, 0, 500) . "...(Devamı için tıkla)";
                } else {
                    $productText = $value->text;
                }

                $data[] = [
                    "productDetails"    => ["productName" => $value->name, "productLink" => $value->link, "productImg" => $value->image, "productPrice" => $value->price, "productCount" => $value->count,  "productId" => $value->ProductID, "productText" =>  $productText, "productCreateDate" => $value->createDate],
                ];
            }
            echo json_encode($data);
            die();
        } else {
            echo json_encode("Not Found");
            die();
        }
    }
    public function getProductsForCategory()
    {
        header('Content-type: application/json');
        if (isset($_POST["CategoryID"])) {
            $incomingCategoryID =    SecurityFilter($_POST["CategoryID"]);
        } else {
            $incomingCategoryID =    "";
        }
        if (isset($_POST["Language"])) {
            $incomingLanguage =    SecurityFilter($_POST["Language"]);
        } else {
            $incomingLanguage =    "";
        }

        $Product    = new ProductModel($incomingLanguage);
        $Category   = new CategoryModel($incomingLanguage);
        if ($incomingCategoryID != "") {
            $incomingData = $Product->getProductsFM($incomingCategoryID);
        } else {
            $incomingData = $Product->getProductsFM($Category->getCategoriesOnlyProducts()[1]->MenuID);
        }

        if ($incomingData) {
            $data = [];

            foreach ($incomingData as $value) {
                $dataE = [];
                if (strlen($value->text) > 500) {
                    $productText = mb_substr($value->text, 0, 500) . "...(Devamı için tıkla)";
                } else {
                    $productText = $value->text;
                }

                $data[] = [
                    "productDetails"    => ["productName" => $value->name, "productLink" => $value->link, "productImg" => $value->image, "productPrice" => $value->price, "productCount" => $value->count, "productId" => $value->ProductID, "productText" =>  $productText, "productCreateDate" => $value->createDate],
                ];
            }
            echo json_encode($data);
            die();
        } else {
            echo json_encode("Not Found");
            die();
        }
    }

    
    public function getProductsForBasket(){
        if (isset($_POST["Language"])) {
            $incomingLanguage =    SecurityFilter($_POST["Language"]);
        } else {
            $incomingLanguage =    "";
        }

        $Basket    = new BasketModel($incomingLanguage);

        $session     = session();
        $userSession = $session->get('user');

        $User = model('UserModel');
        $user = $User->getUser(['email' => $userSession]);

        $incomingData = $Basket->getProductsForBasket($user['id']);

        return $incomingData;

    }
    
    public function getCategoryForCategory()
    {
        header('Content-type: application/json');
        if (isset($_POST["CategoryID"])) {
            $incomingCategoryID =    $_POST["CategoryID"];
        } else {
            $incomingCategoryID =    "";
        }
        if (isset($_POST["Language"])) {
            $incomingLanguage =    SecurityFilter($_POST["Language"]);
        } else {
            $incomingLanguage =    "";
        }

        $Category = new CategoryModel($incomingLanguage);
        if ($incomingCategoryID != "") {
            $incomingData = $Category->getCategoriesAltID($incomingCategoryID);
        } else {
            $incomingData = $Category->getCategories();
        }

        if ($incomingData) {
            $data = [];

            foreach ($incomingData as $value) {
                $data[] = [
                    "categoryDetails"    => ["categoryName" => $value->name, "categoryId" => $value->MenuID],
                ];
            }
            echo json_encode($data);
            die();
        } else {
            echo json_encode("Not Found");
            die();
        }
    }
    
}
