<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

$product_list="";
?> 

<html>
<head>
<title> Portfolio</title>
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
<div>
<button class='button1'><a href="additem.php">Add Items</a></button>
<button class='button1'><a href="dash.php">Home</a></button>

</div>
<h1>Products</h1>
<table cellspacing=30>
<th><td>ID</td><td>Name</td><td>Description</td><td>Price</td><td>Action</td></th>
<?php

$query="select * from food";
$querys=mysqli_query($conn, $query);
$product_count=mysqli_num_rows($querys);
if($product_count>0)
{
while($row=mysqli_fetch_array($querys, MYSQLI_ASSOC)){
$id=$row["idfood"];
$name=$row["item"];
$description=$row["description"];
$price=$row["price"];

$productImage=$row["image"];
$pros="uploads/".$productImage;
echo'<tr><td>'.$id.'</td><td>'.$name.'</td><td>'.$description.'</td>
<td>'.$price.'</td>
<td>
<button class="button1"><a href="update.php?updateid='.$id.'">Update</a></button>
<button class="button1"><a href="delete.php?deleteid='.$id.'">Delete</a></button></td></tr> 

';

}}
else
{
$product_list="You have no products listed in your store yet";
echo $product_list;
	
}


?>
</table>
</main>
</body>
</html>


