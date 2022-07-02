<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
if($ses_role == 'user')
{
    $tagline = "As a user, you can edit journal information (except reasigning user) and configuration, view metrics and statistics of the journals, and generate widget by using widget generator.";
}elseif($ses_role=='admin')
{
    $tagline = "In this page, you can edit journal information, edit journal configuration, view metrics and statistics of the journals, generate widget using OJStat Widget Generator, copying the connecting script, and close a journal. Keep in mind that closing a journal will delete all data related to the journal (based on the siteId) and this cannot be undone. <br> <span class='badge badge-warning'>0</span> means you need to edit the journal and assign a user as the journal manager. Please add a user first.";
}
?>
<div class="flash">
    <?php 
        Flasher::flash();
    ?>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="bg-hard-blue text-light p-2 text-center">Journals</h2>
            <p class="list-group-item border-left-main"><?=$tagline;?></p>
            <table class="table table-condensed table-striped table-sm">
                <thead>
                    <tr class="bg-dark text-light">
                        <th class='text-center'>Num.</th>
                        <th>Journal Name</th>
                        <th class='text-center'>SiteID</th>
                        <th class='text-center'>RoleID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($data['journal_list'] as $journal)
                    {
                        echo "<tr>";
                        echo "<td class='text-center'>";
                        echo $no++;
                        echo "<td>";
                        echo $journal['web_name'];
                        $journal_edit_path = BASEURL . '/public/journal/edit/' . $journal['web_siteid'];
                        $journal_config_path = BASEURL . '/public/journal/config/' . $journal['web_siteid'];
                        $journal_stat_path = BASEURL . '/public/statistics/' . $journal['web_siteid'];
                        $journal_widgen_path = BASEURL . '/public/widget/' . $journal['web_siteid'];
                        $journal_script_path = BASEURL . '/public/script/' . $journal['web_siteid'];
                        $journal_close_path = BASEURL . '/public/journal/close/' . $journal['web_siteid'];
                        $journal_visit_path = BASEURL . '/public/journal/masterdata/' . $journal['web_siteid'];
                        $journal_report_path = BASEURL . '/public/report/' . $journal['web_siteid'];
                        echo "<p>PISSN: $journal[web_pissn] | EISSN: $journal[web_eissn] <br> <a href='$journal_edit_path' class='badge badge-primary p-1'>Edit Journal</a> | <a href='$journal_config_path' class='badge badge-success p-1'>Configure Journal</a> | <a href='$journal_stat_path' class='badge badge-dark p-1'>View Metrics and Statistics</a> | <a href='$journal_widgen_path' class='badge badge-info p-1'>Widget Generator</a> | <a href='$journal_script_path' class='badge badge-warning p-1'>Script tag</a> | <a href='$journal_report_path' target='blank' class='badge badge-secondary p-1'>Report</a>";
                        if($ses_role == 'admin')
                        {
                            echo " | <a href='$journal_visit_path' class='badge badge-dark p-1'>Master Data</a> | <a href='$journal_close_path'  class='badge badge-danger p-1' onclick='return confirm(\"Are you sure? This cannot be undone!\");'>Close</a></p>";
                        }else{
                            echo "</p>";
                        }
                        echo "<td class='text-center'>";
                        echo $journal['web_siteid'];
                        echo "<td class='text-center roleid'>";
                        echo $journal['roleid'];
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <p class="list-group-item border-left-main">
                <?php 
                if($ses_role == 'admin')
                {
                    echo "Have you recently upgraded from a previous version? If yes, please edit the journal and assign a user as the manager and run the configuration so that the statistical reports of this journal can display correctly.";
                }else{
                    echo "Do not forget to configure the journal and sync the data if you just upgraded from a previous version.";
                }
                ?>
            
            </p>
                <br>
            <a href="<?=BASEURL;?>/public/<?=$ses_role;?>"><i class="fa fa-arrow-left"></i> Return</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        jQuery.each($('.roleid'), function(){
            if(this.textContent == 0){
                $(this).addClass("bg-warning");
            }
        })
    });
</script>