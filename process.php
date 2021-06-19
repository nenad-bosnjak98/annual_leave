<?php

$employees = file_get_contents('js/employees.json');
$emparray = json_decode($employees, true);




if(isset($_POST['fullname']) && isset($_POST['designation']) && isset($_POST['date'])) {
    if(isset($_POST['fulltime'])) {
        foreach($emparray as $emp) {
            if($emp['full_name'] == $_POST['fullname'] && $emp['designation'] == $_POST['designation'] && $emp['start_date'] == $_POST['date'] ) {
                print_r($emp);
            }
        }
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