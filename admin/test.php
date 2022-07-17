<!DOCTYPE html>
<html>
<head>
  <title>Display all records from Database</title>
</head>
<body>

<h2>Maklumat Guru</h2>

<table border="2">
  <tr>
    <td>ID</td>
    <td>Nama Guru</td>
    <td>Nombor Telefon</td>
    <td>Emel</td>
  </tr>

<?php

include "db.php"; // Using database connection file here

$records = mysqli_query($con,"SELECT * FROM teacher"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['teacherID']; ?></td>
    <td><?php echo $data['teacherName']; ?></td>
    <td><?php echo $data['teacherTelNo']; ?></td>
    <td><?php echo $data['teacherEmail']; ?></td>
  </tr>	
<?php
}
?>
</table>

<?php mysqli_close($con); // Close connection ?>

</body>
</html>