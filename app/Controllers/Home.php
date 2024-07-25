<?php

namespace App\Controllers;

// USE 
    use App\Models\Admin\AOwnerModel;
use App\Models\LanguageModel;
use App\Models\SettingModel;

// EXTRA USE
    $session = \Config\Services::session();
    helper(["fonksiyonlar", "curl", "googleTranslate","getUser"]);

class Home extends BaseController
{
    public $data = array();
    public $ownerData;

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
        if(isset($_SESSION["user"])){
            $model = model('UserModel');
            $this->data["userDetails"] = $model->getUser(["email" =>$_SESSION["user"]]);
        }
    }
    
        /* Select */
    public function index()
    {
        return view('index', $this->data);
    }
    public function collection(){
        return view("collection", $this->data);
    }

    public function notFound(){
        return view("errors/html/error_404");
    }
    public function sitemap(){
        header("Content-Type: text/xml;charset=utf8");
        return view("sitemap");
    }
}
