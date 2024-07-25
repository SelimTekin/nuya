<?php

namespace App\Controllers\Fpanel;

// USE
    use App\Controllers\BaseController;

    use App\Models\Admin\ALogModel;
    use App\Models\Admin\AOwnerModel;
    use App\Models\Admin\AProductModel;
use App\Models\CategoryModel;
use App\Models\ExtraProductModel;
use App\Models\LanguageModel;
use App\Models\ProductModel;

    use Exception;

// EXTRA USE
    helper("fonksiyonlar");
    helper("minRequire");
    helper("googleTranslate");
    $session = \Config\Services::session();

class Product extends BaseController
{
    public $data = array();

    public function __construct()
    {
        $ALog    = new ALogModel(); 
        $AOwner   = new AOwnerModel();
        $Admin      = new Admin();
        $Language   = new LanguageModel();
        
        $this->data["activeLanguages"]      = $Language->getsActiveLanguage();

        $ALog->setLog();
        if (!(isset($_SESSION["Fowner"]))) {
            header("Location: " . base_url("Fpanel"));
            exit();
        }else{
            if(!($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)){ // require User ?
                header("Location: " . base_url("Fpanel/board/ustYetki"));
                exit();
            }else{
                if(!($this->data["owner"] = $AOwner->getOwnerFU($_SESSION["Fowner"]))){
                    $Admin->leave();
                }
            }
        }
    }
    
        /* Add */

    public function add($Action = "0")
    {
        // Get Models
        $language                           = detectedLanguage();
        $Category                           = new CategoryModel($language);
        
        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);
        
        // Main
        $this->data["categories"]       = $Category->getCategoriesforProduct();
        $this->data["whichLocations"]   = [["Kategoriler","Category"],["Ürün Ekle","Product/add"]];

        // Result
        return view("Fpanel/productAdd", $this->data);
    }
    public function add_result()
    {
        $detectedLanguage                   = detectedLanguage();
        $AProduct                           = new AProductModel();
        $Language                           = new LanguageModel();

        $getVals = SecurityMaster($_POST, ["name", "link", "price", "count", "MenuID"]); // incoming add
        foreach($getVals as $getKey => $getVal){ $$getKey = $getVal; }
        if(isset($_POST["text"])){
            $incomingText = $_POST["text"];
        }else{
            $incomingText = "";
        }

        $img = $this->request->getFile("image");
        if (($incomingLink != "") and ($incomingName != "") and ($incomingPrice != "") and ($incomingCount != "") and ($incomingMenuID != "") and ($incomingText != "")) {
            $incomingLink   = "product/" . SEO($incomingLink, $incomingMenuID);
            if ($AProduct->setProduct($incomingLink, $incomingPrice, $incomingCount, $incomingMenuID)) { // Added
                $lastId = $AProduct->getInsertLastID();
                foreach($Language->getsActiveLanguage() as $activeLanguage){
                    $languageCode = $activeLanguage->languageCode;
                    if(!($detectedLanguage ==  $languageCode)){
                        $newName = translateToAll($incomingName, $languageCode);
                        $newText = translateToAll($incomingText, $languageCode);
                    }else{
                        $newName = $incomingName;
                        $newText = $incomingText;
                    }
                    if(!($AProduct->setProductLanguage($lastId, $newName, $newText, $languageCode))){
                        header("Location: " . base_url("Fpanel/product/addPlus/Technical-Error"));
                        exit();
                    }
                }
                if ($img->getName() != "") {
                    $imgName    = ImgNameCreator();

                    $incomingImgExtra    =    substr($img->getName(), -4);
                    if ($incomingImgExtra == "jpeg") {
                        $incomingImgExtra    =    "." . $incomingImgExtra;
                    }
                    $fullImgName    = $imgName . $incomingImgExtra;

                    $this->data = array(
                        "image" => $fullImgName
                    );
                    $img->move("img/productImg", $fullImgName);
                    if ($img->hasMoved()) {
                        if (!$AProduct->updProductImg($lastId, $this->data)) {
                            header("Location: " . base_url("Fpanel/product/addPlus/Technical-Error"));
                            exit();
                        }
                    } else {
                        header("Location: " . base_url("Fpanel/product/addPlus/Technical-Error"));
                        exit();
                    }
                }
                header("Location: " . base_url("Fpanel/product/addPlus/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/product/addPlus/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/product/addPlus/EmptyArea"));
            exit();
        }
    }
    
        /* Update */

    public function update($id = "0", $Action = "0")
    {
        $language                           = detectedLanguage();
        // Get Models
        $Product    = new ProductModel($language);
        $Category    = new CategoryModel($language);
        
        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);
        
        // Main
        if ($id != "0") {
            $incomingId            =    SecurityFilter($id);
        } else {
            $incomingId            =    "";
        }
        if ($incomingId != "") {
            if ($contentInfo    =    $Product->getProduct($incomingId)) {
                $this->data["incomingId"]           = $incomingId;
                $this->data["contentInfo"]          = $contentInfo;

                $this->data["categories"]           = $Category->getCategoriesforProduct();
                
                $this->data["whichLocations"]       = [["Kategoriler","Category"],["Ürün Güncelle","Product/update/" . $incomingId]];

                // Result
                return view("Fpanel/productUpdate", $this->data);
            } else {
                header("Location: " . base_url("Fpanel/categoryPlus/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/categoryPlus/EmptyArea"));
            exit();
        }
    }
    public function update_result($id = "0")
    {
        $detectedLanguage                   = detectedLanguage();
        $Product = new ProductModel();
        $Language = new LanguageModel();
        $AProduct = new AProductModel();
        
        if ($id != 0) {
            $incomingId        =    SecurityFilter($id);
        } else {
            $incomingId        =    "";
        }
        
        $getVals = SecurityMaster($_POST, ["name", "price", "count", "link", "MenuID"]); // incoming add
        foreach($getVals as $getKey => $getVal){ $$getKey = $getVal; }
        if(isset($_POST["text"])){
            $incomingText = $_POST["text"];
        }else{
            $incomingText = "";
        }

        $img = $this->request->getFile("image");
        if ($img->getName() != "") {
            $imgName    = ImgNameCreator();
            $incomingImgExtra    =    substr($img->getName(), -4);
            if ($incomingImgExtra == "jpeg") {
                $incomingImgExtra    =    "." . $incomingImgExtra;
            }
            $fullImgName    = $imgName . $incomingImgExtra;

            $this->data = array(
                "image" => $fullImgName
            );
            $contentInfo        =   $Product->getProduct($incomingId);

            $deletedFilePath        =    "img/productImg/" . $contentInfo->image;
            if ($deletedFilePath != "img/productImg/") {
                try {
                    unlink($deletedFilePath);
                } catch (Exception $e) {
                }
            }

            $img->move("img/productImg", $fullImgName);
            if ($img->hasMoved()) {
                if (!$AProduct->updProductImg($incomingId, $this->data)) {
                    header("Location: " . base_url("Fpanel/product/updatePlus($incomingId/Technical-Error"));
                    exit();
                }
            } else {
                header("Location: " . base_url("Fpanel/product/updatePlus/$incomingId/Technical-Error"));
            }
        }
        if (($incomingId != "") and ($incomingName != "")  and ($incomingPrice != "")  and ($incomingCount != "") and ($incomingText != "") and ($incomingLink != "") and ($incomingMenuID != "")) {
            $incomingLinkPlus = explode("/", $incomingLink);
            if ($incomingLinkPlus[0] != "product") {
                $incomingLink = "product/" . SEO($incomingLink, $incomingMenuID);
            }
            $time = time();
            $this->data = array(
                "MenuID" => $incomingMenuID,
                "link" => $incomingLink,
                "price" => $incomingPrice,
                "count" => $incomingCount,
                "updateDate" => date($time),
            );
            if ($AProduct->updProductImg($incomingId, $this->data)) {
                
                foreach($Language->getsActiveLanguage() as $activeLanguage){
                    $languageCode = $activeLanguage->languageCode;
                    if(!($detectedLanguage == $languageCode)){
                        $newName = translateToAll($incomingName, $languageCode);
                        $newText = translateToAll($incomingText, $languageCode);
                    }else{
                        $newName = $incomingName;
                        $newText = $incomingText;
                    }
                    
                    if(!($AProduct->updProductLanguage($incomingId, $newName, $newText, $languageCode))){
                        header("Location: " . base_url("Fpanel/product/updatePlus/$incomingId/Technical-Error"));
                        exit();
                    }
                }

                header("Location: " . base_url("Fpanel/product/updatePlus/$incomingId/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/product/updatePlus/$incomingId/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/product/updatePlus/$incomingId/EmptyArea"));
            exit();
        }
    }

        /* Delete */

    public function delete_result($id)
    {
        if ($this->delete_function($id)) { // true or false

            header("Location: " . base_url("Fpanel/categoryPlus/200"));
            exit();
        } else {

            header("Location: " . base_url("Fpanel/categoryPlus/Technical-Error"));
            exit();
        }
    }

    public function delete_function($id = "0"){
        if ($id != "0") {
            $incomingId        =    SecurityFilter($id);
        } else {
            $incomingId        =    "";
        }
        if ($incomingId != "") {
            $Product            = new ProductModel();
            $AProduct           = new AProductModel();
            $Language           = new LanguageModel();
            
            $contentInfo    = $Product->getProduct($incomingId);
            if(!isset($contentInfo->image)){
                $contentImage = "";
            }else{
                $contentImage = $contentInfo->image;
            }
            $deletedFilePath        = "img/productImg/" . $contentImage;
    
            if ($AProduct->delProduct($incomingId)) { // true or false
                foreach($Language->getsActiveLanguage() as $activeLanguage){
                    $languageCode = $activeLanguage->languageCode;
                    
                    if(!($AProduct->delProductDetails($incomingId, $languageCode))){
                        header("Location: " . base_url("Fpanel/categoryPlus/Technical-Error"));
                        exit();
                    }
                }
                if ($deletedFilePath != "img/productImg/") {
                    try {
                        unlink($deletedFilePath);
                    } catch (Exception $e) {
                    }
                }
                return true;
            } else {
                return false;
            }
        } else {
            header("Location: " . base_url("Fpanel/categoryPlus/EmptyArea"));
            exit();
        }

    }
}
