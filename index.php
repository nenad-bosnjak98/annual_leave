<!DOCTYPE html>
<html lang="en">
<head>
  <title>Annual Leave</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php require 'process.php'?>

<div class='optext'>Annual Leave Form</div>
<div class="form_space">

<ul class="nav nav-pills" id="pills">
    <li class="active"><a data-toggle="pill" href="#employee">Employees</a></li>
    <li><a data-toggle="pill" href="#admin">Administrators</a></li>
</ul>
  
<div class="tab-content">
  <div id="employee" class="tab-pane fade in active">
    <form action='' method='POST' class="form1">

      <div class="mb-3" id="fname">
        <label class="form-label">Full Name:</label>
        <input type="text" name='fullname' class="form-control">
      </div>

      <div class="mb-3" id="des">
        <label class="form-label">Designation:</label>
        <input type="text" name='designation' class="form-control">
      </div>

  <div class="form-inline">
      <div class="form-group" id="startd">
        <label>Start date:</label>
        <input type="date" name='sdate' id="inputd">
      </div>

      <div class="form-group" id="enddate">
        <label>End date:</label>
        <input type="date" name='edate' id='inpute'>
      </div>
</div>
      <button type="submit" name='submit' value='Submit' id="btn" class="btn btn-primary">Submit</button>

    </form>

  </div>
  <?php require 'admin_process.php' ?>
<div id="messages">
  <?php
if(isset($error)) {
  echo $error;
}
if(isset($message)) {
  echo $message;
}
if(isset($error_admin)) {
  echo $error_admin;
}


?>
</div>
    <div id="admin" class="tab-pane fade">
    <form action='' method='POST' class="form1">
      <div class="mb-3" id="fname">
        <label class="form-label">Username:</label>
        <input type="text" name="username" class="form-control">
      </div>
      <div class="mb-3" id="pass">
        <label class="form-label">Password:</label>
        <input type="password" name="password" class="form-control">
      </div>

      <button type="submit" id="btn" name="submita" class="btn btn-primary">Submit</button>
    </form>
    </div>
  </div>
  <div id='twobuttons'>
  <a type="submit" href='approvals.php'  id='firstb'>Approvals</a>
  <a type="submit" href='refusals.php' id='secondb'>Refusals</a>
  </div>





</div>
<script>

function hideMessage() {
    document.getElementById("messages").style.display = "none";
};
setTimeout(hideMessage, 2000);

</script>
</body>
</html>