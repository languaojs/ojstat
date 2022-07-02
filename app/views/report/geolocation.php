<?php 
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
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">Geolocation Statistics</p>
        </div>
    </div>
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 mb-3">
            <p><strong>Visitor Map</strong></p>
            <div id="cMap"  style="width:100%; height:300px" class="p-2 shadow"></div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 mb-3">
            <p><strong>Top Ten Countries</strong></p>
            <div id="myVisitChartBox" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="myCChart"></canvas>
            </div>
        </div>
    </div>
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
            <p><strong>Locations</strong></p>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="country-tab" data-toggle="tab" href="#countries" role="tab" aria-controls="home" aria-selected="true">Countries</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="region-tab" data-toggle="tab" href="#regions" role="tab" aria-controls="home" aria-selected="false">Regions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="city-tab" data-toggle="tab" href="#cities" role="tab" aria-controls="profile" aria-selected="false">Cities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="isp-tab" data-toggle="tab" href="#isp" role="tab" aria-controls="isp" aria-selected="false">ISP</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="countries" role="tabpanel" aria-labelledby="home-tab">
                    <br>
                    <table class="table table-sm table-condensed table-hover" id="countryTable">
                        <thead>
                            <tr class="bg-unique text-light">
                                <th>Countries</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique (%)</th>
                                <th class='text-center'>Returning (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['countries'] as $country)
                            {
                                $flag = "<img src='".BASEURL."/public/img/flags/".Sanitize::clean(strtolower($country['pv_countrycode'])).".png' class='shadow'/>";
                                echo "<tr>";
                                echo "<td>";
                                echo $flag ." ".Sanitize::clean($country['pv_country']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($country['allVisitor']);
                                echo "<td class='text-center'>";
                                $percU = $country['uniqueVisitor']/$country['allVisitor']*100;
                                echo Sanitize::clean($country['uniqueVisitor'])." (".Sanitize::clean(number_format($percU,1))."%)";
                                echo "<td class='text-center'>";
                                $ret = $country['allVisitor']-$country['uniqueVisitor'];
                                $percR = $ret/$country['allVisitor']*100;
                                echo Sanitize::clean($ret). " (". Sanitize::clean(number_format($percR,1)) ."%)";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="regions" role="tabpanel" aria-labelledby="home-tab">
                    <br>
                    <table class="table table-condensed table-sm table-hover" id="regionTable">
                        <thead>
                            <tr class="bg-unique text-light">
                                <th>Regions</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['regions'] as $region)
                            {
                                $flag = "<img src='".BASEURL."/public/img/flags/".Sanitize::clean(strtolower($region['pv_countrycode'])).".png' class='shadow'/>";
                                echo "<tr>";
                                echo "<td>";
                                echo $flag." ". Sanitize::clean($region['pv_region'])." (".Sanitize::clean($region['pv_country']).")";
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($region['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($region['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo $region['allVisitor']-$region['uniqueVisitor'];
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="cities" role="tabpanel" aria-labelledby="profile-tab">
                    <br>
                    <table class="table table-condensed table-sm table-hover" id="cityTable">
                        <thead>
                            <tr class="bg-unique text-light">
                                <th>Cities</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['cities'] as $city)
                            {
                                $flag = "<img src='".BASEURL."/public/img/flags/".Sanitize::clean(strtolower($city['pv_countrycode'])).".png' class='shadow'/>";
                                echo "<tr>";
                                echo "<td>";
                                echo $flag ." ". Sanitize::clean($city['pv_city'])." (".Sanitize::clean($city['pv_region']).", ".Sanitize::clean($city['pv_country']).")";
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($city['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($city['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo $city['allVisitor']-$city['uniqueVisitor'];
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="isp" role="tabpanel" aria-labelledby="isp-tab">
                    <br>
                    <table class="table table-condensed table-sm table-hover" id="ispTable">
                        <thead>
                            <tr class="bg-unique text-light">
                                <th>ISP</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['isp'] as $isp)
                            {
                                echo "<tr>";
                                echo "<td>";
                                echo Sanitize::clean($isp['pv_isp']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($isp['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($isp['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo $isp['allVisitor']-$isp['uniqueVisitor'];
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $.fn.DataTable.ext.pager.numbers_length = 5;
    $('#countryTable, #regionTable, #cityTable, #ispTable').dataTable({
        order:[[1,'desc']]
    }); 
});
drawChartSingleDataStackedY('myCChart', 'bar', [<?php foreach($tcl as $tccl){echo '"'.$tccl.'",';}?>], 'Ten top Countries', [<?php foreach($tcd as $tccd){echo '"'.$tccd.'",';}?>]);
cMap();
function cMap(){
    google.charts.load('current', {
        'packages':['geochart'],
        'mapsApiKey':'<?=$data['config_info']['apikey'];?>'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        const data = google.visualization.arrayToDataTable([
          ['Country', 'Visitors'],
          <?php
            foreach($data['visitor_map'] as $cmap){
                echo "['".$cmap['pv_country']."', ".$cmap['Visitor']."],";
            }
          ?>
        ]);

        const options = {
            title: 'Visitors Map',
            colorAxis: {colors: ['#667c91','#42586e']},
            enableRegionInteractivity: true,
            keepAspectRatio: true,
            tooltip: {isHtml: true}
        };

        const chart = new google.visualization.GeoChart(document.getElementById('cMap'));

        chart.draw(data, options);

        $(window).resize(function(){
        chart.draw(data, options);
    });
      }
}
</script>