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
        <div style="max-width: 800px; margin-left:auto; margin-right:auto; border:1px solid #eeeeee; background-color:white;">
            <div id="header" style="height:100px; width:100%; background-color:black; text-align:center;">
                <img style="max-height:100px; width:auto;" src="https://liquorlibrary-email-pics.s3-ap-southeast-2.amazonaws.com/brandlogo.jpg">
            </div>
            <hr style="padding:0; margin:0;">
            <div id="content" style="height: auto; width:100%; min-height: 300px; padding: 30px 20px 0px;">
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
                            <button type="submit" id="resetSubmit" style="background-color: #555555;
                        border: none;
                        border-radius: 4px;
                        color: #ffca2b;
                        padding: auto 32px;
                        height: 40px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 1rem;
                        width: 100px;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr style="margin-top: 50px;">
            <div id="footer" style="text-align:center; padding-bottom: 30px;">
                <div style="display:inline-flex; ">
                    <div style="text-align:center;">
                        <p style="font-size:1rem; margin: 0;"><b>Liquor Library</b></p>
                        <small style="font-size:0.7rem;">THE NEW INDUSTRY STANDARD</small>
                    </div>
                    <div style="width:1px; border-right: 1px solid #ffca2b; margin: 0px 20px 0px;">
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
    <script>
        $(function() {
            $("#resetSubmit").on("click", function(e) {
                var form = $("#resetForm")[0];
                var isValid = form.checkValidity();
                if (!isValid) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');

            });
            $('#inputpassword').blur(function() {
                if ($(this).val() != '') {
                    $(this).addClass('is-valid');
                    $(this).removeClass('is-invalid');
                } else {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                }
            });
            $('#confirmpassword').blur(function() {
                if ($(this).val() != '') {
                    if ($(this).val() != $('#inputpassword').val()) {
                        $(this).removeClass('is-valid');
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).addClass('is-valid');
                        $(this).removeClass('is-invalid');
                    }
                } else {
                    $(this).removeClass('is-valid');
                }
            });
        });
    </script>
</body>

</html>