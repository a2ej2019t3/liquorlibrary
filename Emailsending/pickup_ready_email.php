
<?php
session_start();
if(isset($buyeremail)){
    $sendername='liquor library';
    $senderemail_address='liquorlibrary@admin.com';

    $branchname=$_SEESSION['warehouse']['whName'];
    $requestorderID=$orderID;

    define("PROJECT_HOME","http://localhost/liquorlibrary");
    
    define("PORT", ""); // port number
    define("MAIL_USERNAME", "ham38538821@gmail.com"); // smtp usernmae
    define("MAIL_PASSWORD", "gkatkdgur88!!"); // smtp password
    define("MAIL_HOST", "smtp.gmail.com"); // smtp host
    define("MAILER", "smtp");
    
    define("SENDER_NAME", $sendername);
    define("SERDER_EMAIL", $senderemail_address);
    
    if(!class_exists('PHPMailer')) {
        require('phpmailer/class.phpmailer.php');
        require('phpmailer/class.smtp.php');
    }
    
    
    $mail = new PHPMailer();
    
    $emailBody = '
    <div class="mailbox" style="text-align: center; border: 1px solid rgba(215, 232, 186, 1); border-radius:25px; margin-top: 30px; font-family: "Montserrat", sans-serif;>
        <div class="mailheading"> <h2> Alert: Now your order is ready at the store! </h2></div>
        <div class="mailcontent" style="margin-top: 20px; margin-bottom: 30px; ">
           <hr>
            <br>
            <div style="boder: 1px solid rgba(124, 99, 84, 1); border-radius: 25px;">
            <p style="font-size: 19px; font-weight: 700;">'.$branchname.' from '.$sendername.' is informing you that your order(order number: '.$orderID.') is now ready to meet you!</p>
            <div style="background-color: rgba(244, 232, 117, 1); margin: 20px auto; padding: 40px 0;">
            <p style="font-size: 19px; font-weight: 700;">notice: please do not forget to bring your ID with you.</p>
            </div> 
            </div>
            <p> To go to the home page <a href="'.PROJECT_HOME.'/index.php">Click here</a>. </p>
            <p> To reply to this comment click here '.$senderemail_address.'</p>

            <br>
            <hr>
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
    
    $mail->SetFrom($senderemail_address, $sendername);
    // $mail->ReturnPath($email, $sender_name);
    $mail->AddAddress($buyeremail);
    $mail->Subject = "Liquor Library: your order is ready at the $branchname ";		
    $mail->MsgHTML($emailBody);
    $mail->IsHTML(true);
    
    if(!$mail->Send()) {
        return 2;
    } else {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Your request is Succesfully sent!');
        
        </script>");
        return 1;
        // header('Location: ../'. $_SESSION['location'].'.php');
    }
    
}
else{
    echo 'form error';
}

?>
