//Autheticate the user form the database

<?php
require_once("database.php");
require_once("functions.php");
require_once("session.php");
require_once("user.php");

if(isset($_GET["username"]) && isset($_GET["password"]))
{
	$username=$_GET["username"];
	$password=$_GET["password"];
	$found_user=User::authenticate($username,$password);
	if($found_user){
		$session->login($found_user);
		redirect_to("main.php");
	}
	else{
		die("record not found".mysql_error());
		//echo "record not found";
		//redirect_to("login.html");
		
	}
}
?>
