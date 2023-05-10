<?php

@session_start();
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

include('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title> Cart</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
<html>
<head>

<style>
body{
margin:0;
padding:0;

}




.btn{
color:orange;	
}
 .btn a{
color:orange;
text-decoration:none;	
}



a, .nav-link {

color:orange;
text-decoration:none;
}

.tableContainer{
	width:50%;
	margin:auto;
	margin-top:5rem;
}
th{
	
	background-color:#f2f2f2;
	padding:10px;
	
}
td{
padding:10px;	
}
.inputQty{
	width:50px;
}
</style>
</head>
<body>
<header>
<div >

<!--<h2><?php cart_quan(); ?></h2>-->



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

<span class="navbar-text" ><?php cart_quan() ?></span>
<span class="navbar-text"><?php cart_price() ?></span>
<?php if(isset($_SESSION['useremail'])){
//echo'<span class="navbar-text">Welcome '.$_SESSION['username'].'</span>';
 
echo'<button type="button" class="btn btn-light" ><a href="logout.php">logout</a></button>';
}
else{
echo'<button type="button" class="btn btn-light"><a href="login.php">login</a></button>';	
}
?>

<button type="button" class="btn">search</button>

</nav>
</div>
</header>
<main>

<div>
<?php

$product_list="";
$ips=getIPAddress(); 

		
$query="select * from cart where ipaddress='$ips'";

$querys=mysqli_query($conn, $query);
$product_count=mysqli_num_rows($querys);
if($product_count>0)
{
	
echo ' 
<div class="tableContainer"><table ><tr><th>Image</th><th>Name</th><th>Description</th><th>Price</th><th>Remove</th><th>Quantity</th><th>Action</th></tr>';
while($row=mysqli_fetch_array($querys, MYSQLI_ASSOC)){
	
$id=$row["idfood"];
$quantity=$row["quantity"];
 
$query_food="select * from food where idfood=$id";
            $queryf=mysqli_query($conn, $query_food);
           $rowp=mysqli_fetch_array($queryf, MYSQLI_ASSOC);
		
			$price=$rowp["price"]*$quantity;
			//$id=$rowp["idfood"];
            $description=$rowp["description"];
            $name= $rowp["item"];   
            $productImage=$rowp["image"];
            $pros="uploads/".$productImage;
 

            echo'
			<tr><td><img src="'.$pros.'" width="50" height="50"></td> 
            <td>'.$name.'</td>
			<td>'.$description.'</td>
            <td>'.$price.'</td>
			
			<form action=" " method="POST">
			<td><input type="checkbox" name="removevalue[]" value='.$id.'></td>
			<input type="hidden" name="update_id" value='.$id.' />
			<td><input class="inputQty" type="text" name="qty" value='.$quantity.' /></td>
            <td><input type="submit" name="update_cart" value="update">';
 
			if (isset($_POST["update_cart"])){
				
	            $quantity=$_POST['qty'];
				$update_value=$_POST["update_id"];
				$quantity=stripslashes($quantity);
	            $quantity=mysqli_real_escape_string($conn, $quantity);
	            $queryp="update cart set  
	            quantity=$quantity where idfood=$update_value";
	
			    $queryt=mysqli_query($conn, $queryp); 
				
				if($queryt){
	            header('location:cart.php');}
				
 } 
 
            
           
			 
	            

		echo'		 
	
               
				<td><input type="submit" name="remove_cart" value="remove"></td></form></tr> ';
				
				
			    echo $itemr=remove_cart_item();

		}
		

echo '</table><h4>Total price:';
cart_price();
echo'</h4>
<button type="button" class="btn" ><a href="cart.php?delete_all" onclick="Confirmation ()">Delete all</a></button>';

echo '<script type="text/javascript">function Confirmation(){return confirm("Are you sure you want to delete all ?");} </script>';
}
         
else
{
	echo '<div>';
$product_list="You have no products listed in your cart yet";
echo $product_list;	
echo '</div>';
}

?>

<button type="button" class="btn"><a href="front.php">Continue Shopping</a></button>
<button type="button" class="btn"><a href="checkout.php">Checkout</a></button>

</div>
</div>
</main>
</body>
</html>