<?php

$name = $_GET['name'];
$date = $_GET['nDate'];
$time = $_GET['nTime'];
//$data['name'] = $_POST['name'];


$conn = mysqli_connect("localhost", "root", "", "tas");

$result = mysqli_query($conn, "INSERT INTO attendance (teacherName, attendanceDate, attendanceTime) VALUES ('$name', '$date', '$time')");