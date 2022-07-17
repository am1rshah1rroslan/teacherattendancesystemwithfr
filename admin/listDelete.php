<?php
    include 'db.php';
    //include 'auth_session.php';
    session_abort();
    session_start();

    //function to remove teacher files from server
    function removeFiles($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK );

            foreach( $files as $file ){
                removeFiles( $file );      
            }

            rmdir( $target );
        } elseif(is_file($target)) {
            unlink( $target );  
        }
    }

    if (isset($_GET['del']))
    {
        $id=$_GET['del'];
        $record = mysqli_query($con,"SELECT * FROM teacher WHERE teacherID='$id'");

        while($data = mysqli_fetch_array($record))
		{
			$name=$data['teacherName'];
		}

        //delete teacher files from server
        $folderName = ("../user/facedetect/labeled_images/" . $name);
  
        removeFiles($folderName);

        //delete teacher info from database
        mysqli_query($con, "delete from teacher where teacherID='$id'");

        $_SESSION['message'] = "Teacher's information Erased Successfully!";
        header('location: list.php');
        exit();

    }

    

?>