<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
if(isset($_SESSION['username']))
$ses=$_SESSION['username'];

if(isset($_POST['qid'])){
	$wid=$_POST['wid'];
	$id=$_POST['id'];
	$sql1 = "SELECT * FROM Product,Warehouse WHERE ProductID='$id'";
	$result = $db->query($sql1);
	$sql42 = "SELECT * FROM Worker WHERE Name='$wid'";
	$result42 = $db->query($sql42);
	$row = $result->fetch_assoc();
	$row1 = $result42->fetch_assoc();
	$whid=$row['WHID'];
	$wid=$row1['WorkerID'];
	$wwnm=$row1['Name'];
	$wnm=$row['WName'];
	$nm=$row['Name'];
	$nm=$_POST['nm'];
	$sp=$_POST['sp'];
	$ip=$_POST['ip'];
	$qt=$_POST['qt'];
	$id=$_POST['id'];
	$ed=$_POST['ed'];
	$ss1=$_POST['ss1'];
	setcookie('id','$id',time() + 86400,"/" );
	$sql = "INSERT INTO Product (Name, SalePrice, PurchasePrice, Quantity, WHID,ExpiryDate,CapacityTaken)
			VALUES ('$nm', $sp, $ip, $qt, $whid,'$ed',$ss1);";
    $db->query($sql);

    $sql542="SELECT ProductID FROM Product WHERE Name='$nm' AND WHID='$whid'";
	$result542 = $db->query($sql542);
	$row22 = $result542->fetch_assoc();
	$idd=$row22['ProductID'];
    $sql22 = "INSERT INTO ImportRecord (WHID,WorkerID,PriceImportedAt,IQuantity,IProductID,ImportDate)
			VALUES ($whid, $wid, $ip, $qt, $idd, '$ed');";
	$db->query($sql22);
    $tim=date("d/m/Y");
	$tim1=date("H:i");
	$space=" ";
	$file="logs.txt";
	$newLine="\n";
	$txt = "Worker $wwnm has Entered Product $nm to warehouse $wnm";
	file_put_contents($file,$tim1.$space.$tim.$space.$txt.$newLine,FILE_APPEND);
    header("location:warehouses.php");
}

?>