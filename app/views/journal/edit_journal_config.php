<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
$ses_roleid = Session::get_session('roleid');
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="bg-hard-blue text-light text-center p-3">Edit Journal Configuration</h2>
            <div class="bg-hard-blue text-light p-3 conf" style="display:none;">
                <p>The following form allows you to:</p>
                <ol>
                    <li>Set the Google Scholar (GS) Account Type that a journal has. Typically, if the GS account is created by a user, the type is also <b>user</b>. Otherwise, it is <b>journal</b></li>
                    <li>Set the Google API Key, if any. If you do not have any Google API Key, just use the provided key. The key is used to render Google Chart.</li>
                    <li>Decide what report you want to show or hide, either statistic report or metric report. e.g., if the journal does not have a Scimago ID, it should be hidden from the report.</li>
                </ol>
            </div>
            
            <hr>
            <form action="<?=BASEURL;?>/public/journal/config_form_data" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h3>Keys</h3>
                        <div class="form-group">
                            <label for="">Google Scholar Type</label>
                            <select name="config_gs_type" id="" class="form-control">
                                <option><?=$data['config']['config_gs_type'];?></option>
                                <option>journal</option>
                                <option>user</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Google API Key</label>
                            <input type="text" name="config_api_key" id="" class="form-control" value = "<?=$data['config']['config_api_key'];?>">
                            <br>
                            <p>Default API Key is Google Free API Key taken from Google Chart Documentation. You can change with yours if any. If you do not have any, do not delete the default API Key. <b><i>If you are upgrading from OJStat 1.3, refresh this page.</i></b></p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h3>Statistics</h3>
                        <div class="form-group">
                            <label for="">Visits</label>
                            <select name="config_vistat" id="" class="form-control">
                                <option><?=$data['config']['config_vistat'];?></option>
                                <option>show</option>
                                <option>hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Unique Visits</label>
                            <select name="config_uniquevis" id="" class="form-control" data-toggle="popover" data-trigger="hover" data-content="Currently unavailable. Unique visit is embedded into visit." data-placement="top">
                                <option>show</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Visitor Countries</label>
                            <select name="config_country" id="" class="form-control">
                                <option><?=$data['config']['config_country'];?></option>
                                <option>show</option>
                                <option>hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Page Views</label>
                            <select name="config_pageview" id="" class="form-control">
                                <option><?=$data['config']['config_pageview'];?></option>
                                <option>show</option>
                                <option>hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Systems</label>
                            <select name="config_system" id="" class="form-control">
                                <option><?=$data['config']['config_system'];?></option>
                                <option>show</option>
                                <option>hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Traffic Sources</label>
                            <select name="config_domain" id="" class="form-control">
                                <option><?=$data['config']['config_domain'];?></option>
                                <option>show</option>
                                <option>hide</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h3>Metrics</h3>
                        <div class="form-group">
                            <label for="">Scimago</label>
                            <select name="config_scimago" id="" class="form-control">
                                <option><?=$data['config']['config_scimago'];?></option>
                                <option>show</option>
                                <option>hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Index Copernicus</label>
                            <select name="config_ici" id="" class="form-control">
                                <option><?=$data['config']['config_ici'];?></option>
                                <option>show</option>
                                <option>hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Google Scholar</label>
                            <select name="config_gs" id="" class="form-control">
                                <option><?=$data['config']['config_gs'];?></option>
                                <option>show</option>
                                <option>hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="configid" value = "<?=$data['config']['configid'];?>" id="" class="form-control">
                            <a href="<?= BASEURL;?>/public/journal" class="btn btn-warning btn-sm">Cancel and Return</a>
                            <?php 
                                if($ses_roleid == $data['config']['roleid'] || $ses_role == 'admin')
                                {
                                    echo '<input type="submit" value="Save Changes" name = "editConfig" class="btn btn-primary btn-sm">';
                                }else{
                                    echo '';
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.conf').toggle('slow');
    });
</script>