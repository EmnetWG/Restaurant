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
</head>
<body>
<?php
include("header.php");
?>
    <main>
    <section class="hero">
        <div class="container">
        <h1>Food made with Love</h1>
<button class="btn">Today's menu</button> 
<button class="btn"><a href="signup.php"> Sign up</a></button>
        </div>
    </section>
<section class="padding-block-900">
    <div class="container">
    
          
         <h6 class="text-align-center text-primary-400">Our Menu</h6>
         <div class="flow">
         <h2 class="fs-secondary-heading fw-bold text-align-center">Our Top Rated Dishes</h2>
         <hr class="line">
        </div>
       
        <?php
      include("viewitems.php");
      cart();
        ?>

        
    </div>

</section>
<section class="padding-block-900">
<div class="container">
    <div class="even-columns">
        <div class="flow">
<h1 class="fs-primary-heading fw-bold text-neutral-400">Our Awesome Restaurant</h1>
<p class="text-neutral-300">When, while the lovely valley teems with vapour around me, and the meridian sun 
    strikes the upper surface of the impenetrable foliage of my trees, and but a 
    few stray gleams steal into the inner sanctuary, I throw myself down among the
     tall grass by the trickling stream; and, as I lie close to the earth, a 
     thousand unknown plants are noticed by me.</p>
     <button class="btn">Read More</button>
        </div>
        <div >
           
           <img src="images/about-4.jpg" />
        </div>
    </div>
</div>
</section>
<section class="padding-block-900">
        <div class="container bg-primary-100">
          
        <h6 class="text-align-center text-primary-400">Testimonial</h6>
         <div class="flow">
         <h2 class="fs-secondary-heading fw-bold text-align-center">Our Clients Say</h2>
         <hr class="line">
         </div>
          <div class="even-columns">
         
<div class="testimonial">
    <div class="testimonial-title">
             <img src="images/testimonial-1.jpg" />
             <div>
             <h4 class="fs-700 fw-bold">Name</h4>
             <p class="text-neutral-300">Profession</p>
             </div>
    </div>
    <p class="text-neutral-300">When, while the lovely valley teems with vapour around me, and the meridian sun 
    strikes the upper surface of the impenetrable foliage of my trees, and but a 
    few stray gleams steal into the inner sanctuary</p>

            </div>
            <div class="testimonial">
            <div class="testimonial-title">
             <img src="images/testimonial-2.jpg" />
             <div>
             <h4 class="fs-700 fw-bold">Name</h4>
             <p class="text-neutral-300">Profession</p>
             </div>
            </div>
            <p class="text-neutral-300">When, while the lovely valley teems with vapour around me, and the meridian sun 
    strikes the upper surface of the impenetrable foliage of my trees, and but a 
    few stray gleams steal into the inner sanctuary</p>

            </div>
            <div class="testimonial">
            <div class="testimonial-title">
             <img src="images/testimonial-4.jpg" />
             <div >
             <h4 class="fs-700 fw-bold">Name</h4>
             <p class="text-neutral-300">Profession</p>
             </div>
            </div>
            <p class="text-neutral-300">When, while the lovely valley teems with vapour around me, and the meridian sun 
    strikes the upper surface of the impenetrable foliage of my trees, and but a 
    few stray gleams steal into the inner sanctuary</p>

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
