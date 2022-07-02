<?php 
Session::start();
$role = array("admin");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="text-primary">Add User</h2>
            <p class="lead">All fields are required</p>
            <hr>
            <form action="<?=BASEURL;?>/public/admin/add_user" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <h3>Login Credential</h3>
                        <p class="text-info">User will use their credential to login to OJStat.</p>
                        <div class="form-group">
                            <label for="">Username<sup class="text-danger">*</sup></label>
                            <input type="text" name="username" class= "form-control" id="" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Password<sup class="text-danger">*</sup></label>
                            <input type="text" name="userpass" class= "form-control" id="" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Role ID<sup class="text-danger">*</sup> try <span class="badge badge-info"><?=$data['role_id_suggest'];?></span></label>
                            <input type="number" name="roleid" class= "form-control"  id="roleId" data-toggle="popover" data-title="User Role ID" data-content="Please use a unique number. No users can have similar Role ID number." data-trigger="hover" data-placement="top" required/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                        <h3>User Information</h3>
                        <p class="text-info">This information will appear on the <i>Report Page</i> on any journal that this user manages.</p>
                        <div class="form-group">
                            <label for="">Fullname<sup class="text-danger">*</sup></label>
                            <input type="text" name="user_fullname" id="" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Cover Image URL<sup class="text-danger">*</sup></label>
                            <input type="url" name="user_img_url" id="" class="form-control" data-toggle="popover" data-title="User Picture" data-content="Put the link to the user image starts from https." data-trigger="hover" data-placement="top" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Email<sup class="text-danger">*</sup></label>
                            <input type="email" name="user_email" id="" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Link<sup class="text-danger">*</sup></label>
                            <input type="url" name="user_link" id="" class="form-control" data-toggle="popover" data-title="User Link" data-content="Put user's complete link like blog or website start from https." data-trigger="hover" data-placement="top" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Brief Description<sup class="text-danger">*</sup></label>
                            <textarea name="user_desc" id="" cols="30" rows="10" class="form-control"  data-toggle="popover" data-title="User Description" data-content="Tell visitors about this user, the occupation or duty on the journal." data-trigger="hover" data-placement="top" required/></textarea>
                        </div>
                        <div class="form-group">
                            <a href="<?=BASEURL;?>/public/admin" class="btn btn-warning">Cancel and Return</a>
                            <input type="submit" value="Add User" name="addUser" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

