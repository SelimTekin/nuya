<?php

namespace App\Controllers;

// USE
    use CodeIgniter\Controller;

    use App\Models\Admin\AOwnerModel;

    use App\Models\CategoryModel;
    use App\Models\LanguageModel;
    use App\Models\ProductModel;
    use App\Models\SettingModel;

// EXTRA USE
    helper(["fonksiyonlar", "curl", "googleTranslate","getUser", "ai"]);
    $session = \Config\Services::session();

class OurPackages extends Controller
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
            $this->data["userDetails"] = $model->getUser(["email" => $_SESSION["user"]]);
        }
    }

    /* Select */

    public function index()
    {
        $Category = new CategoryModel();
        $Language = new LanguageModel();

        $this->data["menus"]                = $Category->getCategoriesOnlyProducts();
        $this->data["activeLanguages"]      = $Language->getsActiveLanguage();
        $language                           = detectedLanguage();
        $this->data["showProducts"]         = getJsonCurlPost("SoftPHP/getProductsForCategory", ["Language"=>$language]);
        $this->data["minLanguage"]          = json_decode($Language->getMinLanguage(1, $language)->nameSet); 
        
        return view('ourPackages', $this->data);
    }

    public function product($link)
    {
        $language                           = detectedLanguage();
        $Product = new ProductModel($language);
        $Language = new LanguageModel();
        $newLink = "product/" . $link;
        $this->data["minLanguage"]          = json_decode($Language->getMinLanguage(1, $language)->nameSet); 
        if(isset($this->data["userDetails"])){
            $gender = ($this->data["userDetails"]["gender"]=="erkek")?0:1;
        }else{
            $gender = 1;
        }
        if($productInfo                         = $Product->getProductLink($newLink)){
            $this->data["activeLanguages"]      = $Language->getsActiveLanguage();
            $this->data["product"]              = getJsonCurlPost("SoftPHP/getProduct", ["ProductID" => $productInfo->ProductID, "Language"=>$language]);
            $selectedId                         = myOptionFind($this->data["product"]->productDetails->productId, $gender);
            $this->data["aiSelected"]           = getJsonCurlPost("SoftPHP/getProduct", ["ProductID" => $selectedId, "Language"=>$language]);


            return view("products", $this->data);
        }else{
            header("Location: " . base_url("OurPackages"));
            exit();
        }
    }
}
