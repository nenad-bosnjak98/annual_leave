<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests</title>
</head>
<body>

<?php 
$pending = file_get_contents('js/pending.json');
$penarray = json_decode($pending, true);

foreach($penarray as $key => $value) {
    if (!is_array($value)) {
        echo $key . '=>' . $value . '<br/>';
    } else {
        foreach ($value as $key => $val) {
            echo $key . '=>' . $val . '<br/>';
        }
    }
    
}
echo "<button type='submit' name='reset'>Clear</button>
    <button type='submit' name='submit'>Submit</button>";
?>
    
</body>
</html>