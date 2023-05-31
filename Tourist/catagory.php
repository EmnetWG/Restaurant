
<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
$itemErr ="";
if(isset($_POST['add'])) {
	


if(empty($_POST['catagory'])){
	 $itemErr = "Item is required";	
	}
	else{
		$catagory=$_POST['catagory'];
	}
	$catagory=stripslashes($catagory);
	
	$catagory=mysqli_real_escape_string($conn, $catagory);
	$queryc="insert into `catagory`(`type`) 
	values( '$catagory')";
	
	
$querys=mysqli_query($conn, $queryc);
if($querys){
	header('location:admin.php');}
	mysqli_close($conn);
}
?>
<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

if(isset($_GET['deleteid'])) {
$id=$_GET['deleteid'];	
$queryd="delete from `catagory` where `idcatagory`=$id";
$querys=mysqli_query($conn, $queryd);

if($querys){
	header('location:admin.php');}
	mysqli_close($conn);
}
?>
<style>

.container-catagory{
	display: flex;
	
	align-items: center;
	justify-content: space-around;
}
.cart-details th{
	
	background-color:#f2f2f2;
	padding:1rem;
	
}

    
.cart-details tr{
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
   
   .cart-details th {
      display: none;
    }
    
    .cart-details tr {
      display: block;
    }
    .cart-details td {
      
      display: flex;
      flex-basis: 100%;
      padding: 10px 0;
    }
     .cart-details td:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
	  .container-catagory{
		flex-direction: column;
	  }
      
    }
  

</style>
<div class="container-catagory padding-block-900">
<div  class="form-details" style="padding-left: 0;">

<table>
<tr><td>
<form action=" " method="POST" enctype="multipart/form-data">
<table >
<tr>
<td ><label>Add Catagory</label><br><br></td></tr>
<tr>
<td>
<input type="text" name="catagory"><span class="error">* <?php echo $itemErr;?></span>
<br><br></td></tr>
<tr>

<td><button type="submit" name="add"  class="btn" >Add</button></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>

<?php
$query="select * from `catagory` ";
   	
  
	$querys=mysqli_query($conn, $query);
$product_count=mysqli_num_rows($querys);
if($product_count>0)
{
	
echo '<div class="cart-details ">
<table class="text-align-center"><tr><th>Catagory</th><th>Update</th><th>Delete</th></tr>';
while($row=mysqli_fetch_array($querys, MYSQLI_ASSOC)){
	
	$id=$row["idcatagory"];	
            $catagory= $row["type"];   
           
 

            echo'
			<tr>
      <td data-label="Catagory">'.$catagory.'</td>
           
			
            <td data-label="Update">
            
           <a style="color:var(--clr-accent-100); text-decoration:underline; " href="catagory.php?updateid='.$id.'">Update</a></td>
           <td data-label="Delete">
            <a style="color:var(--clr-primary-400);" href="catagory.php?deleteid='.$id.'">Delete</a>
            </td></tr>';
			
 
            
    

		}
		
echo '</table></div></div>';
}

         
else
{
	echo '<div style="margin-bottom:2rem;">';
$product_list="You have no catagory listed  yet";
echo'<p class="text-neutral-300">'; 
echo $product_list;
echo '</p></div>';
}




?>

        