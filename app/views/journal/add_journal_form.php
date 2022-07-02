<?php 
Session::start();
$role = array("admin");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();

?>
<div class="container">
    <div class="row mt-5">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="bg-hard-blue text-light text-center p-3">Add a Journal</h2>
            <p class="list-group-item border-left-main">Please complete the fields especially the journal information and authorization. You can only add a journal if at least one active user exists in the system.</p>
            <hr>
            <form action="<?=BASEURL;?>/public/journal/journal_form_data" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h4>Journal Information</h4>
                        <div class="form-group">
                            <label for="journalname">Journal Name</label>
                            <input type="text" name="web_name" class = "form-control" id="" data-toggle="popover" data-title="Journal Name" data-content="Journal name should be written in Sentence Case, no ampersand (&)." data-trigger="hover" data-placement="top" required>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Print ISSN</label>
                            <input type="text" name="web_pissn" class = "form-control" id="" data-toggle="popover" data-title="Journal Print ISSN" data-content="This is the ISSN of the printed version. If none, use 0000-0000" data-trigger="hover" data-placement="top" required>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Electronic ISSN</label>
                            <input type="text" name="web_eissn" class = "form-control" id="" data-toggle="popover" data-title="Journal Electronic ISSN" data-content="This is the ISSN of the electronic version. Required!" data-trigger="hover" data-placement="top" required>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Homepage URL</label>
                            <input type="url" name="web_url" class = "form-control" id="" data-toggle="popover" data-title="Journal Homepage URL" data-content="Put the complete URL of the journal, starts from https" data-trigger="hover" data-placement="top" required>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Cover URL</label>
                            <input type="url" name="web_img" class = "form-control" id="" data-toggle="popover" data-title="Journal Cover URL" data-content="Put the URL of the cover image of the journal. This should be copied from OJS journal list by right-clicking the image and copy image address. It must start from https" data-trigger="hover" data-placement="top" required>
                        </div>
                        <div class="form-group">
                            <label for="journalname">Journal Short Description</label>
                            <textarea name="web_desc" id="" cols="30" rows="10" class="form-control" data-toggle="popover" data-title="Journal Description" data-content="Tell the visitors what is the journal about. Only one paragraph is allowed and no HTML tags are allowed." data-trigger="hover" data-placement="top" required></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h4>Journal Index IDs</h4>
                        <div class="form-group">
                            <label for="">Scimago ID</label>
                            <input type="text" name="web_scimago" id="" class="form-control"  data-toggle="popover" data-title="Journal Scimago ID" data-content="Put the Scimago ID of the journal, if any. The ID should be numeric." data-trigger="hover" data-placement="top">
                        </div>
                        <div class="form-group">
                            <label for="">Index Copernicus ID</label>
                            <input type="text" name="web_ici" id="" class="form-control" data-toggle="popover" data-title="Journal ICI ID" data-content="Put the Index Copernicus ID of the journal, if any. The ID should be numeric." data-trigger="hover" data-placement="top">
                        </div>
                        <div class="form-group">
                            <label for="">Google Scholar ID</label>
                            <input type="text" name="web_gscholarid" id="" class="form-control" data-toggle="popover" data-title="Journal Google Scholar ID" data-content="Put the Google Scholar ID of the journal, if any. The ID should be alpha-numeric." data-trigger="hover" data-placement="top">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h3>Authorization</h3>
                        <div class="form-group">
                            <label for="">Journal SiteId</label>
                            <input type="number" name="web_siteid" id="" class="form-control" data-toggle="popover" data-title="Journal Site ID" data-content="This must be a unique number. Please use number that no journal is currently using." data-trigger="hover" data-placement="top" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Journal Manager</label>
                            <select name="roleid" id="" class="form-control" data-toggle="popover" data-title="Journal Manager" data-content="Select the user that you want to assign to manage this journal." data-trigger="hover" data-placement="top">
                                <?php 
                                    foreach($data['user_list'] as $userlist)
                                    {
                                        echo "<option value=$userlist[user_roleid]>$userlist[user_fullname] ($userlist[user_roleid])</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <a href="<?=BASEURL;?>/public/admin" class="btn btn-warning btn-sm">Cancel and Return</a>
                            <input type="submit" value="Add Journal" name = "sendJournalData" class="btn btn-primary btn-sm">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
