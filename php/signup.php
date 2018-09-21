<?php
$user_name = "root";
$password = "";
$database = "wtproject";
$server = "127.0.0.1";
$t=new mysqli($server, $user_name, $password, $database);
if(!$t){
	die ('SQL Error: ' . mysqli_error($t));
}
if(isset($_POST['fname'])&& isset($_POST['lname'])&& isset($_POST['designation']) && isset($_POST['id']) && isset($_POST['password']) && isset($_POST['hintq']) && isset($_POST['ans'])){
	
	$fname=mysqli_real_escape_string($t, $_POST['fname']);
	$lname=mysqli_real_escape_string($t, $_POST['lname']);
	$designation=mysqli_real_escape_string($t, $_POST['designation']);
	$id=mysqli_real_escape_string($t, $_POST['id']);
	$password=mysqli_real_escape_string($t, $_POST['password']);
	$hintq=mysqli_real_escape_string($t, $_POST['hintq']);
	$ans=mysqli_real_escape_string($t, $_POST['ans']);
	$class=mysqli_real_escape_string($t, $_POST['class']);
	$division=mysqli_real_escape_string($t, $_POST['division']);
	$batch=mysqli_real_escape_string($t, $_POST['batch']);
	$cc_of=mysqli_real_escape_string($t, $_POST['cc_of']);
	$mentor_of=mysqli_real_escape_string($t, $_POST['mentor_of']);

	
	
	if($designation==="6"){

		$query = "SELECT `EmpID` FROM `Staff` WHERE  cc_of=\"".$class.$division."\"";
		$result = mysqli_query($t, $query);
		if (!$result) {
			die ('SQL Error: ' . mysqli_error($t));
		}
		$count=mysqli_num_rows($result);
		if($count==1){
			$cc = mysqli_fetch_assoc($result);
		}

		$query = "SELECT `EmpID` FROM `Staff` WHERE  mentor_of=\"".$batch.$division."\"";
		$result = mysqli_query($t, $query);
		if (!$result) {
			die ('SQL Error: ' . mysqli_error($t));
		}
		$count=mysqli_num_rows($result);
		if($count==1){
			$mentor = mysqli_fetch_assoc($result);
		}

		$sql="INSERT INTO `Student` (`EnrollID`, `Password`,  `Name`, `Class`, `Batch`,`Mentor`,`ClassCordinator`, `HintQ`, `Answer`) VALUES ('".$id."', '".$password."', '".$fname." ".$lname."', '".$class.$division."' , '".$batch.$division."', '".$mentor['EmpID']."', '".$cc['EmpID']."', '".$hintq."', '".$ans."')";
		if(mysqli_query($t,$sql)){
			echo "<script>window.location.href='../Home/';</script>";
		}
		else{
			echo "Record insert error";
		}
	}
	else{
		$sql="INSERT INTO `Staff` (`EmpID`, `Password`,  `Name`, `Designation`, `cc_of`,`mentor_of`, `HintQ`, `Answer`) VALUES ('".$id."', '".$password."', '".$fname."', '".$designation."' , '".$cc_of."', '".$mentor_of."', '".$hintq."', '".$ans."')";
		if(mysqli_query($t,$sql)){
			echo "<script>window.location.href='../Home/';</script>";

		}
		else{
			echo "Record insert error";
		}
	}
}
else
{
	echo "<script>window.location.href='../SignUp/';</script>";

}

?>