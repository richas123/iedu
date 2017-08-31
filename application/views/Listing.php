                <?php
                    $z = 0; $count = 4;
                    if(count($course) < 4):
                        $count = count($course);
                    endif;
                ?>  
                <?php do { ?>              
                    <div class="row">
                        <div class="start-page">
                            <div class="col-sm-1 col-md-1 col-lg-1"></div>
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <h3>
                                    <!---  -->                                               
                                </h3>                            
                                <?php for($z=$z;$z<$count;$z++):?>
                                    <?php if($z%2 == 0): $cls = 'arrenge-left'; else: $cls = ''; endif;?>
                                    <div class="col-sm-6 col-md-3 col-lg-3 content-box-4 <?php echo $cls;?>">
                                        <?php 
                                            $slug = urlencode(strtolower(str_replace(' ', '-', trim($course[$z]->title)))."-".$course[$z]->course_id);
                                            $myurl = 'courses/'.$this->uri->segment(3).'/'.$slug;
                                        ?>                                        
                                        <div class="content-img">
                                            <a href="/<?php echo $myurl;?>">
                                                <img src="<?php echo $course[$z]->image_url;?>">
                                            </a>
                                        </div>
                                        <h4 class="title">                                            
                                            <a href="/<?php echo $myurl;?>" title="<?php echo $course[$z]->title;?>">
                                                <?php echo $course[$z]->title;?>
                                            </a>
                                        </h4>
                                        <div class="description">
                                            <?php echo substr($course[$z]->description, 0, 90);?>
                                        </div>
                                        <div class="rateprice">                                
                                            <div class="pull-left">
                                                <div class="">
                                                    <?php for($x=0;$x<$course[$z]->course_rating;$x++):?>
                                                        <i class="ion-android-star"></i>
                                                    <?php endfor;?>   
                                                </div>
                                                <div class="">
                                                    <?php if($course[$z]->price == 0):?>
                                                        FREE
                                                    <?php else:?>
                                                        $<?php echo $course[$z]->price;?>
                                                    <?php endif;?> 
                                                </div>
                                            </div>
                                            <?php if($this->session->userdata('mydata')['user_id']):?>
                                                <?php if($course[$z]->subscription_id == 0):?>
                                                    <a href="/enroll-course/<?php echo $this->uri->segment(3).'/'.$slug;?>" class="pull-right enroll">
                                                        Enroll Now
                                                    </a>
                                                <?php else:?>
                                                    <a data-toggle="modal" href="#enrollRmoveModal" class="pull-right enrolled" data-value="<?php echo $course[$z]->course_id;?>">
                                                        Enrolled
                                                    </a>
                                                <?php endif;?>
                                            <?php else:?>
                                                <a data-toggle="modal" href="/sign-in" class="pull-right enroll">
                                                    Enroll Now
                                                </a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                <?php endfor;?>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1"></div>    
                        </div>
                    </div>
                    <?php 
                        if(count($course) == $count):
                            $count++;
                        else:
                            if(count($course) < ($count+4)):
                                $count = count($course);
                            else:
                                $count = $count + 4;
                            endif;
                        endif;
                    ?>
                <?php } while($count <= count($course)); ?>

                <?php if(count($course) >= 20):?>
                    <div class="row pag-row display-none">
                        <a href="javascript:void(0);" class="enroll" data-title="<?php echo ($this->input->post('offset')+20);?>" data-url="<?php echo $this->uri->segment(3);?>">
                            Load More
                        </a>
                    </div>
                <?php endif;?>