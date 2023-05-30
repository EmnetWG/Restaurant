<?php
@session_start();
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

//include("functions.php"); 
//<h1><?php cart_quan(); </h1>

?>

<?php
if(isset($_SESSION['useremail'])){
	include("payment.php");
}
else
{
	include("login.php");
}

?>

