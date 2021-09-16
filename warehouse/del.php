<?php
session_start();
include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
if(isset($_SESSION['username']))
$ses=$_SESSION['username'];

if(isset($_POST['del'])){
	$whid=$_POST['whid'];
	$id=$_POST['id'];
	$wid=$_POST['wid'];
	$sql1 = "SELECT * FROM Product,Warehouse WHERE ProductID='$id'";
	$result = $db->query($sql1);
	$sql42 = "SELECT * FROM Worker WHERE WorkerID='$wid'";
	$result42 = $db->query($sql42);
	$row = $result->fetch_assoc();
	$row1 = $result42->fetch_assoc();
	$wwnm=$row1['Name'];
	$wnm=$row['WName'];
	$nm=$row['Name'];
	$sql = "DELETE FROM Product WHERE ProductID=$id;";
    $db->query($sql);
    $tim=date("d/m/Y");
	$tim1=date("H:i");
	$space=" ";
	$file="logs.txt";
	$newLine="\n";
	$txt = "Worker $wwnm has Deleted Product $nm from warehouse $wnm";
	file_put_contents($file,$tim1.$space.$tim.$space.$txt.$newLine,FILE_APPEND);
    header("location:warehouses.php");
}
