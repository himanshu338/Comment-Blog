//Outlook of the blog

<?php

require_once("database.php");
require_once("functions.php");
require_once("session.php");
require_once("user.php");

if(!$session->is_logged_in()){redirect_to("login.html");}
?>
<html>
<head>
<title>
comment 
</title>
</head>
<form id="3" method="GET" action="comment.php">
Comment:</br></br>
<input type="text" rows="16" cols="24" value="area" name="area"></br>
<input type="submit"></br></br>
</form>
</html>


//For realoading the previous results
<?php

require_once("ex2.php");

?>

<html>
<form id="4" method="GET" action="logout.php">
<input type="submit" name="logout"  value="logout">
</form>
</html>
</br>
</br>
</form>
</html>


	


