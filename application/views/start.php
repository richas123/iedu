            <?php for($a=0;$a<count($categories);$a++):?>
                <div class="container">
                    <div class="row">
                        <div class="start-page">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>
                                    For <?php echo $categories[$a]->title?> <small>(<?php echo count($categories[$a]->courses);?>)</small>
                                    <?php if(count($categories[$a]->courses) > 4):?>
                                        <a href="/<?php echo 'courses/'.strtolower(str_replace(' ', '-', trim($categories[$a]->title))).'-'.$categories[$a]->category_id;?>" class="pull-right">More</a>
                                    <?php endif;?>                                                        
                                </h3>
                                <?php
                                    $count = 4;
                                    if(count($categories[$a]->courses) < 4):
                                        $count = count($categories[$a]->courses);
                                    endif;
                                ?>
                                <?php for($z=0;$z<$count;$z++):?>
                                    <?php if($z%2 == 0): $cls = 'arrenge-left'; else: $cls = ''; endif;?>
                                    <div class="col-sm-6 col-md-3 col-lg-3 content-box-4 <?php echo $cls;?>">
                                        <?php 
                                            $slug = strtolower(str_replace(' ', '-', trim($categories[$a]->courses[$z]->title)))."-".$categories[$a]->courses[$z]->course_id;
                                            $myurl = 'courses/'.strtolower(str_replace(' ', '-', trim($categories[$a]->title))).'-'.$categories[$a]->category_id.'/'.$slug;
                                        ?>
                                        <div class="content-img">
                                            <a href="/<?php echo $myurl;?>">
                                                <img src="<?php echo $categories[$a]->courses[$z]->image_url;?>">
                                            </a>
                                        </div>
                                        <h4 class="title">
                                            <a href="/<?php echo $myurl;?>" title="<?php echo $categories[$a]->courses[$z]->title;?>">
                                                <?php echo $categories[$a]->courses[$z]->title;?>
                                            </a>
                                        </h4>
                                        <div class="description">
                                            <?php echo substr($categories[$a]->courses[$z]->description, 0, 90);?>
                                        </div>
                                        <div class="rateprice">                                
                                            <div class="pull-left">
                                                <div class="">
                                                    <?php for($x=0;$x<$categories[$a]->courses[$z]->course_rating;$x++):?>
                                                        <i class="ion-android-star green"></i>
                                                    <?php endfor;?> 
                                                    <?php if($categories[$a]->courses[$z]->course_rating < 5):?>
                                                        <?php for($x=$x;$x<5;$x++):?>
                                                            <i class="ion-android-star"></i>
                                                        <?php endfor;?>
                                                    <?php endif;?>
                                                </div>
                                                <div class="">
                                                    <?php if($categories[$a]->courses[$z]->price == 0):?>
                                                        FREE
                                                    <?php else:?>
                                                        $<?php echo $categories[$a]->courses[$z]->price;?>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                            <?php if($this->session->userdata('mydata')['user_id']):?>
                                                <?php if($categories[$a]->courses[$z]->course_subscription == 0):?>
                                                    <a href="/enroll-course/<?php echo strtolower(str_replace(' ', '-', trim($categories[$a]->title))).'-'.$categories[$a]->category_id;?>/<?php echo $slug;?>" class="pull-right enroll">
                                                        Enroll Now
                                                    </a>
                                                <?php else:?>
                                                    <a data-toggle="modal" href="#enrollRmoveModal" class="pull-right enrolled" data-value="<?php echo $categories[$a]->courses[$z]->course_id;?>">
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
                        </div>
                    </div>
                </div>
            <?php endfor;?>
            