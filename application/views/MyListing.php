                <?php
                    $z = 0; $count = 4;
                    if(count($theCourse) < 4):
                        $count = count($theCourse);
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
                                        <div class="content-img">
                                            <img src="<?php echo $theCourse[$z]->image_url;?>">
                                        </div>
                                        <h4 class="title">
                                            <?php 
                                                $slug = urlencode(strtolower(str_replace(' ', '-', trim($theCourse[$z]->title)))."-".$theCourse[$z]->course_id);
                                                $urls = 'courses/'.strtolower(str_replace(' ', '-', trim($theCourse[$z]->category_title)).'-'.$theCourse[$z]->category_id);
                                            ?>
                                            <a href="/<?php echo $urls;?>/<?php echo $slug;?>" title="<?php echo $theCourse[$z]->title;?>">
                                                <?php echo $theCourse[$z]->title;?>
                                            </a>
                                        </h4>
                                        <div class="description">
                                            <?php echo substr($theCourse[$z]->description, 0, 90);?>
                                        </div>
                                        <div class="rateprice">                                
                                            <div class="pull-left">
                                                <div class="">
                                                    <?php for($x=0;$x<$theCourse[$z]->course_rating;$x++):?>
                                                        <i class="ion-android-star"></i>
                                                    <?php endfor;?>   
                                                </div>
                                                <div class="">
                                                    <?php if($theCourse[$z]->price == 0):?>
                                                        FREE
                                                    <?php else:?>
                                                        $<?php echo $theCourse[$z]->price;?>
                                                    <?php endif;?> 
                                                </div>
                                            </div>
                                            <a data-toggle="modal" href="#enrollRmoveModal" class="pull-right enrolled" data-value="<?php echo $theCourse[$z]->course_id;?>">
                                                Enrolled
                                            </a>
                                        </div>
                                    </div>
                                <?php endfor;?>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1"></div>    
                        </div>
                    </div>
                    <?php 
                        if(count($theCourse) == $count):
                            $count++;
                        else:
                            if(count($theCourse) < ($count+4)):
                                $count = count($theCourse);
                            else:
                                $count = $count + 4;
                            endif;
                        endif;
                    ?>
                <?php } while($count <= count($theCourse)); ?>

                <?php if(count($theCourse) >= 20):?>
                    <div class="row my-row display-none">
                        <a href="javascript:void(0);" class="enroll" data-title="<?php echo ($this->input->post('offset')+20);?>">
                            Load More
                        </a>
                    </div>
                <?php endif;?>