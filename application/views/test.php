<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="referrer" content="origin">

        <title>iEdu</title>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,‌​100italic,300,300ita‌​lic,400italic,500,50‌​0italic,700,700itali‌​c,900italic,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/assets/css/3.3.7.bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/3.3.7.bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="/assets/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="/assets/css/ionicons.min.css" />
        <link rel="stylesheet" href="/assets/css/custom.css" />
        <link rel="stylesheet" href="/assets/css/half-slider.css" />

        <script type="text/javascript">
            function CopyToClipboard(containerid) {

                if (document.selection) {  
                    var range = document.body.createTextRange();
                    range.moveToElementText(document.getElementById(containerid));
                    range.select().createTextRange();
                    document.execCommand("Copy"); 

                } else if (window.getSelection) { 
                    var range = document.createRange();
                     range.selectNode(document.getElementById(containerid));
                     window.getSelection().addRange(range);
                     document.execCommand("Copy");
                     alert("text copied") 
                }
            }
        </script> 
    </head>

    <body>    
        <script>
            window.iedu = {"ajax_run":true,"base_url":"http:\/\/localhost:2000"};
        </script>

        <div class="container notic">
            <div class="alert alert-success alert-dismissable display-none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Success! </strong>             </div>
            <div class="alert alert-info alert-dismissable display-none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Info! </strong>             </div>
            <div class="alert alert-warning alert-dismissable display-none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Warning! </strong>             </div>
            <div class="alert alert-danger alert-dismissable display-none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Fail! </strong>             </div>
        </div>

        <aside id="navss" class="assigment for-navigation"> 
            <div class="set-element">
                <i class="ion-android-arrow-forward animated fadeInLeft is-closed" data-toggle="transs"></i>        
            </div> 
                            <div class="set-element">
                    <a href="/courses/professional-4">
                        For Professionals
                    </a>
                </div>
                <div class="set-element">
                    <a href="/courses/college-6">
                        For College
                    </a>
                </div>
                <div class="set-element">
                    <a href="/courses/school-5">
                        For School
                    </a>
                </div>
                <div class="set-element">
                    <a href="/courses/languages-8">
                        Languages
                    </a>
                </div>
                                        <div class="set-element">
                    <a class="page-scroll" data-toggle="modal" title="Sign In" href="/sign-in"> 
                        Sign In
                    </a>
                </div>
                <div class="set-element">
                    <a class="page-scroll" data-toggle="modal" title="Sign Up" href="/sign-up"> 
                        Sign Up
                    </a>
                </div>
                    </aside>

        <aside id="course-course"  class="assigment for-navigation">
            <div class="set-element">
                <i class="ion-android-arrow-forward animated fadeInLeft is-closed" data-toggle="transs-course"></i>
            </div> 
                            <div class="set-element">
                    Please Sign In
                </div>
                    </aside>

        <aside id="the-discover"  class="assigment for-navigation">
            <div class="set-element">
                <i class="ion-android-arrow-forward animated fadeInLeft is-closed" data-toggle="transs-discover"></i>
            </div> 
            <div class="set-element">
                <a href="/courses/professional-4">
                    For Professionals
                </a>
            </div>
            <div class="set-element">
                <a href="/courses/college-6">
                    For College
                </a>
            </div>
            <div class="set-element">
                <a href="/courses/school-5">
                    For School
                </a>
            </div>
            <div class="set-element">
                <a href="/courses/languages-8">
                    Languages
                </a>
            </div>
        </aside>

        
            <div class="jumbotron">
                <div class="container">
                    <nav id="myNavbar" class="navbar navbar-default navbar-inverse" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="transs">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="">
                                <img src="/assets/img/Final_iEdu_200.png">
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="/courses/professional-4">Professional</a>
                                </li>
                                <li>
                                    <a href="/courses/college-6">College</a>
                                </li>
                                <li>
                                    <a href="/courses/school-5">School</a>
                                </li>
                                <li>
                                    <a href="/courses/languages-8">Language</a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                                                        <a class="page-scroll" data-toggle="modal" title="Sign In" href="/sign-in"> 
                                            Sign In
                                        </a>
                                                                  
                                </li>
                                <li >
                                                                        <a class="page-scroll" data-toggle="modal" title="Sign Up" href="/sign-up"> 
                                            Sign Up
                                        </a>
                                                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h1>
                                Own your future by learning new skills online
                            </h1>
                            <p>
                                Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups. 
                            </p>
                            <p>
                                <a href="/get-start" target="" class="btn btn-success btn-lg get-start">
                                    Get started
                                </a>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 align-img">
                            <img src="/assets/img/iEDU-App_imgforbanner.png">
                        </div>
                    </div> 
                </div>               
            </div>  
            <div class="row no-padding no-margin">
                <div id="featured">
                    <div class="container">
                        
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4 class="main-text">
                                The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin. 
                            </h4>
                            <div class="col-sm-12 col-md-3 col-lg-3 content-box-4 arrenge-left">
                                                            <div class="content-img">
                                    <a href="/courses/professional-4/learn-computer-science-3">
                                        <img src="https://salesuadmin.blob.core.windows.net/images/_5909c02868437.png">
                                    </a>
                                </div>
                                <h4 class="title">
                                    <a href="/courses/professional-4/learn-computer-science-3">
                                        Learn Computer Science                                 </a>
                                </h4>
                                <div class="description">
                                    Learn Computer Science                             </div>
                                <div class="rateprice">
                                    <div class="pull-left">
                                                                                FREE
                                                                        </div>
                                    <div class="pull-right">
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                                                                                                <i class="ion-android-star"></i>
                                                                                                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 content-box-4">
                                                            <div class="content-img">
                                    <a href="/courses/school-5/learn-biochemistry-6">
                                        <img src="https://salesuadmin.blob.core.windows.net/images/_5910685bce9b9.png">
                                    </a>
                                </div>
                                <h4 class="title">                                
                                    <a href="courses/school-5/learn-biochemistry-6">
                                        Learn Biochemistry                                 </a>
                                </h4>
                                <div class="description">
                                    Learn Biochemistry                             </div>
                                <div class="rateprice">
                                    <div class="pull-left">
                                                                                FREE
                                                                        </div>
                                    <div class="pull-right">
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                                                                                                <i class="ion-android-star"></i>
                                                                                        <i class="ion-android-star"></i>
                                                                                                                </div>
                                </div>
                            </div>                        
                            <div class="col-sm-12 col-md-3 col-lg-3 content-box-4 arrenge-left">
                                                            <div class="content-img">
                                    <a href="/courses/college-6/learn-english-spelling-5">
                                        <img src="https://salesuadmin.blob.core.windows.net/images/_5910650a6f101.png">
                                    </a>
                                </div>
                                <h4 class="title">                                
                                    <a href="/courses/college-6/learn-english-spelling-5">
                                        Learn English Spelling                                </a>
                                </h4>
                                <div class="description">
                                    Learn English Spelling                            </div>
                                <div class="rateprice">
                                    <div class="pull-left">
                                                                                FREE
                                                                        </div>
                                    <div class="pull-right">
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                                                                                                <i class="ion-android-star"></i>
                                                                                                                </div>
                                </div>
                            </div>                        
                            <div class="col-sm-12 col-md-3 col-lg-3 content-box-4">
                                                            <div class="content-img">
                                    <a href="/courses/languages-8/learn-marathi-216">
                                        <img src="https://salesuadmin.blob.core.windows.net/images/_59513c4a600fe.png">
                                    </a>
                                </div>
                                <h4 class="title">
                                    <a href="/courses/languages-8/learn-marathi-216">
                                        Learn Marathi                                 </a>
                                </h4>
                                <div class="description">
                                    Learn Marathi                             </div>
                                <div class="rateprice">
                                    <div class="pull-left">
                                                                                FREE
                                                                        </div>
                                    <div class="pull-right">
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                <i class="ion-android-star green"></i>
                                                                                                            </div>
                                </div>
                            </div>
                        </div>   
                        
                    </div>
                </div>
            </div>
            <div id="school">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin   
                            <br><br>
                            <button>High School</button>
                            <button>Middle School</button>
                            <br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <button>Elementary School</button>                     
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <a href="/courses/school-5">
                                <img src="/assets/img/School_img.png">
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div id="college">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <a href="/courses/college-6">
                                <img src="/assets/img/College_img.png">
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin      
                            <br><br> 
                            <div>
                                <button>Engineering</button>
                                <button>Business</button>
                                <br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <button>Medicine</button>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div> 
                        </div>
                        
                    </div>
                </div>
            </div>            
            <div id="professional">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin 
                            <br><br>
                            <button>Programming</button>
                            <button>Design</button>
                            <br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <button>Business</button>                       
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <a href="/courses/professional-4">
                                <img src="/assets/img/Professionals_img.png">
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div id="language">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <a href="/courses/languages-8">
                                <img src="/assets/img/Language_img.png">
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7">
                            The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin                        
                            <br><br>
                            <div>
                                <button>Asian Languages</button>
                                <button>European Languages</button>
                                <br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <button>Middle East Languages</button>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>  


            <div class="row no-padding no-margin">
                <h1 class="free-trial">Start Your Free Trial Now</h1>     
                <h3 class="trial-text"> lorem ipsum text is typically a scrambled</h3> 
                <p class="trial-start">
                    <a href="get-start" target="" class="btn btn-success btn-lg get-start">
                        Get started
                    </a>
                </p>          
            </div>                        
            <footer>
                    <div class="container">   
                        <div class="row">                    
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="col-xs-12 col-md-12 col-md-9">
                                    <img src="/assets/img/iEdu-logo_footer.png">
                                    <div class="f-text">
                                    The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero
                                    </div>
                                    <div class="ftr">@ 2016 EdCast Inc. All rights reserved.</div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                
                                <div class="col-sm-12 col-md-12 align-text">
                                    <div class="row">
                                        <a target="_blank" href="https://twitter.com/ieduteam">
                                            <img class="pull-right" src="/assets/img/twitter.png"> <!-- TW -->
                                        </a>
                                        <a target="_blank" href=" https://www.facebook.com/iedu.io">
                                            <img class="pull-right" src="/assets/img/FB.png">
                                        </a>
                                        <a target="_blank" href="https://www.youtube.com/channel/UC65vEFhxRDbeXmK--7BxJ-w">
                                            <img class="pull-right" src="/assets/img/youtube.png"> <!-- YT -->
                                        </a>
                                        <h3 class="pull-right">Get in touch with us</h3>
                                        
                                        <h3 class="pull-left">Get in touch with us</h3>
                                        <a target="_blank" href="https://www.youtube.com/channel/UC65vEFhxRDbeXmK--7BxJ-w">
                                            <img class="pull-left" src="/assets/img/youtube.png"> <!-- YT -->
                                        </a>
                                        <a href=" https://www.facebook.com/iedu.io">
                                            <img class="pull-left" src="/assets/img/FB.png">
                                        </a>
                                        <a href="https://twitter.com/ieduteam">
                                            <img class="pull-left" src="/assets/img/twitter.png">
                                        </a>
                                    </div>
                                    <div class="row soc-row">
                                        <a  href="https://play.google.com/store/apps/details?id=com.wagmob.golearningbus" target="_blank">
                                            <img src="/assets/img/Playstore_btn.png" class="app-img">
                                        </a>
                                        <a href="https://itunes.apple.com/us/app/golearningbus-university-by-wagmob/id1037335675?ls=1&mt=8" target="_blank">
                                            <img src="/assets/img/Appstore_btn.png" class="app-img">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>                    
                        </div>
                    </div>
                </footer>
       


        

        <img src="/assets/img/loader.gif" id="loaders" class="display-none">

        <script src="/assets/js/1.12.4.jquery.min.js"></script>
        <script src="/assets/js/3.3.7.bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <script src="/assets/js/star-rating.js" type="text/javascript"></script>
        <script type="text/javascript" src="/assets/js/validation.js"></script>
        <script type="text/javascript" src="/assets/js/jquery-function.js"></script>
        <script src="/assets/js/custom.js"></script>
        <script type="text/javascript">
            setTimeout(function(){ 
                
                $(".alert").removeClass('display-block');
                $(".alert").addClass('display-none');      
                unsetSess();
                $(".collapse-pre").removeAttr("style");
            }, 5000);

            jQuery(document).ready(function () {            
                var $inp = $('#rating-input');
                $inp.rating({
                    min: 0,
                    max: 5,
                    step: 1,
                    size: 'sm',
                    showClear: false
                });

                $('body').on('click', '#continue', function(){
                    
                    $("#wrongAns").removeClass("in");
                    $("#wrongAns").css("display", "none");
                    $("#rightAns").removeClass("in");
                    $("#rightAns").css("display", "none");
                    $(".modal-backdrop").remove();
                    changeQuizz();
                });
            });      
        </script>

        <style>
            .multipleInput-container {
                border:1px #ccc solid;
                padding:1px;
                padding-bottom:0;
                cursor:text;
                font-size:13px;
                width:70%;
                height: 75px;
                overflow: auto;
                background-color: white;
                border-radius:3px;
            }

            .multipleInput-container input {
                font-size:13px;
                /*clear:both;*/
                width:150px;
                height:24px;
                border:0;
                margin-bottom:1px;
                outline: none
            }

            .multipleInput-container ul {
                list-style-type:none;
                padding-left: 0px !important;
            }

            li.multipleInput-email {
                float:left;
                margin-right:2px;
                margin-bottom:1px;
                border:1px #BBD8FB solid;
                padding:2px;
                background:#F3F7FD;
                color: #333;
            }

            .multipleInput-close {
                width:16px;
                height:16px;
                background:url(https://www.livetechniciancloud.com/css/close.png);
                display:block;
                float:right;
                margin:0 3px;
            }

            .email_search {
                width: 100% !important;
                color: #333;
            }
        </style>


        <script>
            function validateEmail(email) {
                var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                return re.test(email);
            }
            var total_email = 1;
            (function( $ ){
                $.fn.multipleInput = function() {                    
                    return this.each(function() {
                        $list = $('<ul/>');
                        var $input = $('<input type="email" id="email_search" class="email_search multiemail" placeholder="Enter upto five email address" />').keyup(function(event) {
                            if(event.which == 13 || event.which == 32 || event.which == 188) {
                                if(event.which==188){
                                    var val = $(this).val().slice(0, -1);
                                    total_email++;
                                    if(total_email > 5){
                                        $("#email_search").attr('disabled', 'disabled');
                                    }
                                }else{
                                    var val = $(this).val();
                                }
                                if(validateEmail(val)){

                                    $list.append($('<li class="multipleInput-email"><span>' + val + '</span></li>')
                                        .append($('<a href="#" class="multipleInput-close" title="Remove"><i class="ion-ios-close"></i></a>')
                                                .click(function(e) {
                                                    $(this).parent().remove();
                                                    e.preventDefault();
                                                })
                                            )
                                        );
                                    $(this).attr('placeholder', '');
                                    $(this).val('');
                                }else{
                                    alert('Please enter valid email id, Thanks!');
                                }                                   
                            }
                        });
                        var $container = $('<div class="multipleInput-container" />').click(function() {
                            $input.focus();
                        });
                        $container.append($list).append($input).insertAfter($(this));
                        var $orig = $(this);
                        $(this).closest('form').submit(function(e) {
                            var emails = new Array();
                            $('.multipleInput-email span').each(function() {
                                emails.push($(this).html());
                            });
                            emails.push($input.val());
                            $orig.val(emails.join());
                        });
                        return $(this).hide();
                    });                   
                };
            })( jQuery );
            $('#mail-5').multipleInput();
        </script>

        <script>
            $(document).ready(function() {
                $("#file-upload").on('change', function() {
                    var countFiles = $(this)[0].files.length;
                    var imgPath = $(this)[0].value;
                    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();                    
                    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                        if (typeof(FileReader) != "undefined") {
                            for (var i = 0; i < countFiles; i++) 
                            {
                                var reader = new FileReader();
                                reader.onload = function(e) {                                    
                                    $("#image-holder img").attr("src", e.target.result);
                                }
                                reader.readAsDataURL($(this)[0].files[i]);
                            }
                        } else {
                            alert("This browser does not support FileReader.");
                        }
                    } else {
                        alert("Pls select only images");
                    }
                });
            });
        </script>
    </body>
</html>