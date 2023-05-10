<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

if(isset($_GET['deleteid'])) {
$id=$_GET['deleteid'];	
$query="delete from `food` where idfood=$id";
$querys=mysqli_query($conn, $query);

if($querys){
	header('location:foodslist.php');}
	mysqli_close($conn);
}
?>
	