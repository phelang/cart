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
	

	// if no product was selected then redirect to products view
	
	$validid = pf_validate_number($_GET['id'],"redirect", $config_basedir); 



	$Conn = new mysqli('127.0.0.1','root','',"tpsshop");
				
				If (mysqli_connect_errno())
					die("<p>Unable to connect to database.</p>"
					. "<p>Error code ". Mysqli_connect_errno()
					. ": ". mysqli_connect_errno()) . "</p>";	
				
	$producst_selecsql = "SELECT * FROM products WHERE cat_id = " . $_GET['id'] . ";";
	$QueryResult = @mysqli_query($Conn, $producst_selecsql);
	
	$numrows =  mysqli_num_rows($QueryResult);
?>
		
<body>

	<?php
	
		require('header.php');
		
		
	?>
	
	<div id="wrapper">
		<div id="page" class="container">		
		
			<div id="content">			
		
				<?php

					if($numrows == 0)
					{
						
						echo "<h1>No products</h1>";

						echo "There are no products in this category.";

					}
					else
					{
						echo "<table cellpadding='10'>";
						?>
							<?php $c = 0; ?>
							<?php while(($Row = mysqli_fetch_assoc($QueryResult))){ ?>
							
								<div id="two-column">
									
									
									<?php  if (($c%2) == 0): ?>				  
										
										
										<!-- POPULATE IF MOD is 1 -->
									
										<div id="tbox1"> <!-- BOX 1 -->
											<div class="title">
												
											</div>
											
											<p align='center' style = 'font-color:#006400'> <?php echo '<strong>'.$Row['name'] . '</strong>'; ?></p>
											
										
					
											<?php
											if(empty($Row['image'])) {
												echo "<p><img src='./product/no_image.jpg' width='370' height='170' alt='". $Row['name'] . "'></p>";
											}
											else 
											{
												echo "<p><img src='./product/" . $Row['image']. "' alt='". $Row['name'] . "'></p>";
											}
											?>
											<p align='center'>Price <strong> R <?php echo sprintf('%.2f', $Row['price']); ?></strong> </p>
									
											<ul class="style2" align='center'>
												<?php echo "<li><a href='" . $config_basedir . "cartitems.php?id=" .($Row['id']) . "'>". 'Buy' . "</a></li>";?>
												<li><a href="#"></a></li>
											</ul>

										</div>
										
										
									<?php else: ?>
										
									
										<div id="tbox2">	<!-- BOX 1 -->
											
											<p align='center'><?php echo '<strong>'.$Row['name'] . '</strong>'; ?></p>
											
											<?php
											if(empty($Row['image'])) {
												echo "<p><img src='./product/no_image.jpg' width='370' height='170' alt='". $prodrow['name'] . "'></p>";
											}
											else 
											{
												echo "<p><img src='./product/" . $Row['image']. "' alt='". $Row['name'] . "'></p>";
											}
											?>
											<p align='center'>Price <strong> R <?php echo sprintf('%.2f', $Row['price']); ?></strong> </p>
											
											<ul class="style2" align='center'>
												
												<?php echo "<li><a href='" . $config_basedir . "cartitems.php?id=" .($Row['id']) . "'>". 'Buy' . "</a></li>";?>
												<li><a href="#"></a></li>
												
						
												
											</ul>
											
											
										</div>
									
									<?php endif; ?>
							</div>	
							
							<?php $c++; ?>
							<?php }
						echo "</table>";
						
					}

					?>
		
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









