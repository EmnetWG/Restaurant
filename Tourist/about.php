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
    <title>Document</title>
    <style>
.line-about{
    background-color:var(--clr-primary-400);
          border: none;
          margin-left:1rem; 
          width:4em; 
          height:2px; 
          margin-bottom:1.5rem;
}
.about-title{
    display:flex; 
   
    align-items:baseline;
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
    <div class="even-columns">
    <div >
           
           <img src="images/about-4.jpg" />
        </div>
        <div>
            <div class="about-title" >
          <h6 class=" text-primary-400" >About us</h6>
          <hr class="line-about" >
</div>
           <div class="flow">
           <h2 class="fs-secondary-heading fw-bold ">Welcome to Our Restaurant</h2>
           
           

<p class="text-neutral-300">When, while the lovely valley teems with vapour around me, and the meridian sun 
    strikes the upper surface of the impenetrable foliage of my trees, and but a 
    few stray gleams steal into the inner sanctuary, I throw myself down among the
     tall grass by the trickling stream; and, as I lie close to the earth, a 
     thousand unknown plants are noticed by me.</p>
     <button class="btn">Read More</button>
        </div>
        </div>
        
    </div>
</div>
</section>
</main>
    <?php
include("footer.php");
    ?>
   
   <script src="main.js"></script> 
</body>
</html>
