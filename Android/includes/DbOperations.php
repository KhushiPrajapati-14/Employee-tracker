<?php 

	class DbOperations{

		private $con; 

		function __construct(){

			require_once dirname(__FILE__).'/DbConnect.php';

			$db = new DbConnect();

			$this->con = $db->connect();

		}

		public function userLogin($username,$pass){
		
			$stmt = $this->con->prepare("SELECT * FROM webtable WHERE EmployeeID = ? AND Password = ?");
			$stmt->bind_param("is",$username,$pass);
			$stmt->execute();
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}

		public function getUserByUsername($username)

		{
			$stmt = $this->con->prepare("SELECT * FROM webtable WHERE EmployeeID= ?");
			$stmt->bind_param("s",$username);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		
	}