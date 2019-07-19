<?php
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;

if ($_REQUEST['token'] != null) {
    $linkToken = $_REQUEST['token'];
} else {
    $linkToken = 'testtoken';
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

<body style="background-size: 150px; background-repeat: repeat; background-image: url(images/background3.png); overflow-y: hidden; height: 100vh;">
    <div id="main" style="height:100%; position:related;">
        <div style="max-width: 800px;
    max-height: 530px;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    border: 1px solid #eeeeee;
    position: absolute;
    background: white;">
            <div id="header" style="height:100px; width:100%; background-color:black; text-align:center;">
                <img style="max-height:100px; width:auto;" src="https://liquorlibrary-email-pics.s3-ap-southeast-2.amazonaws.com/brandlogo.jpg">
            </div>
            <hr style="padding:0; margin:0;">
            <div id="content" style="height: auto; width:100%; padding: 30px 20px 0px;">
                <?php
                if ($res != null) {
                    $userID = $res[0]['userID'];
                    $_SESSION['rpuid'] = $userID;
                    $userEmail = $res[0]['email'];
                    echo '
                    <form style="padding: 0px 140px 0px;" id="resetForm" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <label for="inputpassword">New password: </label>
                            <input type="password" class="form-control" id="inputpassword" placeholder="Input new password" required>
                            <div class="invalid-feedback">
                                The password can not be empry
                            </div>
                            <small id="passwordTips" class="form-text text-muted">Use capital letters, lowercase letter and symbols to increse the strength of your password.</small>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Confirm: </label>
                            <input type="password" class="form-control" id="confirmpassword" placeholder="Password" required>
                            <div class="invalid-feedback">
                                The password does not match
                            </div>
                        </div>
                        <div class="form-group" style="text-align:center;">
                            <div>
                                <button type="button" id="resetSubmit" style="background-color: #555555;
                                border: none;
                                border-radius: 4px;
                                color: #ffca2b;
                                padding: auto 32px;
                                height: 40px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 1rem;
                                width: 100px;">Submit
                                </button>
                                <div>
                                    <div class="spinner-border text-warning" style="display:none; margin: auto;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>';
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
            <div id="footer" style="padding-bottom: 30px; right: 0; left: 0; bottom: 0; position:absolute; text-align: center;">
                <hr>
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
      include_once("partials/footer.php");
 include_once("partials/foot.php");
    ?>
    <script>
        $(function() {
            $("#resetSubmit").on("click", function(e) {
                check();
                var form = $("#resetForm")[0];
                var isValid = form.checkValidity();
                if (isValid) {
                    $('#resetSubmit').css('display', 'none');
                    $('.spinner-border').css('display', 'block');
                    $('input').attr('disabled', 'true');
                    var xmlhttp = new XMLHttpRequest();
                    var obj = {
                        password: $('#confirmpassword').val()
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(xmlhttp);
                            console.log(xmlhttp.response);
                            $('#content').html('<div style="text-align: center;"><p>Your password has been reset</p><br><button id="homeBtn" type="button" style="background-color: #555555; border: none; border-radius: 4px;color: #ffca2b; padding: auto 32 px; height: 60 px; text-align: center; text-decoration: none; display: inline-block; font-size: 1 rem; width: 200 px;">Home</button></div>');
                            $('#homeBtn').on('click', function() {
                                window.location = 'index.php';
                            })
                        }
                    }
                    xmlhttp.open("POST", "resetPasswordDB.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/json")
                    xmlhttp.send(JSON.stringify(obj));

                }
            });
            $('input').blur(function() {
                check();
            });

            function check() {
                if ($('#inputpassword').val() == '') {
                    $('#inputpassword').addClass('is-invalid');
                    $('#inputpassword').removeClass('is-valid');
                    document.getElementById('inputpassword').setCustomValidity('error');
                } else {
                    $('#inputpassword').addClass('is-valid');
                    $('#inputpassword').removeClass('is-invalid');
                    document.getElementById('inputpassword').setCustomValidity('');
                }
                if ($('#confirmpassword').val() != '' && $('#confirmpassword').val() == $('#inputpassword').val()) {
                    $('#confirmpassword').addClass('is-valid');
                    $('#confirmpassword').removeClass('is-invalid');
                    document.getElementById('confirmpassword').setCustomValidity('');
                } else {
                    $('#confirmpassword').addClass('is-invalid');
                    $('#confirmpassword').removeClass('is-valid');
                    document.getElementById('confirmpassword').setCustomValidity('error');
                }
            }
        });
    </script>
</body>

</html>