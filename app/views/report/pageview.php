<?php 
require_once 'top-row.php';
?>
<div class="container">
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">PageViews</p>
        </div>
    </div>
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p><strong>All Pages</strong></p>
            <table class="table table-condensed table-hover table-sm" id="pageViewTable">
                <thead>
                    <tr class="bg-unique text-light">
                        <th>Page Titles</th>
                        <th class='text-center'>All Views</th>
                        <th class='text-center'>Unique Views</th>
                        <th class='text-center'>Returning Views</th>
                        <th class='text-center'>AVG Duration (in seconds)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($data['all_pageview'] as $pv)
                    {
                        echo "<tr>";
                        echo "<td>";
                        echo $pv['pv_pagetitle'];
                        echo "<td class='text-center'>";
                        echo $pv['allVisitor'];
                        echo "<td class='text-center'>";
                        echo $pv['uniqueVisitor'];
                        echo "<td class='text-center'>";
                        echo $pv['allVisitor']-$pv['uniqueVisitor'];
                        echo "<td class='text-center'>";
                        echo number_format($pv['pageDur']/1000,1);
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <p><strong>Average PageView Duration</strong></p>
            <div class="mybox text-center py-4 shadow">
                <h1><i class="fa fa-eye"></i> <?=date('h:i:s', $data['duration_avg']);?></h1>
            </div>
            <br>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <p><strong>Monthly Average Visit Duration in Seconds</strong></p>
            <div id="mydurBox1" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="monthlyAvgChart"></canvas>
            </div>
            <br>
        </div>
    </div>
    
</div>
<script>
$(document).ready(function(){
    $.fn.DataTable.ext.pager.numbers_length = 5;
    $('#pageViewTable').dataTable({
        order:[[1,'desc']],
        responsive:true
    });
    drawChartSingleData(
        'monthlyAvgChart', 
        'line', 
        [<?php foreach($data['monthly_duration_avg'] as $l){echo '"'.date ('F', strtotime($l['pv_date'])).'",';}?>], 
        'Monthly Average Duration', 
        [<?php foreach($data['monthly_duration_avg'] as $d){echo '"'.$d['monthlyAvg'].'",';}?>])
});
</script>