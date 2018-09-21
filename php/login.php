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
$type = mysqli_real_escape_string($t, $_POST["type"]);
$name = mysqli_real_escape_string($t, $_POST["name"]);
$pass = mysqli_real_escape_string($t, $_POST["pass"]);

if ($type === "Student") {
		# code...
		$query = "SELECT * FROM `Student` WHERE EnrollID='".$name."' AND Password='".$pass."'";
		$result = mysqli_query($t, $query);
		if (mysqli_num_rows($result) !== 0) {
			# code...
			echo "Student";
			$row = $result->fetch_assoc();

			$_SESSION["EnrollID"]=$row["EnrollID"];
			$_SESSION["Class"]=$row["Class"];
			$_SESSION["Name"]=$row["Name"];
			$_SESSION["Batch"]=$row["Batch"];
			$_SESSION["Mentor"]=$row["Mentor"];
			$_SESSION["ClassCordinator"]=$row["ClassCordinator"];
			$_SESSION["HintQ"]=$row["HintQ"];
			$_SESSION["Answer"]=$row["Answer"];
			
		}
		else {
			# code...
			echo "Failed";
		}
	}
elseif ($type === "Faculty") {
		# code...
		$query = "SELECT * FROM `Staff` WHERE EmpID='".$name."' AND Password='".$pass."'";
		$result = mysqli_query($t, $query);
		if (mysqli_num_rows($result) !== 0) {
			# code...
			$row = $result->fetch_assoc();
			if ($row["Designation"] === "1" || $row["Designation"] === "2") {
				# code...
				echo "Head";
			}
			else {
				echo "Faculty";
			}
			$_SESSION["EmpID"]=$row["EmpID"];
			$_SESSION["Name"]=$row["Name"];
			$_SESSION["Designation"]=$row["Designation"];
			$_SESSION["cc_of"]=$row["cc_of"];
			$_SESSION["mentor_of"]=$row["mentor_of"];
			$_SESSION["HintQ"]=$row["HintQ"];
			$_SESSION["Answer"]=$row["Answer"];
		}
		else {
			# code...
			echo "Failed";
		}

	}	
?>