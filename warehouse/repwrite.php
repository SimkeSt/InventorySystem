<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
if(isset($_SESSION['username']))
$ses=$_SESSION['username'];

if(isset($_POST['fiq'])){
	$rep=$_POST['rep'];
	$wwnm=$_POST['wid'];
	$rep=$_POST['rep'];
	$id=$_POST['whid'];
	$sql1 = "SELECT * FROM Product,Warehouse WHERE ProductID='$id'";
	$result = $db->query($sql1);
	$row = $result->fetch_assoc();
	$wnm=$row['WName'];
    $tim=date("d/m/Y");
	$tim1=date("H:i");
	$space=" ";
	$file="reports.txt";
	$newLine="\n";
	$txt = "Worker $wwnm has written a report in warehouse $wnm : 
	$rep";
	file_put_contents($file,$tim1.$space.$tim.$space.$txt.$newLine,FILE_APPEND);
    header("location:warehouses.php");
}

?>