<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
$ses_roleid = Session::get_session('roleid');
Session::get_role($ses_role, $role);
$name = Session::get_name();

?>
<div class="container">
    <div class="row mt-5">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="bg-hard-blue text-center text-light p-3">Edit Journal</h3>
            <p class="list-group-item border-left-main">Please provide the form with valid data.</p>
            <hr>
            <form action="<?=BASEURL;?>/public/journal/journal_edit_form" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h4>Journal Information</h4>
                        <div class="form-group">
                            <label for="journalname">Journal Name</label>
                            <input type="text" name="web_name" class = "form-control" id="" value = "<?=$data['journal']['web_name'];?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Print ISSN</label>
                            <input type="text" name="web_pissn" class = "form-control" id="" value = "<?=$data['journal']['web_pissn'];?>">
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Electronic ISSN</label>
                            <input type="text" name="web_eissn" class = "form-control" id="" value = "<?=$data['journal']['web_eissn'];?>"required/>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Homepage URL</label>
                            <input type="url" name="web_url" class = "form-control" id="" value = "<?=$data['journal']['web_url'];?>"required/>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Cover URL</label>
                            <input type="url" name="web_img" class = "form-control" id="" value = "<?=$data['journal']['web_img'];?>"required/>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Short Description</label>
                            <textarea name="web_desc" id="" cols="30" rows="10" class="form-control"required/> <?=$data['journal']['web_desc'];?></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h4>Journal Index IDs</h4>
                        <div class="form-group">
                            <label for="">Scimago ID</label>
                            <input type="text" name="web_scimago" id="" class="form-control" value = "<?=$data['journal']['web_scimago'];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Index Copernicus ID</label>
                            <input type="text" name="web_ici" id="" class="form-control"  value = "<?=$data['journal']['web_ici'];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Google Scholar ID</label>
                            <input type="text" name="web_gscholarid" id="" class="form-control"  value = "<?=$data['journal']['web_gscholarid'];?>">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h3>Authorization</h3>
                        <div class="form-group">
                            <label for="">Journal Manager [Currently <span class="badge badge-primary"><?=$data['journal']['roleid'];?></span>]</label>

                            <?php 

                            if($ses_role == 'admin'){
                                ?>
                                <select name="roleid" id="" class="form-control">
                                <?php 
                                    foreach($data['user_list'] as $userlist)
                                    {
                                        echo "<option value=$userlist[user_roleid]>$userlist[user_fullname] ($userlist[user_roleid])</option>";
                                    }
                                ?>
                            </select>
                            <?php }else{
                                ?>
                                <p>You cannot assign Journal Manager</p>
                                <input type="hidden" name="roleid" id="" value = "<?=$data['journal']['roleid'];?>" class="form-control" readonly/>
                            <?php };?>
                            
                        </div>
                        <div class="form-group">
                            <a href="<?=BASEURL;?>/public/journal" class="btn btn-warning btn-sm">Cancel and Return</a>
                            <input type="hidden" name="web_id" value ="<?=$data['journal']['web_id'];?>">
                                <?php 
                                if($ses_roleid == $data['journal']['roleid'] || $ses_role == 'admin')
                                {
                                    echo "<input type='hidden' name='web_siteid' value ='". $data['journal']['web_siteid']. "'/>";
                                    echo '<input type="submit" value="Save Changes" name = "sendJournalData" class="btn btn-primary btn-sm">';
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