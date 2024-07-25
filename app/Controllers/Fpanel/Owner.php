<?php

namespace App\Controllers\Fpanel;

// USE
    use App\Controllers\BaseController;

    use App\Models\Admin\ALogModel;
    use App\Models\Admin\AOwnerModel;

// EXTRA USE
    helper("fonksiyonlar");
    helper("minRequire");
    $session = \Config\Services::session();

class Owner extends BaseController
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
        $AOwner   = new AOwnerModel();

        // Important Query
        if (!($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)) {
            header("Location: " . base_url("Fpanel/owner/update/" . $this->data["owner"]->id));
            exit();
        }

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
        $this->data["Owners"]           = $AOwner->getOwners();
        $this->data["whichLocations"]   = [["Yöneticiler", "Owner"]];
        $this->data["whichExtras"]      = [['Yeni Ekle <i class="fa-solid fa-plus"></i>', "Owner/add"], ['Kayıtlar', "Log"]];

        // Result
        return view("Fpanel/owner", $this->data);
    }

        /* Add */

    public function add($Action = "0")
    {
        // Get Models
        $AOwner     = new AOwnerModel();

        // Important Query
        if (!($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)) {
            header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
            exit();
        }
        
        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Main
        $this->data["whichLocations"]   = [["Yöneticiler", "Owner"], ["Yönetici Ekle", "Owner/add"]];
        $this->data["ranks"]            = $AOwner->getOwnerRanks();

        // Result
        return view("Fpanel/ownerAdd", $this->data);
    }
    public function add_result()
    {
        $AOwner     = new AOwnerModel();
        if (!($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)) {
            header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
            exit();
        }

        $getVals = SecurityMaster($_POST, ["userName", "password", "name", "email", "rank"]); // incoming add
        foreach($getVals as $getKey => $getVal){ $$getKey = $getVal; }

        if (($incomingUserName != "") and ($incomingPassword != "") and ($incomingName != "") and ($incomingEmail != "") and ($incomingRank != "")) {
            $md5Using = md5($incomingPassword);
            if ($AOwner->setOwner($incomingUserName, $md5Using, $incomingName, $incomingEmail, $incomingRank)) { // Added
                header("Location: " . base_url("Fpanel/owner/addPlus/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/owner/addPlus/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/owner/addPlus/EmptyArea"));
            exit();
        }
    }

        /* Update */

    public function update($id = "0", $Action = "0")
    {
        // Get Models
        $AOwner     = new AOwnerModel();

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Main
        if ($id != "0") {
            $incomingId            =    SecurityFilter($id);
        } else {
            $incomingId            =    "";
        }
        if ($incomingId != ($AOwner->getOwnerFU($_SESSION["Fowner"])->id)) {
            if (($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)) {
                if ($AOwner->getOwner($incomingId)->rankID == 1) {
                    header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
                    exit();
                }
            } else {
                header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
                exit();
            }
        }
        if ($incomingId != "") {
            if ($contentInfo    =    $AOwner->getOwner($incomingId)) {
                $this->data["incomingId"]       = $incomingId;
                $this->data["contentInfo"]      = $contentInfo;

                $this->data["whichLocations"]   = [["Yöneticiler", "Owner"], ["Yönetici Güncelle", "Owner/update/" . $incomingId]];
                $this->data["ranks"]            = $AOwner->getOwnerRanks();

                // Result
                return view("Fpanel/ownerUpdate", $this->data);
            } else {
                header("Location: " . base_url("Fpanel/ownerPlus/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/ownerPlus/EmptyArea"));
            exit();
        }
    }

    public function update_result($id = "0")
    {
        $AOwner  = new AOwnerModel();
        if ($id != "0") {
            $incomingId            = SecurityFilter($id);
        } else {
            $incomingId            = "";
        }
        if ($incomingId != ($AOwner->getOwnerFU($_SESSION["Fowner"])->id)) {
            if (($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)) {
                if ($AOwner->getOwner($incomingId)->rankID == 1) {
                    header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
                    exit();
                }
            } else {
                header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
                exit();
            }
        }

        $getVals = SecurityMaster($_POST, ["userName", "password", "name", "email", "rankID"]); // incoming add
        foreach($getVals as $getKey => $getVal){ $$getKey = $getVal; }

        if (($incomingUserName != "") and ($incomingName != "") and ($incomingEmail != "")) {
            $data = array(
                "userName" => $incomingUserName,
                "name" => $incomingName,
                "email" => $incomingEmail,
                "securityStatus" => 0
            );
            if ($this->data["owner"]->rankID == 1) {
                if ($incomingId != ($AOwner->getOwnerFU($_SESSION["Fowner"]))) {
                    if($incomingRankID != ""){
                        $data["rank"] = $incomingRankID;
                    }
                }
            }
            if ($incomingPassword != "") {
                $md5Using = md5($incomingPassword);
                $data["password"] = $md5Using;
            }
            if ($AOwner->updOwner($incomingId, $data)) {
                header("Location: " . base_url("Fpanel/owner/updatePlus/$incomingId/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/owner/updatePlus/$incomingId/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/owner/updatePlus/$incomingId/EmptyArea"));
            exit();
        }
    }

        /* Delete */

    public function delete_result($id = "0")
    {
        $AOwner      = new AOwnerModel();
        if ($id != "0") {
            $incomingId        =    SecurityFilter($id);
        } else {
            $incomingId        =    "";
        }
        if ($incomingId != "") {
            if ($incomingId != $AOwner->getOwnerFU($_SESSION["Fowner"])->id) {
                if (!($AOwner->getOwner($incomingId)->rankID == 1)) {
                    if ($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1) {
                        if ($AOwner->delOwner($incomingId)) { // true or false
                            header("Location: " . base_url("Fpanel/ownerPlus/200"));
                            exit();
                        } else {
                            header("Location: " . base_url("Fpanel/ownerPlus/Technical-Error"));
                            exit();
                        }
                    } else {
                        header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
                        exit();
                    }
                } else {
                    header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
                    exit();
                }
            } else {
                header("Location: " . base_url("Fpanel/ownerPlus/kendim"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/ownerPlus/EmptyArea"));
            exit();
        }
    }
}
