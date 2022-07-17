<?php
	//include auth_session.php file on all user panel pages
	include("auth_session.php");
	include("db.php");
	include("edit_data.php");

    if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$records = mysqli_query($con, "SELECT * FROM teacher WHERE teacherID=$id");

		while($data = mysqli_fetch_array($records))
		{
			$name=$data['teacherName'];
			$telno=$data['teacherTelNo'];
			$email=$data['teacherEmail'];
			$status=$data['teacherStatus'];
		}
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Update Teacher Information</title>
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

			<h1>Personal Information of <?php echo $name; ?> </h1>

			<div class='container'>


				<form method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				Name: (Cannot be Changed)<input type="text" name="name" value="<?php echo $name; ?>" disabled>
				Tel. Number: <input type="text" name="telno" value="<?php echo $telno; ?>">
				Email: <input type="email" name="email" value="<?php echo $email; ?>">
				Status:
				<input type="radio" name="status" <?php if (isset($status) && $status=="Tetap") echo "checked";?> value="Tetap">Tetap
  				<input type="radio" name="status" <?php if (isset($status) && $status=="Pindah") echo "checked";?> value="Pindah">Pindah
				<button type="submit" class="registerbtn" name="update">Update</button>  
				</form>

			</div>

		</div>
		<br>
    
	</body>
</html> 