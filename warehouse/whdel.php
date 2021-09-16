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
	$whid=$_POST['id'];
	$sql = "DELETE FROM Warehouse WHERE WHID=$whid;";
	$db->query($sql);
    header("location:WHCreate.php");
}

?>