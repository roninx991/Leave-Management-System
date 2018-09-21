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
	?>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<div class="row">		
			<a class="navbar-brand" id="navbar-title" href="../Home/">
				<img src="../../assets/images/favicon.png" width="30" height="30" alt="P Favicon">
				PICT Leave Management System / Faculty
			</a>
			<a href="../../Home/" style="text-decoration:none;position:absolute;right:10px;top:20px;color:white;">Logout</a> 
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
							<h4>HOD</h4>
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
				<h2 class="titles">Applications for Approval</h2>

			<?php
			$select = "SELECT * from `StaffApps`";
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
							<th scope='col'>Employee ID</th>
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
								<td>".$row['EmpID']."</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="../../dist/bootstrap.min.js"></script>
<script src="../../assets/js/common.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</body>
</html>
