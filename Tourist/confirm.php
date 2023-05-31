<?php
@session_start();
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

include('functions.php');
if(isset($_GET['orderid'])) { 
	$oid=$_GET['orderid'];
	$query="select * from `order_table` where `orderid`='$oid' "; 

$querys=mysqli_query($conn, $query);
$row=mysqli_fetch_array($querys, MYSQLI_ASSOC);
$vouchernumber=$row['vouchernumber'];
$totalprice=$row['totalprice'];	

//include('functions.php'); 

}

if(isset($_POST['submit'])) {
		
$voucherno=$_POST['vouchernumber'];
$amount=$_POST['totalprice'];
$pay_method=$_POST['payment_method'];
$voucherno=stripslashes($voucherno);
$voucherno=mysqli_real_escape_string($conn, $voucherno);
$amount=stripslashes($amount);
$amount=mysqli_real_escape_string($conn, $amount);

$query_pay="insert into `payment` (`order_id`, `amount`, `payment_method`, `vouchernumber`) values($oid, $amount, '$pay_method', $voucherno)";
$querysp=mysqli_query($conn, $query_pay);

	if($querysp){
     $query_update="update `order_table` set `payment_status`='Paid', `order_status`='Pending' where `orderid`='$oid'";
	 $querysu=mysqli_query($conn, $query_update);
	
	  header('location:profile.php?orderdetails'); }
	

}
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
<div class='container  padding-block-900'> 

<div class="form-details">
<table>
<tr><td>
<form action=" " method="POST" enctype="multipart/form-data" autocomplete="off">
<table cellspacing=15>
<tr>
<td><label>Voucher number</label></td>  
<td>
<input type="text" name="vouchernumber" value="<?php echo $vouchernumber ;?>">
</td></tr>
<tr>
<td><label>Amount due</label></td>
<td>
<input type="text" name="totalprice" value="<?php echo $totalprice ;?>">
<br><br></td></tr>
<tr>
<td><label>Select payment method</label></td>
<td>
<select name="payment_method">
<option>Net Banking</option>
<option>UPI</option>
<option>Cash on Delivery</option>
<option>Paypal</option></select>
<br><br></td></tr>
<tr>
<td><label></label></td>
<td><button type="submit" name="submit"  class="btn btn-inverted">Pay</button></td> 
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>
</div>
</div>
</main>
<?php
 include("footer.php") ;  
 ?>  
   <script src="main.js"></script> 
</body>
</html>
