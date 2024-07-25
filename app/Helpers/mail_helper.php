<?php
    function mailSendHelper($Title, $Message, $heMail){
        $email = \Config\Services::email();
        $email->setFrom("ankamenu@ankamenu.com", "AstroGorya");
        $email->setTo($heMail);
        
        $email->setSubject($Title);
        $email->setMessage($Message);
        
        return $email->send();
    }
?>

