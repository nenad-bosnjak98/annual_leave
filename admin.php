<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Pending Requests</title>
</head>
<body>
<div class='jsontxt' id="files">

<?php
require 'accept.php';
$pending = file_get_contents('js/pending.json');
$penarray = json_decode($pending, true);
$i = 0;

foreach($penarray as $key => $value) {

    
    if (!is_array($value)) {
        echo $key . '=>' . $value . '<br/>';
    } else {
        foreach ($value as $key => $val) {
            echo $key . '=>' . $val . '<br/>';
        }
    }


    echo '<br>';
    echo '<a id="button1" href="admin.php?id='.$penarray[$i]["id"].'">Accept</a>';
    echo "<a id='button2'>Decline</a>";
    echo '<br>';
    echo '<br>';
    $i++;
}
?>
  </div>
</body>
</html>