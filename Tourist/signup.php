<?php
include("functions.php");
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

$passErr = $emailErr =$addressErr=$cityErr=$lastErr=$firstErr=$confErr=$phoneErr=" ";
if(isset($_POST['submit'])) {
		

if((!empty($_POST['email']))&&(!empty($_POST['firstname']))&&(!empty($_POST['lastname']))
&&(!empty($_POST['phone']))&&(!empty($_POST['city']))&&(!empty($_POST['password']))&&
(!empty($_POST['confirmpass']))){
	 
	
    $address=$_POST['address'];
   
	
    $email=$_POST['email'];
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $phone=$_POST['phone'];
    $pass=$_POST['password'];
    $city=$_POST['city'];
    $confpass=$_POST['confirmpass']; 
	
	 $email=stripslashes($email);
	 $first=stripslashes($first);
	 $last=stripslashes($last);
   $phone=stripslashes($phone);
	 $city=stripslashes($city);
	 $address=stripslashes($address);
	 $pass=stripslashes($pass);
	 $confpass=stripslashes($confpass);
	 $email=mysqli_real_escape_string($conn, $email);
   $phone=mysqli_real_escape_string($conn, $phone);
	 $first=mysqli_real_escape_string($conn, $first);
	 $last=mysqli_real_escape_string($conn, $last);
	 $pass=mysqli_real_escape_string($conn, $pass);
	 $city=mysqli_real_escape_string($conn, $city);
	 $address=mysqli_real_escape_string($conn, $address);
$confpass=mysqli_real_escape_string($conn, $confpass);
$hashpassword=password_hash($pass, PASSWORD_DEFAULT);
	 
	 $query="select * from `user` where email='$email'";
$querys=mysqli_query($conn, $query);
$row_count=mysqli_num_rows($querys);
if($row_count>0){
	$emailErr="Email is already present";
}

elseif($pass!=$confpass){
	$confErr="Password does not much";
}
else  
{
$queryi="insert into `user` (`firstname`, `lastname`, `phone`, `city`, `address`, `email`,`password`, `type`)
	values( '$first', '$last', '$phone', '$city', '$address', '$email', '$hashpassword', 'user')";
	$querysi=mysqli_query($conn, $queryi);
	if($querysi){

	header('location:front.php'); }
mysqli_close($conn);
	
}	
}
else{
  $passErr = $emailErr =$addressErr=$cityErr=$lastErr=$firstErr=$confErr=$phoneErr="It is required ";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Sign Up</title>
    <style>
    
        
        
        </style>
</head>
<body>
<?php
include("header.php");
?>
    <main>
<section class="padding-block-900">
<div class="container " >
<div  class="form-details">
<table >
<tr><td>
<form action=" " method="POST" enctype="multipart/form-data" autocomplete="off">
<table cellspacing=15>
<tr>
<td><label>First Name</label></td>
<td>
<input type="text" name="firstname" ><span class="error">* <?php echo $firstErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Last Name</label></td>
<td>
<input type="text" name="lastname" ><span class="error">* <?php echo $lastErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Phone Number</label></td>
<td>
<input type="text" name="phone" ><span class="error">* <?php echo $phoneErr;?></span>
<br><br></td></tr>
<tr>
<td><label>City</label></td>
<td>
<input type="text" name="city" ><span class="error">* <?php echo $cityErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Address</label></td>
<td>
<input type="text" name="address" >
<br><br></td></tr>
<tr>
<td><label>Email</label></td>
<td>
<input type="email" name="email" value="Enter email" onfocus="this.value=''"><span class="error">* <?php echo $emailErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Password</label></td> 
<td>
<input type="password" name="password" value="Enter Password" onfocus="this.value=''"><span class="error">* <?php echo $passErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Confirmpassword</label></td> 
<td>
<input type="password" name="confirmpass"><span class="error">* <?php echo $confErr;?></span>
<br><br></td></tr>
<tr>
<td><a href="login.php" style="color:var(--clr-primary-400);">Login</a></td>
<td><button type="submit" name="submit"  class="btn">Sign up</button></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>
</div>
</section>
    </main>
    <?php
include("footer.php");
    ?>
    
   
   <script src="/main.js"></script> 
</body>
</html>

