<?php

require_once("database.php");
require_once("functions.php");
require_once("session.php");
require_once("user.php");
require_once("Comment.php");

if(isset($_GET["area"])){
	
	$comment=new Comment();
	$comment->area=$_GET["area"];
	$comment->user_id=$_SESSION["user_id"];
	$comment->user_name=$_SESSION["user_name"];
	$comment->create();
	//$sql="INSERT INTO comment (user_id,area) VALUES ('$user_id', '$area')";
	//if($database->query($sql))
	//redirect_to("main.php");
	//else
	//echo "xxxxxxx";
}
else
{
	die("field not filled");
}

?>
