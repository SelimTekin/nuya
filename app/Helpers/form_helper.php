<?php

function myFormItems($myForms)
{
    $html = '';
    foreach ($myForms as  $myFormValue) {

        $formStructure     = $myFormValue[0]; // structure

        if ($formStructure == 'simple') {
            $formType         = $myFormValue[1]; 
            $formName         = $myFormValue[2];
            $formLabel        = $myFormValue[3];
            $formPlace        = $myFormValue[4];

            $html .= "
                <label for='$formName' class='form-label formTextBlocks formTextBlocks'>$formLabel</label>
                <input type='$formType' class='form-control formValueBlocks formValueBlocks' name='$formName' id='$formName' aria-describedby='helpId' placeholder='$formPlace'>
            ";
        } else if ($formStructure == 'textArea') {
            $formName         = $myFormValue[1];
            $formLabel        = $myFormValue[2];
            $formPlace        = $myFormValue[3];

            $html .= "
                <label for='$formName' class='form-label formTextBlocks formTextBlocks'>$formLabel</label>
                <textarea class='form-control formValueBlocks formValueBlocks ckeditor' name='$formName' id='$formName' rows='3' placeholder='$formPlace'></textarea>
            ";

        } else if ($formStructure == 'select') {
            $formName           = $myFormValue[1];
            $formLabel          = $myFormValue[2];
            $formOptions        = $myFormValue[3];

            $htmlX = '';
            if ($formOptions) {
                foreach ($formOptions as $myOption) {
                    $myOptionValue      = $myOption[0];
                    $myOptionName       = $myOption[1];
                    $htmlX .= "
                        <option value='$myOptionValue'>$myOptionName</option>
                    ";
                }
            }
            $html .= "
                <label for='$formName' class='form-label formTextBlocks formTextBlocks'>$formLabel</label>
                <select class='form-control formValueBlocks formValueBlocks' name='$formName' id='$formName'>
                    $htmlX
                </select>
            ";
        }
    }
    return $html;
}
function myFormSelectedItems($myForms)
{
    $html = '';
    foreach ($myForms as  $myFormValue) {

        $formStructure     = $myFormValue[0]; // structure

        if ($formStructure == 'simple') {
            $formType         = $myFormValue[1]; 
            $formName         = $myFormValue[2];
            $formLabel        = $myFormValue[3];
            $formPlace        = $myFormValue[4];
            $formValue        = $myFormValue[5];

            $html .= "
                <label for='$formName' class='form-label formTextBlocks formTextBlocks'>$formLabel</label>
                <input type='$formType' class='form-control formValueBlocks formValueBlocks' name='$formName' id='$formName' aria-describedby='helpId' placeholder='$formPlace' value='$formValue'>
            ";
        } else if ($formStructure == 'textArea') {
            $formName         = $myFormValue[1];
            $formLabel        = $myFormValue[2];
            $formPlace        = $myFormValue[3];
            $formValue        = $myFormValue[4];

            $html .= "
                <label for='$formName' class='form-label formTextBlocks formTextBlocks'>$formLabel</label>
                <textarea class='form-control formValueBlocks formValueBlocks ckeditor' name='$formName' id='$formName' rows='3' placeholder='$formPlace'>$formValue</textarea>
            ";

        } else if ($formStructure == 'select') {
            $formName           = $myFormValue[1];
            $formLabel          = $myFormValue[2];
            $formOptions        = $myFormValue[3];
            $formValue          = $myFormValue[4];

            $htmlX = '';
            if ($formOptions) {
                foreach ($formOptions as $myOption) {
                    $myOptionValue      = $myOption[0];
                    $myOptionName       = $myOption[1];
                    $selected           = "";

                    if($formValue == $myOptionValue){
                        $selected       = "selected";
                    }
                    $htmlX .= "
                        <option value='$myOptionValue' $selected>$myOptionName</option>
                    ";
                }
            }
            $html .= "
                <label for='$formName' class='form-label formTextBlocks formTextBlocks'>$formLabel</label>
                <select class='form-control formValueBlocks formValueBlocks' name='$formName' id='$formName'>
                    $htmlX
                </select>
            ";
        } else if ($formStructure == 'onClickSelect') {
            $formName           = $myFormValue[1];
            $formLabel          = $myFormValue[2];
            $formOptions        = $myFormValue[3];
            $formValue          = $myFormValue[4];
            $formOnclick        = $myFormValue[5];

            $htmlX = '';
            if ($formOptions) {
                foreach ($formOptions as $myOption) {
                    $myOptionValue      = $myOption[0];
                    $myOptionName       = $myOption[1];
                    $selected           = "";

                    if($formValue == $myOptionValue){
                        $selected       = "selected";
                    }
                    $htmlX .= "
                        <option value='$myOptionValue' $selected>$myOptionName</option>
                    ";
                }
            }
            $html .= "
                <label for='$formName' class='form-label formTextBlocks formTextBlocks'>$formLabel</label>
                <select class='form-control formValueBlocks formValueBlocks' name='$formName' id='$formName' onclick='" . $formOnclick . "(this)'>
                    $htmlX
                </select>
            ";
        }
    }
    return $html;
}
?>