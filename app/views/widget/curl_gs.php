<?php 
include('simple_html_dom.php');
$gsurl = "https://scholar.google.com/citations?view_op=list_works&hl=".$lang."&user=".$userid."&pagesize=".$pagesize;
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
foreach($gshtml->find('.gsc_g_al')as $gselement){
    $gsdata1[]=$gselement->plaintext;
}
foreach($gshtml->find('.gsc_g_t')as $gselement){
    $gsdata2[]=$gselement->plaintext;
}
foreach($gshtml->find('.gsc_rsb_std')as $gselement){
    $gsdata3[]=$gselement->plaintext;
}
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>Google Scholar <a href="<?=Sanitize::clean($gsurl);?>" target="blank">Real Time Citation</a> <br> <span class="badge badge-primary">Total <?=Sanitize::clean($gsdata3[0]);?></span> <span class="badge badge-dark">h-index <?=Sanitize::clean($gsdata3[2]);?></span> <span class="badge badge-success">i10-index <?=Sanitize::clean($gsdata3[4]);?></span></p>
            <div id="chartBox" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="widgetChart" title="OJStat | Google Scholar Widget"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    const data = {
      labels: [<?php foreach($gsdata2 as $l){echo '"'.Sanitize::clean($l).'",';}?>],
      datasets: [{
        type:'line',
        label: '# Google Scholar Citations',
        data: [<?php foreach($gsdata1 as $d){echo '"'.Sanitize::clean($d).'",';}?>],
        backgroundColor: [
          'rgba(44, 94, 139, 0.8)'
        ],
        borderColor: [
          'rgba(44, 94, 139, 0.93)'
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
      }
    };
    const myChart = new Chart(
      document.getElementById('widgetChart'),
      config
    );
</script>