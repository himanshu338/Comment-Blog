<?php

require_once("database.php");
require_once("functions.php");
require_once("session.php");
require_once("user.php");

$session->logout();
redirect_to("mainpage.php");

?>
