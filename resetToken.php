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
        include_once('Emailsending/resetPasswordEmail.php');
    } else {
        echo 'something wrong.';
    }
} else {
    echo false;
}
