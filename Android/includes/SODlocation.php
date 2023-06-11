<?php 
		
				session_start();
				
				$con=mysqli_connect("localhost","khushi","program","empfitrack");
				echo "connected";
				
				if(isset($_POST['Time']) and isset($_POST['LocationLatitude']) and isset($_POST['LocationLongitude']) and isset($_POST['EmployeeID']))
				{
                    $time=$_POST['Time'];
				    $locationlatitude=$_POST['LocationLatitude'];
                    $locationlongitude=$_POST['LocationLongitude'];
			    	$employeeid=$_POST['EmployeeID'];
				
		
                    $query1= "UPDATE webtable SET Time='$time', LocationLatitude='$locationlatitude' , LocationLongitude='$locationlongitude' WHERE EmployeeID='$employeeid'";
					$query2=mysqli_query($con,$query1);
					$response['error'] = false;
					$response['time'] = $_POST['Time'];
					$response['locationlatitude'] = $_POST['LocationLatitude'];
                    $response['locationlongitude'] = $_POST['LocationLongitude'];
                    $response['EmployeeID'] = $_POST['EmployeeID'];
				
						
						if($query2)
						{
							echo "query successful: data inserted ";
                        }
                        else
						{
                            echo "query error: not inserted";
                        }		

		}

		else
		{
		echo "Data is not send";
		}

?>