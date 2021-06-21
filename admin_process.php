<?php 

$admins = file_get_contents('js/administrators.json');
$adminsarray = json_decode($admins, true);

if(isset($_POST['username']) && isset($_POST['password'])) {
    foreach($adminsarray as $ad) {
        if($ad['username'] == $_POST['username'] && $ad['password'] == $_POST['password']){
            header("location: admin.php"); 
        }
        else {
            $error_admin = "<label class='text-danger' style='display:flex; justify-content: center; font-size:3rem;'>You didn't enter the correct credentials or you didn't fill all fields!</label>";
        }
    }
}




?>