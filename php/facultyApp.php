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
$ltype = mysqli_real_escape_string($t, $_POST['ltype']);
$dt = mysqli_real_escape_string($t, $_POST['dol'])."\n";
$reasons = mysqli_real_escape_string($t, $_POST['reasons']);
$phone = mysqli_real_escape_string($t, $_POST['phone']);
$addr = mysqli_real_escape_string($t, $_POST['la']);

$id= $_SESSION["EmpID"];

$sql="INSERT INTO `StaffApps` VALUES ('', '".$id."', '".$addr."', '".$phone."', '".$dt.$reasons."', '".$ltype."','Pending Approval')";
$insert = mysqli_query($t, $sql);
if ($insert) {
	# code...
	echo "<script>window.location.href='../SignUp/Faculty/'</script>";
}
else{
	echo "Failed";
}

?>