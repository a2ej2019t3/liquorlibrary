
<?php
session_start();
include('../connection.php');
if (isset($_POST['branchrequestform'])) {
    $subject = $_POST['subject'];
    $senderemail_address = $_POST['email'];
    $sendername='Liquor Library Admin';
    $requestcontent = $_POST['message'];
    $tobuyerID = $_POST['TobranchID'];
    // echo $tobuyerID;
    if ($tobuyerID) {
        $buyeremail_sql = "SELECT email from users WHERE userID='$tobuyerID'";
        $buyeremail_res = mysqli_query($connection, $buyeremail_sql);
        if ($buyeremail_res) {
            $row = mysqli_fetch_row($buyeremail_res);
            $buyeremail = $row[0];
            // echo $buyeremail;

            define("PROJECT_HOME", "http://localhost/liquorlibrary");

            define("PORT", ""); // port number
            define("MAIL_USERNAME", "ham38538821@gmail.com"); // smtp usernmae
            define("MAIL_PASSWORD", "gkatkdgur88!!"); // smtp password
            define("MAIL_HOST", "smtp.gmail.com"); // smtp host
            define("MAILER", "smtp");

            define("SENDER_NAME", $senderemail_address);
            define("SERDER_EMAIL", $senderemail_address);

            if (!class_exists('PHPMailer')) {
                require('phpmailer/class.phpmailer.php');
                require('phpmailer/class.smtp.php');
            }


            $mail = new PHPMailer();

            $emailBody = '
    <div class="mailbox" style="text-align: center; border: 1px solid rgba(215, 232, 186, 1); border-radius:25px; margin-top: 30px; font-family: "Montserrat", sans-serif;>
        <div class="mailheading"> <h2> Admin Request:</h2></div>
        <div class="mailcontent" style="margin-top: 20px; margin-bottom: 30px; ">
           <hr>
            <br>
            <div style="boder: 1px solid rgba(124, 99, 84, 1); border-radius: 25px;">
            <p style="font-size: 19px; font-weight: 700;">You have an email from ' . $senderemail_address . '</p>
            <div style="background-color: rgba(244, 232, 117, 1); margin: 20px auto; padding: 40px 0;">
            <p style="font-size: 19px; font-weight: 700;">Request content: </p>
            <p  style="font-size: 16px; font-weight: 600;">' . $requestcontent . '</p>
            </div> 
            </div>
            <p> To go to the home page <a href="' . PROJECT_HOME . '/index.php">Click here</a>. </p>
            <p> To reply to this comment click here ' . $senderemail_address . '</p>

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
            $mail->AddAddress($buyeremail,'liquor library');
            $mail->Subject = "Admin requested an answer regarding to the backorder";
            $mail->MsgHTML($emailBody);
            $mail->IsHTML(true);

            if (!$mail->Send()) {
                $error_message = 'Problem in Sending Email';
                echo  $error_message;
            } else {
                echo ("<script LANGUAGE='JavaScript'>
        window.alert('Your request is Succesfully sent!');
        
        </script>");
                header('Location: ../' . $_SESSION['location'] . '.php');
            }
        } else {
            echo 'form error';
        }
    } else {
        echo 'buyer ID error';
    }
} else {
    echo 'form error';
}


?>
        