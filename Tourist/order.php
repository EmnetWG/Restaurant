<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
include('functions.php');
if(isset($_GET['userid'])) {
$userid=$_GET['userid'];
$total=0;	
$ip=getIPAddress();
$query="select * from cart where ipaddress='$ip'";
		$querys=mysqli_query($conn, $query);
        $cart_items=mysqli_num_rows($querys);

$totalnumber=$cart_items; 
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
$status='pending';
$vouchernumber=mt_rand();

$query2=" insert into `order_table` (`userid`, `totalnumber`, `totalprice`, `vouchernumber`, `date`, `status`)
values($userid, $totalnumber, $totalprice, $vouchernumber, now(), '$status')";

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
values($userid, $id, $vouchernumber, '$status', $quantity)";
$queryso=mysqli_query($conn, $queryo);
}

 
echo "<script>window.open('profile.php', '_self')</script>"; 
 $dquery="delete from cart where ipaddress='$ip'"; 
					  $queryr=mysqli_query($conn, $dquery);

}
}


?>