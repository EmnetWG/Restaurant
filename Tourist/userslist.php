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
  
   .col-2, .col-3, .col-4, .col-5, .col-6 {
    flex-basis: 12%;
  }
  .col-1{
    flex-basis: 5%;
  }
  .col-7, .col-8{
    flex-basis: 17.5%;
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
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");

	
 $query_u="select * from `user`"; 
     $querys_u=mysqli_query($conn, $query_u);
	 $user_count=mysqli_num_rows($querys_u);
     if($user_count>0)
     {  
        echo ' 
<ul class="responsive-table">
    <li class="table-header">
      
      <div class="col col-1">User Id</div>
      <div class="col col-2">First Name</div>
      <div class="col col-3">Lat Name</div>
      <div class="col col-4">Phone</div>
      <div class="col col-5">City</div>
      <div class="col col-6">Address</div>
      <div class="col col-7">Email</div>
      
      <div class="col col-8">Action</div>
      
    </li>';

$number=1;
while($row=mysqli_fetch_array($querys_u, MYSQLI_ASSOC)){
	
$id=$row["id"];
	 $first=$row['firstname'];
$last=$row['lastname']; 
$phone=$row['phone'];
$city=$row['city'];
$address=$row['address'];
$email=$row['email'];

//$pass=$row['password'];

echo'
			<li class="table-row">
			
            <div class="col col-1" data-label="User Id">'.$id.'</div>
			<div class="col col-2" data-label="First Name">'.$first.'</div>
            <div class="col col-3" data-label="Last Name">'.$last.'</div>
            <div class="col col-4" data-label="Phone Number">'.$phone.'</div>
			<div class="col col-5" data-label="City">'.$city.'</div>
            <div class="col col-6" data-label="Address">'.$address.'</div>
            <div class="col col-7" data-label="Email">'.$email.'</div>
            <div class="col col-8" data-label="Action">
            <a class="text-accent-400" href="updateuser.php?id='.$id.' ">Update</a>
            <a class="text-primary-400" href="deleteuser.php?id='.$id.' ">Delete</a></div></li>
           '
            
            ;    


}

++$number;
				
			

echo '</ul></div>';
}

else{
    $product_list="You have no users listed yet";	
    echo $product_list;
    }


   

?>


