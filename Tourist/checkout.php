<?php
@session_start();
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

//include("functions.php"); 
//<h1><?php cart_quan(); </h1>

?>
<html>
<head>
<title> Check out</title>
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
<li><a href='#'>About us</a></li>
<li><a href='#'>About us</a></li>
<li><a href='#'>About us</a></li>
<li><a href='#'>About us</a></li>
<li><a href='#'>About us</a></li>
<li><a href='#'>About us</a></li>
</ul>


<button class='button1'>search</button>
</div>
</header>
<main>
<?php
if(isset($_SESSION['useremail'])){
	include("payment.php");
}
else
{
	include("login.php");
}

?>
</main>
</body>
</html>