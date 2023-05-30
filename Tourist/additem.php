<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
$itemErr = $priceErr = $codeErr = $descriptionErr ="";
if(isset($_POST['add'])) {
	


if(empty($_POST['catagory'])){
	 $itemErr = "Item is required";	
	}
	else{
		$catagory=$_POST['catagory'];
	}

	if(empty($_POST['item'])){
	 $itemErr = "Item is required";	
	}
	else{
		$item=$_POST['item'];
	}
	if(empty($_POST['price'])){
		 $priceErr = "price is required";
	}
	else{
		$price=$_POST['price'];
	}

if(empty($_POST['description'])){
	
	 $descriptionErr = "description is required";
}
else {
	$description=$_POST['description'];
	
}
	if(!isset($_FILES['uploadf']))
{
echo 'Please select an image.';
}
	$target_dir="uploads/";
$img=$_FILES['uploadf']['name'];

$target_file=$target_dir.basename($_FILES['uploadf']['name']);


	
	$catagory=stripslashes($catagory);
	$item=stripslashes($item);
	$description=stripslashes($description);
	//$code=stripslashes($code);
	$price=stripslashes($price);
	$catagory=mysqli_real_escape_string($conn, $catagory);
	$item=mysqli_real_escape_string($conn, $item);
	$description=mysqli_real_escape_string($conn, $description);
	//$code=mysqli_real_escape_string($conn, $code);
	$price=mysqli_real_escape_string($conn, $price);
	$query="insert into food(date, item, description, price, catagory, image) 
	values(now(), '$item', '$description', '$price', '$catagory', '".$img."')";
	
	
$querys=mysqli_query($conn, $query);
	move_uploaded_file($_FILES['uploadf']['tmp_name'], $target_file);
	//echo "Data inserted";
	if($querys){
	header('location:admin.php');}
	mysqli_close($conn);
}
?>
<style>



        
	</style>
<div  class="form-details">

<table>
<tr><td>
<form action=" " method="POST" enctype="multipart/form-data">
<table >
<tr>
<td ><label>Food Items</label><br><br></td></tr>
<tr>
<td><label>Food Catagory</label></td>
<td>
<select name="catagory">
<option value="food">Food</option>
<option value="drink">Drink</option>
<option value="dessert">Dessert</option>
</select>

<span class="error">* <?php echo $itemErr;?></span>
<br><br></td></tr>

<tr>
<td><label>Food Item</label></td>
<td>
<input type="text" name="item"><span class="error">* <?php echo $itemErr;?></span>
<br><br></td></tr>

<tr>
<td><label>Description</label></td>
<td>
<input type="text" name="description"><span class="error">* <?php echo $descriptionErr;?></span>
<br><br></td></tr>

<tr>
<td><label>Image</label></td>
<td>
<input type="file" name="uploadf">
<br><br></td></tr>

<tr>
<td><label>Price</label></td>
<td>
<input type="text" name="price"><span class="error">* <?php echo $priceErr;?></span>
<br><br></td></tr>

<tr>
<td><label></label></td>
<td><button type="submit" name="add"  class="btn" >Add</button></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>
