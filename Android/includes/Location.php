<?php 
		
 session_start();
				
	$con=mysqli_connect("localhost","khushi","program","empfitrack");
	echo "connected";
				
	 if(isset($_POST['Latitude']) and isset($_POST['Longitude']) and isset($_POST['EmployeeID']) and isset($_POST['CV']))
		{
        $latitude=$_POST['Latitude'];
		$longitude=$_POST['Longitude'];
        $employeeid=$_POST['EmployeeID'];
        $countvalue=$_POST['CV'];


     if($countvalue=="1")
     {
     $query1= "UPDATE webtable SET Task1Latitude='$latitude',Task1Longitude='$longitude' WHERE EmployeeID='$employeeid'";
     $query2=mysqli_query($con,$query1);
     $countvalue=0;
     }
     if($countvalue=="2")        
     {
     $query1= "UPDATE webtable SET Task2Latitude='$latitude',Task2Longitude='$longitude' WHERE EmployeeID='$employeeid'";
     $query2=mysqli_query($con,$query1);
     $countvalue=0;
     }
     if($countvalue=="3")        
     {
     $query1= "UPDATE webtable SET Task3Latitude='$latitude',Task3Longitude='$longitude' WHERE EmployeeID='$employeeid'";
     $query2=mysqli_query($con,$query1);
     $countvalue=0;
     }
     if($countvalue=="4")        
     {
     $query1= "UPDATE webtable SET Task4Latitude='$latitude',Task4Longitude='$longitude' WHERE EmployeeID='$employeeid'";
     $query2=mysqli_query($con,$query1);
     $countvalue=0;
     }

	 $response['error'] = false;
	 $response['EmployeeID'] = $_POST['EmployeeID'];
     $response['latitude'] = $_POST['Latitude'];
     $response['longitude'] = $_POST['Longitude'];
  
   }
		else
		{
		echo "Data is not send";
		}

?>