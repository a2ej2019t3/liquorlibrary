<?php
session_start();
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;

// reCAPTCHA
$captcha = $_REQUEST['token'];
if (!$captcha) {
    echo '<h2>Please check the the captcha form.</h2>';
    exit;
}
$secretKey = "6LeF6qwUAAAAAMYo3Pv_bys2TRSGF2ultYSKCaWC";
$ip = $_SERVER['REMOTE_ADDR'];

// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array('secret' => $secretKey, 'response' => $captcha);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$responseKeys = json_decode($response, true);
if ($responseKeys["success"]) {
    // echo true;

    // prepare the token
    $length = 75;
    $token = bin2hex(random_bytes($length));

    // get userID
    if (isset($_SESSION['user'])) {
        $userID = $_SESSION['user']['userID'];
        $userEmail = $_SESSION['user']['email'];
        var_dump($userEmail);
    } else {
        $res = $DBsql->select('users', array('eamil' => $_POST['email']));
        if ($res) {
            $userID = $res['userID'];
        } else {
            var_dump($res);
        }
        $userEmail = $_POST['email'];
    }

    // update db
    $res = $DBsql->updateDB('users', array('resettoken' => $token, 'resettime' => date("Y-m-d H:i:s")), array('userID' => $userID));

    if ($res) {
        define("PROJECT_HOME", "http://localhost/liquorlibrary");
        define("ADMIN_EMAIL", "admin@gmail.com");

        if (!class_exists('PHPMailer')) {
            require('phpmailer/class.phpmailer.php');
            require('phpmailer/class.smtp.php');
        }

        $mail = new PHPMailer();

        $emailBody = '
        <div class="mailbox" style="text-align: center; border: 1px solid rgba(215, 232, 186, 1); border-radius:25px; margin-top: 30px; font-family: "Montserrat", sans-serif;>
            <p><b>TEST MAIL for reset password...</b></p>                    
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
    } else {
        echo 'something wrong.';
    }
} else {
    echo json_encode(array('success' => 'false'));
}
