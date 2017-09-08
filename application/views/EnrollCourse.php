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
                        Enroll Course
                    </div>
                </div>
            </section>
            <br>
            <div class="container">
                <div class="row">
                    <div class="search-page">
                        <div class="col-sm-12 col-md-12 col-lg-12">                     
                            <div class="col-xs-3 col-sm-5 col-md-3">
                                <img src="<?php echo $courseDesc[0]->image_url;?>" class="course-image">
                            </div>
                            <div class="col-xs-9 col-sm-7 col-md-9">
                                <h4 class="title">
                                    <b>Congratulations!</b> You've successfully enrolled in
                                </h4>
                                <h3 class="title-title">
                                    <?php echo $courseDesc[0]->title;?>
                                </h3>                                
                                <div class="learn-top">
                                    <a href="/courses/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3);?>" class="enroll">Start Learning</a>    
                                </div>                                       
                            </div>     
                        </div>
                    </div>
                </div>
                <br>
            </div>