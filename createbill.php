
<?php include 'testrechnung.php'; ?>
<?php include 'database_login.php'; ?>
<?php session_start(); ?>
<?php 
	$select = "select * from Accounts where Username = '".$_SESSION['User']."';";
	$User = mysql_fetch_array(mysql_query($select));
	
	$select = "select * from Orders, Product where Username = '".$_SESSION['User']."' and Product.ProdNr = Orders.ProdNr;";
	$result = mysql_query($select);
	
	$Products = array();
	while($Product = mysql_fetch_array($result)){
		$Product['CombNr'] = mysql_fetch_array(mysql_query("select PrimCol from ColorComb where CombNr='".$Product['CombNr']."'"))[0];
		array_push($Products,$Product);
	}
	

?>
<?php 
	AddBill($User,$Products);	

?>
	
