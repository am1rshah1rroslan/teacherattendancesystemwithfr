<?php

//$data['name'] = $_POST['name'];


$conn = mysqli_connect("localhost", "root", "", "tas");

//$result = mysqli_query($conn, "INSERT INTO attendance (teacherName, attendanceDate, attendanceTime) VALUES ('$name', '$date', '$time')");

$result = mysqli_query($conn, "SELECT * FROM attendance");

$data = array();
while($row = mysqli_fetch_assoc($result))
{
	$data[] = $row;
}

echo json_encode($data);