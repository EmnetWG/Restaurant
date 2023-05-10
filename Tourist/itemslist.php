<style>
.displayContainer{
	
	
display:flex;
margin:auto;
width:100%;
flex-wrap:wrap;
gap:1rem;

}
.displayList{
	padding:10px ;
	text-align:center;
	width:200px;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);
	
}
.displayList input{
	width:100%;
	
}
.description{
margin-top:0.5rem; 
height:70px;


}
.name{
	margin-top:1rem;
	height:50px;
}
#card-button{ 
	border: none;
  outline: 0;
  
  
 
 
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

@media only screen and (min-width:600px) {

.displayContainer{
	width:75%;
}
}
</style>
<div class="displayContainer">
<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
$product_list="";

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
 

echo "<div class='displayList'>
<img src='$pros' width='160px' height='150px'> 
<div class='name'>
<h4>$name</h4>
</div>
<div class='description'>
<p>$description</p>
</div>
<p>$ $price</p>  
<!---<input type='number' name='update_quantity' min='1'  value='1'> --> 
<div><button name='add_cart' type='button' class='btn bg-light'   id='card-button'><a href='front.php?cartid=$id'>Add to cart</a></button>

</div>

</div> ";



}
}
else
{
$product_list="You have no products listed in your store yet";	
}

?>
</div>