<?php

namespace App\Controllers\Fpanel;

// USE 
    use CodeIgniter\Controller;

    use App\Models\Admin\ALoginModel;
    use App\Models\Admin\ALogModel;
use App\Models\SettingModel;

// EXTRA USE
    helper("fonksiyonlar");
    helper("minRequire");
    $session = \Config\Services::session();

class Admin extends Controller
{
    public $data = array();
    
    public function __construct()
    {
        $ALog    = new ALogModel();
        $ALog->setLog();
    }
    
        /* Select */

    public function index($Action = "0")
    {
        if ((isset($_SESSION["Fowner"]))) {
            header("Location: " . base_url("Fpanel/Panel"));
            exit();
        }
        
        $this->data = alertHelper($Action, $this->data);
        
        // Extra Query
            if ($Action == "Bulunamadi") {
                $this->data["actionName"] = "Bulunmadi";
                $this->data["action"] = "Adinizin yada sifreniz doğru olup olmadığını tekrar kontrol ediniz. Böyle bir yönetici bulunmamaktadır.";
                $this->data["actionStatus"] = "danger";
            }
            if ($Action == "largeTry") {
                $this->data["actionName"] = "largeTry";
                $this->data["action"] = "Sisteme girdiğiniz bilgilere ait kullanıcı için varsayılan giriş hakkı bitmiştir. Lütfen Adminden isim veya şifre güncellemesi talep edin.";
                $this->data["actionStatus"] = "danger";
            }
        
        return view("Fpanel/index", $this->data);
    }
    
        /* Check */

    public function login()
    {
        if ((isset($_SESSION["Fowner"]))) {
            header("Location: " . base_url("Fpanel/Panel"));
            exit();
        }
        $ALogin = new ALoginModel();
        
        $getVals = SecurityMaster($_POST, ["Fname", "Fpassword"]);
        foreach($getVals as $getKey => $getVal){ $$getKey = $getVal; }
        
        if(!$_POST){
            if(isset($_COOKIE["loginCookieName"]) and isset($_COOKIE["loginCookiePass"])){
                $incomingFname      = SecurityFilter($_COOKIE["loginCookieName"]);
                $incomingFpassword  = SecurityFilter($_COOKIE["loginCookiePass"]);
                setcookie("loginCookieName", "123", $time - (60 * 60 * 24 * 30), "/");
                setcookie("loginCookiePass", "123", $time - (60 * 60 * 24 * 30), "/");
            }
        }
        if (($incomingFname != "") and ($incomingFpassword != "")) {
            if ($infos = $ALogin->checkSecurityLogin($incomingFname)) {
                if ($ALogin->getLogin($incomingFname, $incomingFpassword)) {
                    $_SESSION["Fowner"]    =    $incomingFname;

                    header("Location: " . base_url("Fpanel/board/Okey"));
                    exit();
                } else {
                    if ($lastSecurityStatus = $ALogin->securityLogin($incomingFname)) {
                        $ALogin->lastSecurityStatus($incomingFname, $lastSecurityStatus->securityStatus);
                    }
                    header("Location: " . base_url("FpanelPlus/Bulunamadi"));
                    exit();
                }
            } else {
                header("Location: " . base_url("FpanelPlus/largeTry"));
                exit();
            }
        } else {
            header("Location: " . base_url("FpanelPlus/EmptyArea"));
            exit();
        }
    }
    public function leave()
    {
        unset($_SESSION["Fowner"]);
        session_destroy();

        header("Location: " . base_url());
        exit();
    }
    public function change(){
        echo "hi";
        $Setting = new SettingModel();
        $Setting->changeProductImg();
    }
}
