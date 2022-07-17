<?php
    include 'db.php';
    //include 'auth_session.php';
    session_abort();
    session_start();
    if (isset($_POST['update']))
	{
		$id = $_POST["id"];
        $name = $_POST["name"];
		$telno = $_POST["telno"];
		$email = $_POST["email"];
		$status = $_POST["status"];

		//update teacher info into database
		mysqli_query($con,"update teacher set teacherTelNo='$telno', teacherEmail='$email', teacherStatus='$status' where teacherID=$id");

		$_SESSION['message'] = "Update Successful!";
		header('location: list.php');
		exit();

	}


?>