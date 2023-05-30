<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
//include('functions.php');
@session_start();
?>


<style>
    
.responsive-table 
  li {
    border-radius: 3px;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
   
  }
  .table-header {
    background-color: #f2f2f2;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    
  }
  .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
    
  }
  .col-7, .col-8 {
    flex-basis: 20%;
  }
  .col-1{
    flex-basis: 5%; 
  }
  .col-6{
    flex-basis: 15%; 
  }
  .col-2, .col-3, .col-4, .col-5, .col-9,  .col-10 {
    flex-basis: 10%;
  }
  
  .delivery-details{
    display:flex; 
    gap:0.5rem; 
    justify-content:center;
  }
  .form-popup {
      position: fixed;
       display: none; 
      max-width: 300px;
      left: 30%;
      border: 3px solid #f1f1f1;
      top:20%;
      background-color: #f2f2f2;
      transition: 350ms ease-out;
      box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
    }

    
     .form-popup.visiblef{
      display: block;
     }
    
    /* Add styles to the form container */
    .form-container > *{
     padding: 0.5rem;
      margin: 1rem;
     
    }  
    .table-row .user-list{
        display: none;
        box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
      
      
     
      background-color: #ffffff;
    }
    
    .table-row .user-list ul li{
        border-bottom: 1px solid #6C7A89;
       
    }
    .user-list li:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        text-align: right;
       
      }
    .user-list.visible-info{
         
          
         display: block;
          
         
        }
        @media(min-width: 767px){
        .table-row .user-list ul li{
width: 300px;

        }
    }
       

  @media all and (max-width: 767px) {
   .responsive-table .table-header {
      display: none;
    }
    
   .responsive-table  li {
      display: block;
    }
    .col {
     
      flex-basis: 100%;
      
    }
    .col {
      display: flex;
      padding: 10px 0;
    }
      .col:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
      
    }
  
  




</style>


    
<?php
     
     if(isset($_GET['pending'])) {
    $query="select * from order_table where order_status='Pending' ";
    
    }
    
     elseif(isset($_GET['complete'])) {
    $query="select * from order_table where order_status='Confirmed' ";
    
    }
    
    
     elseif(isset($_GET['incomplete'])) {
        $query="select * from order_table where order_status='Incomplete' ";
        
        }

      else{
$query="select * from order_table "; 
}
$querys=mysqli_query($conn, $query);
$product_count=mysqli_num_rows($querys);  
if($product_count>0)
{      //  Confirm
	
echo ' 
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">SNo</div>
      <div class="col col-2">User Id</div>
      <div class="col col-3">Order Id</div>
      <div class="col col-4">Total Number</div>
      <div class="col col-5">Total Price</div>
      <div class="col col-6">Voucher Number</div>
      <div class="col col-7">Date</div>
      <div class="col col-8">Delivery Address</div>
      <div class="col col-9">Payment Status</div>
      <div class="col col-10">Order Status</div>
    </li>';

$number=1;
while($row=mysqli_fetch_array($querys, MYSQLI_ASSOC)){
	
$id=$row["userid"];
//uantity=$row["quantity"];
$orderid=$row['orderid'];
$totalnumber=$row['totalnumber'];
$totalprice=$row['totalprice'];
$date=$row['date'];
$vouchernumber=$row['vouchernumber'];
$deliveryaddress=$row['delivery_address'];
$order_status=$row['order_status'];
$payment_status=$row['payment_status'];


 

            echo'
			<li class="table-row">
			<div class="col col-1" data-label="SNo">'.$number.'</div>
            <div class="col col-2 btn-user" data-label="User Id"><a style="color: var(--clr-primary-400); cursor:pointer;">'.$id.'</a></div>';
          $query_userinfo="select * from `user` where `id`=$id";
          $query_userid=mysqli_query($conn, $query_userinfo); 
          while($row_info=mysqli_fetch_array($query_userid, MYSQLI_ASSOC)){
	
            $email=$row_info["email"];
            $first=$row_info["firstname"];
            $last=$row_info["lastname"];
            $phone=$row_info["phone"];
            $city=$row_info["city"];
            $address=$row_info["address"];
           echo' <div class="user-list">
            <ul>
            <li data-label="Firat Name">'.$first.'</li>
            <li data-label="Last Name">'.$last.'</li>
            <li data-label="Email">'.$email.'</li>
            <li data-label="Phone Number">'. $phone.'</li>
            <li data-label="City">'.$city.'</li>
            <li data-label="Address">'.$address.'</li></ul>
            
          </div>
          ';
             
          }
            echo '
			<div class="col col-3" data-label="Order Id">'.$orderid.'</div>
            <div class="col col-4" data-label="Total Number">'.$totalnumber.'</div>
			<div class="col col-5" data-label="Total Price">'.$totalprice.'</div>
			<div class="col col-6" data-label="Voucher Number">'.$vouchernumber.'</div>
			<div class="col col-7" data-label="Date">'.$date.'</div>
      <div class="col col-8 " data-label="Delivery Address"><div class="delivery-details"><button class="btnform" type="submit"><img src="images/gift-icon.svg" style="width: 16px;
      height: 16px;   "/></button>'.$deliveryaddress.'</div></div>
     
        
			<div class="col col-9" data-label="Payment Status">'.$payment_status.'</div>
            <div class="col col-10" data-label="Order Status">';
			if($order_status=="Pending") {
			 echo'<a class="text-primary-400" href="admin.php?pending&orderid='.$orderid.' ">Confirm</a></div>'; 
             if(isset($_GET['orderid'])){
                $order_idu=$_GET['orderid'];
                $query_orderstatus="update `order_table` set `order_status`='Confirmed'  where `orderid`=$order_idu";
               $query_status=mysqli_query($conn, $query_orderstatus); 
             }
			}
			else{
			echo $order_status.'</div>';	
			
            }
     echo ' <!-- The form -->
      <div class=" form-popup"  >
        <form action=" " class="form-container" method="POST">
          <h1>Delivery Address</h1>
      
          
          <input type="text" placeholder="Enter Delivery Address" name="deliveryAddress" required>
      
         
          <input type="text" name="update_id" value='.$orderid.' >
          <button type="submit" class="btn" name="submit" >Submit</button>';
          if(isset($_POST['submit'])){
            $or_id=$_POST["update_id"];
               $address=$_POST['deliveryAddress'];
               $address=stripslashes($address);
               $address=mysqli_real_escape_string($conn, $address);
               $query_address="update `order_table` set `delivery_address`='$address'  where `orderid`=$or_id";
               $query3=mysqli_query($conn, $query_address); 
               if($query3) {
                echo"<script>alert('The item is updated')</script>";
	echo "<script>window.open('profile.php', '_self')</script>";
              
            
mysqli_close($conn);
          }
          else {
            echo "<script>alert('Not Successful')</script>";
          }
        }
          echo '
          <button type="button" class="btn btn-inverted btnclose">Close</button>
          
        </form>
      
      
        </div>' ;
       
          
          
				++$number;
				
      
           




echo '</li>';
}
echo '</ul>';
}

else {
    echo "You have no product listed yet";
}

?>
 
 <script>

let firstForm=document.querySelectorAll('.form-popup');
let btnForm=document.querySelectorAll('.btnform');
let btnClose=document.querySelectorAll('.btnclose');

for (let i = 0; i < firstForm.length; i++) {
 
btnForm[i].addEventListener('click', () => {
firstForm[i].classList.add('visiblef');



});

}
for (let m = 0; m < firstForm.length; m++) {
 
btnClose[m].addEventListener("click", () => {
  
firstForm[m].classList.remove('visiblef');


});
}
</script>   

<script>
  let btnUser=document.querySelectorAll('.btn-user');
  let userList=document.querySelectorAll('.user-list');
  for (let i = 0; i < btnUser.length; i++) {
 
 btnUser[i].addEventListener('mouseover', () => {
 userList[i].classList.add('visible-info');
 
 
 
 });
}
for (let m = 0; m < btnUser.length; m++) {
 
 btnUser[m].addEventListener('mouseleave', () => {
 userList[m].classList.remove('visible-info');
 
 
 
 });
}
  </script>