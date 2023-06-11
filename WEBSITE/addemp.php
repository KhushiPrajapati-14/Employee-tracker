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
						<a href="login.php" class="d-flex align-items-center justify-content-center"><span class="fa fa-sign-out"><i class="sr-only">Logout</i>

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
					<li class="nav-item active"><a href="addemp.php" class="nav-link">Add/Delete Employee</a></li>
					<li class="nav-item"><a href="empsal.php" class="nav-link">Employee Salary</a></li>
					<li class="nav-item"><a href="emploc.php" class="nav-link">Employee Location</a></li>
					<li class="nav-item"><a href="summary.php" class="nav-link">Payroll Summary</a></li>
				</ul>
			</div>
		</div>
	</nav>


	<section class="hero-wrap hero-wrap-2" style="background-image: url('images/addemp_bg.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end">
				<div class="col-md-9 ftco-animate pb-5">
					<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span> Add An Employee <i class="ion-ios-arrow-forward"></i></span></p>
					<h1 class="mb-0 bread">ADD EMPLOYEE DETAILS BELOW</h1>
				</div>
			</div>
		</div>
	</section>

	<footer class="footer">
		<div class="container-fluid px-lg-5">
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
					<h2 class="footer-heading">Add An Employee</h2>


					<?php

					session_start();

					$con = mysqli_connect("localhost", "root", "", "empfitrack");

					if (isset($_POST["submit"])) {

						$EmployeeID = mysqli_real_escape_string($con, trim($_POST['EmployeeID']));
						$EmployeeName = mysqli_real_escape_string($con, trim($_POST['EmployeeName']));
						$Gender = mysqli_real_escape_string($con, trim($_POST['Gender']));
						$DateofBirth = mysqli_real_escape_string($con, trim($_POST['DateofBirth']));
						$MobileNumber = mysqli_real_escape_string($con, trim($_POST['MobileNumber']));
						$Email = mysqli_real_escape_string($con, trim($_POST['Email']));
						$Password = mysqli_real_escape_string($con, trim($_POST['Password']));
						$Designation = mysqli_real_escape_string($con, trim($_POST['Designation']));
						$Salary = mysqli_real_escape_string($con, trim($_POST['Salary']));
						$Address = mysqli_real_escape_string($con, trim($_POST['Address']));
						$File = addslashes($_FILES["image"]["tmp_name"]);
						$File = file_get_contents($File);
						$File = base64_encode($File);

						$check = validate($con, $EmployeeID, $EmployeeName, $Email, $Password, $MobileNumber);

						if ($check[1] != True || $check[2] != True || $check[3] != True || $check[4] != True || $check[5] != True) {
					?>
							<script src="js/sweetalert.js"></script>
							<script>
								swal("Employee Not Added", "<?php echo $check[0] ?>", "error");
							</script>
							<?php
						} else {
							$query1 = "INSERT INTO webtable (EmployeeID, EmployeeName, Gender, DateofBirth, MobileNumber, Email, Password, Designation, Salary, Address, Image) VALUES('$EmployeeID', '$EmployeeName', '$Gender', '$DateofBirth', '$MobileNumber', '$Email', '$Password', '$Designation', '$Salary', '$Address', '$File')";

							$query2 = mysqli_query($con, $query1);
							if ($query2) {
							?>
								<script src="js/sweetalert.js"></script>
								<script>
									swal("Employee Added!", " ", "success");
								</script>
					<?php
							}
						}
					}


					function validate($con, $EmployeeID, $EmployeeName, $Email, $Password, $MobileNumber)
					{

						$msg = "";
						$EmployeeName_valid = $EmployeeID_valid = $Email_valid = $Password_valid = $MobileNumber_valid = false;


						$idquery = "SELECT * FROM webtable where EmployeeID='$EmployeeID' ";
						$query = mysqli_query($con, $idquery);
						$idcount = mysqli_num_rows($query);
						if ($idcount > 0) {
							$msg .= " Employee ID " . $EmployeeID . " already exists.";
						} else {
							$EmployeeID_valid = True;
						};


						if (strlen($EmployeeName) >= 2 && strlen($EmployeeName) <= 40) {
							if (!preg_match('/[^a-zA-Z\s]/', $EmployeeName)) {
								$EmployeeName_valid = true;
							} else {
								$msg .= "Employee name can contain only alphabets. ";
							}
						} else {
							$msg .= "Employee name must be between 2 to 40 characters long.";
						}


						$emailquery = "SELECT * FROM webtable where Email='$Email' ";
						$query = mysqli_query($con, $emailquery);
						$emailcount = mysqli_num_rows($query);
						if ($emailcount > 0) {
							$msg .= "Email already exists.";
						} else {
							$Email_valid = True;
						}


						if (strlen($Password) >= 6 && strlen($Password) <= 20) {
							$Password_valid = true;
						} else {
							$msg .= " Password must be between 6 to 20 characters long.";
						}


						if (strlen($MobileNumber) > 10 || strlen($MobileNumber) < 10) {
							$msg .= "Mobile Number should be of 10 digits. ";
						} else {
							$MobileNumber_valid = True;
						}


						return array($msg, $EmployeeID_valid, $EmployeeName_valid, $Email_valid, $Password_valid, $MobileNumber_valid);
					}



					?>

					<form method="POST" enctype="multipart/form-data" class="contact-form">
						<div class="form-group">
							<input type="text" class="form-control" id="EmployeeID" name="EmployeeID" required placeholder="Employee ID">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="EmployeeName" name="EmployeeName" required placeholder="Employee Name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="Gender" name="Gender" required placeholder="Gender">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="DateofBirth" name="DateofBirth" required placeholder="Date of Birth">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="MobileNumber" name="MobileNumber" required placeholder="Mobile Number">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="Email" name="Email" required placeholder="Email">
						</div>
						<div class="form-group">
							<input type="Password" class="form-control" id="Password" name="Password" required placeholder="Password">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="Designation" name="Designation" required placeholder="Designation">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="Salary" name="Salary" required placeholder="Salary(Per Hour)">
						</div>
						<div class="form-group">
							<textarea name="Address" id="Address" cols="30" rows="3" class="form-control" required placeholder="Address"></textarea>
						</div>


						<div class="form-group">
							<span class="form-group-Btn">
								<span class="btn btn-info btn-file">
									<input type="file" id="image" name="image">
								</span>
							</span>

							<img id="preview-image">
						</div>
						<script>
							var image = document.getElementById("image");
							var previewimage = document.getElementById("preview-image");
							image.addEventListener("change", function(event) {
								if (event.target.files.length == 0) {
									return;
								}
								var tempurl = URL.createObjectURL(event.target.files[0]);
								previewimage.setAttribute("src", tempurl);
							});
						</script>


						<div class="form-group">
							<input type="submit" class="form-control submit px-3" name="submit" value="Submit">
						</div>
					</form>


					<form method="POST" action="deleteemp.php" class="contact-form">
						<div class="form-group">
							<input type="submit" class="form-control submit px-3" name="RemoveEmployee" value="Remove Employee">
						</div>
					</form>

				</div>
			</div>
		</div>

	</footer>


	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>


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