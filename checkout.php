
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
	
	
	$Conn = new mysqli('127.0.0.1','root','',"tpsshop");
								
	If (mysqli_connect_errno())
		die("<p>Unable to connect to database.</p>"
			. "<p>Error code ". Mysqli_connect_errno()
			. ": ". mysqli_connect_errno()) . "</p>";

	
	$UpdQtySQL = "UPDATE orders SET status=1 WHERE id=". $_SESSION['SESS_ORDERNUM'] . ";";		// update TOTAL in Oreder Table
	@mysqli_query($Conn, $UpdQtySQL) or die(mysql_error());
	
	$sql = "DELETE FROM orderitems WHERE order_id = " . $_SESSION['SESS_ORDERNUM'];
	$del=mysqli_query($Conn, $sql)or die(mysql_error());
	
?>


<body>

	<?php
	
		require('header.php');
		
	?>
	
	<?php
	
		$ordernum=$_SESSION['SESS_ORDERNUM'];
		$Query= "SELECT * FROM orders WHERE id =$ordernum";
													
		$OrderQueryResult = @mysqli_query($Conn, $Query) or die(mysql_error());
		$numrows =  mysqli_num_rows($OrderQueryResult);
												
		$Row = mysqli_fetch_assoc($OrderQueryResult);
		
		
		
		$CustomerQuery= "SELECT * FROM customers WHERE id =" . $Row['customer_id'];
													
		$CustomerQueryResult = @mysqli_query($Conn, $CustomerQuery) or die(mysql_error());
	
		$CustomerRow = mysqli_fetch_assoc($CustomerQueryResult);

	
	?>
	
	<div id="wrapper">
		<div id="page" class="container">		
		
			<div id="content">			
		
				<!-- LOGIN container -->
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

					<h1></h1>

					<h1>Thank You Message</h1>.
					</br />
					</br />
					</br />
					<p>It is our pleasure to serve you every day. Thank you for buying and being loyal to us. You are a special and a valued customer to our company and in fact your business is always greatly appreciated. Thank you!</p>
					</br />
					</br />
					
					
					
					<?php	if(isset($_SESSION['SESS_ORDERNUM'])) : ?>
							<table style="width:100%" bgcolor="#DDDDDD">
											<tr>
												<td > <h1 style="color:#1E90FF" align="left">Company Name<h1></td>
												<td > <h1 style="color:#1E90FF" align="right">STATEMENT<h1></td>
											</tr>
											<tr>
												<td  style="color:#1E90FF" align="left"> Cape Town, 7585</td>
												<td  style="color:#1E90FF" align="right"> Date: <?php echo date("Y/m/d") ?></td>
											</tr>
											<tr>
												<td  style="color:#1E90FF" align="left">Contact :  021-367-3600</td>
												<td  style="color:#1E90FF" align="right">Email : tsp@tsp.com</td>
												
											</tr>
											
							</table>
							<br />
							
							<table style="width:100%" bgcolor="#DDDDDD">
											<tr>
												<td > <h3 style="color:#1E90FF" align="left">Customer<h3></td>
												<tr></tr>
												
												<?php
													
													echo "<tr>";											
													
														echo "<td style='color:#1E90FF' align='left'>". $CustomerRow ['forname'] . "  " .  $CustomerRow ['surname'] . "</td>";														
													
													echo "</tr>"; 	
													echo "<tr>";											
													
														echo "<td style='color:#1E90FF' align='left'>". $CustomerRow ['add1'] . "    " .  $CustomerRow ['postcode'] . "</td>";														
													
													echo "</tr>"; 	
													echo "<tr>";											
													
														echo "<td style='color:#1E90FF' align='left'>". $CustomerRow ['email'] . "</td>";														
													
													echo "</tr>"; 	
												?>
														

											</tr>
											<tr>
										
												<td  style="color:#1E90FF" align="right"> Date: <?php echo date("Y/m/d") ?></td>
											
											</tr>
											
							</table>
						
							<table cellpadding='35' align="center" border="1"   BORDERCOLOR="#DDDDDD">
										
										
										<ul class="style2" align='center'>
					
											<li><a href="#"></a></li>		
											<li><a href="#"></a></li>										
										</ul>

										<br />
										
										<?php
											
											echo "<tr>";
											
											echo "<th>Order ID </th>";
											echo "<th>Date</th>";
											echo "<th>Total</th>";
											
											echo "</tr>"; 	

										
											echo "<tr>";
											
												echo "<td>". $Row['id'] . "</td>";
												echo "<td>". $Row['date'] . "</td>";
												echo "<td> R ". $Row['total'] . "</td>";
											
											echo "</tr>"; 	
										?>
	
							</table>
								<ul class="style2" align='center'>
					
									<li><a href="#"></a></li>		
									<li><a href="#"></a></li>										
								</ul>
							<p style="text-align:center"><strong>Thank You <p>
						<?php else: ?>
							<br />
							<br />
								<ul class="style2" align='center'>
					
									<li><a href="#"></a></li>		
									<li><a href="#"></a></li>										
								</ul>
						
						<?php endif; ?>

					</br />
					</br />
					</br />
					<p align='center'>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="upload" value="1">
							<input type="hidden" name="business" value="phelang.qhu@hotmail.com">
							<?php /*paypal_items();*/ ?>			
							
							<input type="hidden" name="currency_code" value="GBP">
							<input type="hidden" name="amamount" value="">
							<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but03.gif" height="130" width="300" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
						</form>
					</p>
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

<?php
	unset($_SESSION['SESS_ORDERNUM']);
?>




