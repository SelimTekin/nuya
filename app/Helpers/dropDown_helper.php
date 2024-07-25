<?php
    function myDropDown($dropDownItemList){
        $html = '';
        foreach($dropDownItemList as $dropDownKey => $dropDownValue){
            $extraMargin = '';
            if($dropDownKey != (count($dropDownItemList)-1)){
                $extraMargin = 'mb-2';
            }
            $dropDownName   = $dropDownValue[0];
            $dropDownClass  = $dropDownValue[1];
            $dropDownIcon   = $dropDownValue[2];
            $dropDownText   = $dropDownValue[3];
            $html .="
                <div class='dropdown-item $extraMargin adminSettingsArea'>
                    <div name='$dropDownName' class='$dropDownClass'> 
                        <i class='$dropDownIcon'></i> 
                        $dropDownText 
                    </div>
                </div>
            ";
        }
        return $html;
    }
?>