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
	require('config.php');
	require("functions.php");

	$Conn = new mysqli('127.0.0.1','root','',"tpsshop");
								
	If (mysqli_connect_errno())
		die("<p>Unable to connect to database.</p>"
			. "<p>Error code ". Mysqli_connect_errno()
			. ": ". mysqli_connect_errno()) . "</p>";	
	
?>

<?php

	if(isset($_POST['submit_x']))
	{
		
	}
	
	if(isset($_POST['delete_x'])){
		//echo "hello";
		//echo "<a href='delete_from_cart.php?id=". $Row['id'] . "'></a>]";
		
	}

?>


<body>

	<?php
	
		require('header.php');
		
	?>
	
	<div id="wrapper">
		<div id="page" class="container">		
		
			<div id="content">			
				
		
		
				<!-- LOGIN container -->
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<h1>You Cart</h1>
					<?php	if(isset($_SESSION['SESS_LOGGEDIN'])) : ?>
						<?php	if(isset($_SESSION['SESS_ORDERNUM'])) : ?>
							<table cellpadding='35'>
										
										
										<ul class="style2" align='center'>
					
											<li><a href="#"></a></li>		
											<li><a href="#"></a></li>										
										</ul>
										
										<?php
											
											echo "<tr>";
											echo "<th class='textAlignLeft'>Product Name</th>";
											echo "<th>Price </th>";
											echo "<th>Quantity</th>";
											echo "<th>Sub Total</th>";
											echo "<th>Action</th>";
											echo "</tr>"; 	

													
											$ordernum=$_SESSION['SESS_ORDERNUM'];
											$Query= "SELECT * FROM orderitems WHERE order_id =$ordernum";
											
											$OrderQueryResult = @mysqli_query($Conn, $Query) or die(mysql_error());
											$numrows =  mysqli_num_rows($OrderQueryResult);
											
											$sub_total = 0;	
											$total = 0;											
											while(($Row = mysqli_fetch_assoc($OrderQueryResult)))
											{
												

												$prodcut_id = $Row['product_id'];
												
												$producst_selecsql = "SELECT name, price FROM products WHERE id = " .$prodcut_id. ";";
												$ProductQueryResult = @mysqli_query($Conn, $producst_selecsql);
												$prod_row = mysqli_fetch_assoc($ProductQueryResult);
												 
												echo "<tr>";
													echo "<td>" . $prod_row['name']. "</td>";
													echo "<td> R " . $prod_row['price'] . "</td>";
													echo "<td>" . $Row['quantity'] . "</td>";
													
													$sub_total = $prod_row['price'] * $Row['quantity'];
													$total = $total + $sub_total;	
													echo "<td>R " . $sub_total . "</td>";
													echo "<td><a href='delete_from_cart.php?id=".  $Row['id'] ."'><img src='images/delete.gif' width='90' height='50'></a></td>";
																							
												echo "</tr>";
											}
											// total price can be calculated here but for integrity we are using order table
											/*$Query= "SELECT total FROM orders WHERE id =$$ordernum";											
											$OrderTotalResult = @mysqli_query($Conn, $Query) or die(mysql_error());
											$numrows =  mysqli_num_rows($OrderTotalResult);
											
											$total = mysqli_fetch_assoc($OrderTotalResult);
											echo "<tr>";
												echo "<tr>" . $total['total']  . "</td>";
												echo "<tr>";
											echo "</tr>";
											/*$producst_selecsql = "SELECT * FROM products WHERE cat_id = $";
											$QueryResult = @mysqli_query($Conn, $producst_selecsql);*/
											
											
											echo "<tr>";
												echo "<td>Total :</td>";
												echo "<td></td>";
												echo "<td></td>";
												echo "<td> R " . $total . "</td>";
												
												echo "<td><a href='checkout.php?id=".  $_SESSION['SESS_ORDERNUM']."'><img src='images/checkout.gif' width='90' height='50'></a></td>";
												
											
												
											echo "</tr>";

										?>
	
							</table>
						<?php else: ?>
							<br />
							<br />
								<ul class="style2" align='center'>
					
									<li><a href="#"></a></li>		
									<li><a href="#"></a></li>										
								</ul>
							<h3>No cart to show</h3>
						<?php endif; ?>
					
					<?php else: ?> <!-- NOT logged in user -->
						<h3>No cart to show</h3>
						<a href='login.php'>; 
					<?php endif; ?>
					
					
				</form>
		
			</div>
		

			<?php
			//echo $_SESSION['SESS_LOGGEDIN'];
			//echo $_SESSION['SESS_USERNAME'];
			//echo $_SESSION['SESS_USERID'];
			require('sidebar.php');
			
			?>
		
		</div>
	</div>
	
	
	<!-- END HEADING -->
	<?php 
	
		require('footer.php');
		
	?>
</body>