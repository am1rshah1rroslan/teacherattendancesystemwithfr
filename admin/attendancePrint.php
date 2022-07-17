<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("db.php");
session_abort();
session_start(); 
//$uname = $_SESSION['username'];
//$result = mysqli_query($con,"SELECT * FROM users WHERE username = $uname");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Print Attendance</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="adminstyle.css">
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

			<h1>Print Attendance Record</h1>

			<div class='container'>
        <?php
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $curMonth = date("Y.m");
        ?>

        <form method="POST">
        Attendance Month: <input type="month" id="month" name="bulan">
        <button type="submit" name="submit"> Find </button>
        </form>

        <?php
          if (isset($_POST['submit']))
          {
            $curMonth = $_POST["bulan"];
            echo $curMonth;
          }
        ?>

        <?php
          
          $teacherList = mysqli_query($con,"SELECT teacherName FROM teacher WHERE teacherStatus = 'Tetap'");
          $attendanceList = mysqli_query($con,"SELECT teacherName FROM attendance WHERE DATE_FORMAT(attendanceDate, '%Y-%m')");

		  $export = '
		  <table>
		  <th>Teacher Attendance for <?php %curmonth ?></th>
		  <tr>
		  <td>Teacher Name</td>
		  <td>Total Attendance<td>
		  </tr>';

        ?>

			</div>

		</div>
	</body>
</html> 