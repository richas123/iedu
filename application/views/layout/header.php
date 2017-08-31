        <div class="container">
            <div class="jumbotron">
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
                                <a href="/courses/<?php echo $catlink['professional'];?>">Professional</a>
                            </li>
                            <li>
                                <a href="/courses/<?php echo $catlink['college'];?>">College</a>
                            </li>
                            <li>
                                <a href="/courses/<?php echo $catlink['school'];?>">School</a>
                            </li>
                            <li>
                                <a href="/courses/<?php echo $catlink['language'];?>">Language</a>
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