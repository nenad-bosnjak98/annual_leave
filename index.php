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

<div class="form_space">

<ul class="nav nav-pills" id="pills">
    <li class="active"><a data-toggle="pill" href="#employee">Employees</a></li>
    <li><a data-toggle="pill" href="#admin">Administrators</a></li>
</ul>
  
<div class="tab-content">
  <div id="employee" class="tab-pane fade in active">
    <form class="form1">
      <div class="mb-3" id="fname">
        <label class="form-label">Full Name:</label>
        <input type="text" class="form-control">
      </div>
      <div class="mb-3" id="des">
        <label class="form-label">Designation:</label>
        <input type="text" class="form-control">
      </div>
      <label class="form-label" id="cont">Contract Type:</label>
      <div class="form-check" id="radios">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="flexRadioDefault">
            Full-Time
        </label>
      </div>
      <div class="form-check" id="radios">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="flexRadioDefault">
            Part-Time
        </label>
      </div>

      <div class="form-check" id="startd">
        <label>Start date:</label>
        <input type="date" id="inputd">
      </div>


      <button type="submit" id="btn" class="btn btn-primary">Submit</button>
    </form>
  </div>


    <div id="admin" class="tab-pane fade">
    <form class="form1">
      <div class="mb-3" id="fname">
        <label class="form-label">Username:</label>
        <input type="text" class="form-control">
      </div>
      <div class="mb-3" id="pass">
        <label class="form-label">Password:</label>
        <input type="password" class="form-control">
      </div>

      <button type="submit" id="btn" class="btn btn-primary">Submit</button>
    </form>
    </div>
  </div>








</div>

</body>
</html>