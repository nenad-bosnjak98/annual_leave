<?php

if(isset($_POST['fullname']) && isset($_POST['designation']) && isset($_POST['date']) && (isset($_POST['fulltime']) || isset($_POST['parttime']))) {
    if(isset($_POST['fulltime'])) {
        echo $_POST['fullname'];
        echo "<br>";
        echo $_POST['designation'];
        echo "<br>";
        echo $_POST['date'];
        echo "<br>";
        echo $_POST['fulltime'];
    }
    if(isset($_POST['parttime'])) {
        print $_POST['fullname'];
        echo "<br>";
        print $_POST['designation'];
        echo "<br>";
        print $_POST['date'];
        echo "<br>";
        print $_POST['parttime'];
    }
}






?>