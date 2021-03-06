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
                color: #333
            }

            .error {
                color: #f00;
            }

            .terms-pri {
                padding: 15px 0;
            }

            @media only screen and (min-width : 320px) and (max-width : 767px) {
                .container {
                    width: 80%;
                }

                .container h2 {
                    font-size: 20px;
                }

                .terms-pri {
                    font-size: 12px;
                    padding: 15px 0;
                }

                .go-signup, .go-signin {
                    font-size: 12px;
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

        <header class="resert-password">
            <a class="" href="<?php echo $base_url;?>">
                <img src="/assets/img/iEdu-logo-inner.png">
            </a>
        </header>

        <div class="container">
            <div class="" id="ajaxmsg"></div>
            <h2 class="text-center">Sign Up</h2>
            <form role="form" id="signUpForm" name="signUpForm" method="post" action="/Home/signup" novalidate="novalidate" autocomplete="off">
                <div class="form-group">
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                    <span class="form-highlight"></span>
                    <span class="form-bar"></span>
                    <label class="float-label" for="first_name">First Name</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                    <span class="form-highlight"></span>
                    <span class="form-bar"></span>
                    <label class="float-label" for="last_name">Last Name</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="email_id" name="email_id" required>
                    <span class="form-highlight"></span>
                    <span class="form-bar"></span>
                    <label class="float-label" for="email_id">Email</label>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <span class="form-highlight"></span>
                    <span class="form-bar"></span>
                    <label class="float-label" for="password">Password</label>
                </div>
                <div class="">
                    <input type="hidden" name="ApiKey" id="ApiKey" value="<?php echo $ApiKey;?>">
                    <button class="btn btn-primary pull-left sign-in sign-up" id="forsignup">Sign Up</button>
                </div>
                <div class="clearfix"></div>
            </form>     
            <div class="terms-pri text-center">
                By signing up, you agree to our <a href="">Terms of Use</a> and <a href="">Privacy Policy</a>
            </div>
            <hr>
            <div class="go-signin text-center">
                Already have an account? <a class="page-scroll" data-toggle="modal" title="Sign In" href="/sign-in">Sign In</a>
            </div>
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
        <img src="/assets/img/loader.gif" id="loaders" class="display-none">
    </body>
</html>