            <div class="row no-padding no-margin">
                <div id="featured">
                    <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <h4 class="main-text">
                            The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin. 
                        </h4>
                        <div class="col-sm-12 col-md-3 col-lg-3 content-box-4 arrenge-left">
                            <?php $slug = strtolower(str_replace(' ', '-', trim($profession[0]->title)))."-".$profession[0]->course_id;?>
                            <div class="content-img">
                                <a href="/courses/<?php echo $catlink['professional'];?>/<?php echo $slug;?>">
                                    <img src="<?php echo $profession[0]->image_url;?>">
                                </a>
                            </div>
                            <h4 class="title">
                                <a href="/courses/<?php echo $catlink['professional'];?>/<?php echo $slug;?>">
                                    <?php echo $profession[0]->title;?>
                                </a>
                            </h4>
                            <div class="description">
                                <?php echo $profession[0]->description;?>
                            </div>
                            <div class="rateprice">
                                <div class="pull-left">
                                    <?php if($profession[0]->price == 0):?>
                                        FREE
                                    <?php else:?>
                                        $<?php echo $profession[0]->price;?>
                                    <?php endif;?>
                                </div>
                                <div class="pull-right">
                                    <?php for($x=0;$x<$profession[0]->course_rating;$x++):?>
                                        <i class="ion-android-star"></i>
                                    <?php endfor;?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 content-box-4">
                            <?php $slug = strtolower(str_replace(' ', '-', trim($school[0]->title)))."-".$school[0]->course_id;?>
                            <div class="content-img">
                                <a href="/courses/<?php echo $catlink['school'];?>/<?php echo $slug;?>">
                                    <img src="<?php echo $school[0]->image_url;?>">
                                </a>
                            </div>
                            <h4 class="title">                                
                                <a href="courses/<?php echo $catlink['school'];?>/<?php echo $slug;?>">
                                    <?php echo $school[0]->title;?>
                                </a>
                            </h4>
                            <div class="description">
                                <?php echo $school[0]->description;?>
                            </div>
                            <div class="rateprice">
                                <div class="pull-left">
                                    <?php if($school[0]->price == 0):?>
                                        FREE
                                    <?php else:?>
                                        $<?php echo $school[0]->price;?>
                                    <?php endif;?>
                                </div>
                                <div class="pull-right">
                                    <?php for($x=0;$x<$school[0]->course_rating;$x++):?>
                                        <i class="ion-android-star"></i>
                                    <?php endfor;?>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-sm-12 col-md-3 col-lg-3 content-box-4 arrenge-left">
                            <?php $slug = strtolower(str_replace(' ', '-', trim($college[0]->title)))."-".$college[0]->course_id;?>
                            <div class="content-img">
                                <a href="/courses/<?php echo $catlink['college'];?>/<?php echo $slug;?>">
                                    <img src="<?php echo $college[0]->image_url;?>">
                                </a>
                            </div>
                            <h4 class="title">                                
                                <a href="/courses/<?php echo $catlink['college'];?>/<?php echo $slug;?>">
                                    <?php echo $college[0]->title;?>
                                </a>
                            </h4>
                            <div class="description">
                                <?php echo substr($college[0]->description, 0, 90);?>
                            </div>
                            <div class="rateprice">
                                <div class="pull-left">
                                    <?php if($college[0]->price == 0):?>
                                        FREE
                                    <?php else:?>
                                        $<?php echo $college[0]->price;?>
                                    <?php endif;?>
                                </div>
                                <div class="pull-right">
                                    <?php for($x=0;$x<$college[0]->course_rating;$x++):?>
                                        <i class="ion-android-star"></i>
                                    <?php endfor;?>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-sm-12 col-md-3 col-lg-3 content-box-4">
                            <?php $slug = strtolower(str_replace(' ', '-', trim($language[0]->title)))."-".$language[0]->course_id;?>
                            <div class="content-img">
                                <a href="/courses/<?php echo $catlink['language'];?>/<?php echo $slug;?>">
                                    <img src="<?php echo $language[0]->image_url;?>">
                                </a>
                            </div>
                            <h4 class="title">
                                <a href="/courses/<?php echo $catlink['language'];?>/<?php echo $slug;?>">
                                    <?php echo $language[0]->title;?>
                                </a>
                            </h4>
                            <div class="description">
                                <?php echo $language[0]->description;?>
                            </div>
                            <div class="rateprice">
                                <div class="pull-left">
                                    <?php if($language[0]->price == 0):?>
                                        FREE
                                    <?php else:?>
                                        $<?php echo $language[0]->price;?>
                                    <?php endif;?>
                                </div>
                                <div class="pull-right">
                                    <?php for($x=0;$x<$language[0]->course_rating;$x++):?>
                                        <i class="ion-android-star"></i>
                                    <?php endfor;?>
                                </div>
                            </div>
                        </div>
                    </div>                     
                </div>
            </div>
            <div id="school">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin   
                        <br><br>
                        <button>High School</button>
                        <button>Middle School</button>
                        <br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <button>Elementary School</button>                     
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <a href="/courses/<?php echo $catlink['school'];?>">
                            <img src="/assets/img/School_img.png">
                        </a>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div id="college">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <a href="/courses/<?php echo $catlink['college'];?>">
                            <img src="/assets/img/College_img.png">
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin      
                        <br><br> 
                        <div>
                            <button>Engineering</button>
                            <button>Business</button>
                            <br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <button>Medicine</button>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </div> 
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>            
            <div id="professional">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin 
                        <br><br>
                        <button>Programming</button>
                        <button>Design</button>
                        <br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <button>Business</button>                       
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <a href="/courses/<?php echo $catlink['professional'];?>">
                            <img src="/assets/img/Professionals_img.png">
                        </a>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div id="language">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <a href="/courses/<?php echo $catlink['language'];?>">
                            <img src="/assets/img/Language_img.png">
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin                        
                        <br><br>
                        <div>
                            <button>Asian Languages</button>
                            <button>European Languages</button>
                            <br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <button>Middle East Languages</button>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>  
            <div class="row no-padding no-margin">
                <h1 class="free-trial">Start Your Free Trial Now</h1>     
                <h3 class="trial-text"> lorem ipsum text is typically a scrambled</h3> 
                <p class="trial-start">
                    <a href="get-start" target="" class="btn btn-success btn-lg get-start">
                        Get started
                    </a>
                </p>          
            </div>