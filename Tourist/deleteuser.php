<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

if(isset($_GET['id'])) {
$id=$_GET['id'];	
$query="delete from `user` where id=$id";
$querys=mysqli_query($conn, $query);

if($querys){
	header('location:admin.php');}
	mysqli_close($conn);
}
?>