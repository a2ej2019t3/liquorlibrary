<?php
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;

if (isset($_REQUEST['token'])) {
    $linkToken = $_REQUEST['token'];
}

$res = $DBsql->select('users', array('resettoken' => $linkToken));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
    include_once("./partials/head.php");
    ?>
</head>

<body style="background-size: 150px; background-repeat: repeat; background-image: url(images/background3.png); overflow-y: hidden;">
    <div id="main" style="width:100%; margin-top: 50px;">
        <div style="max-width: 800px; margin-left:auto; margin-right:auto; border:1px solid #eeeeee">
            <div id="header" style="height:100px; width:100%; background-color:black; text-align:center;">
                <img style="max-height:100px; width:auto;" src="https://liquorlibrary-email-pics.s3-ap-southeast-2.amazonaws.com/brandlogo.jpg">
            </div>
            <hr style="padding:0; margin:0;">
            <div id="content" style="height: auto; width:100%; padding: 30px 20px 0px;">
                <?php
                if ($res != null) {
                    $userID = $res['userID'];
                    $userEmail = $res['email'];
                    echo '
                        ';
                } else {
                    echo '
                    <div style="text-align: center;">
                        <p style="font-size: 1.5rem; font-weight:100; padding-top: 100px;">
                            The link has expired.
                        </p>
                    </div>';
                }
                ?>
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
    <?php
    include_once("partials/foot.php");
    ?>
</body>

</html>