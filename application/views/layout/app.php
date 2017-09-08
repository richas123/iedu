<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="referrer" content="origin">

        <title>GoLearningBus</title>
        <link rel="icon" type="image/png" href="/assets/img/favicon-.png"/>
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
        <?php            
            $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
            $ok_url = array('base_url' => $base_url);
        ?>
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

        <aside id="navss" class="assigment for-navigation"> 
            <div class="set-element">
                <i class="ion-android-arrow-forward animated fadeInLeft is-closed" data-toggle="transs"></i>        
            </div> 
            <?php if($this->uri->segment(1)):?>                                              
                <div class="set-element">
                    <form id="searchCourse" action="/Search" name="searchCourse" novalidate="novalidate" method="post">
                        <input id="top-search" name="top-search" type="text">
                        <button id="search-top" name="search-top"></button>                            
                    </form>
                </div>
                <div class="set-element">
                    <?php if($this->session->userdata('mydata')['user_id']):?>
                        <a href="javascript:void(0);" class="animated fadeInLeft is-closed" data-toggle="transs-course">
                            My Courses
                        </a>
                    <?php else:?>
                        <a href="javascript:void(0);" class="animated fadeInLeft is-closed" data-toggle="transs-course">
                            My Courses
                        </a>                    
                    <?php endif;?>
                </div>
                <div class="set-element">
                    <a href="javascript:void(0);" class="animated fadeInLeft is-closed" data-toggle="transs-discover">
                        Discover
                    </a>
                </div>
            <?php else:?>
                <div class="set-element">
                    <a href="/courses/<?php echo $catlink['professional'];?>">
                        For Professionals
                    </a>
                </div>
                <div class="set-element">
                    <a href="/courses/<?php echo $catlink['college'];?>">
                        For College
                    </a>
                </div>
                <div class="set-element">
                    <a href="/courses/<?php echo $catlink['school'];?>">
                        For School
                    </a>
                </div>
                <div class="set-element">
                    <a href="/courses/<?php echo $catlink['language'];?>">
                        Languages
                    </a>
                </div>
            <?php endif;?>
            <?php if($this->session->userdata('mydata')['user_id']):?>
                <div class="set-element">
                    <a href="/notification">
                        Notification &nbsp; <img src="/assets/img/Notification_icon.png">
                        <?php if($this->session->userdata('notifys') > 0):?>
                            <span class="shownotify">
                                <?php echo $this->session->userdata('notifys');?>
                            </span>
                        <?php endif;?>
                    </a>
                </div>
                <div class="set-element">
                    <a href="/profile">
                        ME &nbsp;&nbsp; <img src="<?php echo $this->session->userdata('mydata')['image_url'];?>" width="30px">
                    </a>
                </div>
                <div class="set-element">
                    <a href="/SignOut">
                        Sign Out
                    </a>
                </div>
            <?php else:?>
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
            <?php endif;?>
        </aside>

        <aside id="course-course"  class="assigment for-navigation">
            <div class="set-element">
                <i class="ion-android-arrow-forward animated fadeInLeft is-closed" data-toggle="transs-course"></i>
            </div> 
            <?php if($this->session->userdata('mydata')['user_id']):?>
                <?php if(isset($myCourse)):?>
                    <?php if(count($myCourse) == 0):?>
                        <div class="set-element">
                            No Courses
                        </div>
                    <?php else:?>
                        <?php 
                            $ct = 3; 
                            if(count($myCourse) < 3): $ct = count($myCourse); endif;
                        ?>
                        <?php for($z=0;$z<$ct;$z++):?>
                            <div class="set-element">
                                <a tabindex="-1" href="/<?php echo $myCourse[$z]->url;?>">
                                    <img src="<?php echo $myCourse[$z]->image_url;?>" width="50px">
                                    <?php echo $myCourse[$z]->title;?>
                                </a>
                            </div>
                        <?php endfor;?>
                        <div class="set-element">
                            <a tabindex="-1" href="/my-courses" style="color: #9900ff !important;">View All</a>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            <?php else:?>
                <div class="set-element">
                    Please Sign In
                </div>
            <?php endif;?>
        </aside>

        <aside id="the-discover"  class="assigment for-navigation">
            <div class="set-element">
                <i class="ion-android-arrow-forward animated fadeInLeft is-closed" data-toggle="transs-discover"></i>
            </div> 
            <div class="set-element">
                <a href="/courses/<?php echo $catlink['professional'];?>">
                    For Professionals
                </a>
            </div>
            <div class="set-element">
                <a href="/courses/<?php echo $catlink['college'];?>">
                    For College
                </a>
            </div>
            <div class="set-element">
                <a href="/courses/<?php echo $catlink['school'];?>">
                    For School
                </a>
            </div>
            <div class="set-element">
                <a href="/courses/<?php echo $catlink['language'];?>">
                    Languages
                </a>
            </div>
        </aside>

        <?php $this->load->view('layout/'.$header, $ok_url);?>
            <?php $this->load->view($page);?>
        <?php $this->load->view('layout/footer');?>

        <div id="galleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="" id="galleryImage" class="img-responsive" />
                        <p>
                            <br/>
                            <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Close <i class="ion-android-close"></i></button>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="rateCourse" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form name="courseRate" id="courseRate" novalidate="novalidate" method="post" action="/Home/Rates">
                            <div class="text-center">
                                <?php if(isset($courseDesc)):?>
                                    <div class="infomsg">Do you like this course</div>
                                    <hr>
                                    <?php 
                                        $url = ''; $course_id = 0;
                                        if($courseDesc): 
                                            $url = $courseDesc[0]->image_url; 
                                            $course_id = $courseDesc[0]->course_id; 
                                        endif;
                                    ?>
                                    <img src="<?php echo $url;?>" class="rateImage">
                                    <div class="infomsg">
                                        <?php if($courseDesc): echo $courseDesc[0]->title; endif;?>
                                    </div>
                                    <input id="rating-input" name="rating-input" type="text" value="">
                                    <input type="hidden" name="points" id="points" value="0">
                                    <?php endif;?>
                                <textarea class="" id="message" name="message" placeholder="What would you like to say about us?"></textarea>
                            </div>                       
                            <hr>
                            <div class="text-center">
                                <?php if(isset($course_id)):?>
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id;?>">
                                <?php endif;?>
                                <button class="btn btn-primary" id="submitRate">Submit</button>
                                <a class="btn btn-primary" id="cancelRate" href="javascript:void(0);">Cancel</a>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="wrongAns" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-value="no">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="error">
                            Oops
                        </div>
                        <div class="result-msg">
                            Your answer is incorrect!
                        </div>
                        <hr>
                        <div class="infomsg">
                            <a href="javascript:void(0);" id="continue"> CONTINUE </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rightAns" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-value="no">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <div class="green">
                                Awesome
                            </div>
                            <div class="result-msg">
                                You got that right!
                            </div>
                            <hr>
                            <div class="infomsg">
                                <a href="javascript:void(0);" id="continue"> CONTINUE </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="shareApp" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4>Share app with friends</h4>
                            <form action="/Home/shareApp" name="sentMail" id="sentMail" novalidate="novalidate" method="post">
                                <input id="mail-5" name="mail-5" type="text" placeholder="Enetr up to 5 email addresses">
                                <button id="mail-btn" name="mail-btn">Send</button>  
                                <a href="javascript:void(0);" class="personal-note">
                                    Add Personal Note
                                </a>
                            </form>  
                            <br><br>
                            <h4>Or share link via</h4>                            
                            <div id="copy-share" class="pull-left">www.GolearningBus.com</div>
                            <button id="copy-btn" name="copy-btn" onclick="CopyToClipboard('copy-share')">Copy Link</button>
                            <br>
                            <br>
                            <a class="social fbk" href="http://www.facebook.com/sharer/sharer.php?u=https://play.google.com/store/apps/details?id=com.wagmob.golearningbus" target="_blank">
                                <img src="/assets/img/FBS.png">
                            </a>
                            <br class="display-320">
                            <a class="social lin" href="http://www.linkedin.com/shareArticle?url=https://play.google.com/store/apps/details?id=com.wagmob.golearningbus" target="_blank">
                                <img src="/assets/img/ins.png">
                            </a>
                            <br class="display-320">
                            <a class="social gps" href="https://plus.google.com/share?url=https://play.google.com/store/apps/details?id=com.wagmob.golearningbus" target="_blank">
                                <img src="/assets/img/Gps.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="notifyModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <i class="ion-close-circled"></i>
                    <div class="modal-body">
                        <h4></h4>
                        <hr>
                        <div class="ndesc"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="notifydelModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Are you sure to delete this notification?</h4>
                        <hr>
                        <div class="ndesc text-center">
                            <button class="notityDel">Yes</button>
                            <button class="notityNo">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="enrollRmoveModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h4>Do you want to remove this course?</h4>
                            <hr>
                            <button id="yes" name="yes" class="yesnoen pull-right">Yes</button>
                            <button id="no" name="no" class="yesnoen pull-right">No</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="purchaseModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">                    
                    <div class="modal-body">
                        <img src="/assets/img/iEdu-logo-inner.png" class="pull-left">
                        <div class="clearfix padding-20"></div>  
                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" target="_blank">                            
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="FC3PEM4VK94XN">
                                <input type="hidden" name="return" value="http://stage.iedu.io/get-start/getResponse">
                                <input type="hidden" name="cancel_return" value="http://stage.iedu.io">
                                
                                <input type="hidden" name="on0" value="">
                                <select name="os0">
                                    <option value="Yearly Subscription">Get all courses of GoLearningBus Library for $9.99</option>
                                </select>                                
                                <input type="hidden" name="currency_code" value="USD">
                                <i>Please pay $9.99 to get complete access. Do you want to proceed?.</i>
                                <hr>  
                                <div class="form-group">                        
                                <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </div>
                                <div class="clearfix"></div>
                            </form> 
                        <div class="clearfix"></div>
                    </div>                    
                </div>
            </div>
        </div>

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
                                    alert('Enter a Valid Email Address, Thanks!');
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