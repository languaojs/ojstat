<?php
$clabel = array();
$cdatall = array();
$cdataunique = array();

foreach($data['data'] as $chartData)
{
    $clabel[] = $chartData['pv_browser'];
    $cdataall[]=$chartData['allVisitor'];
    $cdataunique[]=$chartData['uniqueVisitor'];
}
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="chartBox" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="widgetChart" title="OJStat | Browser Widget"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    const data = {
      labels: [<?php foreach($clabel as $l){echo '"'.Sanitize::clean($l).'",';}?>],
      datasets: [{
        type:'bar',
        label: '#all visitor',
        data: [<?php foreach($cdataall as $d){echo '"'.Sanitize::clean($d).'",';}?>],
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      },{
        type:'line',
        label: '#unique visitor',
        data: [<?php foreach($cdataunique as $dx){echo '"'.Sanitize::clean($dx).'",';}?>],
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1,
        fill:true
      }]
    };
    const config = {
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        responsive: true,
        maintainAspectRatio: false,
        indexAxis:'y'
      }
    };
    const myChart = new Chart(
      document.getElementById('widgetChart'),
      config
    );
</script>