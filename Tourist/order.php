<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
include('functions.php');
if(isset($_GET['userid']) && isset($_GET['deliveryaddress'])) {
$userid=$_GET['userid'];
$deliveryaddress=$_GET['deliveryaddress'];

$query_uinfo="select * from user where id=$userid";
$querys_info=mysqli_query($conn, $query_uinfo);
       while ($row_user=mysqli_fetch_array($querys_info, MYSQLI_ASSOC)) {
		$first=$row_user['firstname'];
		$last=$row_user['lastname'];
$name=$first." ".$last;
$phone=$row_user['phone'];
       }
$total=0;	
$ip=getIPAddress();
$query="select * from cart where ipaddress='$ip'";
		$querys=mysqli_query($conn, $query);
        $cart_items=mysqli_num_rows($querys);

$totalnumber=$cart_items; 
if($totalnumber>0){
while($row=mysqli_fetch_array($querys, MYSQLI_ASSOC)){
$id=$row["idfood"];
$quantity=$row["quantity"];
$query_food="select * from food where idfood=$id";
		$queryf=mysqli_query($conn, $query_food);
		while($rowp=mysqli_fetch_array($queryf, MYSQLI_ASSOC)){
			$price=array($rowp["price"]*$quantity);
			$price_values=array_sum($price);
			$total+=$price_values;
			
		}
}

$totalprice=$total; 
//$date=now();
$payment_status='Pending';
$order_status='Incomplete';
$vouchernumber=mt_rand();

$query2=" insert into `order_table` (`userid`, `name`, `phone`, `totalnumber`, `totalprice`, `vouchernumber`, `date`, `delivery_address`, `payment_status`, `order_status`)
values($userid, '$name', '$phone', $totalnumber, $totalprice, $vouchernumber, now(), '$deliveryaddress','$payment_status', '$order_status')";

$querys2=mysqli_query($conn, $query2); 

if($querys2) { 
//ho "success";
//echo "You have".$product_count."pending order";   

$query_order="select * from cart where ipaddress='$ip'";
		$querys_order=mysqli_query($conn, $query_order);
        
while($row=mysqli_fetch_array($querys_order, MYSQLI_ASSOC)){
$id=$row["idfood"];
$quantity=$row["quantity"];
$queryo=" insert into `user_order` (`user_id`, `product_id`,  `invoicenumber`, `order_status`, `quantity`)
values($userid, $id, $vouchernumber, '$order_status', $quantity)";
$queryso=mysqli_query($conn, $queryo);
}

 
echo "<script>window.open('profile.php', '_self')</script>"; 
 $dquery="delete from cart where ipaddress='$ip'"; 
					  $queryr=mysqli_query($conn, $dquery);

}



}
else{
	echo "<script>window.open('cart.php', '_self')</script>";
}
}
else{
	echo "<script>window.open('checkout.php', '_self')</script>";
}
?>
