<?php
include('functions.php');
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
	header('location:admin.php');}
	mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Update</title>
	<style>
		
		</style>
</head>
<body>
<header> 
     <div >
      
	 <nav class="primary-navigation">
          <img class="logo" src="images/food.png" style="width: 40px;
        height: 40px; border-radius:50%; display:inline;"/>
        <button id="nav-toggler" class="nav-toggler"></button>
        
         <ul role="list" class="nav-list fs-nav" id="nav-list" >
           <li><a href="admin.php">Home</a></li>
           <li class="drop-btn"><a href="admin.php?catagory" >Catagory</a>
           <div class="catagory-list">
            <a  href='admin.php?food'>Food</a>
            <a href="admin.php?drink">Drink</a>
            <a href="admin.php?desert">Desert</a>
          </div></li>
           <?php if(isset($_SESSION['useremail'])) {
        echo '<li class="nav-item"><a class="nav-link" href="profile.php">My account</a></li>';

}
else
{
echo '<li class="nav-item"><a class="nav-link" href="signup.php.php">Register</a></li>';	
}

?>
           <li class="drop-btn"><a href="admin.php?order" >Orders</a>
           
           <div class="catagory-list">
            <a  href="admin.php?complete">Complete</a>
            <a href="admin.php?incomplete">Incomplete</a>
            
          </div></li>
           <li><a href="admin.php?additem">Add Item</a></li>
		   
		   <li><a href="admin.php?users">Users</a></li>
         </ul>
         <i class="fas fa-shopping-cart"></i><span class="navbar-text" id="cartqty"><?php cart_quan() ?></span> 
<!---<span class="navbar-text"><?php cart_price() ?></span> -->
<?php if(isset($_SESSION['useremail'])){
//echo'<span class="navbar-text">Welcome '.$_SESSION['username'].'</span>';
 
echo'<button type="button" class="btn" ><a href="logout.php">Logout</a></button>';
}
else{
echo'<button type="button" class="btn"><a href="login.php">login</a></button>';	
}
?>

       </nav>
       <?php if(isset($_SESSION['useremail'])){
echo'<span class="navbar-text">Welcome '.$_SESSION['username'].'</span>';
}
?>
     </div>
    </header>
    <main>




<section class="padding-block-900">
	<div class="container">
  <div class="form-details">
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
<td><button type="submit" name="update"  class="btn">Update</button></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
  </div>
</div>
</section>
    </main>
    <?php
include("footer.php");
    ?>
    
    
   
   <script src="/main.js"></script> 
</body>
</html>	

