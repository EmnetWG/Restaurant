<header> 
     <div >
      
        <nav class="primary-navigation">
          <img class="logo" src="images/food.png" style="width: 40px;
        height: 40px; border-radius:50%; display:inline;"/>
        <button id="nav-toggler" class="nav-toggler"></button>
        
         <ul role="list" class="nav-list fs-nav" id="nav-list" >
           <li><a href="front.php">Home</a></li>
           <li class="drop-btn"><a href="#" >Catagory</a>
           <div class="catagory-list">
            <?php
            $query_catagory="select * from `catagory`";
            $query_result=mysqli_query($conn, $query_catagory);
             while($row=mysqli_fetch_array($query_result, MYSQLI_ASSOC)){
              $id=$row["idcatagory"];
              $type=$row["type"];
              echo '<a  href="front.php?'.$type.'">'.$type.'</a>';
             }
            ?>
           
          </div>
          </li>
           <?php if(isset($_SESSION['useremail'])) {
        echo '<li class="nav-item"><a class="nav-link" href="profile.php">My account</a></li>';

}
else
{
echo '<li class="nav-item"><a class="nav-link" href="signup.php">Register</a></li>';	
}

?>
           <li><a href="about.php">About</a></li>
           <li><a href="contact.php">Contact</a></li>
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
<button type="button" class="btn"><a href="cart.php">Cart</a></button>
       </nav>
       <?php if(isset($_SESSION['useremail'])){
echo'<span class="navbar-text">Welcome '.$_SESSION['username'].'</span>';
}
?>
     </div>
    </header>