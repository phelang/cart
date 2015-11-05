<!-- CSS and Formatting -->


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
	
	if(!isset($_SESSION))
	{
		session_start();
		echo 'session started';
	}
	
	require("config.php");
	
	$Conn = new mysqli('127.0.0.1','root','',"tpsshop");
			
			If (mysqli_connect_errno())
				die("<p>Unable to connect to database.</p>"
				. "<p>Error code ". Mysqli_connect_errno()
				. ": ". mysqli_connect_errno()) . "</p>";		
		
	
	
	
	//if(isset($_SESSION['SESS_LOGGEDIN']) == TRUE) 
	{
		//header("Location: " . $config_basedir);
	}

	if(isset($_POST['submit']))
	{
		

		$SQLString = "SELECT * FROM login WHERE username = '" .$_POST['userBox'] . "' AND password = '" . ($_POST['passBox']) . "'";
	
		$QueryResult = @mysqli_query($Conn, $SQLString);
		
		if($QueryResult != FALSE){
			
			$numrows =  mysqli_num_rows($QueryResult);
			
		}		
		
		if($numrows == 1)
		{
			
			$loginrow = mysqli_fetch_assoc($QueryResult);
			//session_register("SESS_LOGGEDIN");	// create a session var LOGGEDIN
			//session_register("SESS_USERNAME");	// CREATE SESSION VAR USER NAME
			//session_register("SESS_USERID");	// CREATE SESSION VAR USERID
			$_SESSION['SESS_LOGGEDIN'] = 1;
			$_SESSION['SESS_USERNAME'] = $loginrow['username'];
			$_SESSION['SESS_USERID'] = $loginrow['id'];
			
			$PrderSQL = "SELECT id FROM orders WHERE customer_id = " . $_SESSION['SESS_USERID'] . " AND status = 0"; // create an order if necessary
			$OrderQueryResult = @mysqli_query($Conn, $PrderSQL);
	 
			$numrows = mysqli_num_rows($OrderQueryResult);

			if($numrows != 0)
			{
				// only set this value if the user has orders
				$orderrow = mysqli_fetch_assoc($OrderQueryResult); 
				$_SESSION['SESS_ORDERNUM'] = $orderrow['id'];
				
			}
			echo $_SESSION['SESS_LOGGEDIN'];
			echo $_SESSION['SESS_USERNAME'];
			echo $_SESSION['SESS_USERID'];
			header("Location: " . $config_basedir);
		}
		else{
			
			header("Location: http://" .$_SERVER['HTTP_HOST']. $_SERVER['SCRIPT_NAME'] . "?error=1");
			
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
		
				<!-- LOGIN container -->
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<h1>Customer Login</h1>

					<p>Please enter your username and password  to log into the websites.<br />
					If you do not have an account, you can get one for 
					free by <a href="register.php">registering</a> </p>.
					
					<br />
					
					<table>
					<tbody>
						<tr>
							<td>Username</td>
							<td><input type="textbox" name="userBox" /></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" name="passBox" /></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="submit" value="Log in" /></td>
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