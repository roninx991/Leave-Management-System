<!DOCTYPE html>
<html>
<head>
	<title>PICT|LMS</title>
	<link rel="shortcut icon" href="../assets/images/favicon.png">
	<link rel="stylesheet" href="../dist/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../dist/jquery-ui.min.css">
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
	$sql="SELECT * FROM `StudApps` WHERE AppID='".$_GET["id"]."'";
	$result=mysqli_query($t,$sql);
	$row=$result->fetch_assoc();
	?>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<div class="row">
			<a class="navbar-brand" id="navbar-title" href="../Home/" style="color:white;">
				<img src="../assets/images/favicon.png" width="30" height="30" alt="P Favicon">
				PICT Leave Management System
			</a>
			<a href="../../php/logout.php" style="text-decoration:none;position:absolute;right:10px;top:20px;color:white;">Logout</a> 

		</div>
	</nav>
	<!-- End Navbar -->
	<br><br>
	<center>
	<form action="DisApp.php" id="leaveform" method="POST">
			<div>
				<h3>Application ID</h3>
				<input type="text" name="id" value=<?php echo "'".$row['AppID']."'";?> ><hr>
			</div>
			<div>
				<h3>Reason(s) for leave: </h3>
				<textarea rows="7" cols="60" required name="reasons" style="resize:none;" readonly="true"><?php echo $row["Reasons&Dates"];?></textarea>
			</div>
			<div><hr>
				<h3>Leave address:</h3>
				<textarea rows="5" cols="60" name="address" style="resize:none;" readonly="true"><?php echo $row["LeaveAddr"];?></textarea>
			</div><hr>
			<h3>On-leave Contact no.:</h3>
			<input id="phone" type="tel" name="phone" readonly="true" value=<?php echo "'".$row['LeaveContact']."'";?> >

		<div class="modal-footer">
			<input type="submit" class="btn btn-danger" name="dis" value="Disapprove" onclick="">
			<input type="submit" class="btn btn-primary" name="ap" value="Approve">
		</div>
	</form>
	</center>

	<script type="text/javascript" src="js/index.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../dist/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="../dist/bootstrap.min.js"></script>
	</body>
	</html>