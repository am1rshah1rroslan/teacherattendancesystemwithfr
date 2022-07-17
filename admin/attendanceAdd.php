<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("db.php");
ob_start();
session_abort();
session_start(); 
//$uname = $_SESSION['username'];
//$result = mysqli_query($con,"SELECT * FROM users WHERE username = $uname");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add Attendance</title>
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

			<h1>Add Attendance (Manual)</h1>

			<div class='container'>

                <?php
                    date_default_timezone_set("Asia/Kuala_Lumpur");
                    $curdate = date("Y-m-d");
                ?>
                <form method="POST">
                    Date: <input type="date" id="date" name="tarikh">
                    <button type="submit" name="submit"> Find </button>
                </form>

                <?php
                    if (isset($_POST['submit']))
                    {
                        $curdate = $_POST["tarikh"];
                    }
                ?>

                Attendance Date For: <?php echo $curdate ?>

				<form method="POST" enctype="multipart/form-data">
                    <br>

                   <table border="2" class="table" id="myTable">
                        <tr style="background: #522e2e;">
                        <td>No.</td>
                        <td>Name</td>
                        <td>Add Attendance</td>
                        </tr>

                        <?php
                            $masuk = mysqli_query($con,"SELECT teacherName FROM attendance WHERE attendanceDate = '$curdate' ");
                            $keluar = mysqli_query($con,"SELECT teacherName FROM teacher WHERE teacherStatus = 'Tetap'");

                            $array1 = array();
                            while ($row = mysqli_fetch_assoc($masuk)) {
                            $array1[] = rtrim($row['teacherName']);
                            }

                            $array2 = array();
                            while ($row2 = mysqli_fetch_assoc($keluar)) {
                            $array2[] = $row2['teacherName'];
                            }

                            $takhadir=array_values(array_diff($array2,$array1));
                            sort($takhadir);
                            $rx=count($takhadir);
                            //echo $takhadir[0];
                            
                            $nom2=1;//counter table tak hadir

                            for ($u=0;$u<$rx;$u++)
                            {
                                $senaraitakhadir = mysqli_query($con,"SELECT * FROM teacher WHERE teacherName = '$takhadir[$u]'");

                                while($data2 = mysqli_fetch_assoc($senaraitakhadir))
                                {
                        ?>
                                    <tr>
                                        <td><?php echo $nom2?></td>
                                        <td><?php echo $data2['teacherName'];?></td>
                                        <input type="hidden" name="date" value="<?php echo $curdate?>">
                                        <td><input type="checkbox" name="guru[]" value="<?php echo $data2['teacherName'];?>"></td>
                                    </tr>     
                        <?php
                                    $nom2=$nom2+1;
                                }
                            }
                        ?>

                    </table>
                   <button type="submit" class="registerbtn" name="tambah">Add Attendance</button>  
				</form>

                <?php
                    if (isset($_POST['tambah']))
                    {
                        $guru=$_POST['guru'];
                        $tarikh=$_POST['date'];
                        foreach ($guru as $gur=>$value) {
                            mysqli_query($con,"INSERT INTO attendance (teacherName, attendanceDate, attendanceTime) VALUES ('$value','$tarikh','')");
                        }
                        $_SESSION['message'] = "Successfully Added Attendance Manually!";
                        header('location: attendancerecord.php');
                        exit();
                    }
                ?>

			</div>

		</div>
    
	</body>
</html> 
<? ob_flush(); ?>