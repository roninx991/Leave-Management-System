<!DOCTYPE html>
<html>
<head>
	<title>PICT|LMS</title>
	<link rel="shortcut icon" href="../../assets/images/favicon.png">
	<link rel="stylesheet" href="../../dist/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../../dist/jquery-ui.min.css">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>
<body>
	<?php
	session_start(); 
	$user_name = "root";
	$password = "";
	$database = "wtproject";
	$server = "127.0.0.1";
	$t=new mysqli($server, $user_name, $password, $database);
	if(!$t){
		die("Connection Failed!");
	}
	$sql="SELECT * FROM `Staff` WHERE EmpID='".$_SESSION["EmpID"]."'";
	$result=mysqli_query($t,$sql);
	$cc=$result->fetch_assoc();
	?>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<div class="row">		
		<a class="navbar-brand" id="navbar-title">
			<img src="../../assets/images/favicon.png" width="30" height="30" alt="P Favicon">
			PICT Leave Management System / Faculty
		</a>
		<a href="../../php/logout.php" style="text-decoration:none;position:absolute;right:10px;top:20px;color:white;">Logout</a> 
		</div>

	</nav>
	<!-- End Navbar -->

	<div class="row">
		<div class="col-12 col-md-3" style="height: 90vh">
			<div class="card" style="height:100%">
				<div class="card-header">
					Profile
				</div>
				<div class="card-body">
				<center>
					<img class ="card-img-top" src="../../assets/images/pict.png" alt="PICT logo" id="pict-logo" style="width:200px;height:200px;">
					<center><p><h3><?php echo $_SESSION["Name"]; ?></h3>
						<h4>Class Co-ordinator of: <br><?php echo $_SESSION["cc_of"];?></h4>
						<h4>Mentor of: <br><?php echo $_SESSION["mentor_of"];?></h4>
						</p>
					</center>
				</center>
				</div>
				<div class="card-footer text-muted">
				</div>
			</div>
		</div>
		<div class="col-12 col-md-9">
			<div class="card">
				<div class="card-header text-center">
					Work-area
				</div>
				<div class="card-body">
					<h2 class="titles">Application Status</h2>

					<?php
						$select = "SELECT * FROM `StaffApps` WHERE EmpID='".$_SESSION["EmpID"]."'";
						$result = mysqli_query($t, $select);
						if (mysqli_num_rows($result) > 0) {
							# code...
							echo "
							<table class='table'>
							  <thead class='thead-dark'>
							    <tr>
							      <th scope='col'>#</th>
							      <th scope='col'>Application ID</th>
							      <th scope='col'>Status</th>
							    </tr>
							  </thead>
							  <tbody>";
							  $i = 1;
							  while ($row = $result->fetch_assoc()) {
							  	# code...
							  	echo "<tr>
								      <th scope='row'>".$i."</th>
								      <td>".$row['AppID']."</td>
								      <td>".$row['status']."</td>
  								      </tr>";
									  $i++;
							  }
							  echo "</tbody></table>";

						}
						else{
							echo "<p>There are no applications.</p>";
						}
					?>
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							Apply Now
						</button>
						<hr>
						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Leave Application</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="../../php/facultyApp.php" id="leaveform" method="POST">	
											<h3>Type of leave:</h3>
											<div class="form-check">
												<input type="radio" id="one" name="ltype" value="CL"><label>&nbsp;CL</label>
												<input type="radio" id="two" name="ltype" value="ML"><label>&nbsp;ML</label>
												<input type="radio" id="three" name="ltype" value="EL"><label>&nbsp;EL</label>
												<input type="radio" id="four" name="ltype" value="OD"><label>&nbsp;O.D.</label>
												<input type="radio" id="five" name="ltype" value="Coff"><label>&nbsp;C off</label>
												<input type="radio" id="six" name="ltype" value="LWP"><label>&nbsp;LWP</label>
											</div><hr>
											<div class="row">
												<div class="col">
													<h3>Select Dates:</h3>
													<input type="radio" name="dtype" value="full"><label>&nbsp;Full Day</label>
													<input type="radio" name="dtype" value="half"><label>&nbsp;Half Day</label>
													<input type="date" name="dt" id="dt" placeholder="Select Date">
													<input type="button" class="btn btn-primary" value="Add" id="addDay" onclick="submitDate();">
												</div>
											</div><hr>
											<div>
												<h3>Days of Leave: </h3>
												<textarea rows="10" cols="60" id="dol" style="resize:none;" name="dol" placeholder="You can add dates by clicking above button. You can also edit the days here."></textarea>
											</div>
											<div>
												<h3>Reason(s) for leave: </h3>
												<textarea rows="10" cols="60" required style="resize:none;" name="reasons" placeholder="Please state the reason(s) for your leave"></textarea>
											</div>
											<div>
												<h3>Leave address:</h3>
												<textarea rows="5" cols="60" style="resize:none;" name="la" placeholder="Leave Address"></textarea>
											</div><hr>
											<h3>On-leave Contact no.:</h3>
											<input id="phone" type="tel" name="phone" required placeholder="Leave Contact No.">
											<div class="modal-footer">
												<input type="reset" class="btn btn-secondary" value="Reset" title="Reset">
												<input type="submit" class="btn btn-primary" value="Apply" title="Apply for leave">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>	
						<h2 class="titles">Applications for Approval</h2>
						<?php
						$select = "SELECT * from `StudApps` where cc_id='".$_SESSION['EmpID']."'";
						$result = mysqli_query($t, $select);
						$i = 1;
						echo "";
						if (mysqli_num_rows($result) > 0) {
							# code...
							echo "
							<table class='table'>
							  <thead class='thead-dark'>
							    <tr>
							      <th scope='col'>#</th>
							      <th scope='col'>Application ID</th>
							      <th scope='col'>Student ID</th>
							      <th scope='col'>Action</th>
							    </tr>
							  </thead>
							  <tbody>";
							  $i = 1;
							  while ($row = $result->fetch_assoc()) {
							  	# code...
							  	if ($row["status"] === "Pending Approval") {
								  	echo "<tr>
									      <th scope='row'>".$i."</th>
									      <td>".$row['AppID']."</td>
									      <td>".$row['ID']."</td>
									      <td><button id='".$row['AppID']."' type=\"button\" class=\"btn btn-primary\" onclick='viewApp(this);'>
											View
										  </button>
										  </td>
	  								      </tr>";
										  $i++;
							  	}
							  }
							  echo "</tbody></table>";

						}
						else{
							echo "<p>There are no applications.</p>";
						}
					?>
					<div class="card-footer text-muted">
					</div>
				</div>
			</div>
		</div>


		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../../dist/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$("#dt").datepicker();
			// $("#addDay").click(function(){
			// 	var d = $("#dt").val();
			// 	var dtype = $("#dtype").val();
			// 	if (d !== "" && dtype !=="") {
			// 		$("#dol").html() = $("#dol").html() + d + "- " + dtype + "<br>";
			// 	}
			// 	else
			// 	{
			// 		alert("Select date and time period");
			// 	}
			// });
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="../../dist/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script src="../../assets/js/common.js"></script>
	</body>
	</html>
