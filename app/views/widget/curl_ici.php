<?php 
$chici = curl_init();
$urlici = $ici_url;
curl_setopt($chici, CURLOPT_URL, $urlici);
curl_setopt($chici, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chici, CURLOPT_HEADER, 0);
curl_setopt($chici, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($chici, CURLOPT_CONNECTTIMEOUT, 100);
curl_setopt($chici, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($chici, CURLOPT_REFERER, $urlici);
$resultici = curl_exec($chici);
if (curl_errno($chici)) { echo curl_error($chici); }
else {
  $decodedici = json_decode($resultici, true);
}
curl_close($chici);

$data_label = array();
$data_set = array();

foreach ($decodedici as $datainit)
{
  $data_label[] = $datainit['year'];
  $data_set[] = $datainit['valueNum'];
}
?>
<div class="container">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p>Index Copernicus <a href ="<?="https://journals.indexcopernicus.com/search/details?id=$ici_id";?>">Real Time Metric</a> at <?=date("D, F j, Y");?></p>
    <div id="chartBox" style="width:100%; height:300px" class="p-2 shadow">
        <canvas id="widgetChart" title="OJStat | Index Copernicus Widget"></canvas>
    </div>
  </div>
</div>
<script>

    const data = {
    labels: [<?php foreach(array_reverse($data_label) as $tccl){echo '"'.Sanitize::clean($tccl).'",';}?>],
    datasets: [{
    label: 'ICI Meth.',
    data: [<?php foreach(array_reverse($data_set) as $tccd){echo '"'.Sanitize::clean($tccd).'",';}?>],
    backgroundColor: [
        'rgba(44, 94, 139, 0.8)'
    ],
    borderColor: [
        'rgba(44, 94, 139, 0.93)'
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
    scales: {
        y: {
        beginAtZero: true
        }
    }
    }
};
const myCChart = new Chart(
    document.getElementById('widgetChart'),
    config
);
</script>
