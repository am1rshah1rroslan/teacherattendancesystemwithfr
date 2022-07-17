<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("db.php");
include("listDelete.php");
include("edit_data.php");

$uname = $_SESSION['username'];
$result = mysqli_query($con,"SELECT * FROM users WHERE username = $uname");
?>
<!DOCTYPE html>
<html>
<head>
<title>Teacher List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="adminstyle.css">

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

<?php
  $limit = 10;  
  if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
    } 
    else{ 
    $page=1;
    };  
  $start_from = ($page-1) * $limit;  
  $resultPage = mysqli_query($con,"SELECT * FROM teacher ORDER BY teacherName ASC LIMIT $start_from, $limit");
?>

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

  <h1>TEACHER LIST</h1>
  <?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
	<?php endif ?>

  <div class="container2">

  <input type="search" id="myInput" onkeyup="myFunction()" placeholder="Teacher Name" title="Key in teacher's name.">
  <br>
  <br>

    <div class="table">

      <table border="2" class="table" id="myTable">
        <tr style="background: #522e2e;">
          <th>No.</th>
          <th>ID</th>
          <th>Teacher Name</th>
          <th>Tel. Number</th>
          <th>Email</th>
          <th>Status</th>
          <th>Update Record</th>
          <th>Delete Record</th>
        </tr>

      <?php

      include "db.php"; // Using database connection file here

      //$records = mysqli_query($con,"SELECT * FROM teacher ORDER BY teacherName ASC"); // fetch data from database
      $nom=1;

      while($data = mysqli_fetch_array($resultPage))
      {
      ?>
        <tr>
          <td><?php echo $nom ?></td>
          <td><?php echo $data['teacherID']; ?></td>
          <td><?php echo $data['teacherName']; ?></td>
          <td><?php echo $data['teacherTelNo']; ?></td>
          <td><?php echo $data['teacherEmail']; ?></td>
          <td><?php echo $data['teacherStatus']; ?></td>
          <td><a href="listEdit.php?edit=<?php echo $data['teacherID']; ?>" class="edit_btn">Update</a></td>
          <td><a onclick="return confirm('User chosen will be deleted. Are you sure?');" href="listDelete.php?del=<?php echo $data['teacherID']; ?>" class="del_btn">Delete</a></td>
        </tr>	
      <?php
      $nom=$nom+1;
      }
      ?>
      </table>

    </div>
  
  </div>

  <div class="center">
  <div class="pagination">
  <?php
    $result_db = mysqli_query($con,"SELECT COUNT(teacherID) FROM teacher"); 
    $row_db = mysqli_fetch_row($result_db);  
    $total_records = $row_db[0];  
    $total_pages = ceil($total_records / $limit); 
    /* echo  $total_pages; */
    $pagLink = "<ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {
      $pagLink .= "<a class='page-link' href='list.php?page=".$i."'>".$i."</a>";	
    }
    echo $pagLink . "</ul>";
  ?>
  </div>
  </div>

</div>
<?php mysqli_close($con); // Close connection ?>
</body>
</html> 