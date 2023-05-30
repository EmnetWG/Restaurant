<?php

$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
?>

<style>
    .list_card{
    display: flex;
     flex-direction:column;
  }
    .team{
  display: flex;
  gap:3rem;
  justify-content: center;
  
  flex-wrap: wrap;

    }
    .team-img {
  width:250px;
  height: 250px;
  object-fit: cover;
 
  margin-bottom: 1.5rem;
 
}
.border-card{
 max-width: 250px;
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25);
  
}


@media (max-width: 60em) {
  
  .team{
    
    margin-left: 1rem;
  margin-right: 1rem;
   
  }
  
}
    </style>
    <div class="list_card">
    <div class='padding-block-700' >
<form action= '' method='GET' style="float:right;">
    
    <input type='text' name='search_data'  />
<button type='submit' name='search'  class='btn btn-inverted'/>Search</button>
</form>
</div>

<div class="team">

<?php
$product_list="";
if(isset($_GET['Food'])) {
    $query="select * from food where catagory='food' ";
    
    }
     elseif(isset($_GET['Drink'])) {
      $query="select * from food where catagory='drink' ";
       
    }
    elseif(isset($_GET['Dessert'])) {
      $query="select * from food where catagory='dessert' ";
      
    }

    elseif(isset($_GET['search'])){
        $search_data_value=$_GET['search_data'];
        $query="select * from `food` where item like '%$search_data_value%'";
    
    }
        else {
      $query="select * from food ";
         
    }

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
 
echo " 
 
<div class='text-align-center border-card'>
              
              <img src='$pros' class='team-img'/>
              <h5 class='fs-400  text-accent-400'>$name</h5>
              <p class='fs-300'>$description</p>
              <p>$price</p> 
            


<!---<input type='number' name='update_quantity' min='1'  value='1'> --> 
<div><button name='add_cart' type='button' class='btn'   id='card-button'><a href='front.php?cartid=$id'>Add to cart</a></button>

</div>
</div>

";



}
}
else
{
$product_list="You have no products listed in your store yet";	
echo $product_list;
}

?>
</div>
    </div>
