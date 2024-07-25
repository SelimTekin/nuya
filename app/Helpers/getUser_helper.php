<?php

use App\Models\InfoEnterModel;

function newUser($Path){
    $infoEnter      = new InfoEnterModel();
    $userIP         = $_SERVER["REMOTE_ADDR"];
    $userWhere      = "https://" . $_SERVER["SERVER_NAME"] . $Path;
    $userBrowser    = $_SERVER["HTTP_USER_AGENT"];
    $userTime       = time();

    $infoEnter->setInfo($userIP, $userWhere, $userBrowser, $userTime);
}
?>