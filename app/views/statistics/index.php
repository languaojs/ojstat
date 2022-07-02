<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <?php require_once '../app/views/user/menus/menu_statistics.php';?>
            </nav>
            <br>
            <div class="row mt-2">
                <div class="col-xs-12 col-sm-12 cpl-md-6 col-lg-6">
                    <h3 class="display-3 mt-5 text-info">Monitoring your journal statistics is easy now.</h2>
                </div>
                <div class="col-xs-12 col-sm-12 cpl-md-6 col-lg-6">
                    <img src="<?=BASEURL;?>/public/img/misc/see-stat-4.jpg" width="100%" alt="OJStat">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row bg-hard-blue mt-2 text-light p-3 stat" style="display:none">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <p><strong>What is this page about?</strong></p>
                <p>Through this page, you and your colleagues can see your journal metrics and statistics. In each report, additional information regarding the importance of the report and several best practices that you can do to improve your journals based on the data presented on this page are available.</p>
                <p>There are two types of data presentation in OJStat, tabular and graphical. We believe that tabulated numbers are powerful to signify the progress of your journals. Meanwhile, the graphical presentation is very useful to give you more insights about your journal stats.</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <p><strong>Metrics</strong></p>
                <i class="fa fa-check text-success"></i> Scimago Metric <br>
                <i class="fa fa-check text-success"></i> Index Copernicus Metric <br>
                <i class="fa fa-check text-success"></i> Google Scholar Metric <br>
                <br>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" >
                <p><strong>Statistics</strong></p>
                <i class="fa fa-check text-success"></i> Visit Statistics <br>
                <i class="fa fa-check text-success"></i> Countries Statistics <br>
                <i class="fa fa-check text-success"></i> Traffic Sources <br>
                <i class="fa fa-check text-success"></i> System and Devices <br>
                <i class="fa fa-check text-success"></i> PageViews <br>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.stat').toggle('slow');
    });
</script>