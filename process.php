<?php

$employees = file_get_contents('js/employees.json');
$emparray = json_decode($employees, true);
$endOfYear = new DateTime('last day of December last year');
$beginningOfYear = new DateTime('first day of January this year');

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

                    
                    // Calculating ammount of months last year and this year

                    $dateobj1 = new DateTime($_POST['sdate']);
                    $lastyear = $dateobj1->diff($endOfYear);
                    $monthslastyear = round($lastyear->y*12 + $lastyear->m + $lastyear->d / 30);

                    echo $monthslastyear;
                    echo '<br>';

                    $thisyear = $beginningOfYear->diff($date);
                    $monthsthisyear = round($thisyear->y*12 + $thisyear->m + $thisyear->d / 30);

                    echo $monthsthisyear;
                    echo '<br>';

                    // Remaining days last year
                    $dayslastyear = 20/12 * $monthslastyear;




                    // Conditions for calculating the annual leave allowed days
                    if($days > 365) {
                        $formula = 20 + $dayswithoutweekends;
                    }
                    else {
                        
                        $formula = round(20/12 * $months);
                    }

                    echo $formula;


                }
            }
        }
    }












?>