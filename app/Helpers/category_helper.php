<?php
// My Functions

use function PHPUnit\Framework\isType;

function productWrite($data, $spaceValue) // Product Writer
{
    $html = "";
    foreach ($data as $dataKey => $dataValue) {
        $dataProductID                  = $dataValue["productID"];
        $dataProductName                = $dataValue["productName"];
        $dataProductMenuID              = $dataValue["productMenuID"];
        $clickEvent     = "";

        $htmlX = "
                        <div class='dropdown'>
                            <a class='btn btn-danger dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <i class='fa-solid fa-sliders'></i>
                            </a>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                " . $clickEvent . "
                                <div class='dropdown-item mb-2 adminSettingsArea' style='border-bottom:2px solid grey;padding-bottom:10px'>
                                    <div name='Fpanel/extraProduct/addPlusP/" . $dataProductID . "' class='goInLink'>
                                        <i class='fa-solid fa-plus'></i> Ekle
                                    </div>
                                </div>
                                <div class='dropdown-item mb-2 adminSettingsArea'>
                                    <div name='Fpanel/product/update/" . $dataProductID . "' class='goInLink adminUpdateColor'>
                                        <i class='fa-solid fa-highlighter'></i> Güncelle
                                    </div>
                                </div>
                                
                                <div class='dropdown-item adminSettingsArea'>
                                    <div name='Fpanel/product/delete_result/" .  $dataProductID . "' class='goInDeleteComplete adminDeleteColor'>
                                        <i class='fa-solid fa-trash-can'></i> Sil
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
        $html .= "
                        <div class='d-flex categoryItem' style='display:none!important'>
                            <div class='col-8 categoryMenuArea'>
                                <div style='margin-left:" . $spaceValue . "px;' class='row categoryProductBlocks categoryMenuBottomArea' name='X-" . $dataProductMenuID . "'> 
                                    <div class='categoryProductItemLineArea'>
                                        <span style='color:red'>[Urun]</span> $dataProductName
                                    </div>
                                </div> 
                            </div> 
                            <div class='col-4 categorySelectArea'>
                                $htmlX
                            </div> 
                        </div>
                    ";
    }
    return $html;
}
function menuWrite($data, $spaceValue = 0) // Menu Writer
{
    $html                   = "";
    foreach ($data as $dataKey => $dataValue) {
        $dataCategoryID         = $dataValue["categoryId"];
        $dataCategoryName       = $dataValue["categoryName"];
        $dataCategoryRumuz      = $dataValue["categoryRumuz"];
        $dataCategoryBottomId   = $dataValue["categoryBottomId"];
        if (isset($dataValue["bottomData"])) {
            $dataBottomData         = $dataValue["bottomData"];
        } else {
            $dataBottomData         = "";
        }

        if ($dataBottomData != "") {
            if ($dataCategoryRumuz == 1) {
                $clickEventProduct = "
                    <div class='dropdown-item mb-2 adminSettingsArea' name='" . $dataCategoryID . "' onclick='addCategoryProduct(this)'>
                        <i class='fa-solid fa-plus'></i> Ürün Ekle
                    </div>
                    ";
                $clickEvent = "categoryIndexChange(" . $dataCategoryID . ")";
            } else {
                $dataCategoryInBottomId = $dataValue["categoryInBottomRumuz"];
                $clickEventProduct = "";
                if($dataCategoryInBottomId == 1){
                    $clickEvent = "menuIndexChange(" . $dataCategoryID . ")";
                }else{
                    $clickEvent = "menuIndexMenuChange(" . $dataCategoryID . ")";
                }
            }
            $htmlXIn = "
                    <div class='dropdown-item mb-2 adminSettingsArea' onclick='" . $clickEvent . "'>
                        <i class='fa-solid fa-stairs'></i> Yeniden sırala
                    </div>
                    $clickEventProduct
                ";
            $htmlIcon = "
                    <i class='fa-solid fa-angle-right'></i>
                ";
        } else {
            $htmlXIn = "
            <div class='dropdown-item mb-2 adminSettingsArea' name='" . $dataCategoryID . "' onclick='addCategoryProduct(this)'>
                <i class='fa-solid fa-plus'></i> Ürün Ekle
            </div>
            ";
            $htmlIcon = "
                <i class='fa-solid fa-minus'></i>
                ";
            $clickEvent = "";
        }
        if ($dataCategoryBottomId > 1) {
            $styleFacktor = "none";
        } else {
            $styleFacktor = "flex";
        }

        $htmlX                  = "
            ";
        if ($dataCategoryID != 1) {
            $htmlX = "
                    <div class='dropdown'>
                        <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fa-solid fa-sliders'></i>
                        </a>
                        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                            " . $htmlXIn . "
                            <div class='dropdown-item mb-2 adminSettingsArea' style='border-bottom:2px solid grey;padding-bottom:10px'>
                                <div name='Fpanel/category/writeMenu/" . $dataCategoryID . "' class='goInLink'>
                                    <i class='fa-solid fa-list'></i> Yazdır
                                </div>
                            </div>
                            <div class='dropdown-item mb-2 adminSettingsArea'>
                            
                                <div name='Fpanel/category/update/" . $dataCategoryID . "' class='goInLink adminUpdateColor'>
                                    <i class='fa-solid fa-highlighter'></i> Güncelle
                                </div>
                            </div>
                            
                            <div class='dropdown-item adminSettingsArea'>
                                <div name='Fpanel/category/delete_result/" .  $dataCategoryID . "' class='goInDeleteComplete adminDeleteColor'>
                                    <i class='fa-solid fa-trash-can'></i> Sil
                                </div>
                            </div>
                        </div>
                    </div>
                ";
        } else {
            $htmlX = "
                    <div class='dropdown'>
                        <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fa-solid fa-sliders'></i>
                        </a>
                        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                            <div class='dropdown-item mb-2 adminSettingsArea' onclick='" . $clickEvent . "'>
                                <i class='fa-solid fa-stairs'></i> Yeniden sırala
                            </div>
                            <div class='dropdown-item mb-2 adminSettingsArea'>
                                <div name='Fpanel/category/writeMenu/" . $dataCategoryID . "' class='goInLink'>
                                    <i class='fa-solid fa-list'></i> Yazdır
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
        }
        if(gettype($dataBottomData) == "array"){
            $myLenght = count($dataBottomData);
        }else{
            $myLenght = 0;
        }
        $html .= "
                    <div class='d-flex categoryItem' style='display:" . $styleFacktor . "!important'>
                        <div class='col-8 categoryMenuArea'>
                            <div style='margin-left:" . $spaceValue . "px;' class='row categoryMenuBlocks categoryMenuBottomArea' name='" . $dataCategoryID . "-" . $dataCategoryBottomId . "' status='0' onclick='treeModel(this)'> 
                                <span class='categorySelectIcon' style='left: -" . ($spaceValue + 35) . "px'>
                                    " . $htmlIcon . "
                                </span>
                                <div class='categoryMenuItemLineArea'>
                                    $dataCategoryName - $myLenght 
                                </div>
                            </div>
                        </div>
                        <div class='col-4 categorySelectArea'>
                        $htmlX
                        </div> 
                    </div>
                    ";

        if ($dataBottomData != "") {
            if ($dataCategoryRumuz == 1) {
                $html .= productWrite($dataBottomData, $spaceValue + 20);
            } else {
                $html .= menuWrite($dataBottomData, $spaceValue + 20);
            }
        }
    }
    return $html;
}
function productWritePage($data) // Product Writer Page
{
    $html = "";
    foreach ($data as $dataKey => $dataValue) {
        $dataProductName                = $dataValue["productName"];
        $dataProductMenuID              = $dataValue["productMenuID"];

        $html .= "
                        <div class='d-flex categoryItem'>
                            <div class='col-8 categoryMenuArea'>
                                <div style='margin-left:20px;' class='row categoryProductBlocks categoryMenuBottomArea' name='X-" . $dataProductMenuID . "'> 
                                    <div class='categoryProductItemLineArea'>
                                        ~ $dataProductName
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    ";
    }
    return $html;
}
function menuWritePage($data) // Menu Writer Page
{
    $html                   = "";
    foreach ($data as $dataKey => $dataValue) {
        $dataCategoryID         = $dataValue["categoryId"];
        $dataCategoryName       = $dataValue["categoryName"];
        $dataCategoryRumuz      = $dataValue["categoryRumuz"];

        if (isset($dataValue["bottomData"])) {
            $dataBottomData         = $dataValue["bottomData"];
        } else {
            $dataBottomData         = "";
        }

        if ($dataCategoryID != 1) {
            $html .= "
                    <div style='border-bottom:3px solid grey;font-size:25px;text-align:left;padding:30px'>
                        $dataCategoryName  
                    </div> 
                    ";
        }

        if ($dataBottomData != "") {
            if ($dataCategoryRumuz == 1) {
                $html .= productWritePage($dataBottomData);
            } else {
                $html .= menuWritePage($dataBottomData);
            }
        }
    }
    return $html;
}
function mainWritePage($data)
{
    $html = "";
    $dataCategoryID         = $data["categoryId"];
    $dataCategoryName       = $data["categoryName"];
    $dataCategoryRumuz      = $data["categoryRumuz"];
    if ($dataCategoryID != 1) {
        $html = "
            <div style='border-bottom:3px solid grey;font-size:25px;text-align:left;padding:30px'>
                $dataCategoryName  
            </div> 
            ";
    }
    if (isset($data["bottomData"])) {
        $dataBottomData         = $data["bottomData"];
    } else {
        $dataBottomData         = "";
    }
    if ($dataCategoryRumuz == 1) {
        $html .= productWritePage($dataBottomData);
    } else {
        $html .= menuWritePage($dataBottomData);
    }
    return $html;
}
