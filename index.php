<html>
<head>
   <link   href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript">
function do_login()
{
 var login=$("#login").val();
 var password=$("#password").val();
 if(login!="" && password!="")
 {
  $.ajax
  ({
  type:'post',
  url:'login.php',
  data:{
   login:login,
   password:password
  },
  success:function(response) {
  if(response=="success")
  {
    window.location.href="table.php";
  }
  else
  {
    alert("Wrong Details");
  }
  }
  });
 }

 else
 {
  alert("Please Fill All The Details");
 }

 return false;
}
</script>
</head>
<body>
 <form method="post" action="login.php" onsubmit="return do_login();">
  Username:<br>
  <input type="text" name="login" id="login">
  <br>
  User password:<br>
  <input type="password" name="password" id="password">
  <br>
  <input type="submit" value="Enter">
 </form>

</div>
</body>
</html>
