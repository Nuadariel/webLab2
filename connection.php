<?php
$con=mysqli_connect("127.0.0.1","root","");
 mysqli_select_db ($con, "users2");
if (!$con)
{
    die('Could not connect: ' . mysqli_error());
}
?>
