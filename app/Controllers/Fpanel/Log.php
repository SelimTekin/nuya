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

class Log extends BaseController
{
    public $data = array();

    public function __construct()
    {   
        $AOwner     = new AOwnerModel();
        $Admin      = new Admin();

        if (!(isset($_SESSION["Fowner"]))) {
            header("Location: " . base_url("Fpanel"));
            exit();
        }else{
            if(!($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)){
                header("Location: " . base_url("Fpanel/ownerPlus/ustYetki"));
                exit();
            } else{
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
        $Owner = new AOwnerModel();

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Main
        $this->data["Owners"]           = $Owner->getOwners();
        $this->data["whichLocations"]   = [["Kayıtlar","Log"]];
        $this->data["whichExtras"]      = [['<i class="fa-solid fa-bars"></i> Bütün veriler',"Log/LogAll"]];

        // Result
        return view("Fpanel/logers", $this->data);
    }
    public function logAll($Action = "0")
    {
        // Get Models
        $Logs = new ALogModel();

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Main
        $Logs = new ALogModel();
        $this->data["Logs"] = $Logs->getLogs();

        $this->data["whichLocations"] = [["Kayıtlar","Log"],["Bütün Kayıtlar","Log/logAll"]];
        $this->data["whichExtras"]    = [['<i class="fa-solid fa-trash-can"></i> Verilerin hepsini sil',"Log/delete_all_result"]];

        // Result
        return view("Fpanel/logAll", $this->data);
    }
    public function loger($ownerName = "0", $Action = "0")
    {
        // Get Models
        $Logs = new ALogModel();

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Main
        if ($ownerName != "0") {
            $incomingOwnerName         =    SecurityFilter($ownerName);
        } else {
            $incomingOwnerName         =    "";
        }
        $this->data["ownerName"]        = $ownerName;
        $this->data["Logs"]             = $Logs->getLog($incomingOwnerName);
        $this->data["whichLocations"]   = [["Kayıtlar","Log"],["Kayıtçı Detayı","Log/loger/" . $incomingOwnerName]];
        $this->data["whichExtras"]      = [['<i class="fa-solid fa-trash-can"></i> Verileri Sil</i>',"Log/delete_result/" . $incomingOwnerName]];

        // Result
        return view("Fpanel/log", $this->data);
    }

        /* Delete */

    public function delete_all_result(){
        $ALog = new ALogModel();
        if ($ALog->delLogs()) { // true or false
            header("Location: " . base_url("Fpanel/logAllPlus/200"));
            exit();
        } else {
            header("Location: " . base_url("Fpanel/logAllPlus/Technical-Error"));
            exit();
        }
    }
    public function delete_result($ownerName)
    {
        $ALog = new ALogModel();
        if ($ownerName != "0") {
            $incomingId        =    SecurityFilter($ownerName);
        } else {
            $incomingId        =    "";
        }
        if ($incomingId != "") {
            if ($ALog->delLog($ownerName)) { // true or false
                header("Location: " . base_url("Fpanel/logPlus/$ownerName/200"));
                exit();
            } else {
                header("Location: " . base_url("Fpanel/logPlus/$ownerName/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/logPlus/$ownerName/EmptyArea"));
            exit();
        }
    }
}
