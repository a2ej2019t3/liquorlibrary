
<?php
if(isset($_POST['contactform'])){
    $topic= $_POST['questiontopic'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['emailaddress'];
    $company_name = $_POST['companyname'];
    $contact_number = $_POST['contactnumber'];
    $comment= $_POST['comment'];
    $sender_name= $first_name. $last_name;
    
    
    define("PROJECT_HOME","http://localhost/liquorlibrary");
    
    define("PORT", ""); // port number
    define("MAIL_USERNAME", "ham38538821@gmail.com"); // smtp usernmae
    define("MAIL_PASSWORD", "gkatkdgur8821!"); // smtp password
    define("MAIL_HOST", "smtp.gmail.com"); // smtp host
    define("MAILER", "smtp");
    
    define("SENDER_NAME", $sender_name);
    define("SERDER_EMAIL", $email);
    
    if(!class_exists('PHPMailer')) {
        require('phpmailer/class.phpmailer.php');
        require('phpmailer/class.smtp.php');
    }
    
    
    $mail = new PHPMailer();
    
    $emailBody = '
    <div class="mailbox" style="text-align: center; border: 1px solid rgba(215, 232, 186, 1); border-radius:25px; margin-top: 30px; font-family: "Montserrat", sans-serif;>
        <div class="mailheading"> <h2> You have 1 quetion to answer from '.$sender_name.'! </h2></div>
        <div class="mailcontent" style="margin-top: 20px; margin-bottom: 30px; ">
           <hr>
            <br>
            <div style="boder: 1px solid rgba(124, 99, 84, 1); border-radius: 25px;">
            <p style="font-size: 19px; font-weight: 700;">Company: <span style="font-size: 16px; font-weight: 600;">'.$company_name.'</span> </p>
            <p style="font-size: 19px; font-weight: 700;">Contact number: <span style="font-size: 16px; font-weight: 600;"> '.$contact_number.'</span> </p>
            <p style="font-size: 19px; font-weight: 700;">Comment topic: <span style="font-size: 16px; font-weight: 600;"> '.$topic.'</span> </p>
            <div style="background-color: rgba(244, 232, 117, 1); margin: 20px auto; padding: 40px 0;">
            <p style="font-size: 19px; font-weight: 700;">comment content: </p>
            <p  style="font-size: 16px; font-weight: 600;">'.$comment.'</p>
            </div> 
            </div>
            <p> To go to the home page <a href="'.PROJECT_HOME.'/index.php">Click here</a>. </p>
            <p> To reply to this comment click here '.$email.'</p>

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
    $mail->Password = "gkatkdgur8821!";
    $mail->Host     = "smtp.gmail.com";
    $mail->Mailer   = "smtp";
    
    $mail->SetFrom($email, $sender_name);
    // $mail->ReturnPath($email, $sender_name);
    $mail->AddAddress("ham38538821@gmail.com");
    $mail->Subject = "$email requested an answer regarding to $topic";		
    $mail->MsgHTML($emailBody);
    $mail->IsHTML(true);
    
    if(!$mail->Send()) {
        $error_message = 'Problem in Sending Email';
        echo  $error_message;
    } else {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Your request is Succesfully sent!');
        window.location.href='../index.php';
        </script>");
    }
    
}
else{
    echo 'form error';
}

?>
