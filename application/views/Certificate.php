<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="referrer" content="origin">
        <title>GoLearningBus</title>
        <link rel="icon" type="image/png" href="/assets/img/favicon-.png"/>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,‌​100italic,300,300ita‌​lic,400italic,500,50‌​0italic,700,700itali‌​c,900italic,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/assets/css/3.3.7.bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/3.3.7.bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/ionicons.min.css" />
        <link rel="stylesheet" href="/assets/css/custom.css" />

        <style type="text/css">
            
            body.forReset {
                background: url("../../assets/img/signin-signup.jpg");
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

            .resert-password .pull-right {
                color: #333;
                text-decoration: none;
            }

            i.ion-android-share-alt {
                font-size: 35px;
            }

            .dropdown-toggle {
                padding: 0 !important;
            }

            .nav.navbar-nav a {
                color: #333 !important;
            }

            .dropdown-submenu img {
                margin: 0;
                width: inherit;
            }

            .dropdown-menu {
                min-width: inherit;
            }

            .nav .open > a, .nav .open > a:focus, .nav .open > a:hover {
                background: #fff !important
                ;
            }

            .nav > li {
                padding-bottom: 9.4px;
            }

            .text-center > img {
                margin-top: 10px;
                width: 30%;
            }

            @media only screen and (min-width : 320px) and (max-width : 767px) {
                .text-center > img {
                    width: 80%;
                }
            }

            @media only screen and (min-width : 768px) {
                .text-center > img {
                    width: 60%;
                }
            }

            @media only screen and (min-width : 1024px) {
                .text-center > img {
                    width: 50%;
                }
            }

            @media only screen and (min-width : 1200px) {
                .text-center > img {
                    width: 30%;
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
                <img src="/assets/img/GLB_icon.png">
            </a>
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="ion-android-share-alt"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu" id="discover">                            
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base64_decode($_GET['data']);?>" target="_blank">
                                <img src="/assets/img/facebook.png">
                            </a>
                        </li>                                                   
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="https://www.linkedin.com/sharing/share-offsite?url=<?php echo base64_decode($_GET['data']);?>" target="_blank">
                                <img src="/assets/img/linkedin.png">
                            </a>
                        </li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="https://plus.google.com/share?url=<?php echo base64_decode($_GET['data']);?>" target="_blank">
                                <img src="/assets/img/google-plus.png">
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>

        <div class="text-center" width="60%">
            <img src="<?php echo base64_decode($_GET['data']);?>">
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