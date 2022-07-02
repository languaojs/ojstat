<?php 
include("simple_html_dom.php");
$nowYear = date('Y');
$years = array ($nowYear-1, $nowYear-2, $nowYear-3);
$h5year = array();
$h5index = array();
$h5median = array();
foreach($years as $year){
    $gsurl = "https://scholar.google.com/citations?hl=$gs_lang&view_op=list_hcore&venue=$gs_id.$year";
    $gscurl = curl_init();
    curl_setopt($gscurl, CURLOPT_URL, $gsurl);
    curl_setopt($gscurl, CURLOPT_HEADER, 0);
    curl_setopt($gscurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($gscurl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($gscurl, CURLOPT_CONNECTTIMEOUT, 100);
    curl_setopt($gscurl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($gscurl, CURLOPT_REFERER, $gsurl);
    $gsResult = curl_exec($gscurl);
    curl_close($gscurl);
    $gshtml = new simple_html_dom();
    $gshtml->load($gsResult);
    $gsdata1 = array();
    $gsdata2 = array();
    $gsdata3 = array();
    foreach($gshtml->find('.gsc_mp_anchor')as $gselement){
        $gsdata1[]=$gselement->plaintext;
    }
    foreach($gshtml->find('p')as $gselement){
        $gsdata2[]=$gselement->plaintext;
    }
    foreach($gshtml->find('span')as $gselement){
        $gsdata3[]=$gselement->plaintext;
    }
    $h5year[]=$year;
    $h5index[]=$gsdata3['34'];
    $h5median[]=$gsdata3['35'];
}
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p>Google Scholar <a href="<?=$gsurl;?>" target="blank">Real Time Metrics</a></p>
        <div id="myGsChartBox" style="width:100%; height:300px" class="p-2 shadow">
            <canvas id="myGsChart" title="OJStat | Google Scholar Widget"></canvas>
        </div>
    </div>
</div>
<script>
if(document.getElementById('myGsChart')){
    doit();
}
function doit(){
    const data = {
      labels: [<?php foreach(array_reverse($h5year) as $iyear){
          echo '"'.$iyear. '",';
      };?>],
      datasets: [{
        type:'bar',
        label: 'h5-index',
        data: [<?php foreach(array_reverse($h5index) as $h5i){
            echo '"'. $h5i . '",';
        };?>],
        backgroundColor: [
          'rgba(44, 94, 139, 0.8)'
        ],
        borderColor: [
          'rgba(44, 94, 139, 1)'
        ],
        borderWidth: 1
      },{
        type:'bar',
        label: 'h5-median',
        data: [<?php foreach($h5median as $h5m){
            echo '"'. $h5m . '",';
        };?>],
        backgroundColor: [
          'rgba(44, 94, 139, 0.59)'
        ],
        borderColor: [
          'rgba(44, 94, 139, 1)'
        ],
        borderWidth: 1
      }
    ]
    };
    const config = {
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
    const myChart = new Chart(
      document.getElementById('myGsChart'),
      config
    );
}
</script>