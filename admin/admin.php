<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("db.php");
$uname = $_SESSION['username'];
$result = mysqli_query($con,"SELECT * FROM users WHERE username = $uname");
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="adminstyle.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<!-- <script defer src="barchart.js"></script> -->
</head>
<body>

<div class="sidebar">
  <p class="sidetitle">TEACHER ATTENDANCE SYSTEM</p>
	<br>
  <a href="admin.php"><i class="fa fa-fw fa-home"></i> Dashboard</a>
  <br>
  <a href="attendancerecord.php"><i class="fa fa-fw fa-list"></i> Attendance</a>
	<br>
  <a href="list.php"><i class="fa fa-fw fa-users"></i> Teacher List</a>
  <br>
  <a href="register.php"><i class="fa fa-fw fa-user-plus"></i> Register</a>
  <br>
  <div class="bottomleft">
  <a href="logout.php"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
  </div>
</div>

<div class="main">
  <h1>DASHBOARD</h1>
  <p>Welcome back, <?php echo $uname; ?> !</p>
  <div class="container2">
    <?php

      include "db.php"; // Using database connection file here

      $records = mysqli_query($con,"SELECT COUNT(teacherName) FROM teacher WHERE teacherStatus = 'Tetap'"); // fetch data from database
      $count = mysqli_fetch_array($records);
    ?>

    <?php
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $curdate = date("Y-m-d");
      $come = mysqli_query($con,"SELECT COUNT(teacherName) FROM attendance where attendanceDate = '$curdate'");
      $hadir = mysqli_fetch_array($come);
      $takhadir = $count[0] - $hadir[0];
    ?>
    <h2 style="color:#ffff80;">Today's Attendance</h2>
    <br>
    Number of Teachers: <?php echo $count[0]; ?>

    &nbsp;Attend : <?php echo $hadir[0]; ?>

    &nbsp;Absent : <?php echo $takhadir; ?>

    <br>
    <br>
    

    <canvas id="myChart" style="width:100%;max-width:600px;background-color:white;margin: 0 auto;margin-left: auto;margin-right: auto;"></canvas>

    <script>

      var hadir= <?php echo $hadir[0]; ?>;
      var takhadir= <?php echo $takhadir; ?>;
      var xValues = ["Attend", "Absent"];
      var yValues = [];
      yValues[0]= hadir;
      yValues[1]= takhadir;
      yValues[2]= 0;
      var barColors = ["green", "red"];

      new Chart("myChart", {
        type: "bar",
        data: {
          labels: xValues,
          datasets: [{
            backgroundColor: barColors,
            data: yValues
          }]
        },
        options: {
          legend: {display: false},
          title: {
            display: true,
            text: "Total Attendance"
          }
        }
      });
    
    </script>

  </div>
</div>
     
</body>
</html> 