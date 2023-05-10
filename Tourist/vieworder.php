<?php
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
//include('functions.php');
@session_start();
?>
<html>
<head>
<title> Order Details</title>

<style>
body{
	margin:0;
	padding:0;
}

.contTab{
	
	
	overflow-x:auto;
	
}

th{
	
	background-color:#f2f2f2;
	padding:10px;
	
	
}
td{
padding:10px;

	
}

}
table{
	table-layout:fixed;
	margin-top:5rem;
	border-collapse:collapse;
	
}
.vart{
	width:200px;
	
}


</style>

</head>
<body>
<?php


if(isset($_SESSION['useremail'])) {
	$useremail=$_SESSION['useremail'];
 $query_user="select * from `user` where `email`='$useremail'";  
     $querys_user=mysqli_query($conn, $query_user);
	 $rowp=mysqli_fetch_array( $querys_user, MYSQLI_ASSOC);
	 $id=$rowp['id'];


$query="select * from order_table where userid='$id' "; 

$querys=mysqli_query($conn, $query);
$product_count=mysqli_num_rows($querys);  
if($product_count>0)
{      //  Confirm
	
echo ' 
<table><tr><th>SNo</th><th>Id</th><th>Orderid</th><th>Totalnumber</th><th>Totalprice</th><th>Vouchernumber</th><th Class="vart">Date</th><th>Complete</th><th>Action</th></tr>';
$number=1;
while($row=mysqli_fetch_array($querys, MYSQLI_ASSOC)){
	
$id=$row["userid"];
//uantity=$row["quantity"];
$orderid=$row['orderid'];
$totalnumber=$row['totalnumber'];
$totalprice=$row['totalprice'];
$date=$row['date'];
$vouchernumber=$row['vouchernumber'];
$status=$row['status'];
if($status=='pending') {
$order_status='Incomplete';	
}
else {
$order_status='Complete';	
}
 

            echo'
			<tr>
			<td>'.$number.'</td>
            <td>'.$id.'</td>
			<td>'.$orderid.'</td>
            <td>'.$totalnumber.'</td>
			<td>'.$totalprice.'</td>
			<td>'.$vouchernumber.'</td>
			<td class="vart">'.$date.'</td>
			<td>'.$order_status.'</td>
            <td>';
			if($order_status=="Incomplete") {
			 echo'<a href="confirm.php?orderid='.$orderid.' ">Confirm</a></td></tr>'; 
			}
			else {
			echo 'Paid</td></tr>';	
			}
			
			 
				++$number;
				
			
}
echo '</table>';
}

}
?>
</body>
</html>