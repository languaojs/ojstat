<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-4">
        <div class="flex-between mb-4">
            <h3 class="text-primary">User Detail</h3>
            <button class="btn btn-primary btn-sm" id="editProfile" data-toggle="modal" data-target="#editDetail">Edit Profile</button>
        </div>    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="shadow p-3">
                        <h4>User Profile</h4>
                        <hr>
                        <h5><?=$data['profile_detail']['user_fullname'];?> (<?=$data['profile_detail']['userrole'];?>)</h5>
                        <h5>Description:</h5>
                        <p><?=$data['profile_detail']['user_desc'];?></p>
                        <p><i class="fa fa-link"></i> <?=$data['profile_detail']['user_link'];?></p>
                        <p><i class="fa fa-envelope"></i> <?=$data['profile_detail']['user_email'];?></p>
                        <hr>
                        <a href="<?=BASEURL;?>/public/<?=$ses_role;?>">Return</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="shadow p-3 text-center">
                        <img src="<?=$data['profile_detail']['user_img_url'];?>" alt="User Profile Photo" width="100" height="auto"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editDetail" tabindex="-1" role="dialog" aria-labelledby="editDetail" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit User Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?=BASEURL;?>/public/user/edit_user_detail" method="post">
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" name="user_fullname" id="" class="form-control" autocomplete="off" value="<?=$data['profile_detail']['user_fullname'];?>"/>
            </div>
            <div class="form-group">
                <label for="profile_id">Profile Image URL</label>
                <input type="hidden" name="userid" id="" class="form-control" autocomplete="off" value="<?=$data['profile_detail']['userid'];?>" readonly/>
                <input type="url" name="user_img_url" id="" class="form-control" autocomplete="off" value="<?=$data['profile_detail']['user_img_url'];?>"/>
            </div>
            <div class="form-group">
                <label for="description">Short Description</label>
                <input type="text" name="user_desc" id="" class="form-control" autocomplete="off" value="<?=$data['profile_detail']['user_desc'];?>"/>
            </div>
            <div class="form-group">
                <label for="userlink">User Link</label>
                <input type="url" name="user_link" id="" class="form-control" autocomplete="off" value="<?=$data['profile_detail']['user_link'];?>"/>
            </div>
            <div class="form-group">
                <label for="useremail">User Email</label>
                <input type="email" name="user_email" id="" class="form-control" autocomplete="off" value="<?=$data['profile_detail']['user_email'];?>"/>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name = "edit_user_profile" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
