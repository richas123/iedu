            <section id="inner-search">
                <div class="row">
                    <div>
                        <a href="<?php echo $base_url;?>">
                            <img src="/assets/img/Home icon.png" class="bcrumbimg">
                        </a> / 
                        <a href="<?php echo $base_url;?>/Profile">
                            Me
                        </a> /  
                        Profile Setting
                    </div>
                </div>
            </section>

            <?php 
                $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                $ok_url = array('base_url' => $base_url); 
            ?>

            <div class="container">
                <div class="row">
                    <div class="profile-setting">
                        <div class="col-sm-1 col-md-2 col-lg-2"></div>
                        <div class="col-sm-10 col-md-8 col-lg-8">
                            <form id="profileChange" name="profileChange" novalidate="novalidate" action="/Profile/Setting" method="post" enctype="multipart/form-data"> 
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Profile Image</label>
                                        <div class="col-sm-10 text-center">
                                            <div class="imgdiv pull-left" id="image-holder">
                                                <img src="<?php echo $profile->image_url;?>">
                                                <label for="file-upload" class="custom-file-upload">
                                                    Change
                                                </label>
                                                <input id="file-upload" name="file-upload" type="file"/>
                                            </div>
                                            <!--<div id="image-holder" class="imgdiv"></div>-->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo ucfirst($profile->first_name);?>">
                                            <i class="ion-edit"></i>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo ucfirst($profile->last_name);?>">
                                            <i class="ion-edit"></i>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?php echo $profile->email_id;?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <input type="hidden" name="image_id" id="image_id" value="<?php echo $profile->image_id;?>">
                                    <button class="save" id="save" name="save" type="submit">Save</button>
                                    <a class="cancel" id="cancel" name="cancel" href="/Profile">Cancel</a>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-1 col-md-2 col-lg-2"></div>    
                    </div>
                </div>
            </div>