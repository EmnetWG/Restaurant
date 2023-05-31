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
  
     .col-5  {
    flex-basis: 15%;
  }
  .col-2,.col-1{
    flex-basis: 5%;
  }
  .col-7, .col-3, .col-4, .col-6{
    flex-basis: 20%;
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

	
 $query_u="select * from `payment`"; 
     $querys_u=mysqli_query($conn, $query_u);
	 $payment_count=mysqli_num_rows($querys_u);
     if($payment_count>0)
     {  
        echo ' 
<ul class="responsive-table">
    <li class="table-header">
      
      <div class="col col-1">PId</div>
      <div class="col col-2">Order Id</div>
      <div class="col col-3">Voucher Number</div>
      <div class="col col-4">Payment Method</div>
      <div class="col col-5">Amount</div>
      <div class="col col-6">Date</div>
      
      
      <div class="col col-7">Action</div>
      
    </li>';

$number=1;
while($row=mysqli_fetch_array($querys_u, MYSQLI_ASSOC)){
    $voucherno=$row['vouchernumber'];
    $amount=$row['amount'];
    $pay_method=$row['payment_method'];
    $orderid=$row['order_id']	;
$date=$row['date'];
$pid=$row["pid"];
	

echo'
			<li class="table-row">
			
            <div class="col col-1" data-label="PId">'.$pid.'</div>
			<div class="col col-2" data-label="Order Id">'.$orderid.'</div>
            <div class="col col-3" data-label="Voucher Number">'.$voucherno.'</div>
            <div class="col col-4" data-label="Payment Method">'.$pay_method.'</div>
			<div class="col col-5" data-label="Amount">'.$amount.'</div>
            <div class="col col-6" data-label="Date">'.$date.'</div>
            
            <div class="col col-7" data-label="Action">
            <a class="text-accent-400" href="listpayment.php?id='.$pid.' ">Update</a>
            <a class="text-primary-400" href="listpayment.php?id='.$pid.' ">Delete</a></div></li>
           '
            
            ;    


}

++$number;
				
			

echo '</ul></div>';
}

else{
    $payment_list="You have no payment listed yet";	
    echo $payment_list;
    }


   

?>


