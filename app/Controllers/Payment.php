<?php

namespace App\Controllers;

use App\Libraries\Iyzico;
use App\Models\BasketModel;

// EXTRA USE
helper(["fonksiyonlar", "curl", "googleTranslate", "getUser"]);

class Payment extends BaseController
{
    // Payment
    public function payment()
    {
        $basketModel  = model("BasketModel");
        $userModel    = model('UserModel');
        $addressModel = model('AddressModel');
        $AOwnerModel = model('Admin/AOwnerModel');

        $owner = $AOwnerModel->getOwnerFU('icabiNewLine');

        $session     = session();
        $userSession = $session->get('user');
        $user = $userModel->getUser(['email' => $userSession]);

        // object
        $address = $addressModel->getAddress($user['id'])[0];

        // object
        $basket  = $basketModel->getProductsInBasket(['userId' => $user['id']]);

        $iyzico = new Iyzico();
        $payment = $iyzico->setForm([
            'conversationID' => '123456789', // order id
            'price' => 60.0,
            'paidPrice' => $basket['totalProductPrice'],
            'basketID' => $basket['result'][0]['basketNumber'],
        ])
            ->setBuyer([
                'id' => $owner->id,
                'name' => $owner->name,
                'surname' => 'Kırgız',
                'phone' => '05395662844',
                'email' => $owner->email,
                'identity' => "12345678910",
                'address' => "Adres",
                'ip' => $this->request->getIPAddress(),
                'city' => 'Kırklareli',
                'country' => "Türkiye",
            ])
            ->setShipping([
                'name' => $user['name'],
                'city' => $address["city"],
                'country' => 'Türkiye',
                'address' => $address["address"],
            ])
            ->setBilling([
                'name' => $user['name'],
                'city' => $address["city"],
                'country' => 'Türkiye',
                'address' => $address["address"],
            ]);

        foreach ($basket['result'] as $product) {

            $transformedData = [
                'id' => $product['productId'],
                'name' => $product['name'],
                'category' => 'Erkek Ayakkabı', // Kategori sabit veya başka bir yerden alınabilir
                'price' => 60.0 // Fiyatı float olarak dönüştürelim
            ];
            $payment = $iyzico->setItems([$transformedData]);
        }
        $payment = $iyzico->paymentForm();

        $data = array('paymentContent' => $payment->getCheckoutFormContent(), 'paymentStatus' => $payment->getStatus());

        $this->finishBasket($user);
        return view('payment', $data);
    }

    public function callback()
    {
        $token = $_REQUEST['token'];
        $conversationID = '123456789'; // order id
        $iyzico = new Iyzico();
        $response = $iyzico->callbackForm($token, $conversationID);

        return view('callback', [
            'paymentStatus' => $response->getPaymentStatus(),
        ]);
    }
    public function finishBasket($user){
        $Basket = new BasketModel();

        $baskets = $Basket->getBasketFUserId($user["id"]);
        foreach($baskets as $basket){
            $data = array("finishInfo" => 1);
            $Basket->updateBasket($basket->id, $data);
        }
    }
}
