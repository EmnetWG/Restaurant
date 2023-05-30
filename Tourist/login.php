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
	 
  $email=$_POST['email'];
  
    $pass=$_POST['password'];

	 $email=stripslashes($email);
	 $pass=stripslashes($pass);
	 $email=mysqli_real_escape_string($conn, $email);
	 $pass=mysqli_real_escape_string($conn, $pass);
	 
	 $query="select * from `user` where `email`='$email'";
     $querys=mysqli_query($conn, $query);
     $row_count=mysqli_num_rows($querys);
	

      if($row_count>0){
        $rowp=mysqli_fetch_array( $querys, MYSQLI_ASSOC);
        $username=$rowp['firstname'];
          $password=$rowp['password'];
         
          $type=$rowp['type'];

        if(password_verify($pass,$password )) {
     $_SESSION['useremail']=$email;
   $_SESSION['username']=$username;
        
      if($type=="admin"){
       
        echo "<script>window.open('admin.php', '_SELF')</script>";

      }
      
       
        
      
    
      else {
	  $ipt=getIPAddress(); 

		
$queryc="select * from `cart` where `ipaddress`='$ipt'";

$querysc=mysqli_query($conn, $queryc);
$product_count=mysqli_num_rows($querysc);

     
        if($product_count==0) {
	  header('location:front.php');
	//mysqli_close($conn);
		}
		else {
			
			echo "<script>window.open('payment.php', '_SELF')</script>";        
		}
      }}

	else {
		echo 'Invalid email or password';
		
	}
	
      }
else {
	echo 'Invalid credentials';
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
    <title>Log in</title>
	<style>
	@media  (min-width: 50em) {
.form-details{
    padding-left:30%;
}
        }
        .form-details input{
            width:95%;
border-radius:4px;
box-sizing:border-box;
padding:10px;
border: none;

border:1px solid #eee;
background-color:#f7f7f7;


        } 
        </style>
</head>
<body>
<?php
include("header.php");
?>
    <main>
	<section class="padding-block-900">
    <div class="container">
<div class="form-details">

<table>
<tr><td>
<form action=" " method="POST" enctype="multipart/form-data" autocomplete="off">
<table cellspacing=15>
<tr>
<td><label>Email</label></td>
<td>
<input type="email" name="email" onfocus="this.value=''"><span class="error">* <?php echo $emailErr;?></span>
<br><br></td></tr>
<tr>
<td><label>Password</label></td>
<td>
<input type="password" name="password" onfocus="this.value=''"><span class="error">* <?php echo $passErr;?></span>
<br><br></td></tr>
<tr>
<td><a href="signup.php" style="color:var(--clr-primary-400)">Sign up</a></td>
<td><button type="submit" name="submit"  class="btn">Login</button></td>
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



	 
