<?php

namespace App\Controllers\Fpanel;

// USE
    use App\Controllers\BaseController;

    use App\Models\Admin\ALogModel;
    use App\Models\Admin\AOwnerModel;
    use App\Models\Admin\APanelModel;
use App\Models\InfoEnterModel;
use App\Models\SettingModel;

// EXTRA USE
    helper("minRequire");
    $session = \Config\Services::session();

class Panel extends BaseController
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
        $APanel  = new APanelModel();
        $InfoEnter  = new InfoEnterModel();
        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);
        
        // Extra Starter Alert
        if ($Action == "ustYetki") {
            $this->data["actionName"] = "ustYetki";
            $this->data["action"] = "Üst yetkiye sahip olmalısın.";
            $this->data["actionStatus"] = "danger";
        }

        // Main
        if ($this->data["owner"]->rankID == 2) { // Bank
            if ($Action == "") {
                header("Location: " . base_url("Fpanel/desk"));;
            } else {
                header("Location: " . base_url("Fpanel/deskPlus/$Action"));
            }
            exit();
        } else if ($this->data["owner"]->rankID == 3) { // Waiter
            if ($Action == "") {
                header("Location: " . base_url("Fpanel/waiter"));
            } else {
                header("Location: " . base_url("Fpanel/waiterPlus/$Action"));
            }
            exit();
        }
        $inData = array(
            ["Günlük Ziyaretçi"     ,$InfoEnter->getInfoUniqueUserForDay()  ,"fa-solid fa-users"            ],
            ["Günlük İzlenme"       ,$InfoEnter->getInfoUserForDay()        ,"fa-solid fa-eye"              ],
            ["Toplam Ziyaretçi"     ,$InfoEnter->getInfoUniqueUsers()       ,"fa-solid fa-users"            ],
            ["Toplam İzlenme"       ,$InfoEnter->getInfoUsers()             ,"fa-solid fa-glasses"          ],
            ["Yönetici"             ,$APanel->sumOwner()                    ,"fa-solid fa-user-gear"        ],
            ["Menü"                 ,$APanel->sumMenu()                     ,"fa-solid fa-folder-open"      ],
            ["Ürün"                 ,$APanel->sumProduct()                  ,"fa-solid fa-squarespace"      ],
            ["Aktif Dil"            ,$APanel->sumLanguage()                 ,"fa-solid fa-language"         ],
            ["Log"                  ,$APanel->sumLog()                      ,"fa-solid fa-chart-simple"     ],
        );

        $this->data["panels"] = $inData;
        
        // Result
        return view("Fpanel/pano", $this->data);
    }
}
