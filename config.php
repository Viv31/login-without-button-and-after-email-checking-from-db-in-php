<?php 
$db_hostname = "localhost";
$db_user = "root";
$db_pwd = "";
$db_name="Loginwithoutbutton";
$conn = mysqli_connect($db_hostname,$db_user,$db_pwd,$db_name);
if($conn){
//echo "Connected";
}
else{
	echo "We have connection error";
}

?>