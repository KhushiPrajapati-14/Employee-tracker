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
	<link rel="stylesheet" href="css/style1.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
	        	<li class="nav-item"><a href="empattendance.php" class="nav-link">Employee Attendance</a></li>
	        	<li class="nav-item"><a href="addemp.php" class="nav-link">Add/Delete Employee</a></li>
	        	<li class="nav-item"><a href="empsal.php" class="nav-link">Employee Salary</a></li>
	          <li class="nav-item"><a href="emploc.php" class="nav-link">Employee Location</a></li>
            <li class="nav-item active"><a href="summary.php" class="nav-link">Payroll Summary</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
   

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/empsal_bg.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span> PAYROLL SUMMARY <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">PAYOUT SUMMARY OF COMPANY</h1>
          </div>
        </div>
      </div>
    </section>
  
    <footer class="footer">
  
              <?php
						 	
               session_start();
               $con=mysqli_connect("localhost","root","","empfitrack");
               $query="SELECT SUM(JAN) as 'jansal' FROM monthtable";
               $res=mysqli_query($con,$query);
               $data=mysqli_fetch_array($res);

               $query1="SELECT SUM(FEB) as 'febsal' FROM monthtable";
               $res1=mysqli_query($con,$query1);
               $data1=mysqli_fetch_array($res1);

               $query2="SELECT SUM(MAR) as 'marsal' FROM monthtable";
               $res2=mysqli_query($con,$query2);
               $data2=mysqli_fetch_array($res2);

               $query3="SELECT SUM(APRIL) as 'aprilsal' FROM monthtable";
               $res3=mysqli_query($con,$query3);
               $data3=mysqli_fetch_array($res3);

               $query4="SELECT SUM(MAY) as 'maysal' FROM monthtable";
               $res4=mysqli_query($con,$query4);
               $data4=mysqli_fetch_array($res4);

               $query5="SELECT SUM(JUNE) as 'junesal' FROM monthtable";
               $res5=mysqli_query($con,$query5);
               $data5=mysqli_fetch_array($res5);
              
              ?>     
  
    <script type="text/javascript">
         
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
          var data = google.visualization.arrayToDataTable([
               ['MONTHS', 'SALARY',{ role: "style" } ],
               ['JAN' , <?php echo $data['jansal']?>,   "color: #040035" ],
               ['FEB' , <?php echo $data1['febsal']?>,  "color: #040035" ],
               ['MAR' , <?php echo $data2['marsal']?>,  "color: #040035" ],
               ['APRIL',<?php echo $data3['aprilsal']?>,"color: #040035" ],
               ['MAY' , <?php echo $data4['maysal']?>,  "color: #040035" ],
               ['JUNE', <?php echo $data5['junesal']?>, "color: #040035" ]
              
          ]);

          var options = {
          title: 'PAYOUT SUMMARY OF COMPANY (6 MONTHS)',
          hAxis: {
                     title: 'MONTHS',
                 },
          vAxis: {
                     title: 'SALARY',
                 },       
          width: 1150,
          height: 650,
          curveType: 'function',
          legend: { position: "none" },
          backgroundColor:'#668cff',
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        
              }                

    </script>

         <div id="curve_chart" class="chart"></div>
         <label> </label>
          
         <div class="container-fluid px-lg-5">
         <label> </label>
			  	  <div class="row">
				   	  <div class="col-md-4 py-1">
					      <div class="row">
						  	  <div class="col-md-8">
							  	   <div class="row justify-content-center">
								    	  <div class="col-md-12 col-lg-10">
										       <div class="row">
											
										       </div>
									       </div>
								      </div>
							     </div>
						     </div>
					     </div>  
          
                <div class="col-md-4 py-md-5 py-4 aside-stretch-right pl-lg-6">
                <label></label>
			           <form method="POST" class="contact-form">
        		     
                 <div class="form-group">
                 
					       <input type="submit" class="form-control submit px-3" name="Back" value="Back" formaction="summary.php">
			           </div>
		     
                 </form>
         
                 </div>
             </div>
		     </div>

    </footer>
  
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