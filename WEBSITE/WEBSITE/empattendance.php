<!DOCTYPE html>
<html lang="en">
  <head>
    <title>EmpFiTrack</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  <div class="container pt-5">
			<div class="row justify-content-between">
				<div class="col">
					<a class="navbar-brand" href="index.html">Emp<span>Fi</span>Track</a>
				</div>
				<div class="col d-flex justify-content-end">
					<div class="social-media">
		    		<p class="mb-0 d-flex">
            <a href="login.php" class="d-flex align-items-center justify-content-center"><span class="fa fa-sign-out" ><i class="sr-only">Logout</i>
          
          </span></a>
						
		    		</p>
	        </div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	     <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav mr-auto">
	        	<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	        	<li class="nav-item active"><a href="empattendance.php" class="nav-link">Employee Attendance</a></li>
	        	<li class="nav-item"><a href="addemp.php" class="nav-link">Add/Delete Employee</a></li>
	        	<li class="nav-item"><a href="empsal.php" class="nav-link">Employee Salary</a></li>
	            <li class="nav-item"><a href="emploc.php" class="nav-link">Employee Location</a></li>
				<li class="nav-item"><a href="monsal.php" class="nav-link">Monthly Salary</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/empatt_bg.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span> Employee Attendance <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Attendance Details</h1>
          </div>
        </div>
      </div>
    </section>
   	<div class="center-div">
	   <div class="table-responsive">
   				<table class="table table-hover">
						<thead>
						  <tr>
							<th scope="col">Employee ID</th>
							<th scope="col">Employee Name</th>
							<th scope="col">Attendance</th>	
							</tr>
						</thead>
						<tbody>
						<?php
							session_start();
     
							$con=mysqli_connect("localhost","root","","empfitrack");
							$selectquery="SELECT * FROM webtable  ";
							$query=mysqli_query($con,$selectquery);
							$nums=mysqli_num_rows($query);
							while($res = mysqli_fetch_array($query)){

								if( $res['Task1Latitude']==0 && $res['Task1Longitude']==0 && $res['Task2Latitude']==0 && $res['Task2Longitude']==0 && $res['Task3Latitude']==0 && $res['Task3Longitude']==0 && $res['Task4Latitude']==0 && $res['Task4Longitude']==0  )
								{
									$attendance="Absent";
								}
								else
								{
									$attendance="Present";
								}
						?>
						  <tr>
							
							<td><?php echo $res['EmployeeID'];?></td>
							<td><?php echo $res['EmployeeName'];?></td>
							<td><?php echo $attendance ;?></td>
			            
						</tr>
						 
						  <?php
							}
						 ?>
						 
						</tbody>
					  </table>
				</div>
			</div>
	
    

  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>