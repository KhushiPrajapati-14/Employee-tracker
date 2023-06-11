<?php 

require_once '../includes/DbOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['EmployeeID']) and isset($_POST['Password'])){ //checking whether the data inserted by user is null or full
		$db = new DbOperations(); 

		if($db->userLogin($_POST['EmployeeID'], $_POST['Password'])){ //storing the data received after executing the query into a key
			$response['username'] = $_POST['EmployeeID']; //displays the data from database into postman using the key value in resonse
			$response['password'] = $_POST['Password']; //displays the data from database into postman using the key value in response
			
			$user = $db->getUserByUsername($_POST['EmployeeID']);  //storing the data received after executing the query into a key
			$response['error'] = false; //displays the data from database into postman using the key value in response
			$response['EmployeeName'] = $user['EmployeeName']; //displays the data from database into postman using the key value in response
			$response['Gender'] = $user['Gender']; //displays the data from database into postman using the key value in response
			$response['Email'] = $user['Email']; //displays the data from database into postman using the key value in response
			$response['Address'] = $user['Address']; //displays the data from database into postman using the key value in response
			$response['MobileNumber'] = $user['MobileNumber']; //displays the data from database into postman using the key value in response


		}else{
			$response['error'] = true; 
			$response['message'] = "Invalid username or password";			
		}

	}else{
		$response['error'] = true; 
		$response['message'] = "Please enter all the fields";
	}
}

echo json_encode($response);