<?php

namespace App\Controllers\Fpanel;

// USE
    use App\Controllers\BaseController;

    use App\Models\Admin\ALogModel;
    use App\Models\Admin\AOwnerModel;
    use App\Models\Admin\ASettingModel;
    use App\Models\SettingModel;
    use Exception;

// EXTRA USE
    helper("minRequire");
    helper("fonksiyonlar");
    $session = \Config\Services::session();

class Setting extends BaseController
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

        /* Select */

    public function index($Action = "0")
    {
        // Get Models
        $Setting = new SettingModel();
        
        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);
        
        // Main
        $this->data["settings"] = $Setting->getSettings();
        $this->data["whichLocations"] = [["Ayarlar","Settings"]];

        // Result
        return view("Fpanel/setting", $this->data);
    }

        /* Update */

    public function update_result()
    {
        $Setting = new SettingModel();
        $ASetting = new ASettingModel();

        
        $getVals = SecurityMaster($_POST, [
            "siteName", "siteTitle", "siteDescription", "siteKeywords", "siteCopyright",
            "phone", "address", "socialLinkEmail", "socialLinkFacebook", "socialLinkTwitter", "socialLinkInstagram", "socialLinkLinkedin"
        ]); // incoming add
        foreach($getVals as $getKey => $getVal){ $$getKey = $getVal; }

        $incomingFiles = $this->request->getFiles();

        foreach($incomingFiles as $incomingFileKey => $incomingFileValue){
            if ($incomingFileValue->getName() != "") {
                $imgName    = ImgNameCreator();
                $incomingImgExtra    =    substr($incomingFileValue->getName(), -4);
                if ($incomingImgExtra == "jpeg") {
                    $incomingImgExtra    =    "." . $incomingImgExtra;
                }
                $fullImgName    = $imgName . $incomingImgExtra;
                $this->data = array(
                    $incomingFileKey => $fullImgName
                );
                $contentInfo        =   $Setting->getSettings();
    
                if(!isset($contentInfo->$incomingFileKey)){
                    $contentImage = "";
                }else{
                    $contentImage = $contentInfo->$incomingFileKey;
                }
                
                $deletedFilePath        = "img/serverLogo/" . $contentImage;
                if ($deletedFilePath != "img/serverLogo/") {
                    try {                    
                        unlink($deletedFilePath);
                    } catch (Exception $err) {
                    }
                }
                $incomingFileValue->move("img/serverLogo", $fullImgName);
                if ($incomingFileValue->hasMoved()) {
                    if (!$ASetting->updSetting($this->data)) {
                        header("Location: " . base_url("Fpanel/settingPlus/Technical-Error"));
                        exit();
                    }
                } else {
                    header("Location: " . base_url("Fpanel/settingPlus/Technical-Error"));
                    exit();
                }
            };
        }
        
        if (($incomingSiteName != "") and ($incomingSiteTitle != "") and ($incomingSiteDescription != "")
            and ($incomingSiteKeywords != "") and ($incomingSiteCopyright != "") and ($incomingPhone != "") and ($incomingAddress != "")
            and ($incomingSocialLinkEmail != "") and ($incomingSocialLinkFacebook != "") and  ($incomingSocialLinkTwitter != "") 
            and ($incomingSocialLinkInstagram != "") and ($incomingSocialLinkLinkedin != "") 
        ) {
            $this->data = array(
                "siteName" => $incomingSiteName,
                "siteTitle" => $incomingSiteTitle,
                "siteDescription" => $incomingSiteDescription,
                "siteKeywords" => $incomingSiteKeywords,
                "siteCopyright" => $incomingSiteCopyright,
                "phone" => $incomingPhone,
                "address" => $incomingAddress,
                "socialLinkEmail" =>    $incomingSocialLinkEmail,
                "socialLinkFacebook" => $incomingSocialLinkFacebook,
                "socialLinkTwitter" =>  $incomingSocialLinkTwitter,
                "socialLinkInstagram" =>$incomingSocialLinkInstagram,
                "socialLinkLinkedin" => $incomingSocialLinkLinkedin
            );
            if ($ASetting->updSetting($this->data)) {
                header("Location: " . base_url("Fpanel/settingPlus/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/settingPlus/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/settingPlus/EmptyArea"));
            exit();
        }
    }
}
