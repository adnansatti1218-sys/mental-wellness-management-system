<?php
	session_start();
	session_destroy();
	header("Location: counsellor_login.php");
	exit();
?>
