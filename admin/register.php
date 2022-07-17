<?php
	//include auth_session.php file on all user panel pages
	include("auth_session.php");
	include("db.php");
	include("upload_data.php");
	$uname = $_SESSION['username'];
	$result = mysqli_query($con,"SELECT * FROM users WHERE username = $uname");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>User Registration</title>
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
		  <h1>USER REGISTRATION</h1>
			<?php if (isset($_SESSION['message'])): ?>
			<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
			</div>
			<?php endif ?>
		  <br>
		  <form method="POST" enctype="multipart/form-data">  
		   <div class="container"> 
		   <h1 style="text-align:center;"> Registration Form</h1>  
		   <hr>  
		   <label> Name: </label>   
		   <input type="text" name="name" placeholder= "Name" pattern="^[a-zA-Z ]+$" required />   
		   <label>   
		   Tel. Number:  
		   </label>  
		   <input type="text" name="phone" placeholder="Tel. Number" size="13" pattern="^[0-9]+$" required>   
		   <label for="email"><b>Email:</b></label>  
		   <input type="email" placeholder="Email" name="email" required>
		   <label>   
		   Facial Images (5 Images Required) :  
		   </label>
		   <input id="uimg" type="file" name="image[]" multiple accept=".jpg, .jpeg" required>	
		   <br> 
		   <br> 
		   <button type="submit" class="registerbtn" name="save">Register</button>    
		 </form>
		</div>
		<br>
    
	</body>
</html> 