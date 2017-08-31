            <section id="inner-search">
                <div class="row">
                    <div>
                        <a href="<?php echo $base_url;?>">
                            <img src="/assets/img/Home icon.png" class="bcrumbimg">
                        </a>
                         / 
                         <a href="/Profile">
                            Me
                        </a>
                         / Change Password               
                    </div>
                </div>
            </section>

            <?php 
                $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                $ok_url = array('base_url' => $base_url); 
            ?>

            <div class="container">
                <div class="row">
                    <div class="change-password">
                        <div class="col-sm-1 col-md-2 col-lg-2"></div>
                        <div class="col-sm-10 col-md-8 col-lg-8">                       
                            <form action="/ChangePass" method="post" id="changePass" name="changePass" novalidate="novalidate">
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="old_password" name="old_password" placeholder="Password" value="" type="password">
                                            <i class="ion-edit"></i>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="new_password" name="new_password" placeholder="New Password" value="" type="password">
                                            <i class="ion-edit"></i>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="con_password" name="con_password" placeholder="Confirm Password" value="" type="password">
                                            <i class="ion-edit"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <input type="hidden" name="ApiKey" id="ApiKey" value="<?php echo $ApiKey;?>">
                                    <input type="hidden" name="curr_url" id="curr_url" value="<?php echo $complete_url;?>">
                                    <button class="change-pass pull-left" type="submit">Change Password</button>
                                    <a class="cancel pull-left" id="cancel" name="cancel" href="/Profile">Cancel</a>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <div class="col-sm-1 col-md-2 col-lg-2"></div>    
                    </div>
                </div>
            </div>