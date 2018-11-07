<?php
include "connection.php";

$id = $_POST['id'];


$query = "DELETE FROM login WHERE id=".$id;
mysqli_query($con,$query);

echo "success";
