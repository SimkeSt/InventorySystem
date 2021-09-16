<?php
 //logout process destroy the loged in session

$tim=date("d/m/Y");
 session_start();

	$tim1=date("H:i");
	$space=" ";
	$file="logs.txt";
	$newLine="\n";
	$username=$_SESSION['username'];
	$txt = "Worker '$username' has Logged out";
	file_put_contents($file,$tim1.$space.$tim.$space.$txt.$newLine,FILE_APPEND);
 session_unset();
 session_destroy();
 echo "<script>window.location='index.php';</script>";
?>