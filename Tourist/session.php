<?php

session_start();
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
$userm=$_SESSION['useremail'];
$query6="select `email` from `user` where `email`='$userm'";
$query7=mysqli_query($conn, $query6);
$result=mysqli_fetch_assoc($query7);
$qu=$result['email'];
if(!isset($qu)){
	mysqli_close($conn);
	header('location:login.php');
}
?>