<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
include('functions.php');
@session_start();

//$ip=getIPAddress();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile</title> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>

<style>

body{
margin:0;
padding:0;
}
nav{
	
	color:white;
}
a, .nav-link {

color:orange;
text-decoration:none;
}
.btn{
color:orange;	
}
 .btn a{
color:orange;
text-decoration:none;	
}
.button1{
	padding:10px;
	
	width:70px;
	margin-right:10px;
	border-radius:10px;

}
}

.nav_left ul {


}
.nav_left ul li {
list-style-type:none;
padding:10px;
}
.button1{
	padding:10px;
	height:40px;
	margin-right:10px;
	
}
.nav_left{
	background-color:grey;
	
}
.nav_left li{
	
}
.nav_left ul li a
{
	text-decoration:none;
	color:white;
}
.side{
text-align:center;
margin:auto;

}

.side a {
	
	text-decoration:none;
	
}
.footer{
	text-align:center;
	background-color:black;
	color:white;
	height:50px;
}
.container{
	display:grid;
	gap:1em;
}

@media only screen and (min-width:600px) {

.container{

grid-template-columns:1fr 4fr;
grid-template-rows:auto auto auto;

}

.container-side{
	display:flex;
	
	grid-column:2/3;
	
}

.nav-container{
	grid-column:1/3;
}	
.footer{
	grid-column:1/3;
}
}
</style>
</head>
<body>
<header>
<div class="container">
<div class="nav-container">
<nav class="navbar navbar-expand-md bg-dark  navbar-dark">


<a class="navbar-brand" href="#"><img src="images/pay.jpg" height="20" class="rounded px-2"/></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse"  data-bs-target="#collapsibleNavbar">
<span class="navbar-toggler-icon"></span></button>

<div class="collapse navbar-collapse" id="collapsibleNavbar">
<ul class="navbar-nav" >
<li class="nav-item"><a  class="nav-link" href='#'>Home</a></li>
<li class="nav-item"><a  class="nav-link" href='#'>About us</a></li>
<?php if(isset($_SESSION['useremail'])) {
echo '<li class="nav-item"><a class="nav-link" href="profile.php">My account</a></li>';

}
else
{
echo '<li class="nav-item"><a class="nav-link" href="signup.php.php">Register</a></li>';	
}

?>

<li class="nav-item"><a class="nav-link" href='#'>About us</a></li>
<li class="nav-item"><a class="nav-link" href='#'>Contact</a></li>
</ul>
</div>
 

<span><?php cart_quan() ?> </span>
<span><?php cart_price() ?></span>
<?php if(isset($_SESSION['useremail'])){
echo'<p>Welcome '.$_SESSION['username'].'</p>';
 
echo'<button class="button1"><a href="logout.php">logout</a></button>';
}
else{
echo'<button class="button1"><a href="login.php">login</a></button>';	
}
?>
<button class="button1"><a href="cart.php">Cart</a></button>
</nav>
</div>
</header>
<main>
<div class="container-side">
<div class="nav_left">

<ul>
<li><a href='profile.php'>Your Profile</a></li> 
<li><a href='profile.php?orderdetails'> My orders</a></li>
<li><a href='profile.php?editaccount'>Edit Account</a></li>  
<li><a href='profile.php?deleteaccount'>Delete Account</a></li> 
<li><a href='logout.php'>Logout</a></li> 
<li><a href='profile.php'>About us</a></li> 
</ul>

</div>
<div class='side'> 
<?php
if(isset($_SESSION['useremail'])) {
	$useremail=$_SESSION['useremail'];
 $query_user="select * from `user` where `email`='$useremail'"; 
     $querys_user=mysqli_query($conn, $query_user);
	 $rowp=mysqli_fetch_array( $querys_user, MYSQLI_ASSOC);
	 $id=$rowp['id'];

$query="select * from order_table where userid='$id'"; 

$querys=mysqli_query($conn, $query);
$product_count=mysqli_num_rows($querys);
if(!isset($_GET['editaccount'])) {
	if(!isset($_GET['deleteaccount'])) { 
		if(!isset($_GET['orderdetails'])) {
             if($product_count>0) {
		
	
echo "<p>You have ".$product_count." pending order</p>";
echo "<a  href=' profile.php?orderdetails'> Orders details</a>";  

}
        else {
	echo  "<p>You have 0 pending order</p>";
	echo "<a  href='front.php'> Explore products</a>";
}
}
} 
}
}

if(isset($_GET['orderdetails'])) {
include('vieworder.php');
}
 if(isset($_GET['editaccount'])) {
include('editprofile.php'); 
}
if(isset($_GET['deleteaccount'])) {
include('deleteaccount.php');	
}
?>
</div>
</div>
<div class="footer">
<p>Copyright 2022</p>
</div>
</div>
</main>
</body>
</html>

