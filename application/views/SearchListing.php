                <?php if(count($courseDetail) == 0):?>
                    <div class="row"></div>
                <?php else:?>

                    <?php for($z=0;$z<count($courseDetail);$z++):?>
                        <?php 
                            $slug = urlencode(strtolower(str_replace(' ', '-', trim($courseDetail[$z]->title)))."-".$courseDetail[$z]->course_id);
                            $myurl = 'courses/'.strtolower(str_replace(' ', '-', trim($courseDetail[$z]->category_title))).'-'.$courseDetail[$z]->category_id.'/'.$slug;
                        ?>  
                        <div class="row">
                            <div class="search-result">
                                <div class="col-sm-12 col-md-12 col-lg-12">                     
                                    <div class="col-sm-4 col-md-2">
                                        <a href="/<?php echo $myurl;?>" class="title">
                                            <img src="<?php echo $courseDetail[$z]->image_url;?>">
                                        </a>
                                    </div>
                                    <div class="col-sm-8 col-md-10">
                                        <a href="/<?php echo $myurl;?>" class="title">
                                            <?php echo $courseDetail[$z]->title;?>
                                        </a>
                                        <div class="description sl">
                                            <?php //echo $courseDetail[$z]->description;?>
                                        </div>
                                        <div class="pull-left">
                                            <div class="rate1">
                                                <?php for($x=0;$x<$courseDetail[$z]->course_rating;$x++):?>
                                                    <i class="ion-android-star green"></i>
                                                <?php endfor;?>  
                                                <?php if($courseDetail[$z]->course_rating < 5):?>
                                                    <?php for($x=$x;$x<5;$x++):?>
                                                        <i class="ion-android-star"></i>
                                                    <?php endfor;?>
                                                <?php endif;?>
                                            </div>
                                            <div class="rate2">
                                                <?php if($courseDetail[$z]->price == 0):?>
                                                    FREE
                                                <?php else:?>
                                                    $<?php echo $courseDetail[$z]->price;?>
                                                <?php endif;?> 
                                            </div>
                                        </div>
                                        <?php if($this->session->userdata('mydata')['user_id']):?>
                                            <?php if($courseDetail[$z]->subscription_id == 0):?>
                                                <a href="/enroll-course/<?php echo strtolower(str_replace(' ', '-', trim($courseDetail[$z]->category_title))).'-'.$courseDetail[$z]->category_id.'/'.$slug;?>" class="pull-right enroll">
                                                    Enroll Now
                                                </a>
                                            <?php else:?>
                                                <a data-toggle="modal" href="#enrollRmoveModal" class="pull-right enrolled" data-value="<?php echo $courseDetail[$z]->course_id;?>">
                                                    Enrolled
                                                </a>                                            
                                            <?php endif;?>
                                        <?php else:?>
                                            <a data-toggle="modal" href="/sign-in" class="pull-right enroll">
                                                Enroll Now
                                            </a>                                        
                                        <?php endif;?>
                                        <div class="clearfix"></div>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                        <br>
                    <?php endfor;?>
                    <?php if(count($courseDetail) == 10):?>
                        <div class="row search-row display-none">
                            <a href="javascript:void(0);" class="enroll" data-title="<?php echo ($this->input->post('offset')+10);?>" data-value="<?php echo $this->input->post('top-search');?>">
                                Load More
                            </a>
                        </div>
                    <?php endif;?>
                <?php endif;?>