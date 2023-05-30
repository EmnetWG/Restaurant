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

<form method='POST' style="margin-bottom:2rem;">
<input action=" " type='submit' name='submit' value='Delete Account' class="btn btn-inverted">
</form>
<a href="profile.php" class="btn">Cancel</a>


