
    <?php

function myOptionFind($urunNumber, $gender){
    exec("getData " . $urunNumber . " " . $gender , $out);
    return $out[0];
}