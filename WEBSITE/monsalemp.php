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
            <a href="login.php" class="d-flex align-items-center justify-content-center"><span class="fa fa-sign-out" ><i class="sr-only">Logout</i></span></a>
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
            <h1 class="mb-0 bread">PAYOUT SUMMARY</h1>
          </div>
        </div>
      </div>
    </section>
               
<footer class="footer">

                    <?php
						 	      session_start();
				            $con=mysqli_connect("localhost","root","","empfitrack");
			              if(isset($_POST['empsalmonth']))
			              {
					          $id=$_POST['EmployeeID2'];
					          $empsalmonthquery="SELECT * FROM monthtable WHERE EmployeeID='$id'";
					          $run=mysqli_query($con,$empsalmonthquery);
					          if(mysqli_num_rows($run)>0)
					          {
						           while($row = mysqli_fetch_array($run))
						           {
							    ?>  

                  <div class="center-div">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Designation</th>	
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php echo $row['EmployeeID'];?></td>
                            <td><?php echo $row['EmployeeName'];?></td>
                            <td><?php echo $row['Designation'];?></td>
                          </tr>
                        </tbody>
                      </table>
 	 		              </div>
                  </div> 

  <script type="text/javascript">

    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() 
    {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Salary", { role: "style" } ],
        ["JAN",  <?php echo $row['JAN'];?>,  "color: #040035"],
        ["FEB",  <?php echo $row['FEB'];?>,  "color: #040035"],
        ["MAR",  <?php echo $row['MAR'];?>,  "color: #040035"],
        ["APRIL",<?php echo $row['APRIL'];?>,"color: #040035"],
		    ["MAY",  <?php echo $row['MAY'];?>,  "color: #040035"],
		    ["JUN",  <?php echo $row['JUNE'];?>, "color: #040035"],
		    ["JULY", <?php echo $row['JULY'];?>, "color: #040035"],
		    ["AUG",  <?php echo $row['AUG'];?>,  "color: #040035"],
		    ["SEPT", <?php echo $row['SEPT'];?>, "color: #040035"],
		    ["OCT",  <?php echo $row['OCT'];?>,  "color: #040035"],
		    ["NOV",  <?php echo $row['NOV'];?>,  "color: #040035"],
		    ["DEC",  <?php echo $row['DECE'];?>, "color: #040035"]
      ]);
        
      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title:'PAYOUT SUMMARY OF EMPLOYEE'  ,
        width: 1150,
        height: 650,
        hAxis: {
                     title: 'MONTHS',
                 },
          vAxis: {
                     title: 'SALARY',
                 },       
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
		    backgroundColor:'#668cff',
      };
      
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
	 
            <?php 
              }}}                
            ?>	  
    }
  </script>

<div id="columnchart_values" class="chart"></div>
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