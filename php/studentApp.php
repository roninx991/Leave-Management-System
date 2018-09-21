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
$sdt = mysqli_real_escape_string($t, $_POST['sdt']);
$edt = mysqli_real_escape_string($t, $_POST['edt']);
$dt = $sdt."-".$edt."\n";
$reasons = mysqli_real_escape_string($t, $_POST['reasons']);
$phone = mysqli_real_escape_string($t, $_POST['phone']);
$addr = mysqli_real_escape_string($t, $_POST['address']);
$cc = $_SESSION["ClassCordinator"];
$id= $_SESSION["EnrollID"];
$mentor = $_SESSION["Mentor"];
$sql="INSERT INTO `StudApps` VALUES ('', '".$id."', '".$cc."', '".$mentor."', '".$dt.$reasons."', '".$addr."', '".$phone."', 'Pending Approval')";
$insert = mysqli_query($t, $sql);
if ($insert) {
	# code...
	echo "<script>window.location.href='../SignUp/Student/'</script>";
}
else{
	echo "Failed";
}

?>