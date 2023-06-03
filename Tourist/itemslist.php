<?php
include("session.php");
?>
<style>


th{
	
	background-color:#f2f2f2;
	padding:1rem;
	
}

tr{
  box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  margin-bottom: 1.5rem;
  border-radius: 3px;
    padding: 15px 20px;
}




@media all and (max-width: 50em) {
    
    .cart-details{
        margin: auto;
      }
    th {
      display: none;
    }
    tr:first-of-type{
      display: none;
    }
    
    tr {
      display: block;
      
    }
    td {
      
      display: flex;
      flex-basis: 100%;
      padding: 1rem 0;
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

<?php



$product_list="";

if(isset($_GET['food'])) {
  $query="select * from food where catagory='food' ";
  
  }
   elseif(isset($_GET['drink'])) {
    $query="select * from food where catagory='drink' ";
     
  }
  elseif(isset($_GET['dessert'])) {
    $query="select * from food where catagory='dessert' ";
    
  }
  elseif(isset($_GET['catagory'])) {
    $query="select * from food";
    
  }
  else {
    $query="select * from food ";
   	
  }
	$querys=mysqli_query($conn, $query);
$product_count=mysqli_num_rows($querys);
if($product_count>0)
{
	
echo ' 
<table class="cart-details text-align-center"><tr><th>Image</th><th>Name</th><th>Description</th><th>Catagory</th><th>Price</th><th>Update</th><th>Delete</th></tr>';
while($row=mysqli_fetch_array($querys, MYSQLI_ASSOC)){
	
$id=$row["idfood"];
//$quantity=$row["quantity"];
 
//$query_food="select * from food";
           // $queryf=mysqli_query($conn, $query_food);
           //$rowp=mysqli_fetch_array($queryf, MYSQLI_ASSOC);
		
			$price=$row["price"];
			//$id=$rowp["idfood"];
            $description=$row["description"];
            $name= $row["item"]; 
            $catagory= $row["catagory"];   
            $productImage=$row["image"];
            $pros="uploads/".$productImage;
 

            echo'
			<tr><td data-label="Image"><img src="'.$pros.'" width="50" height="50"></td> 
            <td data-label="Name">'.$name.'</td>
			<td data-label="Description">'.$description.'</td>
      <td data-label="Catagory">'.$catagory.'</td>
            <td data-label="Price">'.$price.'</td>
			
			
			
            <td data-label="Update">
            
           <a style="color:var(--clr-accent-100); text-decoration:underline; " href="edititem.php?updateid='.$id.'">Update</a></td>
           <td data-label="Delete">
            <a style="color:var(--clr-primary-400);" href="delete.php?deleteid='.$id.'">Delete</a>
            </td></tr>';
			
 
            
    

		}
		
echo '</table>';
}

         
else
{
	echo '<div style="margin-bottom:2rem;">';
$product_list="You have no products listed  yet";
echo'<p class="text-neutral-300">'; 
echo $product_list;
echo '</p></div>';
}




?>

        
