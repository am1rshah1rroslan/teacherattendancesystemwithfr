<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("db.php");
$uname = $_SESSION['username'];
$result = mysqli_query($con,"SELECT * FROM users WHERE username = $uname");
?>
<!DOCTYPE html>
<html>
<head>
<title>Attendance List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
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
  <h1>TEACHER ATTENDANCE RECORD</h1>

  <?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
	<?php endif ?>

  <div class="container2">
  
    <?php
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $curdate = date("Y-m-d");
      $dateformat = date("d-m-Y");
    ?>

    <div class="container3">
      <form method="POST">
        <label for="tarikh">Date:</label>
        <input type="date" id="date" name="date">
        <button type="submit" name="submit"> Find </button>
        <a href="attendanceAdd.php" class="edit_btn">Add Attendance</a>
        <button type = "submit" name="submitPrint" onclick="exportData()"> Print List</button>
        <!--<a href="attendancePrint.php" class="edit_btn">Cetak Kehadiran</a>-->
      </form>
    </div>


    <?php
      if (isset($_POST['submit']))
      {
        $curdate = $_POST["date"];
        $sec = strtotime($curdate); 
        $dateformat = date("d-m-Y",$sec);
      }
      
    ?>

    <div class="table">

      <h2 style="color:#ffff80;">Attendance: <?php echo "<font color='white'>" . $dateformat ?></h2>
      

      <div class = "tableContainerDiv">
        <table border="2" class="table" id="tableAttendance">
            <tr style="background: #522e2e; position: sticky; top: 0; z-index: 1;">
              <th>No.</th>
              <th>Attendance ID</th>
              <th>Teacher Name</th>
              <th>Time</th>
            </tr>
          <?php
        
            $records = mysqli_query($con,"SELECT * FROM attendance WHERE attendanceDate = '$curdate' ORDER BY attendanceDate ASC, attendanceTime ASC");
            
            $nom=1;//counter table hadir

            while($data = mysqli_fetch_array($records))
            {
          ?>
              <tr>
                <td><?php echo $nom ?></td>
                <td><?php echo $data['attendanceID']; ?></td>
                <td><?php echo $data['teacherName']; ?></td>
                <!--<td><?php //echo $data['attendanceTime']; ?></td>-->
                <td><?php 
                if($data['attendanceTime']=="00:00:00")
                {
                  echo "MANUAL";
                }else
                  echo $data['attendanceTime']; ?></td>
              </tr>

          <?php
              $nom=$nom+1;
            }

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

          ?>
        </table>
      </div>

      <h2 style="color:#ffff80;">Absent List</h2>

      <div class= "tableContainerDiv">

        <table border="2" class="table" id="tableAttendance0">
          <tr style="background: #522e2e; position: sticky; top: 0; z-index: 1;">
            <td>No.</td>
            <td>Teacher Name</td>
            <td>Tel. Number</td>
            <td>Email</td>
          </tr>

          <?php

            $nom2=1;//counter table tak hadir

            for ($u=0;$u<$rx;$u++)
            {

              $senaraitakhadir = mysqli_query($con,"SELECT * FROM teacher WHERE teacherName = '$takhadir[$u]'");

              while($data2 = mysqli_fetch_assoc($senaraitakhadir))
              {
          ?>

                <tr>
                  <td><?php echo $nom2 ?></td>
                  <td><?php echo $data2['teacherName']; ?></td>
                  <td><?php echo $data2['teacherTelNo']; ?></td>
                  <td><?php echo $data2['teacherEmail']; ?></td>
                </tr>	

          <?php
              $nom2=$nom2+1;
              }
            }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  function exportData(){
    /* Get the HTML data using Element by Id */
    var table = document.getElementById("tableAttendance");
 
    /* Declaring array variable */
    var rows =[];
 
      //iterate through rows of table
    for(var i=0,row; row = table.rows[i];i++){
        //rows would be accessed using the "row" variable assigned in the for loop
        //Get each cell value/column from the row
        column1 = row.cells[0].innerText;
        column2 = row.cells[1].innerText;
        column3 = row.cells[2].innerText;
        column4 = row.cells[3].innerText;
 
    /* add a new records in the array */
        rows.push(
            [
                column1,
                column2,
                column3,
                column4
            ]
        );
 
        }
        csvContent = "data:text/csv;charset=utf-8,";
         /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray){
            row = rowArray.join(",");
            csvContent += row + "\r\n";
        });
 
        /* create a hidden <a> DOM node and set its download attribute */
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "Kehadiran <?php echo $dateformat?>.csv");
        document.body.appendChild(link);
         /* download the data file named "Stock_Price_Report.csv" */
        link.click();
}
</script>
</body>
</html> 