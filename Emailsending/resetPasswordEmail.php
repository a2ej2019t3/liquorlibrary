<?php
// $userEmail = 'junboz598@gmail.com';
define("PROJECT_HOME", "http://localhost/liquorlibrary");
define("ADMIN_EMAIL", "admin@gmail.com");

if (!class_exists('PHPMailer')) {
    require('phpmailer/class.phpmailer.php');
    require('phpmailer/class.smtp.php');
}

$mail = new PHPMailer();

$emailBody = '
<div id="main" style="width:100%; margin-top: 50px;">
<div style="max-width: 800px; margin-left:auto; margin-right:auto; border:1px solid #eeeeee">
    <div id="header" style="height:100px; width:100%; background-color:black; text-align:center;">
        <img style="max-height:100px; width:auto;" src="https://liquorlibrary-email-pics.s3-ap-southeast-2.amazonaws.com/brandlogo.jpg">
    </div>
    <hr style="padding:0; margin:0;">
    <div id="content" style="height: auto; width:100%; padding: 30px 20px 0px;">
        <p>
            Hi '.$_SESSION['user']['firstName'].',
        </p>
        <p style="padding-left: 20px;">
            You have requested to reset password. <b>If it was not you please ignore this email.</b>
            Otherwise, click the button below to reset your password.
        </p>
        <div style="width:100%; text-align:center; margin-top: 50px;">
            <div>
                <a href="localhost/liquorlibrary/resetPassword.php?token='.$token.'" style="background-color: #555555;
                        border: none;
                        border-radius: 4px;
                        color: #ffca2b;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        width: 300px;">
                    <b>RESET PASSWORD</b>
                </a>
            </div>
        </div>
    </div>
    <hr style="margin-top: 50px;">
    <div id="footer" style="text-align:center; padding-bottom: 30px;">
        <div style="display:inline-flex; ">
            <div style="text-align:center;">
                <p style="font-size:1rem; margin: 0;"><b>Liquor Library</b></p>
                <small style="font-size:0.7rem;">THE NEW INDUSTRY STANDARD</small>
            </div>
            <div style="width:1px; border-right: 1px solid black; margin: 0px 20px 0px;">
            </div>
            <div>
                <small>Email: <span>admin@sample.com</span></small><br>
                <small>Contact number: <span>+234234234</span></small>
            </div>
        </div>
    </div>
</div>
</div>
';

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;
$mail->Username = "ham38538821@gmail.com";
$mail->Password = "gkatkdgur88!!";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";

$mail->SetFrom(ADMIN_EMAIL, 'liquor library');
$mail->AddAddress($userEmail, 'liquor library');
$mail->Subject = "Reset password";
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if (!$mail->Send()) {
    $error_message = 'Problem in Sending Email';
    echo  $error_message;
} else {
    echo true;
}