<?php

$conn = mysqli_connect("localhost", "root", "", "tas");

$result = mysqli_query($conn, "SELECT * FROM teacher WHERE teacherStatus = 'Tetap'");

$data = array();
while($row = mysqli_fetch_assoc($result))
{
	$data[] = $row;
}

echo json_encode($data);