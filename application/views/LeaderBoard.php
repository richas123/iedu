            <section id="inner-search">    
                <div class="row">
                    <div>
                        <a href="<?php echo $base_url;?>">
                            <img src="/assets/img/Home icon.png" class="bcrumbimg">
                        </a> / 
                        <a href="/<?php echo 'courses/'.$this->uri->segment(2);?>">
                            <?php 
                                $bread = explode('-', $this->uri->segment(2)); $breadcrumb = '';
                                for($t=0;$t<count($bread)-1;$t++): 
                                    if($t>0): $breadcrumb .= ' '; endif;
                                    $breadcrumb .= $bread[$t]; 
                                endfor;
                                echo "For ".ucfirst($breadcrumb);
                            ?>
                        </a> / 
                        <a href="/<?php echo 'courses/'.$this->uri->segment(2).'/'.$this->uri->segment(3);?>">
                            <?php echo $courseDesc[0]->title;?> 
                        </a> / 
                       Leaderboard
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
                                <div class="description learning">
                                    <?php echo $courseDesc[0]->description;?>
                                </div>
                                <?php 
                                    for($z=0;$z<count($courseDetail);$z++):
                                        for($x=0;$x<count($courseDetail[$z]->subsections);$x++):
                                            $completeass += $courseDetail[$z]->subsections[$x]->completed_assignments;
                                            $totalass += $courseDetail[$z]->subsections[$x]->total_assignments;
                                        endfor;
                                    endfor;
                                ?>
                                <div class="set-top">
                                    <a href="/courses/<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3);?>" class="enroll">
                                        Continue Learning
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
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>    
                    </div>
                </div>
                <br>
                <div class="row leadcurri">
                    <div class="curri-lead">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <h3 class="curriculumRate pull-left">
                                <a href="/courses/<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3);?>"> Curriculum </a>
                            </h3>
                            <h3 class="leaderboardRate pull-left">
                                <a href="javascript:void(0);"> Leaderboard </a>
                            </h3>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="Leaderboard-box">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <?php for($z=0;$z<count($leaderboard);$z++):?>
                                <div class="inner-board">
                                    <img src="<?php echo $leaderboard[$z]->image_url;?>" width="25px">
                                    <?php echo $leaderboard[$z]->first_name.' '.$leaderboard[$z]->last_name;?>
                                    <span class="pull-right">
                                        <?php
                                            echo (int)(($leaderboard[$z]->completed / $leaderboard[$z]->total) * 100).'%';
                                        ?>
                                    </span>
                                </div>
                            <?php endfor;?>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="certify">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10">                    
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