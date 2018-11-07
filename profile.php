<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link   href="css/bootstrap.min.css" rel="stylesheet">
  <link   href="css/style.css" rel="stylesheet">
  <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
  <style>
  h1 {
      position: absolute;
      left: 400px;
      top: 0px;
  }
  h2 {
      position: absolute;
      left: 550px;
      top: 310px;
  }
  h4 {
      position: absolute;
      left: 800px;
      top: 317px;
  }
  h3 {
      position: absolute;
      left: 250px;
      top: 400px;
  }
  </style>
</head>


<body>

<script type="text/javascript">
window.onload = function(){
			document.getElementById('save').onsubmit=function() {
				var inputs = document.getElementById("save").elements;
				var id = <?php
				if(isset($_SESSION["other_id"])==true) {
					echo $_SESSION["other_id"];
				}
				else {
					echo $_SESSION["id"];
				}?>;
				//alert(id);
				$.ajax({
					type: "POST",
					url: "save.php",
					data: {id: id, login:inputs[0].value, fname:inputs[1].value, lname:inputs[2].value, password:inputs[3].value},
					success: function(){
						<?php unset($_SESSION["other_id"]); ?>
						alert("Saved");
					}
				})
				return false;
			}
		}
</script>

  <?php
  if(isset($_GET['id']))
  {
  	$id = $_GET['id'];
  	include ("connection.php");
  	$result = mysqli_query($con, "SELECT * FROM login WHERE id='$id'");
  	$myrow = mysqli_fetch_array($result);

  	if(isset($_SESSION["role"]))
  	{
  		if($_SESSION["role"]=="admin")
  		{
        if($_SESSION["id"]==$myrow['id'])
        {
          echo'<form id="save">';
    			echo'Role:';
    			echo $myrow["role"];
    			echo '<br>';
    			echo'Login:<br>';
    			echo'<input type="text" name="login" id="log" value='.htmlspecialchars($myrow["username"]).'><br>';
    			echo '<br>';
    			echo'First name:<br>';
    			echo'<input type="text" name="fname" id="fname" value='.htmlspecialchars($myrow["name"]).'><br>';
    			echo '<br>';
    			echo'Last name:<br>';
    			echo'<input type="text" name="lname" id="sname" value='.htmlspecialchars($myrow["surname"]).'><br>';
    			echo '<br>';
    			echo'Password:<br>';
    			echo'<input type="text" name="password" id="pass" value='.htmlspecialchars($myrow["password"]).'><br>';
    			echo'<span><input type="submit" value="Save"></span>';
          echo'</form>';
    			echo'<br>';
        }
        else{
          $_SESSION["someones_id"] = $myrow['id'];
    			echo'<form id="save">';
    			echo'Role:';
    			echo $myrow["role"];
    			echo '<br>';
    			echo'Login:<br>';
    			echo'<input type="text" name="login" id="log" value='.htmlspecialchars($myrow["username"]).'><br>';
    			echo '<br>';
    			echo'First name:<br>';
    			echo'<input type="text" name="fname" id="fname" value='.htmlspecialchars($myrow["name"]).'><br>';
    			echo '<br>';
    			echo'Last name:<br>';
    			echo'<input type="text" name="lname" id="sname" value='.htmlspecialchars($myrow["surname"]).'><br>';
    			echo '<br>';
    			echo'Password:<br>';
    			echo'<input type="text" name="password" id="pass" value='.htmlspecialchars($myrow["password"]).'><br>';
    			echo'<span><input type="submit" value="Save"></span>';
          echo'</form>';
    			echo'<br>';
        }
  		}
  		else
  		{
        if($_SESSION["id"]==$myrow['id']){
          echo'<form id="save">';
    			echo'Role:';
    			echo $myrow["role"];
    			echo '<br>';
    			echo'Login:<br>';
    			echo'<input type="text" name="login" id="log" value='.htmlspecialchars($myrow["username"]).'><br>';
    			echo '<br>';
    			echo'First name:<br>';
    			echo'<input type="text" name="fname" id="fname" value='.htmlspecialchars($myrow["name"]).'><br>';
    			echo '<br>';
    			echo'Last name:<br>';
    			echo'<input type="text" name="lname" id="sname" value='.htmlspecialchars($myrow["surname"]).'><br>';
    			echo '<br>';
    			echo'Password:<br>';
    			echo'<input type="password" name="password" id="pass" value='.htmlspecialchars($myrow["password"]).'><br>';
  			  echo'<span><input type="submit" value="Save"></span>';
          echo'</form>';
    			echo'<br>';
        }
        else{
        echo'Role:';
        echo $myrow["role"];
        echo '<br>';
  			echo'Login:<br>';
  			echo $myrow["username"].'<br>';
  			echo '<br>';
  			echo'Name:<br>';
  			echo $myrow["name"].'<br>';
  			echo '<br>';
  			echo'Surname:<br>';
  			echo $myrow["surname"].'<br>';
  			echo '<br>';
      }
  		}
  	}
  }
  ?>

  <form>
  <input type="button" value="Main page" onClick='location.href="table.php"'>
  </form>

  </body>
  </html>
