<?php
session_start();

if($_SESSION['username'] == ""){
	die("You are not logged in");
}
	system('/sbin/reboot');
?>
	
	<center> Your device is now rebooting! </center>
