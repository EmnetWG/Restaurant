<?php
session_start();
include('functions.php');
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Profile</title>
    
    <style>

.nav_secondary{
	background-color:grey;
    display:flex;
	
}
.nav_secondary  li {
list-style-type:none;
padding:10px;

}

.nav_secondary ul li a
{
	text-decoration:none;
	color:white;
}


.container-main{
	display:grid;
	gap:1em;
}

@media only screen and (min-width:600px) {

.container-main{

grid-template-columns:1fr;
grid-template-rows:auto auto;

}


}
</style>

</head>
<body>
<?php
include("header.php");
?>
    <main>


<div class="container-main">


<div class="container-side">


<ul class="nav_secondary">
<li><a href='profile.php'>My Profile</a></li> 
<li><a href='profile.php?orderdetails'> My orders</a></li>
<li><a href='profile.php?editaccount'>Edit Account</a></li>  
<li><a href='profile.php?deleteaccount'>Delete Account</a></li> 

 
</ul>

</div>
<div class='container text-align-center padding-block-900'> 
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
		
	
echo "<p style='margin-bottom:2rem;'>You have ".$product_count." pending order</p>";
echo "<a  href=' profile.php?orderdetails'  class='btn btn-inverted'> Orders details</a>";  

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
//include('vieworder.php');
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



</main>
<?php
include("footer.php");
    ?>
    
    
   
    
</body>
<script src='main.js'></script>
</html>

