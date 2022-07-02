<?php 
require_once 'top-row.php';
?>
<div class="container">
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">Visit Statistics</p>
        </div>
    </div>
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 mb-3">
            <p><strong>Overall Visits</strong></p>
            <div id="chartBox1" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="visitChart"></canvas>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-3">
            <p><strong>Unique and Returning Visitors</strong></p>
            <div id="chartBox2" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="visitUrChart"></canvas>
            </div>
        </div>
    </div>
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-2">
            <p><strong>This Month (<?=date('F Y');?>) Visit</strong></p>
            <div id="chartBox3" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="thisMonthChart"></canvas>
            </div>
            <br>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-2">
            <p><strong>This Year (<?=date('Y');?>) Visit</strong></p>
            <div id="chartBox4" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="monthlyChart"></canvas>
            </div>
            <br>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-2">
            <p><strong>Yearly Visit</strong></p>
            <div id="chartBox5" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="yearlyChart"></canvas>
            </div>
            <br>
        </div>
    </div>
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2">
            <p><strong>Visit by Date</strong></p>
            <table class="table table-sm table-hover" id="visitTable">
                <thead>
                    <tr class="bg-unique text-light">
                        <th>Date</th>
                        <th>Month Year</th>
                        <th class='text-center'>All</th>
                        <th class='text-center'>Unique</th>
                        <th class='text-center'>Return</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($data['visit_table'] as $visit){
                        echo "<tr>";
                        echo "<td>";
                        echo Sanitize::clean(date('Y m d', strtotime($visit['pv_date'])));
                        echo "<td>";
                        echo Sanitize::clean(date('F Y', strtotime($visit['pv_date'])));
                        echo "<td class='text-center countme'>";
                        echo Sanitize::clean($visit['allVisitor']);
                        echo "<td class='text-center'>";
                        echo Sanitize::clean($visit['uniqueVisitor']);
                        echo "<td class='text-center'>";
                        echo Sanitize::clean($visit['allVisitor']-$visit['uniqueVisitor']);
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb2">
            <p><strong>Visit by Date and Time</strong></p>
            <table class="table table-sm" id="timeTable">
                <thead>
                    <tr class="bg-unique text-light">
                        <th>Date</th>
                        <th>Time</th>
                        <th class='text-center'>All</th>
                        <th class='text-center'>Unique</th>
                        <th class='text-center'>Return</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($data['visit_time'] as $vtime){
                            echo "<tr>";
                            echo "<td>";
                            echo Sanitize::clean($vtime['pv_date']);
                            echo "<td>";
                            echo Sanitize::clean($vtime['pv_time']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($vtime['allVisitor']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($vtime['uniqueVisitor']);
                            echo "<td class='text-center'>";
                            echo Sanitize::clean($vtime['allVisitor']-$vtime['uniqueVisitor']);
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <div class="row mt-3 pl-2">
        <div class="col-xs 12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main" >Visit Average Values</p>
            <div class="row">
                <div class="col xs-12 col-sm-12 col-md-7 col-lg-7 mb-2">
                    <p><strong>Daily Average Visit Every Month in this Year <?=date('Y');?></strong></p>
                    <div id="chartBox6" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="avgMChart"></canvas>
                    </div>
                    <br>
                </div>
                <div class="col xs-12 col-sm-12 col-md-5 col-lg-5 mb-2">
                    <p><strong>Monthly Average Visit Every Year</strong></p>
                    <div id="chartBox7" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="avgYChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){
    drawChartDoubleDataScrollable(
        'visitChart',
        [<?php foreach($data['all_visit_data']['datalabel'] as $l){echo '"'. date('M d, Y', strtotime($l)).'",';}?>],
        'line',
        'Unique',
        [<?php foreach($data['all_visit_data']['uniquedataset'] as $dx){echo '"'.$dx.'",';}?>],
        'line',
        'Returning',
        [<?php foreach($data['all_visit_data']['alldataset'] as $d){echo '"'.$d.'",';}?>]
    );

    $.fn.DataTable.ext.pager.numbers_length = 5;
    $('#visitTable, #timeTable').dataTable();

    drawChartSingleData('visitUrChart', 'doughnut',['Returning Visitor','Unique Visitor'] , 'Visitor Comparison', [<?=$data['visitor_count']['returningVisitor'];?>,<?=$data['visitor_count']['uniqueVisitor'];?>])

    drawChartDoubleData("thisMonthChart", [<?php foreach($data['this_month']['monthDate'] as $a){echo '"'. date('d', strtotime($a)).'",';}?>], 'line', 'Unique', [<?php foreach($data['this_month']['monthUnique'] as $au){echo '"'. $au.'",';}?>],'line', 'Returning', [<?php foreach($data['this_month']['monthRet'] as $al){echo '"'. $al.'",';}?>]);

    drawChartDoubleDataStackedY("monthlyChart", [<?php foreach($data['monthly_visit']['monthlyMonth'] as $c){echo '"'. date('F', strtotime($c)).'",';}?>], 'bar', 'Returning', [<?php foreach($data['monthly_visit']['monthlyRet'] as $c1){echo '"'. $c1.'",';}?>],'line', 'Unique', [<?php foreach($data['monthly_visit']['monthlyUnique'] as $c2){echo '"'. $c2.'",';}?>]);

    drawChartDoubleDataStackedY("yearlyChart", [<?php foreach($data['yearly_visit']['yearlyYear'] as $d){echo '"'. date('Y', strtotime($d)).'",';}?>], 'bar', 'Returning', [<?php foreach($data['yearly_visit']['yearlyRet'] as $d1){echo '"'. $d1.'",';}?>],'bar', 'Unique', [<?php foreach($data['yearly_visit']['yearlyUnique'] as $d2){echo '"'. $d2.'",';}?>]);

    drawChartDoubleData("avgMChart", [<?php foreach($data['monthly_avg']['month'] as $gx){echo '"'.$gx.'",';}?>], 'line', 'Avg. Unique Visit', [<?php foreach($data['monthly_avg']['unAvg'] as $g1){echo '"'.$g1.'",';}?>],'line', 'Avg. Returning Visit', [<?php foreach($data['monthly_avg']['retAvg'] as $g2){echo '"'.$g2.'",';}?>]);

    drawChartDoubleData("avgYChart", [<?php foreach($data['yearly_avg']['year'] as $h){echo '"'.$h.'",';}?>], 'bar', 'Avg. Unique Visit', [<?php foreach($data['yearly_avg']['unAvg'] as $h1){echo '"'.$h1.'",';}?>],'bar', 'Avg. Returning Visit', [<?php foreach($data['yearly_avg']['retAvg'] as $h2){echo '"'.$h2.'",';}?>]);
});
</script>