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
            <h2 class="text-primary">Password Management</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <p>You are about to change <i><?=$data['user_data']['user_fullname'];?></i> password who is an/a <i><?=$data['user_data']['userrole'];?></i> in this OJStat.</p>
                    <form action="<?=BASEURL;?>/public/user/change_password" method="POST">
                        <div class="form-group">
                            <input type="checkbox" name="" id="usernameCheck"> Change username too <br>
                            <label for="">Leave it empty if you don't want to change.</label>
                            <input type="text" name="username" id="usernameBox" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="text" name="userpass1" id="pass1" class="form-control">
                            <p>Suggested Password : <code id="suggestedPassword"></code></p>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm New Password</label>
                            <input type="text" name="userpass2" id="pass2" class="form-control">
                            <br>
                            <p id="passMatch"></p>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="userid" value = "21321cdssdfsd|dsfdc321|<?=$data['user_data']['userid'];?>|2312dcddss321" class="form-control">
                            <a href="<?=BASEURL;?>/public/admin" class="btn btn-warning btn-sm">Cancel and Return</a>
                            <input type="submit" value="Change Password" id="formButton" name = "changePassword" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#usernameBox').hide();
    if($('#usernameCheck').click(function(){
        $('#usernameBox').toggle('slow');
    }));
    $('#formButton').prop('disabled', true);
    var length = 8,
    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
    retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
    retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    $('#suggestedPassword').html(retVal);

    $('#pass2').keyup(function(){
        if($('#pass2').val() != $('#pass1').val())
        {
            $('#passMatch').html("<i class='fa fa-warning'></i> Password must match!");
            $('#formButton').prop('disabled', true);
        }else{
            $('#passMatch').html("<i class='fa fa-check'></i> Password matched!");
            $('#formButton').prop('disabled', false);
        }
    });
    })
</script>