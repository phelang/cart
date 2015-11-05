

<?php
	
	class Categories{
		
		private $Conn;
		private $categories;
		
		function __construct()
		{

			$this->Conn = new mysqli('127.0.0.1','root','',"tpsshop");
			
			If (mysqli_connect_errno())
				die("<p>Unable to connect to database.</p>"
				. "<p>Error code ". Mysqli_connect_errno()
				. ": ". mysqli_connect_errno()) . "</p>";		
		}
		
		function __destruct()
		{
			$this->Conn->close(); //Close handles of open database connections
		}
		
		function __wakeup()
		{
			$this->DBConnect = $DBConnect;

		}
		
		
		public function setCategories() // ($storeID) there are no multiple stores only one store with all the inventory
		{
			$SQLString = "SELECT * FROM categories;";
			$QueryResult = @mysqli_query($this->Conn, $SQLString);
			
			if($QueryResult != FALSE) {
				
				$this->categories = array();
							
				while(($Row = mysqli_fetch_assoc($QueryResult)))	// change to object
				{
					$this->categories[$Row['id']] = array();
					$this->categories[$Row['id']]['id'] = $Row['id'];
					$this->categories[$Row['id']]['name'] = $Row['name'];
								
				}
			}			
		}		
		public function getCategoryList() // ($storeID) there are no multiple stores only one store with all the inventory
		{
			return $this->categories;
		}
	}
?>


