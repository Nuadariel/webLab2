<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link   href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
</head>

<script>
$(document).ready(function(){

 $("btn").click(function(){
  var el = this;
  var butid = this.id;

  $.ajax({
   url: 'remove.php',
   type: 'POST',
   data: { id:butid },
   success: function(response){
     $(el).closest('tr').fadeOut(100, function(){
      $(this).remove();
    });

   }
  });

 });

});
</script>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("userz");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {

      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users2";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM login");
if (mysqli_num_rows($result) > 0) {

  if(isset($_SESSION["username"])){
  echo ' Welcome, ', $_SESSION['username'],'!';
  echo '<a href="logout.php"> Logout</a>';
}
else{
  echo 'Welcome, guest !';
  echo '<a href="index.php"> Login</a>';
}
  if(isset($_SESSION["username"]) and $_SESSION["role"]=="admin"){
  echo '<table class="table table-bordered" id="MyTable">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th onclick="sortTable(1)">id</th>';
  echo    '<th onclick="sortTable(0)"> Login</th>';
  echo    '<th>Actions</th>';
  echo  '</tr>';
  echo '</thead>';
  echo '<tbody>';
  foreach ($result as $row) {
    echo '<tr>';
    echo  '<th scope="row">'.$row["id"].'</th>';
    echo  '<td>'.$row["username"].'</td>';
    echo '<td><a class = "btn btn-success" href="profile.php?id='.$row["id"].'">Update</a>&nbsp&nbsp&nbsp';
    echo '<btn class = "btn btn-danger" id='.$row["id"].'>Delete user</btn></td>';
    echo '</tr>';
    }
  echo '</tbody>';
    echo '</table>';
}

if(isset($_SESSION["username"]) and $_SESSION["role"]=="user"){
  echo '<table class="table table-bordered" id="MyTable">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th onclick="sortTable(1)">id</th>';
  echo    '<th onclick="sortTable(0)"> Login</th>';
  echo    '<th scope="col">Actions</th>';
  echo  '</tr>';
  echo '</thead>';
  echo '<tbody>';
  foreach ($result as $row) {
      if ($_SESSION["id"]==$row['id']) {
      echo '<tr>';
      echo  '<th scope="row">'.$row["id"].'</th>';
      echo  '<td>'.$row["username"].'</td>';
      echo '<td><a class = "btn btn-success" href="profile.php?id='.$row["id"].'">Update</a>&nbsp&nbsp&nbsp';
      echo '</tr>';}
    else {
        echo '<tr>';
        echo  '<th scope="row">'.$row["id"].'</th>';
        echo  '<td>'.$row["username"].'</td>';
        echo '<td><a class = "btn" href="profile.php?id='.$row["id"].'">View profile</a>&nbsp&nbsp&nbsp';
        echo '</tr>';
    }}
    echo '</tbody>';
      echo '</table>';
}

if(!isset($_SESSION["username"])){
  echo '<table class="table table-bordered" id="MyTable">';
  echo '<thead>';
  echo  '<tr>';
  echo    '<th onclick="sortTable(1)">id</th>';
  echo    '<th onclick="sortTable(0)"> Login</th>';
  echo  '</tr>';
  echo '</thead>';
  echo '<tbody>';
    while($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo  '<th scope="row">'.$row["id"].'</th>';
      echo  '<td>'.$row["username"].'</td>';
            echo '</tr>';
    }
    echo '</tbody>';
      echo '</table>';
}
}

else {
    echo "В базе никого нет";
}


mysqli_close($conn);
?>

</body>
</html>
