<?php
    session_start();
if (isset($_POST['login']))
{
  $login = $_POST['login'];
  if ($login == '')
  {
    unset($login);
  }
}
    if (isset($_POST['password']))
    {
      $password=$_POST['password'];
      if ($password =='')
      {
        unset($password);
      }
    }

if (empty($login) or empty($password))
    {
    exit ("There are empty fields left, proceed to enter meaningless symbols");
    }
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $login = trim($login);
    $password = trim($password);
    include ("connection.php");

$result = mysqli_query($con,"SELECT * FROM login WHERE username='$login'");
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow['password']))
    {
      echo ($login);
    exit ("Sorry, password field is empty *LAUGHS*" );
    }
    else {
    if ($myrow['password']==$password) {
    $_SESSION['username']=$myrow['username'];
    $_SESSION['id']=$myrow['id'];
    $_SESSION['role']=$myrow['role'];
    echo ("success");
    }
 else {

    exit ("Sorry,something is wrong.");
    }
    }
    ?>
