<?php

	session_start();
	require("config.php");

	$Conn = new mysqli('127.0.0.1','root','',"tpsshop");
								
	If (mysqli_connect_errno())
		die("<p>Unable to connect to database.</p>"
			. "<p>Error code ". Mysqli_connect_errno()
			. ": ". mysqli_connect_errno()) . "</p>";	
		
	
	$itemsql = "SELECT * FROM orderitems WHERE id = ". $_GET['id'] . ";";
	$itemres = @mysqli_query($Conn, $itemsql) or die(mysql_error());
	$numrows = mysqli_num_rows($itemres);
	
	if($numrows == 0) {
		header("Location:" . $config_basedir . "showcart.php");
	}
	
	
	
	$itemrow = mysqli_fetch_assoc($itemres);
	
	$prodsql = "SELECT price FROM products WHERE id = " . $itemrow['product_id'] . ";";
	
	$prodresource = mysqli_query($Conn, $prodsql)or die(mysql_error());
	$prodrow = mysqli_fetch_assoc($prodresource);	// get details of product
	
	$decrease_tot_price = 0;
	
	$decrease_tot_price = $prodrow['price'] * $itemrow['quantity'];
	
	echo "Price to be updated in orders table : " .$decrease_tot_price;
	
	echo "Price to be updated in orders table : " . $_SESSION['SESS_ORDERNUM'];
	
	$UpdQtySQL = "UPDATE orders SET total= total-".	$decrease_tot_price . " WHERE id=". $_SESSION['SESS_ORDERNUM'] . ";";		// update TOTAL in Oreder Table
	@mysqli_query($Conn, $UpdQtySQL) or die(mysql_error());
	
	$sql = "DELETE FROM orderitems WHERE id = " . $_GET['id'];
	$del=mysqli_query($Conn, $sql)or die(mysql_error());
	
	header("Location: " . $config_basedir . "showcart.php");
	
?>