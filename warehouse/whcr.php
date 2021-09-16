<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
if(isset($_SESSION['username']))
$ses=$_SESSION['username'];

if(isset($_POST['id'])){
	$mid=$_POST['mid'];
	$ad=$_POST['ad'];
	$wnm=$_POST['wnm'];
	$cap=$_POST['cap'];
	$sql = "INSERT INTO Warehouse (WName, Adress, ManagerID,Capacity)
			VALUES ('$wnm', '$ad', $mid,$cap);";
	$db->query($sql);
   header("location:WHCreate.php");
}

?>