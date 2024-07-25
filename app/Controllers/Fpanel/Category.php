<?php

namespace App\Controllers\Fpanel;

// USE
use App\Controllers\BaseController;

use App\Models\Admin\ACategoryModel;
use App\Models\Admin\ALogModel;
use App\Models\Admin\AOwnerModel;
use App\Models\Admin\AProductModel;

use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\ProductModel;
use App\Models\SettingModel;
use Exception;

// EXTRA USE
    helper(["fonksiyonlar", "minRequire", "googleTranslate"]);
    $session = \Config\Services::session();

class Category extends BaseController
{
    public $data = array();

    public function __construct()
    {
        $ALog       = new ALogModel();
        $AOwner     = new AOwnerModel();
        $Admin      = new Admin();
        $Language   = new LanguageModel();

        $this->data["activeLanguages"]      = $Language->getsActiveLanguage();

        $ALog->setLog();
        if (!(isset($_SESSION["Fowner"]))) {
            header("Location: " . base_url("Fpanel"));
            exit();
        } else {
            if (!($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)) { // require User ?
                header("Location: " . base_url("Fpanel/board/ustYetki"));
                exit();
            } else {
                if (!($this->data["owner"] = $AOwner->getOwnerFU($_SESSION["Fowner"]))) {
                    $Admin->leave();
                }
            }
        }
    }

    /* Select */

    public function productWrite($underID = "0")
    {
        $Language = detectedLanguage();
        $Product    = new ProductModel($Language);
        $productList = [];

        if ($myProducts = $Product->getProductsFM($underID)) {
            foreach ($myProducts as $myProduct) {
                $productList[]      = ["productID" => $myProduct->ProductID, "productName" => $myProduct->name, "productMenuID" => $myProduct->MenuID];
            }
        }
        return $productList;
    }
    public function menuWrite($underID = "0")
    {
        $Language = detectedLanguage();
        $Category = new CategoryModel($Language);
        $categoryList = [];
        if ($underID != 0) {
            $myCategory = $Category->getCategory($underID);

            $categoryList["categoryId"]       = $myCategory->MenuID;
            $categoryList["categoryName"]     = $myCategory->name;
            $categoryList["categoryRumuz"]    = $myCategory->rumuz;
            $categoryList["categoryBottomId"] = $myCategory->AltID;
        } else {
            $categoryList["categoryRumuz"]    = 0;
        }
        if ($categoryList["categoryRumuz"] == "0") {
            if ($contentsInfo = $Category->getCategoriesAltID($underID)) {
                $rumuzFlag = 1;
                foreach ($contentsInfo as $content) {
                    if($rumuzFlag == 1){
                        if($content->rumuz == 0){
                            $categoryList["categoryInBottomRumuz"] = 0;
                        }else{
                            $categoryList["categoryInBottomRumuz"] = 1;
                        }
                        $rumuzFlag = 0;
                    }
                    $categoryList["bottomData"][$content->name] = $this->menuWrite($content->MenuID);
                }
            }
        } else {
            $incomingBottomData = $this->productWrite($myCategory->MenuID);

            if ($incomingBottomData) {
                $categoryList["bottomData"] = $incomingBottomData;
            }
        }
        return $categoryList;
    }

    public function index($Action = "0")
    {
        // Get Path
        $this->data["PATH"] = $this->request->getUri()->getPath();

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Main
        $this->data["myData"]           = $this->menuWrite();
        $this->data["whichLocations"]   = [["Kategoriler", "Category"]];
        $this->data["whichExtras"]      = [['Kategori Ekle <i class="fa-solid fa-plus"></i>', "Category/add"], ['Ürün Ekle <i class="fa-solid fa-plus"></i>', "Product/add"]];
        // Result
        return view("Fpanel/category", $this->data);
    }
    public function writeMenu($thisMenuID = 1){
        $Setting = new SettingModel();
        $this->data["settings"] = $Setting->getSettings();
        $this->data["myData"]   = $this->menuWrite($thisMenuID); 
        return view("Fpanel/writedMenu", $this->data);
    }

    /* Add */

    public function add($Action = "0")
    {
        // Get Path
        $this->data["PATH"] = $this->request->getUri()->getPath();

        // Get Models
        $Category = new CategoryModel();

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Main
        $this->data["categories"]       = $Category->getCategoriesforCategory();
        $this->data["whichLocations"]   = [["Kategoriler", "Category"], ["Kategori Ekle", "category/add"]];

        // Result
        return view("Fpanel/categoryAdd", $this->data);
    }
    public function add_result()
    {
        $detectedLanguage                   = detectedLanguage();
        $ACategory                          = new ACategoryModel();
        $Language                           = new LanguageModel();

        $getVals = SecurityMaster($_POST, ["name", "link", "AltID", "rumuz"]);
        foreach ($getVals as $getKey => $getVal) {
            $$getKey = $getVal;
        }

        if ($incomingRumuz == "on") {
            $incomingRumuz = 1;
        } else if ($incomingRumuz == "off") {
            $incomingRumuz = 0;
        } else {
            $incomingRumuz        =    0;
        }

        $img = $this->request->getFile("image");
        if (($incomingLink != "") and ($incomingName != "") and ($incomingAltID != "")) {
            $incomingLink = "OurPackages/" . SEO($incomingLink, $incomingAltID);

            if ($ACategory->setCategory($incomingLink, $incomingAltID, $incomingRumuz)) { // Added

                $lastId = $ACategory->getInsertLastID();
                foreach ($Language->getsActiveLanguage() as $activeLanguage) {
                    $languageCode = $activeLanguage->languageCode;
                    if (!($detectedLanguage ==  $languageCode)) {
                        $newName = translateToAll($incomingName, $languageCode);
                    } else {
                        $newName = $incomingName;
                    }
                    if (!($ACategory->setCategoryLanguage($lastId, $newName, $languageCode))) {
                        header("Location: " . base_url("Fpanel/category/addPlus/Technical-Error"));
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
                    $img->move("img/categoryImg/", $fullImgName);
                    if ($img->hasMoved()) {
                        if (!$ACategory->updCategoryImg($lastId, $this->data)) {
                            header("Location: " . base_url("Fpanel/category/addPlus/Technical-Error"));
                            exit();
                        }
                    } else {
                        header("Location: " . base_url("Fpanel/category/addPlus/Technical-Error"));
                    }
                }
                header("Location: " . base_url("Fpanel/category/addPlus/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/category/addPlus/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/category/addPlus/EmptyArea"));
            exit();
        }
    }

    /* Update */

    public function update($id = "0", $Action = "0")
    {
        // Get Path
        $this->data["PATH"] = $this->request->getUri()->getPath();

        // Get Models
        $Category = new CategoryModel();

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Main
        if ($id != "0") {
            $incomingId            =    SecurityFilter($id);
        } else {
            $incomingId            =    "";
        }
        if ($incomingId != "") {
            if ($contentInfo    =    $Category->getCategory($incomingId)) {

                $this->data["incomingId"]         = $incomingId;
                $this->data["contentInfo"]        = $contentInfo;
                $this->data["categories"] = $Category->getCategoriesforCategory();
                $this->data["whichLocations"] = [["Kategoriler", "Category"], ["Kategori Güncelle", "category/update/" . $incomingId]];

                // Result
                return view("Fpanel/categoryUpdate", $this->data);
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
        $Category                           = new CategoryModel();
        $ACategory                          = new ACategoryModel();
        $Language                           = new LanguageModel();

        if ($id != "0") {
            $incomingId        =    SecurityFilter($id);
        } else {
            $incomingId        =    "";
        }

        $getVals = SecurityMaster($_POST, ["name", "link", "AltID", "rumuz"]);
        foreach ($getVals as $getKey => $getVal) {
            $$getKey = $getVal;
        }

        if ($incomingRumuz == "on") {
            $incomingRumuz = 1;
        } else if ($incomingRumuz == "off") {
            $incomingRumuz = 0;
        } else {
            $incomingRumuz        =    0;
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
            $contentInfo        =   $Category->getCategory($incomingId);

            $deletedFilePath        =    "img/categoryImg/" . $contentInfo->image;
            if ($deletedFilePath != "img/categoryImg/") {
                try {
                    unlink($deletedFilePath);
                } catch (Exception $e) {
                }
            }

            $img->move("img/categoryImg", $fullImgName);
            if ($img->hasMoved()) {
                if (!$ACategory->updCategoryImg($incomingId, $this->data)) {
                    header("Location: " . base_url("Fpanel/category/updatePlus/$incomingId/Technical-Error"));
                    exit();
                }
            } else {
                header("Location: " . base_url("Fpanel/category/updatePlus/$incomingId/Technical-Error"));
            }
        }
        if (($incomingId != "") and ($incomingName != "") and ($incomingLink != "") and ($incomingAltID != "")) {
            $incomingLinkPlus = explode("/", $incomingLink);
            if ($incomingLinkPlus[0] != "OurPackages") {
                $incomingLink = "OurPackages/" . SEO($incomingLink, $incomingAltID);
            }
            $this->data = array(
                "link" => $incomingLink,
                "AltID" => $incomingAltID,
                "rumuz" => $incomingRumuz
            );
            if ($ACategory->updCategoryImg($incomingId, $this->data)) {

                foreach ($Language->getsActiveLanguage() as $activeLanguage) {
                    $languageCode = $activeLanguage->languageCode;
                    if (!($detectedLanguage == $languageCode)) {
                        $newName = translateToAll($incomingName, $languageCode);
                    } else {
                        $newName = $incomingName;
                    }

                    if (!($ACategory->updCategoryLanguage($incomingId, $newName, $languageCode))) {
                        header("Location: " . base_url("Fpanel/category/updatePlus/$incomingId/Technical-Error"));
                        exit();
                    }
                }

                header("Location: " . base_url("Fpanel/category/updatePlus/$incomingId/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/category/updatePlus/$incomingId/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/category/updatePlus/$incomingId/EmptyArea"));
            exit();
        }
    }

    /* Delete */

    public function delete_result($id)
    {
        if ($this->delete_function($id)) {

            header("Location: " . base_url("Fpanel/categoryPlus/200"));
            exit();
        } else {
            header("Location: " . base_url("Fpanel/categoryPlus/Technical-Error"));
            exit();
        }
    }
    public function delete_function($id = "0")
    {
        if ($id != "0") {
            $incomingId        =    SecurityFilter($id);
        } else {
            $incomingId        =    "";
        }
        if ($incomingId != "") {
            $Category               = new CategoryModel();
            $ACategory              = new ACategoryModel();
            $Product                = new ProductModel();
            $Language               = new LanguageModel();
            $CProduct               = new Product();

            $contentInfo            = $Category->getCategory($incomingId);
            if (!isset($contentInfo->image)) {
                $contentImage = "";
            } else {
                $contentImage = $contentInfo->image;
            }
            $deletedFilePath        = "img/categoryImg/" . $contentImage;

            if ($ACategory->delCategory($incomingId)) { // true or false
                if ($deletedFilePath != "img/categoryImg/") {
                    try {
                        unlink($deletedFilePath);
                    } catch (Exception $e) {
                    }
                }
                foreach ($Language->getsActiveLanguage() as $activeLanguage) {
                    $languageCode = $activeLanguage->languageCode;

                    if (!($ACategory->delCategoryDetails($incomingId, $languageCode))) {
                        header("Location: " . base_url("Fpanel/categoryPlus/Technical-Error"));
                        exit();
                    }
                }
                if ($contentInfo->rumuz == 1) {
                    $bottomProducts = $Product->getProductsMenuID($incomingId);
                    foreach ($bottomProducts as $bottomProduct) {
                        $CProduct->delete_function($bottomProduct->ProductID);
                    }
                } else {
                    $bottomCategories = $Category->getOurPackagesID($incomingId);
                    foreach ($bottomCategories as $bottomCategory) {
                        $this->delete_function($bottomCategory->MenuID);
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

    /* JS Update */

    public function categoryIndexChange()
    {
        if (isset($_POST["newArray"])) {
            $incomingNewArray  = $_POST["newArray"];
            array_walk($incomingNewArray, function ($value) {
                array_walk($value, "SecurityFilter");
            });
        } else {
            $incomingNewArray  = "";
        }
        if ($incomingNewArray != "") {
            $usedList = [];
            foreach ($incomingNewArray as $keyid => $arrayValue) {
                $useFlag = 0;
                $lastkeyid = $arrayValue["lastkeyid"];
                foreach ($usedList as $used) {
                    if ($used == $keyid) {
                        $useFlag = 1;
                        break;
                    }
                }
                if ($useFlag) {
                    continue;
                }
                if ($keyid == $lastkeyid) {
                    continue;
                } else {
                    $usedList = $this->categoryIndexUpdate($incomingNewArray, $lastkeyid, $keyid);
                }
            }
            echo 1;
        }
    }

    public function categoryIndexUpdate($myList, $lastId, $newId)
    {
        $Product                                = new ProductModel();
        $AProduct                               = new AProductModel();
        $Language                               = new LanguageModel();
        $usedList                               = [];
        $newLanguage                            = [];
        $lastLanguage                           = [];

        $newProductDetails                      = $Product->getProduct($newId);
        foreach ($Language->getsActiveLanguage() as $activeLanguage) {
            $languageCode = $activeLanguage->languageCode;

            $newLanguage[$languageCode] = $Product->getProductDetails($newId, $languageCode);
        };

        try {
            while (true) {
                $useFlag        = 0;
                $usedList[]     = $newId;

                $lastProduct            = $Product->getProduct($lastId);
                foreach($Language->getsActiveLanguage() as $activeLanguage){
                    $languageCode = $activeLanguage->languageCode;

                    $lastLanguage[$languageCode] = $Product->getProductDetails($lastId, $languageCode);
                };

                $AProduct->updProduct($lastId, $newProductDetails->link, $newProductDetails->price, $newProductDetails->count, $newProductDetails->image, $newProductDetails->MenuID);
                foreach($newLanguage as $newKeyLanguage => $newValueLanguage){
                    $AProduct->updProductDetails($newValueLanguage->id, $lastId, $newKeyLanguage);
                }

                $newProductDetails       = $lastProduct;
                $newLanguage             = $lastLanguage;

                $newId                  = $lastId;
                $lastId                 = $myList[$lastId]["lastkeyid"];

                foreach ($usedList as $used) {
                    if ($used == $newId) {
                        $useFlag = 1;
                        break;
                    }
                }
                if ($useFlag) {
                    break;
                }
            }
        } catch (Exception $as) {
            echo "thi";
        }
        return $usedList;
    }

    public function menuIndexChange()
    {
        if (isset($_POST["newArray"])) {
            $incomingNewArray  = $_POST["newArray"];
            array_walk($incomingNewArray, function ($value) {
                array_walk($value, "SecurityFilter");
            });
        } else {
            $incomingNewArray  = "";
        }
        if ($incomingNewArray != "") {
            $usedList = [];
            foreach ($incomingNewArray as $keyid => $arrayValue) {
                $useFlag = 0;
                $lastkeyid = $arrayValue["lastkeyid"];
                foreach ($usedList as $used) {
                    if ($used == $keyid) {
                        $useFlag = 1;
                        break;
                    }
                }
                if ($useFlag) {
                    continue;
                }
                if ($keyid == $lastkeyid) {
                    continue;
                } else {
                    $usedList = $this->menuIndexUpdate($incomingNewArray, $lastkeyid, $keyid);
                }
            }
            echo 1;
            die();
        }
    }
    public function menuIndexUpdate($myList, $lastId, $newId)
    {
        $Category                           = new CategoryModel();
        $Product                            = new ProductModel();
        $ACategory                          = new ACategoryModel();
        $AProduct                           = new AProductModel();
        $Language                           = new LanguageModel();
        $usedList                           = [];
        $lastLanguage                       = [];
        $newLanguage                        = [];

        $newCategoryDetails                 = $Category->getCategory($newId);
        $newProductDetails                  = $Product->getProductsMenuID($newId);
        foreach ($Language->getsActiveLanguage() as $activeLanguage) {
            $languageCode = $activeLanguage->languageCode;

            $newLanguage[$languageCode] = $Category->getCategoryDetails($newId, $languageCode);
        };

        try {
            while (true) {
                $useFlag        = 0;
                $usedList[]     = $newId;

                $lastCategory           = $Category->getCategory($lastId);
                $lastProduct            = $Product->getProductsMenuID($lastId);
                foreach ($Language->getsActiveLanguage() as $activeLanguage) {
                    $languageCode = $activeLanguage->languageCode;

                    $lastLanguage[$languageCode] = $Category->getCategoryDetails($lastId, $languageCode);
                };

                $ACategory->updCategory($lastId, $newCategoryDetails->AltID, $newCategoryDetails->link, $newCategoryDetails->image, $newCategoryDetails->rumuz);
                foreach ($newLanguage as $newKeyLanguage => $newValueLanguage) {
                    $ACategory->updCategoryDetails($newValueLanguage->id, $lastId, $newKeyLanguage);
                }
                foreach ($newProductDetails as $newProductDetail) {
                    $AProduct->updProductIDForID($newProductDetail->ProductID, $lastId);
                }


                $newProductDetails      = $lastProduct;
                $newCategoryDetails     = $lastCategory;
                $newLanguage            = $lastLanguage;

                $newId                  = $lastId;
                $lastId                 = $myList[$lastId]["lastkeyid"];

                foreach ($usedList as $used) {
                    if ($used == $newId) {
                        $useFlag = 1;
                        break;
                    }
                }
                if ($useFlag) {
                    break;
                }
            }
        } catch (Exception $as) {
            echo "thi";
        }
        return $usedList;
    }
    public function menuIndexMenuChange()
    {
        if (isset($_POST["newArray"])) {
            $incomingNewArray  = $_POST["newArray"];
            array_walk($incomingNewArray, function ($value) {
                array_walk($value, "SecurityFilter");
            });
        } else {
            $incomingNewArray  = "";
        }
        if ($incomingNewArray != "") {
            $usedList = [];
            foreach ($incomingNewArray as $keyid => $arrayValue) {
                $useFlag = 0;
                $lastkeyid = $arrayValue["lastkeyid"];
                foreach ($usedList as $used) {
                    if ($used == $keyid) {
                        $useFlag = 1;
                        break;
                    }
                }
                if ($useFlag) {
                    continue;
                }
                if ($keyid == $lastkeyid) {
                    continue;
                } else {
                    $usedList = $this->menuIndexMenuUpdate($incomingNewArray, $lastkeyid, $keyid);
                }
            }
            echo 1;
            die();
        }
    }
    
    public function menuIndexMenuUpdate($myList, $lastId, $newId)
    {
        $Category                           = new CategoryModel();
        $ACategory                          = new ACategoryModel();
        $Language                           = new LanguageModel();

        $usedList                           = [];
        $lastLanguage                       = [];
        $newLanguage                        = [];

        $newCategoryDetails                 = $Category->getCategory($newId);
        $newInCategoryDetails               = $Category->getCategoriesAltID($newId);
        foreach ($Language->getsActiveLanguage() as $activeLanguage) {
            $languageCode = $activeLanguage->languageCode;

            $newLanguage[$languageCode] = $Category->getCategoryDetails($newId, $languageCode);
        };

        try {
            while (true) {
                $useFlag        = 0;
                $usedList[]     = $newId;

                $lastCategory           = $Category->getCategory($lastId);
                $lastInCategory         = $Category->getCategoriesAltID($lastId);
                foreach ($Language->getsActiveLanguage() as $activeLanguage) {
                    $languageCode = $activeLanguage->languageCode;

                    $lastLanguage[$languageCode] = $Category->getCategoryDetails($lastId, $languageCode);
                };

                $ACategory->updCategory($lastId, $newCategoryDetails->AltID, $newCategoryDetails->link, $newCategoryDetails->image, $newCategoryDetails->rumuz);
                foreach ($newLanguage as $newKeyLanguage => $newValueLanguage) {
                    $ACategory->updCategoryDetails($newValueLanguage->id, $lastId, $newKeyLanguage);
                }
                foreach ($newInCategoryDetails as $newInCategoryDetail) {
                    $ACategory->updCategoryAltID($newInCategoryDetail->MenuID, $lastId);
                }


                $newInCategoryDetails   = $lastInCategory;
                $newCategoryDetails     = $lastCategory;
                $newLanguage            = $lastLanguage;

                $newId                  = $lastId;
                $lastId                 = $myList[$lastId]["lastkeyid"];

                foreach ($usedList as $used) {
                    if ($used == $newId) {
                        $useFlag = 1;
                        break;
                    }
                }
                if ($useFlag) {
                    break;
                }
            }
        } catch (Exception $as) {
            echo "thi";
        }
        return $usedList;
    }
}
