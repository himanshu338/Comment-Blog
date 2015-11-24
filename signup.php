//Create the account for user and insert it into the database

<?php
require_once("database.php");
require_once("functions.php");
require_once("session.php");
require_once("user.php");
 
if(isset($_GET["username"]) && isset($_GET["password"]) && isset($_GET["firstname"]) && isset($_GET["lastname"]))
{	

	$user=new User();
	$user->username=$_GET["username"];
	$user->password=$_GET["password"];
	$user->firstname=$_GET["firstname"];
	$user->lastname=$_GET["lastname"];
	$user->create();
}
else{
 	echo "all details are not filled";
}


?>
