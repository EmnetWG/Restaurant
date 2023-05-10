<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
//include('functions.php');
//@session_start();
if (isset($_POST['submit'])){
	$email=$_SESSION['useremail'];
	$query_delete="delete from `user` where `email`='$email'"; 
     $querys=mysqli_query($conn, $query_delete);
	 
	if($querys){
		session_destroy();
		header('location:front.php'); } 
mysqli_close($conn);
	
}
?>
<html>
<head>
<title></title>
</head>
<body>
<form method='POST'>
<input action=" " type='submit' name='submit' value='Delete Account'>
</form>
<a href="profile.php">Cancel</a>

</body>
</html>
