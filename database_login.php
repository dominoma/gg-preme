<?php 

	

	$connection = mysql_connect("localhost", "root", "raspberry") or die(mysql_error());
	mysql_select_db("GG-Preme") or die(mysql_error());
	mysql_query("SET NAMES 'utf8'", $connection);	
	
	
?>