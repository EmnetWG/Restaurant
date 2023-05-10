<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
$passErr = $emailErr =$addressErr=$cityErr=$lastErr=$firstErr=$confErr=" ";

if(isset($_SESSION['useremail'])) {
	$useremail=$_SESSION['useremail'];
 $query_u="select * from `user` where `email`='$useremail'"; 
     $querys_u=mysqli_query($conn, $query_u);
	 $row=mysqli_fetch_array( $querys_u, MYSQLI_ASSOC);
	
	 $first=$row['firstname'];
$last=$row['lastname']; 
$city=$row['city'];
$address=$row['address'];
//$pass=$row['password'];



if(isset($_POST['update'])) {
		

//if(empty($_POST['email'])){
//	 $emailErr = "email is required";	//
//	}
//	else{
//		$email=$_POST['email'];
//	}
	

	if(empty($_POST['firstname'])){
	 $firstErr = "First name is required";	
	}
	else{
		$first=$_POST['firstname'];
	}
	
	if(empty($_POST['lastname'])){
	 $lastErr = "Last name is required";	
	}
	else{
		$last=$_POST['lastname'];
	}
	
	if(empty($_POST['city'])){
	 $cityErr = "City is required";	
	}
	else{
		$city=$_POST['city'];
	}
	
	if(empty($_POST['password'])){
	 $passErr = "Password is required";	
	}
	else{
		$pass=$_POST['password'];
	}
	
	if(empty($_POST['confirmpass'])){ 
	 $confpassErr = "Password is required";	
	}
	else{
		$confpass=$_POST['confirmpass']; 
	}
	
	$address=$_POST['address'];
	
	// $email=stripslashes($email);
	 $first=stripslashes($first);
	 $last=stripslashes($last);
	 $city=stripslashes($city);
	 $address=stripslashes($address);
	 $pass=stripslashes($pass);
	 $confpass=stripslashes($confpass);
	// $email=mysqli_real_escape_string($conn, $email);
	 $first=mysqli_real_escape_string($conn, $first);
	 $last=mysqli_real_escape_string($conn, $last);
	 $pass=mysqli_real_escape_string($conn, $pass);
	 $city=mysqli_real_escape_string($conn, $city);
	 $address=mysqli_real_escape_string($conn, $address);
$confpass=mysqli_real_escape_string($conn, $confpass);
$hashpassword=password_hash($pass, PASSWORD_DEFAULT);
	 
	 if($pass!=$confpass){
	$confErr="Password does not much";
}
else  
{
	
	
$queryi="update `user` set `firstname`='$first', `lastname`='$last', `city`='$city', `address`='$address', 
 `password`='$hashpassword', `type`='user' where `email`= '$useremail'"; 
	$querysi=mysqli_query($conn, $queryi);
	if($querysi){

	header('location:profile.php'); } 
mysqli_close($conn);
	
}	
}
}

?>
<html>
<head></head>
<title>update account</title>
<body>
<div>

<table>
<tr><td>
<form action=" " method="POST" enctype="multipart/form-data" autocomplete="off">
<table cellspacing=15>
<tr>
<td><label>First Name</label></td> 
<td>
<input type="text" name="firstname" value="<?php echo $first ;?>"><span class="error">* <?php echo $firstErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Last Name</label></td>
<td>
<input type="text" name="lastname" value="<?php echo $last ;?>"><span class="error">* <?php echo $lastErr;?></span>
<br><br></td></tr>
<tr>
<td><label>City</label></td>
<td>
<input type="text" name="city" value="<?php echo $city ;?>"><span class="error" *><?php echo $cityErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Address</label></td>
<td>
<input type="text" name="address" value="<?php echo $address ;?>">
<br><br></td></tr>


<tr>
<td><label>Password</label></td>   
<td>
<input type="password" name="password" value="Enter password"><span class="error">* <?php echo $passErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Confirmpassword</label></td> 
<td>
<input type="password" name="confirmpass"><span class="error">* <?php echo $confErr;?></span>
<br><br></td></tr>
<tr>
<td><input type="submit" name="update" value="Update"></td>

</tr>
</table>
</form>
</td>
</tr>
</table>
</div>
</body>
</html>

