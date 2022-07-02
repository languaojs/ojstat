<?php 
Session::start();
$role = array("admin", "user");
$ses_role = Session::get_sess_role();
Session::get_role($ses_role, $role);
$name = Session::get_name();
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <?php require_once '../app/views/user/menus/menu_statistics.php';?>
            </nav>
            <br>
            <h3 class="mt-2 bg-hard-blue text-light text-center p-1">Visitor Countries</h3>
            <p class="list-group-item border-left-main">As your journal starts getting visits, you need to know where the visitors come from. On this page, you can find the to 10 countries that bring visitors to this journal, the visitor map, and the cities of your visitor. Why this matters? Click <a href ="#additionalInfo">here</a> to find out.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <h4 class="bg-dark text-light text-center p-1 border-left-main">Visitor Map</h4>
                    <div id="cMap"  style="width:100%; height:300px" class="p-2 shadow"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <h4 class="bg-dark text-light text-center p-1 border-left-main">10 Top Countries</h4>
                    <div id="myVisitChartBox" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="myCChart"></canvas>
                    </div>
                    <?php 
                        $tcl = array();
                        $tcd = array();
                        foreach($data['top'] as $tc)
                        {
                            $tcl[]=$tc['pv_country'];
                            $tcd[]=$tc['Visitor'];
                        }
                    ?>
                </div>
            </div>
            <br>
            <h3 class="bg-dark text-light text-center p-1">Countries and Cities</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h5 class="bg-dark text-light text-center p-1 border-left-main">Countries</h5>
                    <table class="table table-condensed table-striped table-sm" id="countryTable">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>Country</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['countries'] as $country)
                            {
                                $flag = "<img src='".BASEURL."/public/img/flags/".strtolower($country['pv_countrycode']).".png' class='shadow'/>";
                                echo "<tr>";
                                echo "<td>";
                                echo $flag .' '.$country['pv_country'];
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($country['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($country['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($country['allVisitor']-$country['uniqueVisitor']);
                                echo "</td>";
                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h5 class="bg-dark text-light text-center p-1 border-left-main">Cities</h5>
                    <table class="table table-condensed table-striped table-sm" id="cityTable">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>City</th>
                                <th class='text-center'>All</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['cities'] as $cities)
                            {
                                echo "<tr>";
                                echo "<td>";
                                echo Sanitize::clean($cities['pv_city']) ." (". Sanitize::clean($cities['pv_country']) .")";
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($cities['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($cities['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($cities['allVisitor']-$cities['uniqueVisitor']);
                                echo "</td>";
                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <p class="list-group-item">Last visitor was from <?=Sanitize::clean($data['last']['pv_city']);?>, <?=Sanitize::clean($data['last']['pv_country']);?>.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="additionalInfo">
            <hr>
            <h3>Additional Information</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
                    <p><strong>Terms</strong></p>
                    <ol class="list-group">
                        <li class="list-group-item"><strong>Visitor Map</strong>: A map rendered to show how this journal is known by people around the globe;</li>
                        <li class="list-group-item"><strong>Unique Visitors</strong>: People who visit this journal for the first time;</li>
                        <li class="list-group-item"><strong>Top 10 Countries</strong>: 10 countries where most of the visitors came from;</li>
                        <li class="list-group-item"><strong>Countries</strong>: The number of visitors by country;</li>
                        <li class="list-group-item"><strong>Cities</strong>: The number of visitors by city;</li>
                    </ol>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
                    <p><strong>Why it matters</strong></p>
                    <p class="list-group-item">How popular is this journal? The visitor map shows you the answer. The map captures from where your visitors came from. It is expected that all areas on the map are <i>blue</i> which means that this journal has been known worldwide. This has something to do with the internationalization of the journal, so to speak.You may be finding that most of your visitors come from your own country and that is normal since your visits and/or your colleagues' were also recorded by OJStat. We want your journal to be discovered and accessible to readers in all parts of the globe.</p>
                    <p><strong>Best Practice:</strong></p>
                    <p class="list-group-item">Set your journal to multilingual, at least English is one of the languages applied on your journal. Make sure to have each article title, abstract, and keywords written in English if the original language is different. Additionally, share your journal URL to international forums and invite authors and readers from different countries to participate in your journal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $.fn.DataTable.ext.pager.numbers_length = 5;
    $('#cityTable, #countryTable').dataTable({
        order:[[1,'desc']]
    });
});
vCountry();
cMap();
function cMap(){
    google.charts.load('current', {
        'packages':['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Unique Visitors'],
          <?php
            foreach($data['map'] as $cmap){
                echo "['".Sanitize::clean($cmap['pv_country'])."', ".Sanitize::clean($cmap['uniqueVisitor'])."],";
            }
          ?>
        ]);

        var options = {
            title: 'Unique Visitors',
            colorAxis: {colors: ['#33ADFF', '#003D66']},
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
function vCountry(){
    const data = {
    labels: [<?php foreach($tcl as $tccl){echo '"'.Sanitize::clean($tccl).'",';}?>],
    datasets: [{
    label: '10 Top Countries',
    data: [<?php foreach($tcd as $tccd){echo '"'.Sanitize::clean($tccd).'",';}?>],
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
    }
    }
};


const myCChart = new Chart(
    document.getElementById('myCChart'),
    config
);
}

</script>