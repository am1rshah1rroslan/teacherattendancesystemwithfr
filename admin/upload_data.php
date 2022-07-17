<?php
	include 'db.php';
	//include 'auth_session.php';
	if (isset($_POST['save']))
	{
		$folder_name = $_POST["name"];
		$folder_phone = $_POST["phone"];
		$folder_email = $_POST["email"];
		$status = "Tetap";
		mkdir("../user/facedetect/labeled_images/" . $folder_name);

		//insert teacher info into database
		mysqli_query($con, "insert into teacher(teacherName,teacherTelNo,teacherEmail,teacherStatus)values('$folder_name','$folder_phone','$folder_email','$status')");

		//rename and insert image
		for($x = 0; $x<5; $x++)
		{
			if(isset($_FILES['image']['name'][$x]))
			{
				$fx = $x + 1;
				$file_name = $_FILES['image']['name'][$x];
				$file_tmp = $_FILES['image']['tmp_name'][$x];
				move_uploaded_file($file_tmp, "../user/facedetect/labeled_images/" . $folder_name . "/" . $fx . ".jpg");
				header('location: register.php');
			
			}
		}

		$_SESSION['message'] = "Pendaftaran Berjaya!";
		header('location: register.php');
		exit();

	}

?>
