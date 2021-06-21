<?php

@$id = $_GET["id"]; 


$pending = file_get_contents('js/pending.json');
$penarray = json_decode($pending, true);

$i = 0;
foreach($penarray as $pen) {
    if($pen['id'] == $id) {

        $appr = file_get_contents('js/approved.json');
        $apprarray = json_decode($appr, true);

        $apprarray[] = $pen;

        $final = json_encode($apprarray, JSON_PRETTY_PRINT);
        file_put_contents('js/approved.json', $final);

        unset($penarray[$i]);
        $penarray = array_values($penarray);
        $pennew = json_encode($penarray, JSON_PRETTY_PRINT);
        file_put_contents('js/pending.json', $pennew);
    }
    $i++;
}



?>