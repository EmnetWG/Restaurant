<?php
@session_start();
include("functions.php");
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
if(isset($_SESSION['useremail'])) {
	$useremail=$_SESSION['useremail'];
 $query="select * from `user` where `email`='$useremail'";
     $querys=mysqli_query($conn, $query);
	 $rowp=mysqli_fetch_array( $querys, MYSQLI_ASSOC);
	 $id=$rowp['id'];
   $address=$rowp['address'];

}

   
       

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    
    <title>Payment</title>
   
    <style>
     
     .form-popup {
      
        
        max-width: 300px;
        margin: 4rem;
        border: 3px solid #f1f1f1;
        
       
        transition: 350ms ease-out;
      }

      
       
      
      /* Add styles to the form container */
      .form-container > *{
       padding: 0.5rem;
        margin: 1rem;
       
      } 
      img {
        margin-bottom:2rem; 
        border:1px solid var(--clr-accent-400);
      } 
    </style>
</head>
<body>
<?php
include("header.php");
?>
    <main>

<section class="padding-block-900">
   <div class="container">
    
   
    
   <a href='https://www.paypal.com' ><img  src='images/pay.png' ></a>  
    
  <button type="button" class="btn btn-inverted" ><a style="color:var(--clr-primary-400);" href='order.php?userid=<?php echo $id;  ?>'>Payment Options</a></button>
   </div>
</section>
</main>

 <?php
include("footer.php");
    ?>
    
    <script src="main.js" type="text/javascript"></script>
   

</body>
</html>
