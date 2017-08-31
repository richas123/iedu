            <section id="inner-search">    
                <div class="row">
                    <div>
                        <a href="<?php echo $base_url;?>">
                            <img src="/assets/img/Home icon.png" class="bcrumbimg">
                        </a> / 
                        <a href="/<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2);?>">
                            <?php 
                                $bread = explode('-', $this->uri->segment(2)); $breadcrumb = '';
                                for($t=0;$t<count($bread)-1;$t++): 
                                    if($t>0): $breadcrumb .= ' '; endif;
                                    $breadcrumb .= $bread[$t]; 
                                endfor;
                                echo 'For '.ucfirst($breadcrumb);
                            ?>
                        </a> / 
                        <?php echo $courseDesc[0]->title;?>
                    </div>
                </div>
            </section>
            <br>
            <?php $totalass = 0; $completeass = 0;?>
            <div class="container">
                <div class="row">
                    <div class="search-page">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10">                     
                            <div class="col-xs-3 col-sm-5 col-md-3">
                                <img src="<?php echo $courseDesc[0]->image_url;?>" class="course-image">
                            </div>
                            <div class="col-xs-9 col-sm-7 col-md-9">
                                <h4 class="title">
                                    <?php echo $courseDesc[0]->title;?>
                                </h4>
                                <div class="description">
                                    <?php echo $courseDesc[0]->description;?>
                                </div>
                                <?php if($this->session->userdata('mydata')['user_id']):?>
                                    <?php if($courseDesc[0]->subscription_id == 0):?>                                    
                                        <div class="rate1">
                                            <?php if($courseDesc[0]->price == 0):?>
                                                FREE
                                            <?php else:?>
                                                $<?php echo $courseDesc[0]->price;?>
                                            <?php endif;?> 
                                        </div>
                                        <div class="rate2">
                                            <?php for($x=0;$x<$courseDesc[0]->course_rating;$x++):?>
                                                <i class="ion-android-star"></i>
                                            <?php endfor;?> 
                                        </div>                                    
                                        <a href="/enroll-course/<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3);?>" class="enroll">
                                            Enroll Now
                                        </a>
                                    <?php else:?>
                                        <?php 
                                            for($z=0;$z<count($courseDetail);$z++):
                                                for($x=0;$x<count($courseDetail[$z]->subsections);$x++):
                                                    $completeass += $courseDetail[$z]->subsections[$x]->completed_assignments;
                                                    $totalass += $courseDetail[$z]->subsections[$x]->total_assignments;
                                                endfor;
                                            endfor;
                                        ?>
                                        <div class="set-top">
                                            <a class="enroll" data-toggle="modal" title="Rate this course" href="#rateCourse">
                                                Rate this Course
                                            </a>   
                                            <img src="/assets/img/badge_icon.png" class="pull-right sl-learning"> 
                                            <div class="box pull-right">
                                                <div class="score pull-left"></div>
                                                <div class="bar">
                                                    <div class="progress"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                    <div class="dot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                <?php endif;?>
                            </div>     
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>    
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="curri-lead">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <h3 class="curriculum pull-left">
                                <a href="javascript:void(0);"> Curriculum </a>
                            </h3>
                            <h3 class="leaderboardLearning pull-left">
                                <?php if($this->session->userdata('mydata')['user_id']):?>
                                    <a href="/leaderboard/<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3);?>"> Leaderboard </a>
                                <?php endif;?>
                            </h3>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    </div>
                </div>           
                <br>
                <div class="row">
                    <div class="accordion-box">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <aside class="accordion">
                                <?php for($z=0;$z<count($courseDetail);$z++):?>
                                    <h1>
                                        <?php echo $courseDetail[$z]->title;?>
                                        <i class="ion-ios-plus-empty pull-right"></i>
                                    </h1>
                                    <div>                                        
                                        <?php 
                                            if($this->session->userdata('mydata')['user_id']):
                                                $sectionCount = count($courseDetail[$z]->subsections);
                                            else:
                                                $sectionCount = count($courseDetail[$z]->subsections);
                                            endif;
                                        ?>
                                        <?php for($x=0;$x<$sectionCount;$x++):?>
                                            <h2>
                                                <div class="nums">
                                                    <?php echo ($x+1);?>
                                                </div>
                                                <div class="track_vt7pu8-o_O-bottomTrack_ca0bk7" data-reactid="37" style="background: #9b9b9b none repeat scroll 0% 0%;"></div>
                                                <?php 
                                                    if($z == 0):
                                                        if($x < 2):
                                                            $assUrl = '/courses/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.strtolower(str_replace(' ', '-', trim($courseDetail[$z]->subsections[$x]->title))).'-'.$courseDetail[$z]->subsections[$x]->subsection_id;
                                                        else:
                                                            if($this->session->userdata('mydata')['user_id']):
                                                                if($master_subscription):
                                                                    $assUrl = '/courses/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.strtolower(str_replace(' ', '-', trim($courseDetail[$z]->subsections[$x]->title))).'-'.$courseDetail[$z]->subsections[$x]->subsection_id;
                                                                else:
                                                                    $assUrl = 'javascript:void(0);';
                                                                endif;
                                                            else:
                                                                $assUrl = 'javascript:void(0);';
                                                            endif;
                                                        endif;
                                                    else:
                                                        if($this->session->userdata('mydata')['user_id']):
                                                            if($master_subscription):
                                                                $assUrl = '/courses/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.strtolower(str_replace(' ', '-', trim($courseDetail[$z]->subsections[$x]->title))).'-'.$courseDetail[$z]->subsections[$x]->subsection_id;
                                                            else:
                                                                $assUrl = 'javascript:void(0);';
                                                            endif;
                                                        else:
                                                            $assUrl = 'javascript:void(0);';
                                                        endif;
                                                    endif;
                                                    if($this->session->userdata('mydata')['user_id']):
                                                        if($courseDetail[$z]->subsections[$x]->completed_assignments == $courseDetail[$z]->subsections[$x]->total_assignments):
                                                            $colors = 'green-bg';
                                                        else:
                                                            $colors = '';
                                                        endif;
                                                    else:
                                                        $colors = '';
                                                    endif;
                                                ?>
                                                <div class="circle-div <?php echo $colors;?>"></div>
                                                <a href="<?php echo $assUrl;?>">
                                                    <?php echo $courseDetail[$z]->subsections[$x]->title;?>
                                                </a>
                                                <?php if($z == 0):?>
                                                    <?php if($x < 2):?>
                                                        <?php if($this->session->userdata('mydata')['user_id']):?>
                                                            <?php if($master_subscription):?>
                                                                <i class="pull-right green perci">
                                                                    <?php echo (int)(($courseDetail[$z]->subsections[$x]->completed_assignments/$courseDetail[$z]->subsections[$x]->total_assignments) * 100).'%';?>
                                                                </i>
                                                            <?php else:?>
                                                                <a href="<?php echo $assUrl;?>">
                                                                    <button class="collapse-pre pull-right">Preview</button>
                                                                </a>
                                                            <?php endif;?>
                                                        <?php else:?>
                                                            <a href="/sign-in" data-toggle="modal">
                                                                <button class="collapse-pre pull-right">Preview</button>
                                                            </a>
                                                        <?php endif;?>
                                                    <?php else:?>
                                                        <?php if($this->session->userdata('mydata')['user_id']):?>
                                                            <?php if($master_subscription):?>
                                                                <i class="pull-right green perci">
                                                                    <?php echo (int)(($courseDetail[$z]->subsections[$x]->completed_assignments/$courseDetail[$z]->subsections[$x]->total_assignments) * 100).'%';?>
                                                                </i>
                                                            <?php else:?>
                                                                <a href="#purchaseModal" data-toggle="modal">
                                                                    <i class="ion-ios-locked pull-right"></i>
                                                                </a>
                                                            <?php endif?>
                                                        <?php else:?>
                                                            <a href="/sign-in" data-toggle="modal">
                                                                <i class="ion-ios-locked pull-right"></i>
                                                            </a>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php else:?>
                                                    <?php if($this->session->userdata('mydata')['user_id']):?>
                                                        <?php if($master_subscription):?>
                                                            <i class="pull-right green perci">
                                                                <?php echo (int)(($courseDetail[$z]->subsections[$x]->completed_assignments/$courseDetail[$z]->subsections[$x]->total_assignments) * 100).'%';?>
                                                            </i>
                                                        <?php else:?>
                                                            <a href="#purchaseModal" data-toggle="modal">
                                                                <i class="ion-ios-locked pull-right"></i>
                                                            </a>
                                                        <?php endif;?>
                                                    <?php else:?>
                                                        <a href="/sign-in" data-toggle="modal">
                                                            <i class="ion-ios-locked pull-right"></i>
                                                        </a>
                                                    <?php endif;?>
                                                <?php endif;?>
                                            </h2>
                                        <?php endfor;?>                                        
                                    </div>
                                <?php endfor;?>
                            </aside>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="certify">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <?php if($this->session->userdata('mydata')['user_id']):?>
                            <?php if($completeass == $totalass && $totalass > 0): $bgcert = 'green-bg'; else: $bgcert = ''; endif;?>
                        <?php else:?>
                            <?php  $bgcert = '';?>
                        <?php endif;?>
                        <div class="col-sm-10 col-md-10 col-lg-10 <?php echo $bgcert;?>">                    
                            <div class="pull-left">
                                Get Certificate to Complete All Level of this Course
                            </div>
                            <img src="/assets/img/badge_big_icon.png" class="pull-right">
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    </div>                
                </div>
            </div>

            <script type="text/javascript">
                setTimeout(function(){                 
                    getPercent(<?php echo $completeass;?>, <?php echo $totalass;?>);
                }, 4000);          
            </script>