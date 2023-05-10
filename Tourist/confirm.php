<?php
@session_start();
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

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
     $query_update="update `order_table` set `status`='paid' where `orderid`='$oid'";
	 $querysu=mysqli_query($conn, $query_update);
	
	  header('location:profile.php?orderdetails'); }
	

}
?>
<html>
<head>
<title>Confirm payment</title>
</head>
<body>
<div>

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
<td><input type="submit" name="submit" value="Pay"></td> 
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>
</body>
</html>