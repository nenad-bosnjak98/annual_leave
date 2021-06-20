<?php

$employees = file_get_contents('js/employees.json');
$emparray = json_decode($employees, true);
$endOfYear = new DateTime('last day of December last year');
$beginningOfYear = new DateTime('first day of this year');

$date = new DateTime('now');
$june = date('Y-06-30');

if(isset($_POST['fullname']) && isset($_POST['designation']) && isset($_POST['sdate']) && isset($_POST['edate'])) {
        foreach($emparray as $emp) {
            if($emp['contract_type'] == "Full-Time") {
                if($emp['full_name'] == $_POST['fullname'] && $emp['designation'] == $_POST['designation']) {
                    
                    // Calculating if a user has worked for more than a year

                    $dateobj = new DateTime($emp['start_date']);
                    $realdate = $date->diff($dateobj);
                    $days = $realdate->days;


                }
            }
        }
    }












?>