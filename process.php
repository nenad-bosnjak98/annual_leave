<?php


if(isset($_POST['submit'])) {
    if(empty($_POST['fullname'])) {
        $error = "<label class='text-danger'>You didn't fill the full name field!</label>";
    }
    if(empty($_POST['designation'])) {
        $error = "<label class='text-danger'>You didn't fill the designation field!</label>";
    }
    if(empty($_POST['sdate'])) {
        $error = "<label class='text-danger'>You didn't fill the start date field!</label>";
    }
    if(empty($_POST['edate'])) {
        $error = "<label class='text-danger'>You didn't fill the end date field!</label>";
    }
}

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
                    $date_d = date($emp['start_date']);
                    $date_n = strtotime($date_d);
                    $oneyearless = $date->modify('-1 year')->format('Y-m-d');
                    $date_o = strtotime($oneyearless);

                    if(date('Y', $date_n) == date("Y")) {
                        $monthslastyear = 0;
                        $thisyear = $dateobj->diff($date);
                        $monthsthisyear = round($thisyear->y*12 + $thisyear->m + $thisyear->d / 30);
                    }
                    else if (date('Y', $date_n) ==  date("Y", $date_o)){


                        $dateobj1 = new DateTime($emp['start_date']);
                        $lastyear = $dateobj1->diff($endOfYear);
                        $monthslastyear = round($lastyear->y*12 + $lastyear->m + $lastyear->d / 30);

                        $thisyear = $beginningOfYear->diff($date);
                        $monthsthisyear = round($thisyear->y*12 + $thisyear->m + $thisyear->d / 30);
                    }
                    else {
                        $monthslastyear = 12;
                        $thisyear = $beginningOfYear->diff($date);
                        $monthsthisyear = round($thisyear->y*12 + $thisyear->m + $thisyear->d / 30);
                    }

                    // Remaining days last year and this year
                    $dayslastyear = round(20/12 * $monthslastyear);
                    $daysthisyear = round(20/12 * $monthsthisyear);


                    // Calculating days without weekends from start date to 30.6
                    
                    $date1 = new DateTime($_POST['sdate']);
                    $date2 = new DateTime($june);

                    $date1u = $date1->format('Y-m-d H:i:s');
                    $date2u = $date2->format('Y-m-d H:i:s');
                    $dayswithoutweekends = 0;
                    if(strtotime($date1u) < strtotime($date2u)) {
                        $interval = $date1->diff($date2);

                        for($i=0; $i<=$interval->d; $i++){
                            $weekday = $date1->format('w');
                            $date1->modify('+1 day');
                    
                            if($weekday !== "0" && $weekday !== "6"){
                                $dayswithoutweekends++;  
                            }
                    
                        }
                }

                    $days_remaining = $emp['days_remaining'];
                    // Conditions for calculating the annual leave allowed days
                    if($days > 365) {
                        if(strtotime($date1u) > strtotime($date2u)){
                            $days_remaining = 0;
                            $formula = 20;
                        }
                        else if($dayswithoutweekends < $days_remaining) {
                            $formula = 20 + $dayswithoutweekends;
                            $days_remaining = $dayswithoutweekends;
                        }
                        else if ($dayswithoutweekends >= $days_remaining) {
                            $formula = 20 + $days_remaining;
                        }


                        if(file_exists('js/pending.json')) {
                            $file = file_get_contents('js/pending.json');
                            $array = json_decode($file, true);

                            $array[] = array("id"=>$emp['id'],"full_name"=>$emp['full_name'], "designation"=>$emp['designation'], "contract_type"=>$emp['contract_type'],
                    "start_date"=>$emp['start_date'], "days_remaining_last_year"=>$days_remaining, "days_remaining_this_year"=> 20, "total days"=> $formula,
                    "start_annual"=>$_POST['sdate'], "end_annual"=>$_POST['edate']);

                            $final = json_encode($array, JSON_PRETTY_PRINT);
                            if(file_put_contents('js/pending.json', $final)) {
                                $message = "<label class='text-success' style='display:flex; justify-content: center; font-size:4rem;'>Form Data Submitted </label>";
                            }
                        }
                    }
                    
                    else {
                        if(strtotime($date1u) > strtotime($date2u)){
                            $days_remaining = 0;
                            $formula = $daysthisyear;
                        }
                        else if($dayswithoutweekends < $dayslastyear) {
                            $formula = $daysthisyear + $dayswithoutweekends;
                            $days_remaining = $dayswithoutweekends;
                        }
                        else if($dayswithoutweekends >= $dayslastyear){
                            $formula = $dayslastyear + $daysthisyear;
                            $days_remaining = $dayslastyear;
                        }
                        if(file_exists('js/pending.json')) {
                            $file = file_get_contents('js/pending.json');
                            $array = json_decode($file, true);

                            $array[] = array("id"=>$emp['id'],"full_name"=>$emp['full_name'], "designation"=>$emp['designation'], "contract_type"=>$emp['contract_type'],
                    "start_date"=>$emp['start_date'], "days_remaining_last_year"=>$days_remaining, "days_remaining_this_year"=> $daysthisyear, "total days"=> $formula,
                    "start_annual"=>$_POST['sdate'], "end_annual"=>$_POST['edate']);

                            $final = json_encode($array, JSON_PRETTY_PRINT);
                            if(file_put_contents('js/pending.json', $final)) {
                                $message = "<label class='text-success' style='display:flex; justify-content: center; font-size:4rem;'>Form Data Submitted </label>";
                            }
                        }
                    }




                }
            }
        }
    }

    
    if(isset($_POST['fullname']) && isset($_POST['designation']) && isset($_POST['sdate']) && isset($_POST['edate'])) {
        foreach($emparray as $emp) {
            if($emp['contract_type'] == "Part-Time") {
                if($emp['full_name'] == $_POST['fullname'] && $emp['designation'] == $_POST['designation']) {
                    
                    

                    $dateobj = new DateTime($emp['start_date']);
                    // Calculating ammount of months last year and this year
                    $date_d = date($emp['start_date']);
                    $date_n = strtotime($date_d);
                    $oneyearless = $date->modify('-1 year')->format('Y-m-d');
                    $date_o = strtotime($oneyearless);

                    if(date('Y', $date_n) == date('Y')) {
                        $monthslastyear = 0;
                        $thisyear = $dateobj->diff($date);
                        $monthsthisyear = round($thisyear->y*12 + $thisyear->m + $thisyear->d / 30);
                    }
                    else if (date('Y', $date_n) == date("Y", $date_o)){


                        $dateobj1 = new DateTime($emp['start_date']);
                        $lastyear = $dateobj1->diff($endOfYear);
                        $monthslastyear = round($lastyear->y*12 + $lastyear->m + $lastyear->d / 30);

                        $thisyear = $beginningOfYear->diff($date);
                        $monthsthisyear = round($thisyear->y*12 + $thisyear->m + $thisyear->d / 30);
                    }
                    else {
                        $monthslastyear = 12;
                        $thisyear = $beginningOfYear->diff($date);
                        $monthsthisyear = round($thisyear->y*12 + $thisyear->m + $thisyear->d / 30);
                    }

                    // Remaining days last year and this year
                    $dayslastyear = round(20/12 * $monthslastyear);
                    $daysthisyear = round(20/12 * $monthsthisyear);



                    // Calculating days without weekends from start date to 30.6
                    $date1 = new DateTime($_POST['sdate']);
                    $date2 = new DateTime($june);

                    $date1u = $date1->format('Y-m-d H:i:s');
                    $date2u = $date2->format('Y-m-d H:i:s');
                    $dayswithoutweekends = 0;
                    if(strtotime($date1u) < strtotime($date2u)) {
                        $interval = $date1->diff($date2);

                        for($i=0; $i<=$interval->d; $i++){
                            $weekday = $date1->format('w');
                            $date1->modify('+1 day');
                    
                            if($weekday !== "0" && $weekday !== "6"){
                                $dayswithoutweekends++;  
                            }
                    
                        }
                }



                    // Conditions for calculating the annual leave allowed days
                    
                    if(strtotime($date1u) > strtotime($date2u)){
                        $days_remaining = 0;
                        $formula = $daysthisyear;
                    }
                    else if($dayswithoutweekends < $dayslastyear) {
                        $formula = $daysthisyear + $dayswithoutweekends;
                        $days_remaining = $dayswithoutweekends;
                    }
                    else if($dayswithoutweekends >= $dayslastyear){
                        $formula = $dayslastyear + $daysthisyear;
                        $days_remaining = $dayslastyear;
                    }
                    if(file_exists('js/pending.json')) {
                        $file = file_get_contents('js/pending.json');
                        $array = json_decode($file, true);

                        $array[] = array("id"=>$emp['id'],"full_name"=>$emp['full_name'], "designation"=>$emp['designation'], "contract_type"=>$emp['contract_type'],
                "start_date"=>$emp['start_date'], "days_remaining_last_year"=>$days_remaining, "days_remaining_this_year"=> $daysthisyear, "total days"=> $formula,
                "start_annual"=>$_POST['sdate'], "end_annual"=>$_POST['edate']);

                        $final = json_encode($array, JSON_PRETTY_PRINT);
                        if(file_put_contents('js/pending.json', $final)) {
                            $message = "<label class='text-success' style='display:flex; justify-content: center; font-size:4rem;'>Form Data Submitted </label>";
                        }
                    }



                }
            }
        }
    }
?>