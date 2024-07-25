<?php

namespace App\Controllers\Fpanel;

// USE
    use App\Controllers\BaseController;

    use App\Models\Admin\ALogModel;
    use App\Models\Admin\AOwnerModel;
    use App\Models\BasketModel;
    use App\Models\ProductModel;
    use app\Models\UserModel;

// EXTRA USE
    helper("fonksiyonlar");
    helper("minRequire");
    helper("googleTranslate");
    $session = \Config\Services::session();

class Orders extends BaseController
{
    public $data = array();

    public function __construct()
    {
        $ALog       = new ALogModel();
        $AOwner     = new AOwnerModel();
        $Admin      = new Admin();

        $ALog->setLog();
        if (!(isset($_SESSION["Fowner"]))) {
            header("Location: " . base_url("Fpanel"));
            exit();
        } else {
            if(!($this->data["owner"] = $AOwner->getOwnerFU($_SESSION["Fowner"]))){
                $Admin->leave();
            }
        }
    }

        /* Select */

    public function index($Action = "0")
    {
        // Get Models
        $language                           = detectedLanguage();
        $Basket     = new BasketModel();
        $Product    = new ProductModel($language);
        $model      = model('UserModel');

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Extra Starter Alert 
        if ($Action == "kendim") {
            $this->data["actionName"]   = "kendim";
            $this->data["action"]       = "Kendinizi silemezsiniz.";
            $this->data["actionStatus"] = "danger";
        }
        if ($Action == "ustYetki") {
            $this->data["actionName"] = "ustYetki";
            $this->data["action"] = "Üst yetkiye sahip olmalısın.";
            $this->data["actionStatus"] = "danger";
        }

        // Main
        $this->data["Orders"]              = $Basket->getBasketFinisheds();
        foreach($this->data["Orders"] as $key => $ordersItem){
            $this->data["Orders"][$key]->productDetails     = $Product->getProduct($ordersItem->productId);
            $this->data["Orders"][$key]->userDetails        = $model->getUser(["id" => $ordersItem->userId]);
        } 

        $this->data["whichLocations"]   = [["Yöneticiler", "Orders"]];
      
        // Result
        return view("Fpanel/orders", $this->data);
    }

    public function delete_result($id = "0")
    {
        $Basket     = new BasketModel();
        if ($id != "0") {
            $incomingId        =    SecurityFilter($id);
        } else {
            $incomingId        =    "";
        }
        if ($incomingId != "") {
            if ($Basket->deleteBasket($incomingId)) { // true or false
                header("Location: " . base_url("Fpanel/orderPlus/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/orderPlus/Technical-Error"));
                exit();
            }
                    
        } else {
            header("Location: " . base_url("Fpanel/orderPlus/EmptyArea"));
            exit();
        }
    }
}
