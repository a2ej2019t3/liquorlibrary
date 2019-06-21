<?php
if(!class_exists('PHPMailer')) {
    require('phpmailer/class.phpmailer.php');
	require('phpmailer/class.smtp.php');
}

require_once("mail_config.php");

$mail = new PHPMailer();

$emailBody = '
<div class="mailbox" style="text-align: center; border: 1px solid rgba(215, 232, 186, 1); border-radius:25px; margin-top: 30px; font-family: "Montserrat", sans-serif;>
    <div class="mailheading"> <h2> Thank you for your order! </h2></div>
    <div class="mailcontent" style="background-color: rgba(144, 180, 148, 1); margin-top: 20px; margin-bottom: 30px; ">
        <p style="font-size: 25px; font-weight: 700; margin-top: 10px;"> your order (ordernumber # '.$orderId.') is successfully processed! </p>
       <hr>
        <p> <h3>Order Summary:</h3><br> <span> Total items: '.$finalquantity.' items<br> Total cost: $'.$fianlprice.' <br> Order instruction: '.$note.'<p>
        <br>
        <p> For more detail and status, please visit <a href="'.PROJECT_HOME.'/paymentprocess.php">Click here</a> and log in to check your order detail in your "my orders" tab </p>
        <br>
        <p> If you have any concern, please contact us through via link : <a href="'.PROJECT_HOME.'/contact.php">Click here</a>
        <br> We will get back to you as soon as possible </p>
        <hr>
        </div>
    <div class="endemail">
      <p> 
      Best Regards, 
      Liquor Library
      <br>
      </p>
    </div>
</div>
';

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;  
$mail->Username = "ham38538821@gmail.com";
$mail->Password = "gkatkdgur8821!";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";

$mail->SetFrom("ham38538821@gmail.com", "LIQUOR LIBRARY_Admin");
$mail->AddReplyTo("ham38538821@gmail.com", "LIQUOR LIBRARY_Admin");
$mail->ReturnPath="ham38538821@gmail.com";	
$mail->AddAddress($email);
$mail->Subject = "Order Succeessfully completed";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if(!$mail->Send()) {
    $error_message = 'Problem in Sending Email';
    return  $error_message;
} else {
    // $success_message = 1;
    // echo $success_message;
    return 1;
}