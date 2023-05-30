<?php
session_start();
include('functions.php');
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css" />
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <title>Cart</title>
    <style>


th{
	
	background-color:#f2f2f2;
	padding:1rem;
	
}

    
tr{
  border-radius: 3px;
    padding: 15px 20px;
  box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  margin-bottom: 1.5rem;
}


.inputQty{
	width:50px;
}
.shopping button{
    margin-right:2rem;
    margin-bottom: 2rem;
}

@media all and (max-width: 767px) {
    .shopping{
        padding-left: 2rem;
    }
    .cart-details{
        margin: auto;
      }
    th {
      display: none;
    }
    
    tr {
      display: block;
    }
    td {
      
      display: flex;
      flex-basis: 100%;
      padding: 10px 0;
    }
      td:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
      
    }
  

</style>

</head>
<body>
<?php
include("header.php");
?>
    <main>
        <section class="padding-block-900">
    



<?php
echo'<div class="container">';
$product_list="";
$ips=getIPAddress(); 

		
$query="select * from cart where ipaddress='$ips'";

$querys=mysqli_query($conn, $query);
$product_count=mysqli_num_rows($querys);
if($product_count>0)
{
	
echo ' 
<table class="cart-details text-align-center"><tr><th>Image</th><th>Name</th><th>Description</th><th>Price</th><th>Remove</th><th>Quantity</th><th>Action</th></tr>';
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
			<tr><td data-label="Image"><img src="'.$pros.'" width="50" height="50"></td> 
            <td data-label="Name">'.$name.'</td>
			<td data-label="Description">'.$description.'</td>
            <td data-label="Price">'.$price.'</td>
			
			<form action=" " method="POST">
			<td data-label="Remove"><input type="checkbox" name="removevalue[]" value='.$id.'></td>
			<input type="hidden" name="update_id" value='.$id.' />
			<td data-label="Quantity"><input class="inputQty" type="text" name="qty" value='.$quantity.' /></td>
            <td data-label="Action"><input type="submit" name="update_cart" value="update" class="btn btn-inverted">';
 
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
	
               
				<td><input type="submit" name="remove_cart" value="remove" class="btn btn-inverted"></td></form></tr> ';
				
				
			    echo $itemr=remove_cart_item();

		}
		

echo '</table><h4 class="text-align-center">Total price: $';
cart_price();

echo'</h4><div class="shopping padding-block-700" >
<button type="button" class="btn" ><a href="cart.php?delete_all" onclick="Confirmation ()">Delete all</a></button>';

echo '<script type="text/javascript">function Confirmation(){return confirm("Are you sure you want to delete all ?");} </script>';

}

         
else
{
	echo '<div style="margin-bottom:2rem;">';
$product_list="You have no products listed in your cart yet";
echo'<p class="text-neutral-300">'; 
echo $product_list;
echo '</p></div><div class="shopping padding-block-700" >';
}

echo '<button type="button" class="btn"><a href="front.php">Continue Shopping</a></button>
<button type="button" class="btn btn-inverted"><a href="checkout.php" style="color:var(--clr-primary-400);">Checkout</a></button>
</div>
</div>'

?>


        </section>
</main>

<?php
include("footer.php");
    ?>
    
   
   <script src="/main.js"></script> 
</body>
</html>
