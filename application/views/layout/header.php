            <div class="jumbotron">
                <div class="container">
                    <div class="top-head">
                        <div class="col-sm-1 col-md-1 col-lg-1 col-xs-12">
                            <a class="navbar-brand" href="">
                                <img src="/assets/img/GLB_icon.png">
                            </a>
                            <a href="<?php echo $fblink;?>">
                                <div class="the-social display-320">
                                    <img src="/assets/img/f_log.png">
                                </div>
                            </a>
                            <a href="<? echo 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode($client_redirect_url) . '&response_type=code&client_id=' . $client_id . '&access_type=online'?>">
                                <div class="the-social display-320">
                                    <img src="/assets/img/g_log.png">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
                            <form action="/Search" name="searchCourse" id="searchCourse-head" novalidate="novalidate" method="post">
                                <input type="text" placeholder="Search Here" id="top-search" name="top-search">
                                <i class="ion-android-search"></i>
                            </form>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                            <a href="<?php echo $fblink;?>">
                                <div class="the-social hide-320">
                                    <img src="/assets/img/f_log.png">
                                </div>
                            </a>
                            <a href="<? echo 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode($client_redirect_url) . '&response_type=code&client_id=' . $client_id . '&access_type=online'?>">
                                <div class="the-social hide-320">
                                    <img src="/assets/img/g_log.png">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <nav id="myNavbar" class="navbar navbar-default navbar-inverse" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="transs">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="container">
                            <ul class="nav navbar-nav">
                                <li>                                    
                                    <a href="/courses/<?php echo $catlink['professional'];?>">
                                        <img src="/assets/img/ic_professional.png"> Professional
                                    </a>
                                </li>
                                <li>
                                    <a href="/courses/<?php echo $catlink['college'];?>">
                                        <img src="/assets/img/ic_College.png"> College
                                    </a>
                                </li>
                                <li>
                                    <a href="/courses/<?php echo $catlink['school'];?>">
                                        <img src="/assets/img/ic_school.png"> School
                                    </a>
                                </li>
                                <li>
                                    <a href="/courses/<?php echo $catlink['language'];?>">
                                        <img src="/assets/img/ic_Language.png"> Language
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <?php if($this->session->userdata('mydata')['user_id']):?>
                                        <a class="page-scroll" href="/notification"> 
                                            <img src="/assets/img/Notification_icon.png">
                                            <?php if($this->session->userdata('notifys') > 0):?>
                                                <span class="shownotify">
                                                    <?php echo $this->session->userdata('notifys');?>
                                                </span>
                                            <?php endif;?>
                                        </a>
                                    <?php else:?>
                                        <a class="page-scroll" data-toggle="modal" title="Sign In" href="/sign-in"> 
                                            Sign In
                                        </a>
                                    <?php endif;?>                              
                                </li>
                                <li <?php if($this->session->userdata('mydata')['user_id']):?> style="padding-bottom: 4px;" <?php endif;?>>
                                    <?php if($this->session->userdata('mydata')['user_id']):?>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <div class="pro-circle">
                                                <img src="<?php echo $this->session->userdata('mydata')['image_url'];?>" width="30px" height="30px">
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" id="the-user">                            
                                            <li class="dropdown-submenu" id="profile-section">
                                                <a href="/profile/setting" class="pull-right btn">Edit</a>
                                                <img src="<?php echo $this->session->userdata('mydata')['image_url'];?>" width="50px" height="50px">
                                                <div class="pull-left">
                                                    <div>
                                                        <b><?php echo ucfirst($this->session->userdata('mydata')['first_name']).' '.ucfirst($this->session->userdata('mydata')['last_name']);?></b>
                                                    </div>
                                                    <div>
                                                        <?php echo $this->session->userdata('mydata')['email_id'];?>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a tabindex="-1" href="/profile">
                                                    ME &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </a>
                                            </li> 
                                            <li class="dropdown-submenu">
                                                <a tabindex="-1" href="/SignOut">
                                                    Sign Out
                                                </a>
                                            </li> 
                                        </ul>
                                    <?php else:?>
                                        <a class="page-scroll" data-toggle="modal" title="Sign Up" href="/sign-up"> 
                                            Sign Up
                                        </a>
                                    <?php endif;?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="head-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
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
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>