
<?php
if(!class_exists('PHPMailer')) {
    require('phpmailer/class.phpmailer.php');
	require('phpmailer/class.smtp.php');
}

require_once("mail_config.php");

$mail = new PHPMailer();

$emailBody = '
<div class="mailbox" style="text-align: center; border: 1px solid rgba(215, 232, 186, 1); border-radius:25px; margin-top: 30px; font-family: "Montserrat", sans-serif;>
    <div class="mailheading"> <h2> Thank you for choosing us '.$username.'! </h2></div>
    <div class="mailcontent" style="margin-top: 20px; margin-bottom: 30px; ">
       <div style="background-color: rgba(144, 180, 148, 1); height: 60px;"> <p style="font-size: 25px; font-weight: 700; margin-top: 10px;"> We are informing you that you are successfully signed up! </p></div>
       <hr>
        <br>
        <p> Now enjoy diving to our heaps of beer and wine collections!</p>
      
        <p> please visit <a href="'.PROJECT_HOME.'/index.php">Click here</a> and log in and enjoy your journey. </p>
        <br>
        <p> If you have any concern, please contact us through via link : <a href="'.PROJECT_HOME.'/contact.php">Click here</a>
        <br> We will get back to you as soon as possible </p>
        <hr>
        <br>
        <br>
        </div>
    <div class="endemail">
      <p> 
      Best Regards, <br>
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
$mail->Subject = "Succeessful Sign Up_Liquor Library";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if(!$mail->Send()) {
    $error_message = 'Problem in Sending Email';
    echo  $error_message;
} else {
    $success_message = 1;
    echo $success_message;
}

?>
