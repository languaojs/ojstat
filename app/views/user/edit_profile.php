<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
            <h2>Edit Profile</h2>
            <p>This page is used to edit only your Profile</p>
            <form action="<?=BASEURL;?>/public/user/edit_my_detail" method="post">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">Your Full Name</label>
                            <input type="text" class="form-control" name="user_fullname" id="" value="<?=$data['user_profile']['user_fullname'];?>" data-toggle="popover" data-title="Fullname" data-content="Fill your first and last name" data-trigger="hover" data-placement="top" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Your Email</label>
                            <input type="email" class="form-control" name="user_email" id="" value="<?=$data['user_profile']['user_email'];?>" data-toggle="popover" data-title="Email" data-content="Fill your valid and active email address" data-trigger="hover" data-placement="top" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Your Web URL</label>
                            <input type="url" class="form-control" name="user_link" id="" value="<?=$data['user_profile']['user_link'];?>" data-toggle="popover" data-title="Blog Link" data-content="Fill your blog or social network link" data-trigger="hover" data-placement="top" required/>
                        </div>
                        <div class="form-group">
                            <label for="">URL to your Photo</label>
                            <input type="url" class="form-control" name="user_img_url" id="" value="<?=$data['user_profile']['user_img_url'];?>" data-toggle="popover" data-title="Profile Photo" data-content="Fill your profile photo URL" data-trigger="hover" data-placement="top" required/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="">Descripe yourself</label>
                            <textarea name="user_desc" id="" cols="30" rows="10" class="form-control" data-toggle="popover" data-title="Description" data-content="Describe your professional duty in one paragraph." data-trigger="hover" data-placement="top" required/><?=$data['user_profile']['user_desc'];?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="userid" id="" value="<?=$data['user_profile']['userid'];?>">
                            <a href="<?=BASEURL;?>/public/<?=$data['userrole'];?>" class="btn btn-warning btn-sm">Cancel and Return</a>
                            <input type="submit" value="Save Profile" name ="edit_this_profile" class="btn btn-dark btn-sm">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
