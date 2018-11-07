<?php
session_start();
?>

<!DOCTYPE html>
<html>
 <script type="text/javascript" src="js/jquery-3.3.1.js"> </script>
 <link   href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

 <script type="text/javascript">

 $(document).ready(function() {

      $.ajax({
        type: "GET",
        url: "display.php",
        dataType: "html",
        success: function(response){
            $("#responsecontainer").html(response);
        }

    });
});

</script>

<body>
<table border="1">
   <tr>
   </tr>
</table>
<div id="responsecontainer">

</div>
</body>
</html>
