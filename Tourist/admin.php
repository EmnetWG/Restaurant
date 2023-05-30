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
    <title>Dashboard</title>
    <style>
        
	@media  (min-width: 50em) {

.info-card{
  padding-left: 12%;
}

        }
        .info-card{
          display: flex;
          gap:2rem;
          align-items: center;
          
         
          
        }
        .info-details{
          box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25);
          padding: 1rem;
          width: 200px;
          height: 150px;
        }
        .card-top{
          display: flex;
          justify-content: space-between;
          margin-bottom: 4rem;
        }
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
        echo '<li class="nav-item"><a class="nav-link" href="admin.php">My account</a></li>';

}
else
{
echo '<li class="nav-item"><a class="nav-link" href="adminsignup.php.php">Register</a></li>';	
}

?>
           <li class="drop-btn"><a href="admin.php?order" >Orders</a>
           
           <div class="catagory-list">
            <a href="admin.php?pending">Pending</a>
            <a href="admin.php?complete">Complete</a>
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
      <section class="padding-block-400">

      
<div class="container info-card">

<div class="info-details">
<div class="card-top ">
             
             <h4 class="fs-700 fw-bold"><?php incomplete_order();?></h4>
             <img src="images/gift-icon.svg" style="width: 24px;
             height: 24px;"/>
             </div>
             <h4 class="fs-500 fw-bold">Incomplete Order</h4>

            </div>


<div class="info-details">
<div class="card-top">
             
             <h4 class="fs-700 fw-bold"><?php pending_order();?></h4>
             <img src="images/gift-icon.svg" style="width: 24px;
             height: 24px;"/>
             </div>
             <h4 class="fs-500">Pending Order</h4>

            </div>


<div class="info-details">
<div class="card-top">
             
             <h4 class="fs-700 fw-bold"><?php confirmed_order();?></h4>
             <img src="images/gift-icon.svg" style="width: 24px;
             height: 24px;"/>
             </div>
             <h4 class="fs-500 fw-bold">Confirmed Order</h4>

            </div>

</div>
      </section>
    <section class="padding-block-900">
<div class="container">
<?php
if(isset($_GET['order'])||isset($_GET['complete'])||isset($_GET['incomplete'])||isset($_GET['pending']))
{
    include("adminvieworder.php");
}
elseif(isset($_GET['additem'])) {
    
include("additem.php");


}
elseif(isset($_GET['users'])) {
    
include("userslist.php");


}
else {
?>

    

    
   

<h1>Products</h1>

<?php 


include("itemslist.php");
}
	?>
</div>
    </section>


</main>
<?php
include("footer.php");
    ?>
   
 
</body>
<script src="main.js"></script>
</html>
