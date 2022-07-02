<?php 
require_once 'top-row.php';
?>

<div class="container">
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">Traffic Sources</p>
        </div>
    </div>
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <p><strong>Top Domains</strong></p>
                    <div id="myVisitChartBox" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="refDomChart"></canvas>
                    </div>
                    <br>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <p><strong>Ten Top Traffic Sources</strong></p>
                    <div id="myVisitChartBox2" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="allRefDomChart"></canvas>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <p><strong>All Domains</strong></p>
            <div id="myVisitChartBox3" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="allDomChart"></canvas>
            </div>
            <br>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <p><strong>Top Search Engines and Social Networks</strong></p>
            <div id="myVisitChartBox4" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="allNetChart"></canvas>
            </div>
            <br>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    drawChartDoubleDataScrollable(
        'refDomChart',
        [<?php foreach($data['traffic_data']['tf_labels'] as $label){echo '"'.$label.'",';}?>],
        'bar',
        'Returning',
        [<?php foreach($data['traffic_data']['tf_ret'] as $d1){echo '"'.$d1.'",';}?>],
        'line',
        'Unique',
        [<?php foreach($data['traffic_data']['tf_u'] as $d2){echo '"'.$d2.'",';}?>]
    );

    drawChartDoubleDataStackedY(
        'allRefDomChart',
        [<?php foreach($data['top_domain_data']['tftop_labels'] as $label){echo '"'.$label.'",';}?>],
        'bar',
        'Returning',
        [<?php foreach($data['top_domain_data']['tftop_ret'] as $e1){echo '"'.$e1.'",';}?>],
        'line',
        'Unique',
        [<?php foreach($data['top_domain_data']['tftop_u'] as $e2){echo '"'.$e2.'",';}?>]
    );

    drawChartDoubleDataScrollable(
        'allDomChart',
        [<?php foreach($data['all_traffic_data']['tf_labels'] as $label){echo '"'.$label.'",';}?>],
        'bar',
        'Returning',
        [<?php foreach($data['all_traffic_data']['tf_ret'] as $e1){echo '"'.$e1.'",';}?>],
        'line',
        'Unique',
        [<?php foreach($data['all_traffic_data']['tf_u'] as $e2){echo '"'.$e2.'",';}?>]
    );

    drawChartSingleDataStackedYFa(
        'allNetChart',
        'bar',
        [<?php foreach($data['top_networks']['networks'] as $net){echo '"'.$net.'",';}?>],
        'Top Search Engines and Social Networks',
        [<?php foreach($data['top_networks']['counts'] as $netc){echo '"'.$netc.'",';}?>]
    );

    $.fn.DataTable.ext.pager.numbers_length = 5;
    $('#trafficTable').dataTable();
});
</script>