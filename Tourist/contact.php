<?php
session_start();
include('functions.php');
$conn=mysqli_connect("localhost:3307", "root", "");
mysqli_select_db($conn, "tourist");
$firstErr=" ";

if(isset($_POST['submit'])) {
    $email=stripslashes($email);
    $name=stripslashes($name);
    $subject=stripslashes($subject);
    $message=stripslashes($message);

$email=$_POST['email'];
$name=$_POST['name'];
$subject=$_POST['subject'];
$message=$_POST['message-content'];
 ini_set('SMTP',' gmail.com'); 
ini_set('smtp_port',25);
ini_set('sendmail_from',$email);
$to="cookery@gmail.com";
$header = "From:$email"."\r\n"; 
         
         $header .= "MIME-Version: 1.0"."\r\n";
         $header .= "Content-type: text/html"."\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
		 }
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

        .message input, textarea{
            width:95%;
border-radius:4px;
box-sizing:border-box;
padding:10px;
margin:10px 0;
border:none;
background-color:#f7f7f7;

outline:none;
        }
       
.message textarea{


resize:none;
height:100px;
margin-bottom: 2rem;

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
    
    
          <h6 class=" text-primary-400 text-align-center" >Contact us</h6>
          <div class="flow"> 
         

           
           <h2 class="fs-secondary-heading fw-bold text-align-center">Contact For Any Query</h2>
           <hr class="line" >
        </div>
    <div class="even-columns">

    <div >
           
           <img src="images/about-4.jpg" />
        </div>
       
        <div class="message">
<form  method="POST" autocomplete="off" enctype="multipart/form-data"> 
<input type="text" name="name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="text" name="subject" placeholder="Subject">
<textarea placeholder="Message" name="message-content"></textarea>
<button type="submit" value="Send message" name="submit" class="btn">Send message</button>
</form>
</div> 
           
       
        </div>
        
    </div>

</section>
</main>
<?php
include("footer.php");
    ?>
    
    <script src="https://smtpjs.com/v3/smtp.js"></script>
   <script src="main.js"></script> 
</body>
</html>
