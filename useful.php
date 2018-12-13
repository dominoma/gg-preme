<?php 
include 'database_login.php';


function GetColorArr(){

	$query = "select * from Color;";
	$result = mysql_query($query);
	$ColorCodes = array();
	while($Color = mysql_fetch_array($result)){
		$ColorCodes[$Color['Name']] = $Color['Code'];
	}

	return $ColorCodes;

}
function GetProdColors($ProdNr){
	$select = "select ColorComb.CombNr, ColorComb.PrimCol, ColorComb.SecCol from ColorComb, ProductColors where ColorComb.CombNr = ProductColors.CombNr and ProductColors.ProdNr = '$ProdNr';";
	$result = mysql_query($select);
	$Colors = array();
	while($Color = mysql_fetch_array($result)){
		array_push($Colors,$Color);
	}
	return $Colors;
}
function GetProduct($ProdNr){
	return mysql_fetch_array(mysql_query("select * from Product where ProdNr = '$ProdNr'"));
}

?>