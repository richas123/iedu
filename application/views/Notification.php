            <section id="inner-search">    
                <div class="row">
                    <div>
                        <a href="<?php echo $base_url;?>">
                            <img src="/assets/img/Home icon.png" class="bcrumbimg">
                        </a> / Notification
                    </div>
                </div>
            </section>
            <br>
            <div class="container">
                <div class="row">
                    <div class="Leaderboard-box">
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <?php if(count($notifications) == 0):?>
                                <div class="inner-board notic-board">
                                    There is no notification
                                </div>
                            <?php endif;?>
                            <?php for($z=0;$z<count($notifications);$z++):?>
                                <?php                                     
                                    if($notifications[$z]->is_read == 0):
                                        $bg_clr = 'bg_clr';
                                    else:
                                        $bg_clr = '';
                                    endif;
                                ?>
                                <div class="inner-board <?php echo $bg_clr;?>">
                                    <i class="ion-android-notifications-none"></i>
                                    <span class="notic-board" data-value="<?php echo $notifications[$z]->relation_id;?>" data-toggle="modal" href="#notifyModal">
                                        <?php echo $notifications[$z]->title;?>
                                    </span>                                    
                                    <span class="pull-right notice deleteNotice" data-toggle="modal" href="#notifydelModal" id="<?php echo $notifications[$z]->relation_id;?>">
                                        Delete
                                    </span>
                                    <!--<span class="pull-right notice" id="span-<?php //echo $notifications[$z]->relation_id;?>">
                                        <?php                                     
                                           /* if($notifications[$z]->is_read == 0):
                                                echo "Unread &nbsp;";
                                            else:
                                                echo "Read &nbsp;";
                                            endif;*/
                                        ?>
                                    </span> -->
                                </div>
                                <input type="hidden" name="d-title" id="d-title-<?php echo $notifications[$z]->relation_id;?>" value="<?php echo $notifications[$z]->title;?>">
                                <input type="hidden" name="d-data" id="d-data-<?php echo $notifications[$z]->relation_id;?>" value="<?php echo $notifications[$z]->data;?>">
                            <?php endfor;?>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1"></div>
                    </div>
                </div>
            </div>