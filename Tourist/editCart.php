<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
$itemErr = $priceErr = $codeErr = $descriptionErr ="";
$id=$_GET['updateid'];
$query="select * from food where idfood=$id";
$querys=mysqli_query($conn, $query);
$row=mysqli_fetch_array($querys);

$name=$row["item"];
$description=$row["description"];
$price=$row["price"];


$img=$row["image"];	



?>

<html>
<head>
<title>update item</title>
<style>
body{
margin:0;
padding:0;
background-color:black;
color:pink;
}

ul {

list-style-type:none;
}
li {
float:left;
}

</style>
</head>
<body>


<div>

<table>
<tr><td>
<form action=" " method="POST" enctype="multipart/form-data">
<table cellspacing=15>
<tr>
<td><label>Food Items</label><br><br></td></tr>
<tr>
<td><label>Food Catagory</label></td>
<td>
<select name="catagory" value="<?php echo $catagory?>">
<option value="food">Food</option>
<option value="drink">Drink</option>
<option value="dessert">Dessert</option>
</select>

<span class="error">* <?php echo $itemErr;?></span>
<br><br></td></tr>

<tr>
<td><label>Food Item</label></td>
<td>
<input type="text" name="item" value="<?php echo $name?>"><span class="error">* <?php echo $itemErr;?></span>
<br><br></td></tr>

<tr>
<td><label>Description</label></td>
<td>
<input type="text" name="description" value="<?php echo $description?>"><span class="error">* <?php echo $descriptionErr;?></span>
<br><br></td></tr>

<tr>
<td><label>Image</label></td>
<td>
<input type="file" name="uploadf" value="<?php echo $img?>">
<br><br></td></tr>

<tr>
<td><label>Price</label></td>
<td>
<input type="text" name="price" value="<?php echo $price?>"><span class="error">* <?php echo $priceErr;?></span>
<br><br></td></tr>

<tr>
<td><label></label></td>
<td><input type="submit" name="update" value="Update"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>

</body>
</html>	

<?php
if(isset($_POST['update'])) {
		

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
	$query="update food set idfood=$id, date=now(),
	item='$item', description='$description', price='$price', catagory='$catagory', image='".$img."' where idfood=$id";
	
	
$querys=mysqli_query($conn, $query);
	move_uploaded_file($_FILES['uploadf']['tmp_name'], $target_file);
	//echo "Data inserted";
	if($querys){
	header('location:foodslist.php');}
	mysqli_close($conn);
}
?>

