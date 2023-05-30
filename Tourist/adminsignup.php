<?php
include("functions.php");
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

$passErr = $emailErr =$addressErr=$cityErr=$lastErr=$firstErr=$confErr=$phoneErr=" ";
if(isset($_POST['submit'])) {
		

if((!empty($_POST['email']))&&(!empty($_POST['firstname']))&&(!empty($_POST['lastname']))
&&(!empty($_POST['phone']))&&(!empty($_POST['city']))&&(!empty($_POST['password']))&&
(!empty($_POST['confirmpass']))&&(!empty($_POST['type']))){
	 
	
    $address=$_POST['address'];
   
	$type=$_POST['type'];
    $email=$_POST['email'];
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $phone=$_POST['phone'];
    $pass=$_POST['password'];
    $city=$_POST['city'];
    $confpass=$_POST['confirmpass']; 
	
    $type=stripslashes($type); 
    $email=stripslashes($email);
	 $first=stripslashes($first);
	 $last=stripslashes($last);
   $phone=stripslashes($phone);
	 $city=stripslashes($city);
	 $address=stripslashes($address);
	 $pass=stripslashes($pass);
	 $confpass=stripslashes($confpass);
	 $email=mysqli_real_escape_string($conn, $email);
     $type=mysqli_real_escape_string($conn, $type);
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
	values( '$first', '$last', '$phone', '$city', '$address', '$email', '$hashpassword', '$type')";
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
        @media  (min-width: 50em) {
.user-details{
    padding-left:30%;
}
        }
        </style>
</head>
<body>
<header> 
     <div >
      
        <nav class="primary-navigation">
          <img class="logo" src="images/food.png" style="width: 40px;
        height: 40px; border-radius:50%; display:inline;"/>
        <button id="nav-toggler" class="nav-toggler"></button>
        
         <ul role="list" class="nav-list fs-nav" id="nav-list" >
           <li><a href="front.php">Home</a></li>
           <li><a href=" ">Catagory</a></li>
           <?php if(isset($_SESSION['useremail'])) {
        echo '<li class="nav-item"><a class="nav-link" href="profile.php">My account</a></li>';

}
else
{
echo '<li class="nav-item"><a class="nav-link" href="signup.php.php">Register</a></li>';	
}

?>
           <li><a href="#">About</a></li>
           <li><a href="#">Contact</a></li>
         </ul>
         <i class="fas fa-shopping-cart"></i><span class="navbar-text" id="cartqty"><?php cart_quan() ?></span> 
<!---<span class="navbar-text"><?php cart_price() ?></span> -->
<?php if(isset($_SESSION['useremail'])){
//echo'<span class="navbar-text">Welcome '.$_SESSION['username'].'</span>';
 
echo'<button type="button" class="btn" ><a href="logout.php">Logout</a></button>';
}
else{
echo'<button type="button" class="btn"><a href="login.php">login</a></button>';	
}
?>

       </nav>
       <?php if(isset($_SESSION['useremail'])){
echo'<span class="navbar-text">Welcome '.$_SESSION['username'].'</span>';
}
?>
     </div>
    </header>
    <main>
<section class="padding-block-900">
<div class="container " >
<div  class="user-details">
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
<td><label>User type</label></td>

<td>
<select name="type">

<option value="admin">Admin</option>
<option value="user">User</option>
</select>
</td></tr>
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
<td><label>Confirm Password</label></td> 
<td>
<input type="password" name="confirmpass"><span class="error">* <?php echo $confErr;?></span>
<br><br></td></tr>
<tr>
<td><a href="login.php" style="color:var(--clr-primary-400);">Login</a></td>
<td><input type="submit" name="submit" value="Signup" class="btn btn-inverted"></td>
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

