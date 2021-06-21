<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Approved Requests</title>
</head>
<body>
<div class='jsontxt' id="files">
<h1 style='text-align:center;'>APPROVALS</h1>
<?php
require 'accept.php';
$pending = file_get_contents('js/approved.json');
$penarray = json_decode($pending, true);

if(empty($penarray)) {
    echo '<h2>There are no approvals yet!</h2>';
}
else {

foreach($penarray as $key => $value) {

    
    if (!is_array($value)) {
        echo $key . '=>' . $value . '<br/>';
    } else {
        foreach ($value as $key => $val) {
            echo $key . '=>' . $val . '<br/>';
        }
    }

    
    echo '<br>';
    echo '<br>';
}
}
?>
  </div>
  
</body>
</html>