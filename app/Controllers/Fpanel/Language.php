<?php

namespace App\Controllers\Fpanel;

// USE
    use App\Controllers\BaseController;
    use App\Models\Admin\ADatabaseCreatorModel;
    use App\Models\Admin\ALanguageModel;
    use App\Models\Admin\ALogModel;
    use App\Models\Admin\AOwnerModel;
    use App\Models\LanguageModel;
    use stdClass;

// EXTRA USE
    helper(["fonksiyonlar", "minRequire", "googleTranslate"]);
    $session = \Config\Services::session();

class Language extends BaseController
{
    public $data = array();

    public function __construct()
    {
        $ALog    = new ALogModel();
        $AOwner   = new AOwnerModel();
        $Admin      = new Admin();

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

    public function index($Action = "0")
    {
        // Get Path
        $this->data["PATH"] = $this->request->getUri()->getPath();

        // Get Models
        $AOwner     = new AOwnerModel();
        $Language   = new LanguageModel();

        // Important Query
        if (!($AOwner->getOwnerFU($_SESSION["Fowner"])->rankID == 1)) {
            header("Location: " . base_url("Fpanel/owner/update/" . $this->data["owner"]->id));
            exit();
        }

        // Starter Alert ?
        $this->data = alertHelper($Action, $this->data);

        // Extra Starter Alert
        if ($Action == "languagetr") {
            $data["actionName"]         = "Language Error";
            $data["action"]             = "'TR' dilini silemezsiniz.";
            $data["actionStatus"]       = "danger";
        }

        // Main
        $this->data["Languages"]           = $Language->getLanguages();
        $this->data["whichLocations"]   = [["Dil Seçenekleri", "Language"]];

        // Result
        return view("Fpanel/language", $this->data);
    }

    /* Add */

    public function add_result($id = "0")
    {
        $ADCreator = new ADatabaseCreatorModel();
        $Language = new LanguageModel();
        $ALanguage = new ALanguageModel();
        

        if ($id != "0") {
            $incomingId        =    SecurityFilter($id);
        } else {
            $incomingId        =    "";
        }
        if ($incomingId != "") {
            if ($incomingLanguage = $Language->getLanguage($incomingId)) {

                $incomingLanguageWho = $incomingLanguage->languageCode;
                if (($incomingLanguageWho != "")) {

                    // Menu 
                        if ($incomingLastData = $ADCreator->createDatabaseMenu($incomingLanguageWho)) { // Added
                            foreach ($incomingLastData as $r) {
                                $newName = translateOwner($incomingLanguageWho, $r->name);
                                $data = array(
                                    'name'      => $newName,
                                    'MenuID'    => $r->MenuID,
                                );
                                if(!$ADCreator->newDatabaseInsertMenu($incomingLanguageWho, $data)){
                                    header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                                    exit();
                                }
                            }
                        } else {
                            header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                            exit();
                        }

                    // Product
                        if ($incomingLastData = $ADCreator->createDatabaseProduct($incomingLanguageWho)) { // Added
                            foreach ($incomingLastData as $r) {
                                $newName = translateOwner($incomingLanguageWho, $r->name);
                                $newText = translateOwner($incomingLanguageWho, $r->text);
                                $data = array(
                                    'name' => $newName,
                                    'text' => $newText,
                                    'ProductID' => $r->ProductID,
                                );
                                if(!$ADCreator->newDatabaseInsertProduct($incomingLanguageWho, $data)){
                                    header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                                    exit();
                                }
                            }
                        } else {
                            header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                            exit();
                        }

                    // Min Language
                        if ($incomingLastData = $ADCreator->addDatabaseMinLanguage($incomingLanguageWho)) { // Added
                            // Public
                            $id             = 1;
                            $defaultData = json_decode($incomingLastData[0]->default);
                            $myData      = new stdClass;
                            foreach($defaultData as $key => $defaultD){
                                $myData->$key = translateOwner($incomingLanguageWho, $defaultD);
                            }
                            $data = array(
                                $incomingLanguageWho => json_encode($myData)
                            );
                            if(!$ADCreator->newDatabaseInsertMinLanguage($id, $data)){
                                header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                                exit();
                            }
                            // Fpanel
                        } else {
                            header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                            exit();
                        }
                    if($ALanguage->updLanguageActiveted($incomingId)){
                        header("Location: " . base_url("Fpanel/languagePlus/200"));
                        exit();
                    }else{
                        header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                        exit();
                    }
                } else {
                    header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                    exit();
                }
            }else{
                header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                exit();
            }
        } else {
            header("Location: " . base_url("Fpanel/languagePlus/EmptyArea"));
            exit();
        }
    }

    /* Delete */

    public function delete_result($id)
    {
        $Language = new LanguageModel();
        $ALanguage = new ALanguageModel();
        $ADCreator  = new ADatabaseCreatorModel();

        if ($id != 0) {
            $incomingId        =    SecurityFilter($id);
        } else {
            $incomingId        =    "";
        }
        if($incomingId != ""){
            if ($incomingLanguage = $Language->getLanguage($incomingId)) {

                $incomingLanguageWho = $incomingLanguage->languageCode;

                if ($incomingLanguageWho != "") {
                    if($result = $ADCreator->deleteDatabase($incomingLanguageWho)){
                        if($result == "1"){
                            if($ALanguage->updLanguageDeActiveted($incomingLanguage->id)){
                                header("Location: " . base_url("Fpanel/languagePlus/200"));
                                exit();
                            }
                        }else{

                            header("Location: " . base_url("Fpanel/languagePlus/languagetr"));
                            exit();
                        }
                    }else{
                        header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                        exit();
                    }
                }else{
                    header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                    exit();
                }
            }else{
                header("Location: " . base_url("Fpanel/languagePlus/Technical-Error"));
                exit();
            }
        }
    }
}
