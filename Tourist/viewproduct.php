<?php

if(!isset($_GET['brandid'])){
	if(!isset($_GET['brandid'])){
$query="select * from `products` order by rand() LIMIT 0,9";
	}
}
//number of sold
$query="select * from `user_order` where product_id='$productid'";
$querys=mysqli_query($conn, $query);
$row_count=mysqli_num_rows($querys);

// brand
$query="select * from brand";
$querys=mysqli_query($conn, $query);
while($result=mysqli_fetch_assoc($querys)){
$brandid=$result['brandid'];
$brandtitle=$result['brandtitle'];

echo '<li><a href="index.php?brandid='. $brandid.'"><'. $brandtitle.'</a></li>';
}
//Display by brand

if(isset($_GET['brandid'])){
$id=$_GET['brandid'];
$query="select * from `product` where brandid='$brandid'";	

$query="select * from `product` where brandtitle='$brandtitle'";
$querys=mysqli_query($conn, $query);	
}

//list catagories
echo '<select name="product_catagory">';

while($row=mysqli_fetch_assoc($result)){
$catagory_title=$row['catagory_title'];
$catagory_id=$row['catagory_id'];
echo '<option value="$catagory_id">$catagory_title</option>';	
}

//search
if(isset($_GET['search_data_product'])){
	$search_data_value=$_GET['search_data'];
	$query="select * from `products` where product_keyword like '%$search_data_value%'";

?>
<style>
.nav {
display:flex;
justify-content:space-between;

}
ul {

list-style-type:none;
}
li {
float:left;
padding:10px;
}
.nav {
display:flex;
justify-content:space-between;

}
</style>

