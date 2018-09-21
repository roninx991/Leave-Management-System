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
	$sql="SELECT * FROM `Staff` WHERE EmpID='".$_SESSION["ClassCordinator"]."'";
	$result=mysqli_query($t,$sql);
	$cc=$result->fetch_assoc();
	$sql="SELECT * FROM `Staff` WHERE EmpID='".$_SESSION["Mentor"]."'";
	$result=mysqli_query($t,$sql);
	$mentor=$result->fetch_assoc();
	?>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<div class="row">
			<a class="navbar-brand" id="navbar-title" href="../Home/">
				<img src="../../assets/images/favicon.png" width="30" height="30" alt="P Favicon">
				PICT Leave Management System / Student
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
						<h5>Student</h5></p>
						<p>ID: <?php echo $_SESSION["EnrollID"]; ?></p>
						<p>Class: <?php echo $_SESSION["Class"]; ?></p>
						<p>Batch: <?php echo $_SESSION["Batch"];?></p>
					</center>
				</center>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-9">
			<div class="card">
				<div class="card-header text-center">
					Work-area
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-6">
							<input type="text" name="mentor" class="form-control bg-primary" style="color: white;" value="Your Mentor is <?php echo $mentor["Name"]?> " readonly>		
						</div>
						<div class="col-12 col-md-6">
							<input type="text" name="mentor" class="form-control bg-primary" style="color: white;" value="Your Class Co-ordinator is <?php echo $cc["Name"]?>" readonly>
						</div>	
					</div>
					<br>
					<h2 class="titles">Application Status</h2>
					<?php
						$select = "SELECT * FROM `StudApps` WHERE ID='".$_SESSION["EnrollID"]."'";
						$result = mysqli_query($t, $select);
						if (mysqli_num_rows($result) > 0) {
							# code...
							echo "
							<table class='table'>
							  <thead class='thead-dark'>
							    <tr>
							      <th scope='col'>#</th>
							      <th scope='col'>Application ID</th>
							      <th scope='col'>CC_ID</th>
							      <th scope='col'>Mentor_ID</th>
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
								      <td>".$row['cc_id']."</td>
								      <td>".$row['mentor_id']."</td>
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
						<p>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							Apply Now
						</button>
						</p>

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
										<form action="../../php/studentApp.php" id="leaveform" method="POST">
											<div class="row">
												<div class="col">
													<h3>Select Dates:</h3>
													<input type="date" name="sdt" id="sdt" placeholder="Start Date" required>
													<input type="date" name="edt" id="edt" placeholder="End Date" required>
												</div>
											</div>	
											<hr>
											<div>
												<h3>Reason(s) for leave: </h3>
												<textarea rows="7" cols="60" required name="reasons" style="resize:none;" placeholder="Please state the reason(s) for your leave"></textarea>
											</div>
											<div><hr>
												<h3>Leave address:</h3>
												<textarea rows="5" cols="60" name="address" style="resize:none;" placeholder="Leave address" required></textarea>
											</div><hr>
											<h3>On-leave Contact no.:</h3>
											<input id="phone" type="tel" required name="phone" placeholder="Leave contact no.">
<!-- 											<p>
											<h3>Upload Proof</h3>
											<input type="file" name="proof"><br>
											</p>
											<p>
											<h3>Upload Parent's signed Document</h3>
											<input type="file" name="signed">
											</p>
 -->										</div>
										<div class="modal-footer">
											<input type="reset" class="btn btn-secondary" value="Reset" title="Reset">
											<input type="submit" class="btn btn-primary" value="Apply" title="Apply for leave">
										</div>
									</form>
								</div>
							</div>
						</div>	
					</div>
					<div class="card-footer text-muted">
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="js/index.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../../dist/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$("#sdt").datepicker();
			$("#edt").datepicker();
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="../../dist/bootstrap.min.js"></script>
	</body>
	</html>