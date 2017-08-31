        <nav id="innerNavbar" class="navbar navbar-default navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle animated fadeInLeft is-closed" data-toggle="transs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $base_url;?>">
                        <img src="/assets/img/Final_iEdu.io-logo.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarCollapse">                    
                    <form action="/Search" name="searchCourse" id="searchCourse-head" novalidate="novalidate" method="post">
                        <div class="all-search">
                            <?php 
                                if(isset($_POST['top-search'])):
                                    $vals = $_POST['top-search'];
                                else:
                                    $vals = '';
                                endif;
                            ?>
                            <input id="top-search" name="top-search" type="text" value="<?php echo $vals;?>">
                            <button id="search-top" name="search-top"></button>    
                        </div>
                    </form>                            

                    <ul class="nav navbar-nav">
                        <li class="the-course">
                            <?php if($this->session->userdata('mydata')['user_id']):?>
                                <a role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0);">
                                    My Courses 
                                </a>
                                <?php if(count($myCourse) > 0):?>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" id="mycourse">
                                        <?php 
                                            $ct = 3; 
                                            if(count($myCourse) < 3): $ct = count($myCourse); endif;
                                        ?>
                                        <?php for($z=0;$z<$ct;$z++):?>
                                            <li class="">
                                                <a tabindex="-1" href="/<?php echo $myCourse[$z]->url;?>">
                                                    <img src="<?php echo $myCourse[$z]->image_url;?>" width="50px">
                                                    <?php echo $myCourse[$z]->title;?>
                                                </a>
                                            </li>
                                        <?php endfor;?>
                                        <li class="viewall">
                                            <a tabindex="-1" href="/my-courses" style="color: #9900ff !important;">View All</a>
                                        </li>
                                    </ul>
                                <?php else:?>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" id="mycourse">
                                        <li class="">
                                            <a tabindex="-1" href="javascript:void(0);">
                                                No courses
                                            </a>
                                        </li>
                                    </ul>
                                <?php endif;?>
                            <?php else:?>
                                <a role="button" data-toggle="modal" href="/sign-in">
                                    My Courses 
                                </a>
                            <?php endif;?>
                        </li>
                    </ul>
                    
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Discover <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" id="discover">                            
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="/courses/<?php echo $catlink['professional'];?>">
                                        For Professionals 
                                    </a>
                                </li>                                                   
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="/courses/<?php echo $catlink['college'];?>">
                                        For College 
                                    </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="/courses/<?php echo $catlink['school'];?>">
                                        For School 
                                    </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="/courses/<?php echo $catlink['language'];?>">
                                        Languages 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <?php if($this->session->userdata('mydata')['user_id']):?>
                                <a class="page-scroll" href="/notification" title="Notification"> 
                                    <img src="/assets/img/Notification_icon.png">
                                    <?php if($this->session->userdata('notifys') > 0):?>
                                        <span class="showinnnotify">
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

        <?php if($this->uri->segment(1) != 'profile'):?>
            <div class="row" id="landing-slider">                
                <div class="col-md-12">
                    <header id="myCarousel" class="carousel slide">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="fill" style="background-image:url('/assets/img/banner3.png');"></div>
                                <div class="carousel-caption">
                                    <h2 class="title-head">Learn Web Development</h2>
                                    <div class="description-head">
                                        Web Development is a board term for the work involved in
                                    developing a web site for the Internet (Word Wide Web) or an intra-net (a private network)...
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="fill" style="background-image:url('/assets/img/banner1.png');"></div>
                                <div class="carousel-caption">
                                    <h2 class="title-head">Learn Web Development</h2>
                                    <div class="description-head">
                                        Web Development is a board term for the work involved in
                                    developing a web site for the Internet (Word Wide Web) or an intra-net (a private network)...
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="fill" style="background-image:url('/assets/img/banner2.png');"></div>
                                <div class="carousel-caption">
                                    <h2 class="title-head">Learn Web Development</h2>
                                    <div class="description-head">
                                        Web Development is a board term for the work involved in
                                    developing a web site for the Internet (Word Wide Web) or an intra-net (a private network)...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>                    
                </div>
            </div>
        <?php endif;?>