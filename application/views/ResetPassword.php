<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="referrer" content="origin">
        <title>iEdu</title>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,‌​100italic,300,300ita‌​lic,400italic,500,50‌​0italic,700,700itali‌​c,900italic,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/assets/css/3.3.7.bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/3.3.7.bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/ionicons.min.css" />
        <link rel="stylesheet" href="/assets/css/custom.css" />

        <style type="text/css">
            
            body.forReset {
                background: url("../../assets/img/signin-signup.jpg");
            }

            h3 {
                margin-bottom: 40px;
            }

            .forReset header {
                background: #fff none repeat scroll 0 0;
                height: 55px;
                padding: 10px 4%;
            }

            .resert-password img {
                margin-left: 3%;
                width: 70px;
            }

            .container {
                background-color: #fff;
                margin-top: 50px;
                padding: 40px 5%;
                width: 40%;
                color: #333;
            }

            .notic {
                display: none;
            }

            .change-pass {
                background: #9900ff none repeat scroll 0 0;
                border: 1px solid #9900ff;
                color: #fff;
                padding: 5px 15px;
                border-radius: 4px;
            }

            .error {
                color: #f00;
            }

            @media only screen and (min-width : 320px) and (max-width : 767px) {
                .container {
                    width: 80%;
                }

                .container h2 {
                    font-size: 20px;
                }
            }

            @media only screen and (min-width : 768px) {
                .container {
                    width: 60%;
                }
            }

            @media only screen and (min-width : 1024px) {
                .container {
                    width: 50%;
                }
            }

            @media only screen and (min-width : 1200px) {
                .container {
                    width: 40%;
                }
            }
        </style>
    </head>

    <body class="forReset">  

        <script>
            window.iedu = <?php echo json_encode([
                'ajax_run' => true,
                'base_url' => $base_url
            ]) ?>;
        </script>

        <div class="container notic">
            <div class="alert alert-success alert-dismissable <?php echo $successClass;?>">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Success! </strong> <?php echo $theMessage;?>
            </div>
            <div class="alert alert-info alert-dismissable <?php echo $notifyClass;?>">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Info! </strong> <?php echo $theMessage;?>
            </div>
            <div class="alert alert-warning alert-dismissable <?php echo $warningClass;?>">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Warning! </strong> <?php echo $theMessage;?>
            </div>
            <div class="alert alert-danger alert-dismissable <?php echo $failClass;?>">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Fail! </strong> <?php echo $theMessage;?>
            </div>
        </div>

        <header class="resert-password">
            <a class="" href="<?php echo $base_url;?>">
                <img src="/assets/img/iEdu-logo-inner.png">
            </a>
        </header>

        <div class="container text-center">
            <h3>Reset Password</h3>
            <form role="form" id="resetPass" name="resetPass" method="post" novalidate="novalidate" action="/ResetPassword/reset">  
                <div class="form-group">
                    <input type="email" class="form-control" id="email_id" name="email_id" required>
                    <span class="form-highlight"></span>
                    <span class="form-bar"></span>
                    <label class="float-label" for="email_id">Email</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="otp" name="otp" required>
                    <span class="form-highlight"></span>
                    <span class="form-bar"></span>
                    <label class="float-label" for="inputOTP">OTP</label>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <span class="form-highlight"></span>
                    <span class="form-bar"></span>
                    <label class="float-label" for="inputPassword">New Password</label>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="con_password" name="con_password" required>
                    <span class="form-highlight"></span>
                    <span class="form-bar"></span>
                    <label class="float-label" for="inputPassword">Confirm Password</label>
                </div>                
                <button class="change-pass" type="submit">Change Password</button>
                <div class="clearfix"></div>
            </form>
        </div>

        <script src="/assets/js/1.12.4.jquery.min.js"></script>
        <script src="/assets/js/3.3.7.bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <script type="text/javascript" src="/assets/js/validation.js"></script>
        <script type="text/javascript" src="/assets/js/jquery-function.js"></script>
        <script src="/assets/js/custom.js"></script>
        <script type="text/javascript">
            setTimeout(function(){ 
                
                $(".alert").removeClass('display-block');
                $(".alert").addClass('display-none');      
                unsetSess();
            }, 5000);
        </script>
    </body>
</html>