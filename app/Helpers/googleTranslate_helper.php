<?php

use Stichoza\GoogleTranslate\GoogleTranslate;
function translateActive(){
    $tr = new GoogleTranslate();
    $tr->setSource('tr'); // Translate from English

    if(isset($_COOKIE["language"])){
        $incomingLanguage = SecurityFilter($_COOKIE["language"]);
        if($incomingLanguage == "tr"){
            return 0;
        }
        $tr->setTarget($incomingLanguage); // Translate to Georgian
        return $tr;
    }else{
        return 0;
    }
}
function translateFactory($tr, $text){
    if($tr){
        return $tr->translate($text);
    }else{
        return $text;
    }
}
function detectedLanguage(){
    if(isset($_COOKIE["language"])){
        $incomingLanguage = SecurityFilter($_COOKIE["language"]);
     
        return $incomingLanguage;
    }else{
        return "tr";
    }
}
function translateOwner($language, $text){
    $tr = new GoogleTranslate();
    $tr->setSource('tr'); 
    $tr->setTarget($language); 
    return $tr->translate($text);

}
function detectedTranslate($text){
    if(isset($_COOKIE["language"])){
        $tr = new GoogleTranslate();
        
        $tr->setSource();
        
        $tr->setTarget("tr"); 
        return $tr->translate($text);
    }else{
        return $text;
    }
}
function translateToAll($text, $language){
    $tr = new GoogleTranslate();
    
    $tr->setSource();
    
    $tr->setTarget($language);
    return $tr->translate($text);
}
?>