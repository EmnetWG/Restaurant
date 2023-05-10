<?php
session_start();
include('functions.php');
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
?>
<html>
<head>
<title>Front</title>
<style>

body{
margin:0;
padding:0;
background-color:black;
color:pink;
}
.nav {
display:flex;
justify-content:space-between;

}
.nav a {
text-decoration:none;
color:red;
}
ul {

list-style-type:none;
}
li {
float:left;
padding:10px;
}
.button1{
	padding:10px;
	height:30px;
	margin-right:10px;
	
}

</style>
</head>
<body>
<header>
<div class="nav">
<h1 class="port">Portfolio</h1>
<ul>
<li><a href='#'>Home</a></li>
<li><a href='#'>About us</a></li>
<?php if(isset($_SESSION['useremail'])) {
echo '<li><a href="profile.php">My account</a></li>';

}
else
{
echo '<li><a href="signup.php.php">Register</a></li>';	
}

?>

<li><a href='#'>About us</a></li>
<li><a href='#'>Contact</a></li>
</ul>
<h1><?php cart_quan() ?></h1>
<h1><?php cart_price() ?></h1>
<?php if(isset($_SESSION['useremail'])){
echo'<p>Welcome '.$_SESSION['username'].'</p>';
 
echo'<button class="button1"><a href="logout.php">logout</a></button>';
}
else{
echo'<button class="button1"><a href="login.php">login</a></button>';	
}
?>
<button class="button1"><a href="cart.php">Cart</a></button>
</div>
</header>
<main>
<div>
<button class='button1'><a href="additem.php">Add Items</a></button>
</div>
<h1>Products</h1>

<?php 

include("itemslist.php");
//echo $product_list;	

cart();



?>

</main>
</body>
</html>