<?php

namespace App\Controllers;

// USE 
use CodeIgniter\Controller;

use App\Models\Admin\AOwnerModel;

use App\Models\BasketModel;
use App\Models\ProductModel;
use App\Models\LanguageModel;
use App\Models\SettingModel;

use \Config\Services;

// EXTRA USE  
$session = \Config\Services::session();
helper(["fonksiyonlar", "curl", "googleTranslate", "getUser"]);

class Basket extends Controller
{

    public $data = [];
    public $ownerData;

    /* JS Select */

    public function __construct()
    {

        $Setting    = new SettingModel();
        $AOwner     = new AOwnerModel();
        $this->data["settings"]         = $Setting->getSettings();
        newUser($_SERVER["REQUEST_URI"]);

        if (isset($_SESSION["Fowner"])) {
            if ($AOwner->getOwnerFU($_SESSION["Fowner"])) {
                $this->ownerData = 1;
                $this->data["ownerData"]          = $this->ownerData;
            }
        }
        if (isset($_SESSION["user"])) {
            $model = model('UserModel');
            $this->data["userDetails"] = $model->getUser(["email" => $_SESSION["user"]]);
        }else{
            header("Location: " . base_url("login"));
            exit();
        }
    }

    public function index()
    {

        $session     = session();
        $userSession = $session->get('user');

        $user        = $this->checkUser(['email' => $userSession]);

        $Basket = model("BasketModel");

        $this->data["productsInBasket"]     = $Basket->getProductsInBasket($user['id']);

        return view('basket', $this->data);
    }
    public function finishBasket(){
        $session     = session();
        $userSession = $session->get('user');

        $user        = $this->checkUser(['email' => $userSession]);

        $Basket = model("BasketModel");

        $this->data["productsInBasket"]     = $Basket->getProductsInBasketFinish($user['id']);

        return view('basketFinish', $this->data);
    }

    public function addBasket($incomingProductID)
    {
        date_default_timezone_set('Europe/Istanbul');

        $basketModel  = model("BasketModel");
        $productModel  = model("ProductModel");

        $product = $productModel->getProduct($incomingProductID);

        $session     = session();
        $userSession = $session->get('user');
        $user        = $this->checkUser(['email' => $userSession]);
        $basket = $basketModel->getBasket(['userId' => $user['id'], 'productId' => $incomingProductID, "finishInfo" => "0"]);

        // return $basket->productId;die();

        if (!empty($basket) && $basket->productId == $incomingProductID) {

            $basketModel->updateBasket($basket->id, ['productCount' => $basket->productCount + 1]);

            // Decrease product count after adding basket
            $productModel->updateProduct($incomingProductID, ['count' => $product->count - 1]);

            return redirect()->to(base_url('basket'));
            die();
        } else {
            $addressModel = model("AddressModel");
            $address = $addressModel->getAddress($user['id']);

            $basket = $basketModel->getBasket(['userId' => $user['id'], "finishInfo" => "0"]);
            $basketNumber = empty($basket) ? (!empty($basketModel->getLastRow()) ? $basketModel->getLastRow()['basketNumber'] + 1 : 1) : $basket->basketNumber;

            $data = array(
                "userId" => $user['id'],
                "productId" => $incomingProductID,
                "basketNumber" => $basketNumber,
                "productCount" => 1
            );

            $basketModel->addBasket($data);

            // Decrease product count after adding basket
            $productModel->updateProduct($incomingProductID, ['count' => $product->count - 1]);

            return redirect()->to(base_url('basket'));
        }
    }

    public function deleteProductFromBasket()
    {
        $service = Services::request();
        $productId = $service->getPost('productId');

        $productModel  = model("ProductModel");
        $basketModel   = model("BasketModel");

        $session     = session();
        $userSession = $session->get('user');
        $user        = $this->checkUser(['email' => $userSession]);

        $basket  = $basketModel->getBasket(['userId' => $user['id'], "finishInfo" => "0"]);

        $product = $productModel->getProduct($productId);
        $productModel->updateProduct($productId, ['count' => $product->count + $basket->productCount]);

        $basketModel->deleteBasket(['id' => $basket->id]);

        if (!empty($basketModel->getBasket(['userId' => $user['id'], "finishInfo" => "0"]))) {
            $newTotalPrice = $basketModel->getTotalPriceInBasket(['userId' => $user['id']])->totalProductPrice;
            $newTotalProductCount = $basketModel->getTotalCountInBasket(['userId' => $user['id']]);

            return $this->response->setJSON([
                'success' => true,
                'new_total_price' => $newTotalPrice,
                'new_total_product_count' => $newTotalProductCount->totalProductCount
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'new_total_product_count' => 0
        ]);
    }

    // INCREASE PRODUCT COUNT IN BASKET TABLE and DECREASE PRODUCT COUNT IN PRODUCT TABLE
    public function decreaseProductCount()
    {

        $service = Services::request();
        $productId = $service->getPost('productId');

        $productModel   = model("ProductModel");

        $product = $productModel->getProduct($productId);

        if ($product->count == 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Stokta ürün bulunmamaktadır.'
            ]);
        }

        // Add basket and decrease product count that increased product in basket
        $this->addBasket($productId);

        // get new new product count in the basket
        $session     = session();
        $userSession = $session->get('user');
        $user        = $this->checkUser(['email' => $userSession]);

        $basketModel   = model("BasketModel");
        $newCount = $basketModel->getBasket(['userId' => $user['id'], 'productId' => $productId, "finishInfo" => "0"])->productCount;
        $newTotalPrice = $basketModel->getTotalPriceInBasket(['userId' => $user['id']])->totalProductPrice;
        $newTotalProductCount = $basketModel->getTotalCountInBasket(['userId' => $user['id']])->totalProductCount;
        return $this->response->setJSON([
            'success'         => true,
            'new_count'       => $newCount,
            'new_price'       => $product->price,
            'new_total_price' => $newTotalPrice,
            'new_total_product_count' => $newTotalProductCount
        ]);
    }

    // INCREASE PRODUCT COUNT IN PRODUCT TABLE and DECREASE PRODUCT COUNT IN BASKET TABLE
    public function increaseProductCount()
    {

        $service = Services::request();
        $productId = $service->getPost('productId');

        $productModel  = model("ProductModel");
        $basketModel   = model("BasketModel");

        // get new new product count in the basket
        $session     = session();
        $userSession = $session->get('user');
        $user        = $this->checkUser(['email' => $userSession]);

        $basket  = $basketModel->getBasket(['userId' => $user['id'], 'productId' => $productId, "finishInfo" => "0"]);
        $product = $productModel->getProduct($productId);

        if ($basket->productCount == 1) {

            // DELETE PRODUCT IN BASKET
            $basketModel->deleteBasket(['id' => $basket->id]);
            $productModel->updateProduct($productId, ['count' => $product->count + 1]);

            if (!empty($basketModel->getTotalPriceInBasket(['userId' => $user['id']]))) {
                $newTotalPrice = $basketModel->getTotalPriceInBasket(['userId' => $user['id']])->totalProductPrice;
                $newTotalProductCount = $basketModel->getTotalCountInBasket(['userId' => $user['id']])->totalProductCount;

                return $this->response->setJSON([
                    'success' => false,
                    'new_total_price' => $newTotalPrice,
                    'new_total_product_count' => $newTotalProductCount
                ]);
            }

            return $this->response->setJSON([
                'success' => false,
                'new_total_product_count' => 0
            ]);
        }

        $basketModel->updateBasket($basket->id, ['productCount' => $basket->productCount - 1]);
        $basket  = $basketModel->getBasket(['userId' => $user['id'], 'productId' => $productId, "finishInfo" => "0"]);

        $product = $productModel->getProduct($productId);
        $productModel->updateProduct($productId, ['count' => $product->count + 1]);

        $newTotalPrice = $basketModel->getTotalPriceInBasket(['userId' => $user['id']])->totalProductPrice;
        $newTotalProductCount = $basketModel->getTotalCountInBasket(['userId' => $user['id']])->totalProductCount;

        return $this->response->setJSON([
            'success' => true,
            'new_count' => $basket->productCount,
            'new_price'     => $product->price,
            'new_total_price' => $newTotalPrice,
            'new_total_product_count' => $newTotalProductCount
        ]);
    }

    public function checkUser($where = [])
    {

        $model = model('UserModel');

        $user = $model->getUser($where);

        return empty($user) ? '' : $user;
    }
}
