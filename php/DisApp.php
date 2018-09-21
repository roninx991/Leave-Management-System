<?php

$user_name = "root";
$password = "";
$database = "wtproject";
$server = "127.0.0.1";
$t=new mysqli($server, $user_name, $password, $database);
if(!$t){
	die("Connection Failed!");
}

if (isset($_POST["dis"])) {
	# code...
	$update = "UPDATE `StudApps` SET `status`='Disapproved' WHERE AppID='".$_POST['id']."'";
	mysqli_query($t, $update);
}
elseif (isset($_POST["ap"])) {
	# code...
	$update = "UPDATE `StudApps` SET `status`='Approved' WHERE AppID='".$_POST['id']."'";
	mysqli_query($t, $update);
}
echo "<script>window.location.href='../SignUp/Faculty/'</script>";
?>