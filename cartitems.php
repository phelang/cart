<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TSP</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.php" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.php" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>


<?php
	session_start();
	require("config.php");
	require("functions.php");
?>

<?php
	
	$Conn = new mysqli('127.0.0.1','root','',"tpsshop");
				
				If (mysqli_connect_errno())
					die("<p>Unable to connect to database.</p>"
					. "<p>Error code ". Mysqli_connect_errno()
					. ": ". mysqli_connect_errno()) . "</p>";	
				
	$PoductSQL = "SELECT * FROM products WHERE id = " . $_GET['id'] . ";";
	$QueryResult = @mysqli_query($Conn, $PoductSQL);

	$numrows = mysqli_num_rows($QueryResult);
	$prodrow = mysqli_fetch_assoc($QueryResult);
	
	
	if($numrows == 0)
	{
		header("Location: " . $config_basedir);
	}
	else{
		
		if(isset($_POST['submit_x']))
		{
			
			////
			// 	IF no order has been made before AND SESSION ID PROVIDED 						
			///
			if(isset($_SESSION['SESS_ORDERNUM']))
			{
				
				
				$ValidateItemsQuery= "SELECT * FROM orderitems WHERE product_id ='" . $_GET['id'] . "' AND order_id = '" . $_SESSION['SESS_ORDERNUM'] . "'";	// check that the product has not been selected before
				$OrderValidate = @mysqli_query($Conn, $ValidateItemsQuery) or die(mysql_error());
				$numrows =  mysqli_num_rows($OrderValidate);

				if($numrows == 1){				// check that the product has not been selected before
							
				
						//echo "<p>ITEM ALREADY EXIST</p>";		// update the current quantity
						$totalprice = $prodrow['price'] * $_POST['amountBox'] ;	// multiply quantity	
						
						$UpdQtySQL = "UPDATE orders SET total = total + ". $totalprice . " WHERE id = ". $_SESSION['SESS_ORDERNUM'] . ";";		// update TOTAL in Oreder Table
						@mysqli_query($Conn, $UpdQtySQL) or die(mysql_error());
						
						//$UpdateSQLPrice = "UPDATE orderitems SET quantity = quantity +".  $_POST['amountBox'] . "WHERE product_id = ".  $_GET['id'] . " AND order_id =" . $_SESSION['SESS_ORDERNUM'] .";";	// Update Qunatity in OrderItems Table
						
						//$UpdateSQLPrice = "UPDATE orderitems SET quantity = quantity +".  $_POST['amountBox'] . "WHERE product_id = ".  $_GET['id'] . " AND order_id =" . $_SESSION['SESS_ORDERNUM'] .";";	// Update Qunatity in OrderItems Table
						
						$qty = $_POST['amountBox'];
						$orderId = $_SESSION['SESS_ORDERNUM'];
						$id_prod = $_GET['id'];
						
						
						echo $id_prod;
						$sql = "UPDATE orderitems SET quantity = quantity + $qty WHERE product_id = $id_prod AND order_id=$orderId" ;
           
						
						
						
						@mysqli_query($Conn, $sql) or die("<p>Unable to update quantity.</p>"
							. "<p>Error code ". Mysqli_connect_errno()
							. ": ". mysqli_connect_errno()) . "</p>";
					
						
						
						
					
				}
				else{ // The product has never been selected, create new order
				
					//'User has orders create orderitems for him';
					$itemsql = "INSERT INTO orderitems(order_id,product_id, quantity) VALUES(". $_SESSION['SESS_ORDERNUM'] . ", ". $_GET['id'] . ", ". $_POST['amountBox'] . ")";
					@mysqli_query($Conn, $itemsql) or die(mysql_error());
					
					
					//echo "<p>ITEM ALREADY EXIST</p>";		// update the current quantity
					$totalprice = $prodrow['price'] * $_POST['amountBox'] ;	// multiply quantity	
						
					$UpdQtySQL = "UPDATE orders SET total = total + ". $totalprice . " WHERE id = ". $_SESSION['SESS_ORDERNUM'] . ";";		// update TOTAL in Oreder Table
					@mysqli_query($Conn, $UpdQtySQL) or die(mysql_error());
				} 
					header("Location: " . $config_basedir . "showcart.php");
					
				
			}
			
			
			
			////
			//		if new order
			// 	IF NOOOOT LOGGED-IN AND SESSION ID PROVIDED 						
			///
			else
			{
				if(isset($_SESSION['SESS_LOGGEDIN']))		// create a new order line for a logged user else if not logged in 
													// redirect to login
				{
					//'User dont have orders create an order for him';
					
					$OrderSQL = "INSERT INTO orders(customer_id,status, date) VALUES(". $_SESSION['SESS_USERID'] . ", 0, NOW())";
					$QueryResult = @mysqli_query($Conn, $OrderSQL) or die("<p>Unable to create order.</p>"
							. "<p>Error code ". Mysqli_connect_errno()
							. ": ". mysqli_connect_errno()) . "</p>";
					
					// select the order id and then create oder itemsql
					// one process as i did for the login
					
					$PrderSQL = "SELECT id FROM orders WHERE customer_id = " . $_SESSION['SESS_USERID'] . " AND status = 0"; // create an order if necessary
					$OrderQueryResult = @mysqli_query($Conn, $PrderSQL);
			 
					$numrows = mysqli_num_rows($OrderQueryResult);

					if($numrows != 0)
					{
						$orderrow = mysqli_fetch_assoc($OrderQueryResult); 
						$_SESSION['SESS_ORDERNUM'] = $orderrow['id'];
						
										
						$itemsql = "INSERT INTO orderitems(order_id,product_id, quantity) VALUES(". $_SESSION['SESS_ORDERNUM'] . ", ". $_GET['id'] . ", ". $_POST['amountBox'] . ")";
						@mysqli_query($Conn, $itemsql) or die(mysql_error());		

						$totalprice = $prodrow['price'] * $_POST['amountBox'] ;	// multiply quantity	
						$UpdSQL = "UPDATE orders SET total = total + ". $totalprice . " WHERE id = ". $_SESSION['SESS_ORDERNUM'] . ";";
						@mysqli_query($Conn, $UpdSQL) or die(mysql_error());						
												
					}	
					header("Location: " . $config_basedir . "showcart.php");					
				
				}	
				else{	// create an order where by the user is not set but the session for the user is set, this would be used as reference for the 
					
					header("Location: " . $config_basedir . "register.php");
					
				}	
			}
		}	
		
	}
	
?>

<body>

	<?php
	
		require('header.php');
		
	?>	
	
			<div id="wrapper">
				<div id="page" class="container">		
		
					<div id="content">		
						<br />
						<br/>
						<br />
						<br/>
						<br />
						<br/>
						<form action="cartitems.php?id= <?php echo $_GET['id']; ?>" method="POST">
					
							<table cellpadding='20'>
								
								<ul class="style2" align='center'>
			
									<li><a href="#"></a></li>		
									<li><a href="#"></a></li>										
								</ul>
								<p align='center' style = 'font-color:#006400'> <?php echo '<strong>'.$prodrow['name'] . '</strong>'; ?></p>
								<?php 
								echo "<tr>";
							
									if(empty($prodrow['image'])) {
										echo "<td><imgsrc='product/no_image.jpg' width='50'></td>";
									}
								
									else 
									{
										echo "<td>
										<img src='product/" . $prodrow['image']. "' width='470'   height='200' alt='" . $prodrow['name']. "'></td>";
									}
								echo "</tr>";
								echo "<br />";
								echo "<tr>";
									echo "<td>". $prodrow['description'] . "</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td>Select Quantity <select name='amountBox'>";
									for($i=1;$i<=100;$i++)
									{
										echo "<option>" . $i . "</option>";
									}
									echo "</select></td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td>Price  : <strong> R". sprintf('%.2f', $prodrow['price']) . "</strong></td>";
									
								echo "</tr>";
								echo "<tr>";
									?>	
									
									<td><input type="image"  name ='submit' src="images/add.gif" alt="submit" width="300" height="50"></td>
												
								<?php echo "</tr>"; ?>
								
								<ul class="style2" align='center'>
			
									<li><a href="#"></a></li>		
									<li><a href="#"></a></li>		
								
								</ul>
								
							</table>
					
						</form>
				</div>
				<?php
					
				require('sidebar.php');
					
			?>
			</div>
			
			
			
			
		</div>
			
	
	
	<!-- END HEADING -->
	<?php 
	
		require('footer.php');
		
	?>
	
</body>