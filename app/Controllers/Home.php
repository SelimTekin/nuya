<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // $model = model('BankaHesaplariModel');
        // echo '<pre>';
        // print_r($model->bankaHesabiGuncelle([2, 3], ['ulke' => 'Türkiye']));
        // echo '</pre>';
        // exit;

        return view('index.html');

    }
}
