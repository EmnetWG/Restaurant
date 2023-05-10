<?php
@session_start();
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
if(isset($_SESSION['useremail'])) {
	$useremail=$_SESSION['useremail'];
 $query="select * from `user` where `email`='$useremail'";
     $querys=mysqli_query($conn, $query);
	 $rowp=mysqli_fetch_array( $querys, MYSQLI_ASSOC);
	 $id=$rowp['id'];
}
?>
<html>
<head>
<title>Payment</title>
</head>
<body>
<h1>Payment options</h1> 
<a href='https://www.paypal.com'><img src='images/pay.jpj'></a>  
<a href='order.php?userid=<?php echo $id; ?>'>Pay offline</a>
</body>
</html>