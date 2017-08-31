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
                                echo "For ".ucfirst($breadcrumb);
                            ?>
                        </a> / 
                        <a href="/<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3);?>">
                            <?php 
                                $bread = explode('-', $this->uri->segment(3)); $breadcrumb = '';
                                for($t=0;$t<count($bread)-1;$t++): 
                                    if($t>0): $breadcrumb .= ' '; endif;
                                    $breadcrumb .= $bread[$t]; 
                                endfor;
                                echo ucfirst($breadcrumb);
                            ?>
                        </a> / 
                        <a href="/<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);?>">
                            <?php 
                                $bread = explode('-', $this->uri->segment(4)); $breadcrumb = '';
                                for($t=0;$t<count($bread)-1;$t++): 
                                    if($t>0): $breadcrumb .= ' '; endif;
                                    $breadcrumb .= $bread[$t]; 
                                endfor;
                                echo ucfirst($breadcrumb);
                            ?>
                        </a>
                        <?php if($this->uri->segment(5)):?>
                            <?php $bread = explode('-', $this->uri->segment(5));?>
                             / <a href="">
                                 <?php echo ucfirst($bread[0]);?>
                             </a>
                        <?php endif;?>
                    </div>
                </div>
            </section>
            <?php $forcase = explode('-', $this->uri->segment(5)); $totalcompleteass = 0;?>
            <div class="container">
                <div class="row">
                    <div class="accordion-box">  
                        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>                      
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" id="the-side">  
                            <div class="back-for">
                                <button type="button" class="animated fadeInLeft is-open for-ass-sidebar" data-toggle="offcanvas">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>                            
                            <?php
                                for($z=0;$z<count($assignments);$z++):
                                    if($assignments[$z]->is_complete > 0):
                                        $totalcompleteass++;
                                    endif;
                                endfor;
                                if($totalcompleteass == count($assignments)):
                                    $circleclass = 'green';
                                else:
                                    $circleclass = 'white';
                                endif;
                            ?>
                            <aside id="wrapper" class="accordion assigment">                                
                                <h2>
                                    <a href="javascript:void(0);">
                                        <?php echo ucfirst($breadcrumb);?>
                                    </a>
                                    <!--<span class="percents" style="border-radius: 0px 0px 10px 10px;">0%</span>-->
                                </h2>
                                <p style="">
                                    <?php for($z=0;$z<count($assignments);$z++):?>
                                        <label>
                                            <span>
                                                <?php
                                                    switch (strtolower($assignments[$z]->assignment_type)) {
                                                        case 'video':
                                                            if($assignments[$z]->is_complete == 1):
                                                                ?> <img src="/assets/img/video_icon.png" class="thetask"> <?php
                                                            else:
                                                                ?> <img src="/assets/img/video_gray_icon.png" class="thetask"> <?php
                                                            endif;                                      
                                                            break;

                                                        case 'tutorial':
                                                            if($assignments[$z]->is_complete == 1):
                                                                ?> <img src="/assets/img/tutorial_icon.png" class="thetask"> <?php
                                                            else:
                                                                ?> <img src="/assets/img/tutorial_gray_icon.png" class="thetask"> <?php
                                                            endif; 
                                                            break;

                                                        case 'quiz':
                                                            if($assignments[$z]->is_complete == 1):
                                                                ?> <img src="/assets/img/quiz_icon.png" class="thetask"> <?php
                                                            else:
                                                                ?> <img src="/assets/img/quiz_gray_icon.png" class="thetask"> <?php
                                                            endif;       
                                                            break;
                                                        
                                                        default:
                                                            // do nothing
                                                            break;
                                                    }                                                    
                                                ?>
                                            </span>   
                                            <a href="/<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.strtolower(str_replace(' ','-', $assignments[$z]->title)).'-'.$assignments[$z]->assignment_id.'/'.$z;?>">
                                                <?php echo $assignments[$z]->title;?>
                                            </a>
                                        </label>
                                    <?php endfor;?>
                                </p>
                            </aside>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9" id="the-content">
                            <div class="next-prev">
                                <?php if(count($assignments) == 1):?>
                                    <a href="javascript:void(0);" class="btn pull-left disable">
                                        <i class="ion-chevron-left"></i>
                                        &nbsp; Previous
                                    </a>
                                    <a href="javascript:void(0);" class="btn pull-right disable">
                                        Next &nbsp;
                                        <i class="ion-chevron-right"></i>
                                    </a>
                                <?php else:?>
                                    <?php if($this->uri->segment(6) == 0):?>
                                        <a href="javascript:void(0);" class="btn pull-left disable">
                                            <i class="ion-chevron-left"></i>
                                            &nbsp; Previous
                                        </a>
                                    <?php else:?>
                                        <a href="/<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$assignments[$this->uri->segment(6)-1]->title.'-'.$assignments[$this->uri->segment(6)-1]->assignment_id.'/'.($this->uri->segment(6)-1);?>" class="btn pull-left">
                                            <i class="ion-chevron-left"></i>
                                            &nbsp; Previous
                                        </a>
                                    <?php endif;?>

                                    <?php if(($this->uri->segment(6)+1) == count($assignments)):?>
                                        <a href="javascript:void(0);" class="btn pull-right disable">
                                            Next &nbsp;
                                            <i class="ion-chevron-right"></i>
                                        </a>
                                    <?php else:?>
                                        <a href="/<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$assignments[$this->uri->segment(6)+1]->title.'-'.$assignments[$this->uri->segment(6)+1]->assignment_id.'/'.($this->uri->segment(6)+1);?>" class="btn pull-right">
                                            Next &nbsp;
                                            <i class="ion-chevron-right"></i>
                                        </a>
                                    <?php endif;?>
                                <?php endif;?>
                            </div>
                            <?php 
                                if($this->uri->segment(5)):
                                    $forswitch = strtolower($forcase[0]);
                                else:
                                    $forswitch = strtolower($assignments[0]->assignment_type);
                                endif;

                                switch ($forswitch) {

                                    case 'video': ?> 
                                        <?php if($assignment->video_type == 'azure'):?>
                                            <video controls="" style="height: 350px; width: 100%;">
                                                <source src="<?php echo $assignment->video_url;?>" type="video/mp4" />
                                            </video>
                                        <?php endif;?>
                                        <?php if($assignment->video_type == 'vimeo'):?>
                                            <video controls="" style="height: 350px; width: 100%;">
                                                <source src="<?php echo $assignment->vimeo_urls->Hdvimeourl;?>" type="video/mp4" />
                                            </video>
                                        <?php endif;?>
                                        <?php break;

                                    case 'giphy':?> 
                                        <video controls=""  style="height: 350px; width: 100%;">
                                            <source src="/extensions/myVideo.mp4" type="video/mp4" />
                                        </video>
                                        <?php break;

                                    case 'tutorial':
                                        ?>  <iframe src="<?php echo $assignment->file_url;?>" style="height: 500px; width: 100%;"></iframe >  <?php
                                        break;

                                    case 'quiz':
                                        ?> 
                                        <input type="hidden" name="passing_marks" id="passing_marks" value="<?php echo $assignment->passing_marks;?>">
                                        <?php for($x=0;$x<$assignment->show_questions;$x++):?>
                                            <?php                                                 
                                                if($x == 0): $clsquiz = 'display-block'; else: $clsquiz = 'display-none'; endif;
                                            ?>
                                            <div class="quizz <?php echo $clsquiz;?>" id="quizz_<?php echo $x;?>">
                                                <div>
                                                    <div class="pull-left">
                                                         <?php echo 'Question '.($x+1).' of '.count($assignment->questions);?>
                                                    </div>
                                                    <div class="pull-right" id="timer_<?php echo $x;?>">
                                                        <?php echo $assignment->per_que_duration;?>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <h3 class="question">
                                                    <?php echo $assignment->questions[$x]->data;?>
                                                </h3>
                                                <div class="answer">
                                                    <?php for($y=0;$y<count($assignment->questions[$x]->options);$y++):?>
                                                        <div class="row">
                                                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                <input type="radio" name="option-<?php echo $x?>" id="option-<?php echo $x?>_<?php echo $y;?>" onclick="myclass('<?php echo $x?>_<?php echo $y;?>');">
                                                                <input type="hidden" name="is_correct-<?php echo $x?>_<?php echo $y;?>" id="is_correct-<?php echo $x?>_<?php echo $y;?>" value="<?php echo $assignment->questions[$x]->options[$y]->is_correct;?>">    
                                                            </div>
                                                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                <?php echo $assignment->questions[$x]->options[$y]->data;?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    <?php endfor;?>
                                                </div>
                                            </div>                                            
                                        <?php endfor;?>
                                        <div class="quizz display-none text-center" id="quizz_<?php echo $x;?>">
                                            <div><span id="theResult"></span>%</div>          
                                            <h3 id="congo"></h3>                               
                                            <div id="f-res"></div>
                                            <div>
                                                <a href="" class="enroll">Retake Quiz</a>
                                            </div>                                            
                                        </div>
                                        <?php
                                        break;
                                    
                                    default:
                                        // do nothing
                                        break;
                                }                                
                            ?>                            
                        </div>
                        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
                    </div>
                </div> 
            </div>

            <?php if(isset($assignment->show_questions)):?>
                <script type="text/javascript">
                    var z = 0; var totalQuset = <?php echo $assignment->show_questions;?>;
                    var totalmarks = 0;
                    var perQmark = <?php echo $assignment->per_que_mark;?>;
                    var myTesting = 0;

                    startTimer();
                    function startTimer() {
                        if(totalQuset > z) {
                            var presentTime = document.getElementById('timer_'+z).innerHTML;
                            var timeArray = presentTime.split(/[:]+/);
                            var m = timeArray[0];
                            var s = checkSecond((timeArray[1] - 1));
                            if(s == 59) {
                                m = m - 1;
                            }
                        }
                        if(m < 0) {
                            document.getElementById('quizz_'+z).classList.add('display-none');
                            document.getElementById('quizz_'+z).classList.remove('display-block');
                            z++;
                            document.getElementById('quizz_'+z).classList.add('display-block');
                            document.getElementById('quizz_'+z).classList.remove('display-none');
                            
                            if(totalQuset > z) {                                
                                startTimer();
                            } else {
                                var theres = (totalmarks/<?php echo $assignment->total_marks;?>)*100;
                                document.getElementById('theResult').innerHTML = theres;
                            }
                        }
                        else {
                            document.getElementById('timer_'+z).innerHTML = m + ":" + s;   
                            if(myTesting > 0){
                                var ranschk = document.getElementById('rightAns').getAttribute('data-value');
                                var wanschk = document.getElementById('wrongAns').getAttribute('data-value');
                                if(ranschk == 'no' && wanschk == 'no'){
                                    setTimeout(startTimer, 1000);
                                }    
                            }
                            else{
                                setTimeout(startTimer, 1000);
                            }                            
                        }
                        myTesting++;
                    }

                    function checkSecond(sec) {

                        if (sec < 10 && sec >= 0) {sec = "0" + sec};    
                        if (sec < 0) {sec = "59"};
                        return sec;
                    }

                    function myclass(getans = ''){

                        document.getElementById('rightAns').setAttribute("data-value", "yes");
                        document.getElementById('wrongAns').setAttribute("data-value", "yes");

                        if(document.getElementById('is_correct-'+getans).value == 1){
                            
                            $("#rightAns").addClass("in");
                            $("#rightAns").css("display", "block");
                            $("body").append('<div class="modal-backdrop fade in"></div>');    

                            totalmarks += perQmark;
                        } else {
                            
                            $("#wrongAns").addClass("in");
                            $("#wrongAns").css("display", "block");
                            $("body").append('<div class="modal-backdrop fade in"></div>');
                        }
                    }

                    function changeQuizz(){     

                        document.getElementById('rightAns').setAttribute("data-value", "no");
                        document.getElementById('wrongAns').setAttribute("data-value", "no");                  

                        if(totalQuset > z){
                            document.getElementById('quizz_'+z).classList.add('display-none');
                            document.getElementById('quizz_'+z).classList.remove('display-block');
                            z++;
                            document.getElementById('quizz_'+z).classList.add('display-block');
                            document.getElementById('quizz_'+z).classList.remove('display-none');
                            if(totalQuset > z) {
                                startTimer();
                            } else {
                                var theres = (totalmarks/<?php echo $assignment->total_marks;?>)*100;
                                document.getElementById('theResult').innerHTML = theres;
                                if(totalmarks >= document.getElementById('passing_marks').value){
                                    document.getElementById('congo').innerHTML = 'Congratulations !!!';
                                    document.getElementById('f-res').innerHTML = 'You have passed the quiz';
                                }else{
                                    document.getElementById('congo').innerHTML = '';
                                    document.getElementById('f-res').innerHTML = 'Oops! Please try again';
                                }                                
                            }
                        }
                    }
                </script>
            <?php endif;?>

            <style type="text/css">
                .accordion a {
                    margin-left: 0;
                }

                .track_vt7pu8-o_O-bottomTrack_ca0bk7 {
                    margin-left: 10px;
                }

                .animated.fadeInLeft {
                    background-color: transparent;
                    background-image: none;
                    border: 1px solid #9900ff;
                    border-radius: 4px;
                    padding: 9px 10px;
                }

                .icon-bar {
                    background-color: #9900ff;
                    height: 2px;
                    width: 22px;
                    display: block;
                }

                .icon-bar + .icon-bar {
                    margin-top: 4px;
                }
            </style>