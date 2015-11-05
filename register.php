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

	?>

	<div id="wrapper">
		<div id="page" class="container">		
		
			<div id="content">			
		
				<!-- LOGIN container -->
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<h1>Personal Details</h1>

					<p>Please enter all the required data.</p>.
					
					<br />
					
					<h3>Account</h1> 	<br />
					<table cellpadding='10'>
					<tbody>
						<tr>
							<td>First Name </td>
							<td><input type="textbox" name="userBox" /></td>
						
						</tr>
						<tr></tr>
						<tr>
							<td>Last Name </td>
							<td><input type="password" name="passBox" /></td>
						</tr>
						<tr>
							<td>Adress</td>
							<td><input type="password" name="addressBox" /></td>
						</tr>
						<tr>
							<td>Phone </td>
							<td><input type="password" name="phoneBox" /></td>
						</tr>
						<tr>
							<td>Phone </td>
							<td><input type="password" name="phoneBox" /></td>
						</tr>
				
						
						</tbody>
					</table>
					
					<br />
					<h3>Login</h1> 
					<br />
					
					<table cellpadding='10'>
					<tbody>
						<tr>
							<td>Username </td>
							<td><input type="textbox" name="userBox" /></td>
						
						</tr>
						<tr></tr>
						<tr>
							<td>Password</td>
							<td><input type="password" name="passBox" /></td>
						</tr>
						
						<tr>
							<td>Re-Type Password</td>
							<td><input type="password" name="passBox" /> </td>
						</tr>
						
						
						<tr>
							<td></td>
							<td><input type="submit" name="submit" value="Create Account" /></td>
						</tr>
						</tbody>
					</table>
					
				</form>
		
			</div>
		

			<?php
			//echo $_SESSION['SESS_LOGGEDIN'];
			//echo $_SESSION['SESS_USERNAME'];
			//echo $_SESSION['SESS_USERID'];
				//require('sidebar.php');
			
			?>
		
		</div>
	</div>
	
	
	<!-- END HEADING -->
	<?php 
	
		require('footer.php');
		
	?>
</body>