<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Administrator Login</title>
    <link rel="stylesheet" href="adminlogin.css">

    <script>

        function passwordShow() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </script>

</head>
<body>
<div class="bg-image" style="background-image:url('attendance/bg.jpg')">
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `admin` WHERE username='$username'
                     AND password='" . hash("sha256",$password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: admin.php");
        } else {
            echo "<script>alert(' Wrong Name or Password, please try again! ');</script>";
        }
    } else {}
?>
 
<div id = "frm">
<form method="post" name="login">
    <h1 class="login-title">Administrator Login</h1>
    <input type="text" class="login-input" name="username" placeholder="Name" autofocus="true"/> <br><br>
    <input type="password" class="login-input" name="password" id="pass" placeholder="Password"/><br><br>
    <input type="checkbox" onclick="passwordShow()">Show Password<br><br>
    <input type="submit" value="Login" name="submit"/><br><br>
</form>
<a href="../index.php">Go Back</a>
</div>

</div>


</body>
</html>