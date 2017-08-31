            <?php 
                $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                $ok_url = array('base_url' => $base_url);
                if($profile->is_share == 0):
                    $appcls = 'btn-default off';
                    $remcls = 'btn-primary';
                else:
                    $appcls = 'btn-primary';
                    $remcls = 'btn-default off';
                endif;
            ?>

            <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
            <aside id="wrapper" class="assigment for-profile">                                
                <div class="set-div">
                    <img src="/assets/img/settings.png" class="animated fadeInLeft is-closed pull-left" data-toggle="offcanvas" style="cursor: pointer;">  <div>Settings</div>
                </div>
                <div class="set-element">
                    <a href="/profile/setting">
                        Profile Setting
                    </a>
                </div>
                <div class="set-element">
                    <a href="/change-password">
                        Change Password
                    </a>
                </div>
                <div class="set-element">
                    <a href="#shareApp" data-toggle="modal" class="page-scroll">
                        Share with friends
                    </a>
                </div>
                <div class="set-element">
                    Share Progress on Leaderboard
                    <input checked data-toggle="toggle" data-style="ios" type="checkbox" id="for-share-leader" name="for-share-leader">
                </div>
            </aside>

            <div class="container">                
                <div class="profile-page">
                    <div class="row">                        
                        <div class="clearfix"></div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10"> 
                            <div class="pro-img pull-left">
                                <img src="<?php echo $profile->image_url;?>">
                            </div>
                            <div class="pull-left pro-text">
                                <div class="pro-name">
                                    <?php echo ucfirst($profile->first_name).' '.ucfirst($profile->last_name);?>
                                </div>
                                <div class="pro-mail">
                                    <?php echo $profile->email_id;?>        
                                </div>
                                <div class="pro-score">
                                    Course completed <?php echo (int)((int)($profile->assignment_status->completed) / (int)($profile->assignment_status->total) * 100);?>%
                                </div>
                            </div> 
                            <img src="/assets/img/settings.png" class="animated fadeInLeft pull-right is-closed" data-toggle="offcanvas" style="cursor: pointer;">
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    </div>
                </div>
            </div>
            
            <section id="inner-search" style="margin-top: 0;">
                <div class="row">
                    <div>
                        <a href="<?php echo $base_url;?>">
                            <img src="/assets/img/Home icon.png" class="bcrumbimg">
                        </a>
                         / Me
                    </div>
                </div>
            </section>
            
            <div class="container">
                <div class="row">
                    <div class="achieve">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10"> 
                            <h3 class="">My Achievements</h3>       
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    </div>
                </div>

                <?php if(count($courseDetail) == 0):?>
                    <div class="row">
                        <div class="search-page">
                            <div class="col-sm-1 col-md-1 col-lg-1"></div>
                            <div class="col-sm-10 col-md-10 col-lg-10 set-profile">
                                <div>
                                    You are so close to achieve something!
                                </div>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1"></div>    
                        </div>
                    </div>
                <?php else:?>
                    <?php for($z=0;$z<count($courseDetail);$z++):?>
                        <div class="row">
                            <div class="search-page">
                                <div class="col-sm-1 col-md-1 col-lg-1"></div>
                                <div class="col-sm-10 col-md-10 col-lg-10 set-profile">
                                    <div class="col-sm-4 col-md-2" style="height: auto;">
                                        <img src="<?php echo $courseDetail[$z]->image_url;?>">
                                    </div>
                                    <div class="col-sm-8 col-md-10">
                                        <?php echo $courseDetail[$z]->title;?><br><br>
                                        <span class="green">100% Complete</span>
                                        <a href="<?php echo $base_url."/certificate?data=".base64_encode($courseDetail[$z]->certificate_url);?>" target="_blank" class="pull-right text-center">
                                            <img src="/assets/img/bagde_green.png">
                                            <br>
                                            <span class="green">
                                                Download Certificate
                                            </span>
                                        </a>
                                    </div>                        
                                </div>
                                <div class="col-sm-1 col-md-1 col-lg-1"></div>    
                            </div>
                        </div>
                        <br>
                    <?php endfor;?>
                <?php endif;?>
            </div>

            <style>
                .toggle.ios, .toggle-on.ios, .toggle-off.ios { 
                    border-radius: 20px; 
                    color: #CC7FFF; 
                    border: 1px solid #9900ff; 
                }

                .toggle.ios .toggle-handle {  
                    background: #9900ff none repeat scroll 0 0;
                    border: 1px solid #9900ff;
                    border-radius: 20px;
                    margin-top: -11px;
                    padding: 0 10px; 
                }

                .toggle.btn { 
                    display: block;
                    float: right;
                    margin-top: 6px;
                    min-height: 0;
                    min-width: 0;
                    width: 25px; 
                }

                .toggle-group {
                    display: inline;
                }

                label.btn.btn-primary.toggle-on {
                    background: #cc7fff none repeat scroll 0 0;
                    border: 1px solid #cc7fff;
                }
            </style>

            <script type="text/javascript">
                setTimeout(function(){ 
                    $(".toggle").removeClass('<?php echo $remcls;?>');
                    $(".toggle").addClass('<?php echo $appcls;?>');
                }, 5000);
            </script>