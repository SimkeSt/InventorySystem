<?php
session_start();
include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");



if(isset($_POST['minus'])){
	$whid=$_POST['whid'];
	$wid=$_POST['wid'];
	$id=$_POST['id'];
	$sql1 = "SELECT * FROM Product,Warehouse WHERE ProductID='$id'";
	$result = $db->query($sql1);
	$sql42 = "SELECT * FROM Worker WHERE Name='$wid'";
	$result42 = $db->query($sql42);
	$row = $result->fetch_assoc();
	$row1 = $result42->fetch_assoc();
	$wwnm=$row1['Name'];
	$wid=$row1['WorkerID'];

	$wnm=$row['WName'];
	$nm=$row['Name'];
	$sp=$row['SalePrice'];
	$ip=$row['PurchasePrice'];
	$qt1=($row['Quantity']);
	$qt2=($_POST['minus1']);
	$qt=$qt1-$qt2;
	if($qt < 0)
		$qt=0;
	$id=$row['ProductID'];
	$sql= "UPDATE Product
	SET Quantity = $qt
	WHERE ProductID=$id;";
    $db->query($sql);
    $ed=date("Y/m/d");
    $sql22 = "INSERT INTO SaleRecord (ProductID,WHID,WorkerID,QuantitySold,PriceSoldAt,DateOfSale)
			VALUES ($id, $whid, $wid, $qt2, $sp, '$ed');";

	echo "$id, $whid, $wid, $qt2, $sp, '$ed'";
	$db->query($sql22);
  	$tim=date("d/m/Y");
	$tim1=date("H:i");
	$space=" ";
	$file="logs.txt";
	$newLine="\n";
	$txt = "Worker $wwnm has removed Quantity of $qt2 of $nm from warehouse $wnm";
	file_put_contents($file,$tim1.$space.$tim.$space.$txt.$newLine,FILE_APPEND);

    header("location:warehouses.php");
}

if(isset($_POST['plus'])){
	$whid=$_POST['whid'];
	$id=$_POST['id'];
	$wid=$_POST['wid'];
	$sql1 = "SELECT * FROM Product,Warehouse WHERE ProductID='$id'";
	$result = $db->query($sql1);
	$sql42 = "SELECT * FROM Worker WHERE Name='$wid'";
	$result42 = $db->query($sql42);
	$row = $result->fetch_assoc();
	$row1 = $result42->fetch_assoc();
	$wwnm=$row1['Name'];
	$wid=$row1['WorkerID'];
	$wnm=$row['WName'];
	$nm=$row['Name'];
	$sp=$row['SalePrice'];
	$ip=$row['PurchasePrice'];
	$qt1=($row['Quantity']);
	$qt2=($_POST['plus1']);
	$qt=$qt1+$qt2;
	echo "$qt <br>";
	echo "$whid <br>";
	echo "$id <br>";
	$sql= "UPDATE Product
	SET Quantity = $qt
	WHERE ProductID=$id;";
    $db->query($sql);
    $ed=date("Y/m/d");
    $sql22 = "INSERT INTO ImportRecord (WHID,WorkerID,PriceImportedAt,IQuantity,IProductID,ImportDate)
			VALUES ($whid, $wid, $ip, $qt2, $id, '$ed');";
	$db->query($sql22);

	$tim=date("d/m/Y");
	$tim1=date("H:i");
	$space=" ";
	$file="logs.txt";
	$newLine="\n";
	$txt = "Worker $wwnm has added Quantity of $qt2 of $nm from warehouse $wnm";
	file_put_contents($file,$tim1.$space.$tim.$space.$txt.$newLine,FILE_APPEND);

    header("location:warehouses.php");
}


if(isset($_POST['alt'])){
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
	if(isset($_POST['SP']))
		$sp=$_POST['SP'];
	else
		$sp=$row['SalePrice'];
	if(isset($_POST['IP']))
		$ip=$_POST['IP'];
	else
		$ip=$row['PurchasePrice'];
	$qt=$row['Quantity'];
	$id=$row['ProductID'];
	$sql= "UPDATE Product
	SET PurchasePrice = $ip, SalePrice= $sp
	WHERE ProductID=$id;";
    $db->query($sql);
   
	$db->query($sql2);
    $tim=date("d/m/Y");
	$tim1=date("H:i");
	$space=" ";
	$file="logs.txt";
	$newLine="\n";
	$txt = "Worker $wwnm has Altered Prices of $nm to $sp (Sale Price) and $ip (Import Price) from warehouse $wnm";
	file_put_contents($file,$tim1.$space.$tim.$space.$txt.$newLine,FILE_APPEND);

    header("location:warehouses.php");
}


?>
