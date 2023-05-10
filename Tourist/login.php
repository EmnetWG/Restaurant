<?php
@session_start();
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
include('functions.php');
$passErr = $emailErr ="";

if(isset($_POST['submit'])) {
		

if(empty($_POST['email'])){
	 $emailErr = "email is required";	
	}
	else{
		$email=$_POST['email'];
	}
if(empty($_POST['password'])){
	 $passErr = "Password is required";	
	}
	else{
		$pass=$_POST['password'];
	}
	
	 $email=stripslashes($email);
	 $pass=stripslashes($pass);
	 $email=mysqli_real_escape_string($conn, $email);
	 $pass=mysqli_real_escape_string($conn, $pass);
	 
	 $query="select * from `user` where `email`='$email'";
     $querys=mysqli_query($conn, $query);
     $row_count=mysqli_num_rows($querys);
	 $rowp=mysqli_fetch_array( $querys, MYSQLI_ASSOC);
	  $username=$rowp['firstname'];
      $password=$rowp['password'];
	  
	  $ipt=getIPAddress(); 

		
$queryc="select * from `cart` where `ipaddress`='$ipt'";

$querysc=mysqli_query($conn, $queryc);
$product_count=mysqli_num_rows($querysc);

      if($row_count>0){
		  

      if(password_verify($pass,$password )) {
	 $_SESSION['useremail']=$email;
 $_SESSION['username']=$username;
        if($product_count==0) {
	  header('location:front.php');
	//mysqli_close($conn);
		}
		else {
			
			echo "<script>window.open('payment.php', '_SELF')</script>";        
		}
	  }
	else {
		echo 'Invalid email or password';
		
	}
	
}
else {
	echo 'Invalid credentials';
}


}
	 

?>
<html>
<head>
<title>Login</title>
</head>
<body>
<div>

<table>
<tr><td>
<form action=" " method="POST" enctype="multipart/form-data" autocomplete="off">
<table cellspacing=15>
<tr>
<td><label>Email</label></td>
<td>
<input type="email" name="email" ><span class="error">* <?php echo $emailErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Password</label></td>
<td>
<input type="password" name="password"><span class="error">* <?php echo $passErr;?></span>
<br><br></td></tr>
<tr>
<td><a href="signup.php">Sign up</a></td>
<td><input type="submit" name="submit" value="Login"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>


	 </body>
</html>