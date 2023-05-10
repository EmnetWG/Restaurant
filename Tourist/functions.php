
<?php
function getIPAddress(){
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		
	}
	else {
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

//echo $ip;
function cart(){
	global $conn;
	if(isset($_GET['cartid'])) {
		$ip=getIPAddress();
		$id=$_GET['cartid'];
		$query="select * from cart where idfood=$id AND ipaddress='$ip'";
		$querys=mysqli_query($conn, $query);
$cart_count=mysqli_num_rows($querys);
if($cart_count>0){
	echo"<script>alert('The item is already present inside cart')</script>";
	echo "<script>window.open('front.php', '_self')</script>";
}
else {
	$query="insert into `cart`(idfood, ipaddress, quantity) 
	values($id, '$ip', 1)";

$querys=mysqli_query($conn, $query);
echo"<script>alert('The item is inserted inside cart')</script>";
	echo "<script>window.open('front.php', '_self')</script>";
	
}
	
}
}

function cart_quan(){
global $conn;
	if(isset($_GET['cartid'])) {
		$ip=getIPAddress();
		
		$query="select * from cart where ipaddress='$ip'";
		$querys=mysqli_query($conn, $query);
        $cart_items=mysqli_num_rows($querys);
	}
    else {

	
		$ip=getIPAddress();
		
		$query="select * from cart where ipaddress='$ip'";
		$querys=mysqli_query($conn, $query);
        $cart_items=mysqli_num_rows($querys);	
	
}
echo $cart_items;	
}

function cart_price (){
global $conn;
$total=0;	
		$ip=getIPAddress();
		
		$query="select * from cart where ipaddress='$ip'";
		$querys=mysqli_query($conn, $query);
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
echo $total;
}

function remove_cart_item(){
	global $conn;
					if(isset($_POST['remove_cart'])){
					 foreach($_POST['removevalue'] as $removeid)	{
						 //$extract_id=implode(',', $_POST['removevalue']);
						 //echo $extract_id;
						echo $removeid;
					  $dquery="delete from cart where idfood=$removeid";
					  $queryr=mysqli_query($conn, $dquery); 
					 
					  if($queryr){
						echo "<script>window.open('cart.php', '_self')</script>";
					}
					
					 }
                    }
					
					}
				

?>