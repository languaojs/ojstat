<?php
$visit_label = array();
$visit_data = array(); 
foreach($data['all_visit'] as $visit)
{
    $visit_label[] = $visit['pv_date'];
    $visit_data[] = $visit['visit'];
}

$tcl = array();
$tcd = array();
foreach($data['top_country'] as $tc)
{
    $tcl[]=$tc['pv_country'];
    $tcd[]=$tc['Visitor'];
}

require_once 'top-row.php';
?>
<div class="container">
    <div class="row pl-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="lead list-group-item border-left-main">Summary</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row pl-2">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 py-3">
            <div class="shadow" id="summaryLineChart" style="width:100%; height:300px;">
                <canvas id="LineChart"></canvas>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 py-3">
            <div class="shadow" id="summaryDonutChart" style="width:100%; height:300px;">
                <canvas id="DonutChart"></canvas>
            </div>
        </div>
    </div>
    <div class="row mt-2 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row d-flex justify-content-around align-items-center pl-2">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 my-2">
                    <div class="border-right border-info shadow px-3 py-1 mybox">
                        Total Visits <br>
                        <strong><span class="display-4"><?=$data['visitor_count']['allVisitor'];?> <i class="fa fa-users"></i></span></strong>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 my-2">
                    <div class="border-right border-info shadow px-3 py-1 mybox">
                        Avg. Daily Visitors <br>
                        <strong><span class=" display-4"><?=$data['all_avg'];?> <i class="fa fa-users"></i></span></strong>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 my-2">
                    <div class="border-right border-info shadow px-3 py-1 mybox">
                        Avg. Daily Unique Visitors <br>
                        <strong><span class="display-4"><?=$data['unique_avg'];?> <i class="fa fa-users"></i></span></strong>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 my-2">
                    <div class="border-right border-info shadow px-3 py-1 mybox">
                        Avg. Daily PageViews <br>
                        <strong><span class="display-4"><?=$data['pageview_avg'];?> <i class="fa fa-eye"></i></span></strong>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pl-2">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                    <h3 class="text-dark">Location</h3>
                    <div id="cMap"  style="width:100%; height:300px" class="p-2 shadow"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h3 class="text-dark">Ten Top Countries</h3>
                    <div id="myVisitChartBox" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="myCChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// LineChart
const ctx = document.getElementById('LineChart').getContext('2d');
const myLChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php foreach($visit_label as $vl){echo '"'.$vl.'",';}?>],
        datasets: [{
            label: 'Visit trends all the time',
            data: [<?php foreach($visit_data as $vd){echo '"'.$vd.'",';}?>],
            backgroundColor: [
                'rgba(67, 110, 146, 0.8)'
            ],
            borderColor: [
                'rgba(67, 110, 146, 0.56)'
            ],
            borderWidth: 1,
            fill:true,
            pointRadius:1,
        }]
    },
    options: {
        maintainAspectRatio:false,
        responsive:true,
        scales: {
            y: {
                beginAtZero: true,
                grid:{
                    display:true,
                }
            },
            x:{
                ticks:{
                    display:false
                },
                grid:{
                    display:false
                }
            }
        },
        plugins:{
            legend:{
                display:true,
                position:'top',
                align:'end',
            }
        }
    }
});

//donut chart

const cty = document.getElementById('DonutChart').getContext('2d');
const myDChart = new Chart(cty, {
    type: 'doughnut',
    data: {
        labels: ['Returning Visitor', 'Unique Visitor'],
        datasets: [{
            label: 'Visitor Comparison',
            data: [<?=$data['visitor_count']['returningVisitor'];?>,<?=$data['visitor_count']['uniqueVisitor'];?>,],
            backgroundColor: [
                'rgba(65, 109, 149, 0.5)',
                'rgba(51, 84, 114, 0.8)'
            ],
            borderColor: [
                'rgba(65, 109, 149, 1)',
                'rgba(51, 84, 114, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio:false,
        responsive:true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

//map
vCountry();
cMap();
function cMap(){
    google.charts.load('current', {
        'packages':['geochart'],
        'mapsApiKey':'<?=$data['config_info']['apikey'];?>'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Unique Visitors'],
          <?php
            foreach($data['visitor_map'] as $cmap){
                echo "['".$cmap['pv_country']."', ".$cmap['Visitor']."],";
            }
          ?>
        ]);

        var options = {
            title: 'Visitors Map',
            colorAxis: {colors: ['#667c91','#42586e']},
            enableRegionInteractivity: true,
            keepAspectRatio: true,
            tooltip: {isHtml: true}
        };

        var chart = new google.visualization.GeoChart(document.getElementById('cMap'));

        chart.draw(data, options);

        $(window).resize(function(){
        chart.draw(data, options);
    });
      }
}
//top country
function vCountry(){
    const data = {
    labels: [<?php foreach($tcl as $tccl){echo '"'.$tccl.'",';}?>],
    datasets: [{
    label: '10 Top Countries',
    data: [<?php foreach($tcd as $tccd){echo '"'.$tccd.'",';}?>],
    backgroundColor: [
        'rgba(13, 44, 71, 0.8)',
        'rgba(17, 57, 92, 0.8)',
        'rgba(22, 72, 116, 0.8)',
        'rgba(47, 84, 117, 0.8)',
        'rgba(62, 91, 116, 0.8)',
        'rgba(77, 111, 141, 0.8)',
        'rgba(90, 127, 160, 0.8)'
    ],
    borderColor: [
        'rgba(13, 44, 71, 1)',
        'rgba(17, 57, 92, 1)',
        'rgba(22, 72, 116, 1)',
        'rgba(47, 84, 117, 1)',
        'rgba(62, 91, 116, 1)',
        'rgba(77, 111, 141, 1)',
        'rgba(90, 127, 160, 1)'
    ],
    borderWidth: 1
    }]
};

const config = {
    type: 'bar',
    data,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        indexAxis:'y',
    scales: {
        y: {
        beginAtZero: true
        }
    },
    plugins:{
        legend:{
            display:true,
            position:'top',
            align:'start'
        }
    }
    }
};

const myCChart = new Chart(
    document.getElementById('myCChart'),
    config
);
}
</script>
