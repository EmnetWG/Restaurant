<?php
session_start();
include('functions.php');
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Front</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>

<style>

body{
margin:0;
padding:0;

}

nav{
	
	background-color:#587498;
}
a, .nav-link {

color:orange;
}
a {
	text-decoration:none;
}

.btn{
	padding:8px;
	height:35px;
	margin-right:15px;
	border-radius:15px;
	padding:5px 16px;
	
}
i {
	color:orange;
	font-size:18px;
}
.footer{
	text-align:center;
	background-color:#587498; 
	margin-bottom:0;
	
	color:white;
}
.footer-contact{
	display:flex;
	justify-content:space-around;
	margin:10%;
}
.intro{
	background:url(images/background.jpg);
	background-size:cover;
	background-repeat:no-repeat;
	display:flex;
	height:90vh;
	align-items:center;
	
}



.hero
{
	
color:white;
margin-left:20%;
width:350px;


}
.hero h1{
	font-size:52px;
	font-weight:700;
	text-transform:capitalize; 
	text-align:center;
}
.but1{
background-color:orange;
text-align:center;
margin-left:3rem;
margin-top:1rem;

color:white;
padding:5px 16px;
border-radius:15px;

border:none;
}
.but2{
background-color:transparent;
//transition:background-color 0.2s, border 0.2s;
margin-left:1rem;
border:1px solid orange;

margin-top:1rem;
text-align:center;
color:white;
padding:5px 16px;
border-radius:15px;

}



#cartqty{
	
	padding-right:1rem;
}
hr{
	color:orange;
}
#btnlist{
float:right;
}

</style>
<script src="https://kit.fontawesome.com/aaa4639025.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
<nav class="navbar navbar-expand-md   navbar-dark fixed-top"> 


<a class="navbar-brand" href="#"><img src="images/food.png" height="40" class="rounded-circle px-2"/></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse"  data-bs-target="#collapsibleNavbar">
<span class="navbar-toggler-icon"></span></button>

<div class="collapse navbar-collapse" id="collapsibleNavbar">
<ul class="navbar-nav" >
<li class="nav-item"><a  class="nav-link" href='#'>Home</a></li>
<li class="nav-item"><a  class="nav-link" href='#'>Catagory</a></li> 
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

<i class="fas fa-shopping-cart"></i><span class="navbar-text" id="cartqty"><?php cart_quan() ?></span> 
<!---<span class="navbar-text"><?php cart_price() ?></span> -->
<?php if(isset($_SESSION['useremail'])){
//echo'<span class="navbar-text">Welcome '.$_SESSION['username'].'</span>';
 
echo'<button type="button" class="btn btn-light" ><a href="logout.php">Logout</a></button>';
}
else{
echo'<button type="button" class="btn btn-light"><a href="login.php">login</a></button>';	
}
?>
<button type="button" class="btn btn-light"><a href="cart.php">Cart</a></button>


</nav>
<?php if(isset($_SESSION['useremail'])){
echo'<span class="navbar-text">Welcome '.$_SESSION['username'].'</span>';
}
?>
</header>

<main>
<div class="intro">
<div class="hero">
<h1>Food made with Love</h1>
<button class="but1">Today's menu</button> 
<button class="but2">Sign up</button> 
</div>
</div>

<!-- <button type="button" class="btn btn-light" id="btnlist"><a href="additem.php">Add Items</a></button>-->
<button type="button" class="btn btn-light" id="btnlist"><a href="additem.php">View all</a></button> 

<div class="row">
<h3>  Recent Recipes</h3>
</div>
<div class="row">
<?php 

include("itemslist.php");
//echo $product_list;	

cart();



?>
</div>
<div class="footer" >
<!----<i class="fas fa-bars"></i> 
<i class="fas fa-user"></i>
<i class="fas fa-address-card"></i> -->
<div class="footer-contact">
<div class="contact"> 
<h3 id="contact">Contact us</h3>
<hr >
<p><i class="fas fa-map-marker"></i>  Addis Ababa, Ethiopia</p>
<p><i class="fas fa-phone"></i> Phone: +251911111111</p>
<p><i class="fas fa-envelope"></i> Email:  cookery@gmail.com</P> 
</div>
<div class="social">
<h3 id="contact">Social</h3> 
<hr >
<i class="fab fa-facebook-square"></i>
<i class="fab fa-twitter-square"></i>
</div>
</div>
<div class="copy"> 
<p>copyright 2022</p>
</div>
</div>

</main>
</body>
</html>