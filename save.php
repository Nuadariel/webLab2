<?php
	session_start();
	if(isset($_POST["id"], $_POST["login"], $_POST["fname"], $_POST["lname"], $_POST["password"]))
	{
		if ($_POST["login"] == '' || $_POST["fname"] == '' || $_POST["lname"] == '' || $_POST["password"] == '')
		{
			exit ("You did not fill all the fields");
		}
		$id = $_POST["id"];
		$login = $_POST["login"];
		$password = $_POST["password"];
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		include ("connection.php");
		$query ="UPDATE login SET username='$login', password='$password', name='$fname', surname='$lname' WHERE id='$id'";
		$result = mysqli_query($con, $query) or die("Error " . mysqli_error($con));
	}
?>
