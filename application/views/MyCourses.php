            <section id="inner-search">                
                <div class="row">
                    <div>
                        <a href="<?php echo $base_url;?>">
                            <img src="/assets/img/Home icon.png" class="bcrumbimg">
                        </a>
                         / My Course                    
                    </div>
                </div>                
            </section>
            
            <div class="container container-data">
                <?php
                    $z = 0; $count = 4;
                    if(count($theCourse) < 4):
                        $count = count($theCourse);
                    endif;
                ?>  
                <?php do { ?>              
                    <div class="row">
                        <div class="start-page">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>
                                    <!---  -->                                               
                                </h3>                            
                                <?php for($z=$z;$z<$count;$z++):?>
                                    <?php if($z%2 == 0): $cls = 'arrenge-left'; else: $cls = ''; endif;?>
                                    <div class="col-sm-6 col-md-3 col-lg-3 content-box-4 <?php echo $cls;?>">
                                        <div class="content-img">
                                            <img src="<?php echo $theCourse[$z]->image_url;?>">
                                        </div>
                                        <h4 class="title" title="<?php echo $theCourse[$z]->title;?>">
                                            <?php 
                                                $slug = urlencode(strtolower(str_replace(' ', '-', trim($theCourse[$z]->title)))."-".$theCourse[$z]->course_id);
                                                $urls = 'courses/'.strtolower(str_replace(' ', '-', trim($theCourse[$z]->category_title)).'-'.$theCourse[$z]->category_id);
                                            ?>
                                            <a href="/<?php echo $urls;?>/<?php echo $slug;?>">
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
                                                        <i class="ion-android-star green"></i>
                                                    <?php endfor;?>   
                                                    <?php if($theCourse[$z]->course_rating < 5):?>
                                                        <?php for($x=$x;$x<5;$x++):?>
                                                            <i class="ion-android-star"></i>
                                                        <?php endfor;?>
                                                    <?php endif;?>
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
                        <a href="javascript:void(0);" class="enroll" data-title="20">
                            Load More
                        </a>
                    </div>
                <?php endif;?>                
            </div>