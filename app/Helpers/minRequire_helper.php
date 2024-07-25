<?php
    function alertHelper($Action = "0", $lastData){
        $data                           = [];
    // No Data

        $data["actionName"]             = "";
        $data["action"]                 = "";
        $data["actionStatus"]           = "";

    // Success

        if ($Action == "200") {
            $data["actionName"]         = "Okey";
            $data["action"]             = "İşlem başarılı.";
            $data["actionStatus"]       = "success";
        }

    // Empty Data
        if ($Action == "EmptyArea") {
           $data["actionName"]          = "EmptyArea";
           $data["action"]              = "Lütfen bütün boşlukları doldurunuz.";
           $data["actionStatus"]        = "warning";
        }

    // Error Data
        if ($Action == "Technical-Error") {
            $data["actionName"]         = "technicalerror";
            $data["action"]             = "Sistemde oluşan bir hatadan dolayı işleminizde bir sorun oluştu. Lütfen daha sonra tekrar deneyiniz.";
            $data["actionStatus"]       = "danger";
        }

        return array_merge($data, $lastData);
    }
    function SecurityMaster($postList, $myList){
            $sendList = [];
            foreach($myList as $myListVal){
                $myListKey = "incoming" . ucfirst($myListVal); 
                if(isset($postList[$myListVal])){
                    $myListVal = SecurityFilter($postList[$myListVal]);
                }else{
                    $myListVal  = "";
                }
                $sendList[$myListKey] = $myListVal;
            }
            return $sendList;
    }
?>

