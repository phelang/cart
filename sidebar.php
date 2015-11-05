
<!-- SIDE BAR -->
<?php
	require ('Categories.php');
	
	if((isset($_SESSION['SESS_LOGGEDIN'])) == TRUE )
		$user_logged = (String)($_SESSION['SESS_LOGGEDIN']) ;

?>


 <div id="sidebar">
			<div class="box1">
			
				<div class="title">
					<h2>One account </h2>
				</div>	

				<?php	global $user_logged; ?>
				<?php  if (($user_logged) == 1): ?>				  
					<ul class="style2">
						<li><a href="#">Logged in as :   <strong><?php  echo "   " . $_SESSION['SESS_USERNAME'] ?></a></li>
						<li><a href="logout.php"><strong>Sign out</a></li>
					</ul>	
					
				<?php else: ?>
					<ul class="style2">
						<li><a href="login.php">Sign in to coninue to TSP</a></li>
						<li><a href="register.php">Create account</a></li>
					</ul>		
				<?php endif; ?>
		
			</div>
			
			<div class="box2">
				<div class="title">
					<h2>Product Categories</h2>
				</div>
				<ul class="style2">
	
				<?php
					$cart = new Categories();	
					$cart->setCategories();
					$categories = $cart->getCategoryList();
											
					if(count($categories) > 0)
						?>
						<?php foreach($categories as $ID => $Info) : ?>
							<?php echo "<li><a href='" . $config_basedir . "products.php?id=" .($Info['id']) . "' class='icon icon-ok button'>". ($Info['name']) . "</a></li>";?>
						<?php endforeach; ?>
				</ul>
			</div>
			
			
</div>


<!-- END OF SIDE BAR -->