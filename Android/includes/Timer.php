<?php 
		
				session_start();
				
				$con=mysqli_connect("localhost","khushi","program","empfitrack");
				echo "connected";
				
				if(isset($_POST['RegularHR']) and isset($_POST['OvertimeHR']) and isset($_POST['EmployeeID']) and isset($_POST['CV']))
				{
                    $RGHR=$_POST['RegularHR'];
				    $OVTHR=$_POST['OvertimeHR'];
			    	$employeeid=$_POST['EmployeeID'];
					$countvalue=$_POST['CV'];
					
                    $query1= "UPDATE webtable SET RegularHR= RegularHR +'$RGHR', OvertimeHR=OvertimeHR +'$OVTHR' WHERE EmployeeID='$employeeid'";
					$query2=mysqli_query($con,$query1);
					$response['error'] = false;
					$response['EmployeeID'] = $_POST['EmployeeID'];
					$response['Regularhours'] = $_POST['RegularHR'];
					$response['Overtimehours'] = $_POST['OvertimeHR'];
				
						
						if($query2)
						{
							echo "query successful: data inserted ";
                        }
                        else
						{
                            echo "query error: not inserted";
                        }
				

				if($countvalue>=4)
				{
					$query1= "UPDATE webtable SET RegularHR= RegularHR +'$RGHR', OvertimeHR=OvertimeHR +'$OVTHR' WHERE EmployeeID='$employeeid'";
					$query2=mysqli_query($con,$query1);
					//call maheks data storing query ;
					//$query1= "UPDATE webtable SET RegularHR= 0, OvertimeHR= 0 WHERE EmployeeID='$employeeid'";
					//$query2=mysqli_query($con,$query1);
			}

		}

		else
		{
		echo "Data is not send";
		}

	

?>