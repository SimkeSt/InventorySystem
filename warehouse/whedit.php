<?php
session_start();
include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");

$dundara=$_GET['whid'];
echo "$dundara";

if(isset($_GET['whid'])){
    $whid=$_GET['whid'];
	$wnm=$_GET['wnm'];
	$ad=$_GET['ad'];
	$mid=$_GET['mid'];
	$cap=$_GET['cap'];
	$sql = "UPDATE Warehouse
			SET WName = '$wnm', Adress = '$ad', ManagerID = $mid, Capacity = $cap
			WHERE WHID=$whid;";
    $db->query($sql);
  
    header("location:WHCreate.php");
}


?>
