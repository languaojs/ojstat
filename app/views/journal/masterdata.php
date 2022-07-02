<?php 
Session::start();
$role = array("admin");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="text-center bg-hard-blue text-light p-2">Master Data</h2>
            <p class="list-group-item border-left-main">This page shows you all visit data this journal has gotten all the time.</p>
            <hr>
            <table class="table table-condensed table-striped table-sm table-hover nowrap" id="visitTable" style="width:100%">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Date</th>
                        <th>Time</th>
                        <th>IP</th>
                        <th>Country</th>
                        <th>Region</th>
                        <th>City</th>
                        <th>Traffic Source</th>
                        <th>ISP</th>
                        <th>Duration</th>
                        <th>Page Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($data['allvisit'] as $visit)
                    {
                        echo "<tr>";
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_date']);
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_time']);
                        echo "<td>";
                        echo Sanitize::dehashIp($visit['pv_ipkey']);
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_country']);
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_region']);
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_city']);
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_ref_dom']);
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_isp']);
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_duration']/1000);
                        echo "<td>";
                        echo Sanitize::clean($visit['pv_pagetitle']);
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <a href="<?=BASEURL;?>/public/journal"><i class="fa fa-arrow-left"></i> Return</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.fn.DataTable.ext.pager.numbers_length = 5;
        var mytable = $('#visitTable').dataTable({
            responsive:true
        });
        new $.fn.dataTable.FixedHeader(mytable);
    });
</script>