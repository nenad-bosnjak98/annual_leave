<?php 

$admins = file_get_contents('js/administrators.json');
$adminsarray = json_decode($admins, true);

if(isset($_POST['username']) && isset($_POST['password'])) {
    foreach($adminsarray as $ad) {
        if($ad['username'] == $_POST['username'] && $ad['password'] == $_POST['password']){
            header("location: admin.php"); 
        }
    }
}




?>