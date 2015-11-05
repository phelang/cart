<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Contour 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130706

-->

<html xmlns="http://www.w3.org/1999/xhtml">
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

<body>	
	<?php
		
		require('header.php');
		
	
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		
		}
		else
		{
			echo 'Session ALREADY';
		  
		}

	?>
	<div id="wrapper">
		<div id="page" class="container">
			<div id="content">			
				<div id="banner"> <img src="images/cart.jpg" width="790" height="300" alt="" /> </div>
				<div class="title">
					<h2>Welcome</h2>
					<span class="byline">Welcome to TSP website. Click one of the pages to explore the site. We have a wide range of different products available.</span> </div>
			
				<p>
					One of the most enticing factor about online shopping, particularly during a holiday season, is it alleviates the need to wait in long lines or search from store to store for a particular item.			
				</p>
			
			
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
</html>
