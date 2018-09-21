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
$hintq = mysqli_real_escape_string($t, $_POST["hintq"]);
$answer = mysqli_real_escape_string($t, $_POST["answer"]);


if ($type === "Student") {
		# code...
		$query = "SELECT * FROM `Student` WHERE HintQ='".mysqli_real_escape_string($t, $hintq)."' AND Answer='".mysqli_real_escape_string($t, $answer)."' AND EnrollID='".mysqli_real_escape_string($t, $name)."'";
		$result = mysqli_query($t, $query);
		if (mysqli_num_rows($result) !== 0) {
			# code...
			$update = "UPDATE `Student` SET Password='".$pass."'";
			$except=mysqli_query($t, $update);
			if ($except) {
				# code...
				echo "Successfully Updated";
			}
			else
			{
				echo "Failed...";
			}
		}
		else {
			# code...
			echo "Incorrect question or answer";
		}
	}
elseif ($type === "Faculty") {
		# code...
		$query = "SELECT * FROM `Staff` WHERE HintQ='".mysqli_real_escape_string($t, $hintq)."' AND Answer='".mysqli_real_escape_string($t, $answer)."' AND EmpID='".mysqli_real_escape_string($t, $name)."'";
		$result = mysqli_query($t, $query);
		if (mysqli_num_rows($result) !== 0) {
			# code...
			$update = "UPDATE `Staff` SET Password='".$pass."'";
			$except=mysqli_query($t, $update);
			if ($except) {
				# code...
				echo "Successfully Updated";
			}
			else
			{
				echo "Failed...";
			}
		}
		else {
			# code...
			echo "Incorrect question or answer";
		}
	}	
?>
