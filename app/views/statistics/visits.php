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
            <h3 class="mt-2 bg-hard-blue text-light text-center p-1">Visit Statistics</h3>
            <p class="list-group-item border-left-main">This page contains information regarding visit that this journal gets since the first time it is connected to OJStat. We present you with daily, monthly, and yearly visit statistic that show you all, unique, and returning visitors. The number of visitor today and average daily visit are also included. Click <a href="#additionalInfo">here</a> to read more.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h4 class="bg-dark text-light text-center p-1 border-left-main">Daily Visits</h4>
                    <table class="table table-condensed table-striped table-sm" id="daily">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>Date</th>
                                <th class='text-center'>All Visitors</th>
                                <th class='text-center'>Unique Visitors</th>
                                <th class='text-center'>Returning Visitors</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($data['daily'] as $visit)
                            {
                                echo "<tr>";
                                echo "<td>";
                                echo Sanitize::clean($visit['pv_date']);
                                echo "<td class='text-center'>";
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
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h4 class="bg-dark text-light text-center p-1 border-left-main">Monthly Visits</h4>
                    <table class="table table-condensed table-striped table-sm" id="monthly">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>Month</th>
                                <th class='text-center'>All Visitors</th>
                                <th class='text-center'>Unique Visitors</th>
                                <th class='text-center'>Returning Visitors</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($data['monthly'] as $monthly)
                                {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo date('m Y', strtotime(sanitize::clean($monthly['pv_date'])));
                                    echo "<td class='text-center'>";
                                    echo Sanitize::clean($monthly['allVisitor']);
                                    echo "<td class='text-center'>";
                                    echo Sanitize::clean($monthly['uniqueVisitor']);
                                    echo "<td class='text-center'>";
                                    echo Sanitize::clean($monthly['allVisitor']-$monthly['uniqueVisitor']);
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <br>
                    <h4 class="bg-dark text-light text-center p-1 border-left-main">Yearly Visits</h4>
                    <table class="table table-condensed table-striped table-sm" id="yearly">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>Year</th>
                                <th class='text-center'>All Visitors</th>
                                <th class='text-center'>Unique Visitors</th>
                                <th class='text-center'>Returning Visitors</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach($data['yearly'] as $yearly)
                            {
                                echo "<tr>";
                                echo "<td>";
                                echo date('Y', strtotime(Sanitize::clean($yearly['pv_date'])));
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($yearly['allVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($yearly['uniqueVisitor']);
                                echo "<td class='text-center'>";
                                echo Sanitize::clean($yearly['allVisitor']-$yearly['uniqueVisitor']);
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <h3 class="bg-dark text-light text-center p-1">Visits Trends</h3>
                <div id="myVisitChartBox" style="width:100%; height:300px" class="p-2 shadow">
                    <canvas id="myVChart"></canvas>
                </div>
                <br>
                <p class="list-group-item">Today, this journal is visited <span class="badge badge-dark"><?= Sanitize::clean($data['today']);?></span> times. <br> Daily average visit for this journal is <span class="badge badge-dark"><?=Sanitize::clean($data['average']);?></span> visitors per day.</p>
                <?php 
                    $vlabel = array();
                    $vdata = array();
                    foreach ($data['chart'] as $chart)
                    {
                        $vlabel[] = date('d M Y', strtotime($chart['pv_date']));
                        $vdata[] = $chart['Visitor'];
                    }
                ?>
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
                        <li class="list-group-item"><strong>All Visitors</strong>: People who visited this journal;</li>
                        <li class="list-group-item"><strong>Unique Visitors</strong>: People who visit this journal for the first time;</li>
                        <li class="list-group-item"><strong>Returning Visitors</strong>: People who have visited this journal before, including yourself;</li>
                        <li class="list-group-item"><strong>Daily Visits</strong>: The number of visits by date;</li>
                        <li class="list-group-item"><strong>Monthly Visits</strong>: The number of visits by month in the current year;</li class="list-group-item">
                        <li class="list-group-item"><strong>Yearly Visits</strong>: The number of visits by year;</li>
                        <li class="list-group-item"><strong>Average Daily Visit</strong>: The average number of visit that this journal gets daily, including your visit.</li>
                    </ol>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
                    <p><strong>Why it matters</strong></p>
                    <p class="list-group-item">As the term suggests, visit statistics captures how well your journal is known by people around the world. The higher the number of visits, especially the number of unique visitors, the more known your journal is. We published scientific articles on our journals because we want to contribute to the development of knowledge and science. We want to be found. At this point, visit statistics shows us whether or not our journals are discovered by other people.</p>
                    <p><strong>Best Practice:</strong></p>
                    <p class="list-group-item">To increase the number of visitors, do journal campaign through Call for Paper (CfP). Share your CfP pamphlet on Social Networks with your journal URL. Additionally, share your journal URL to scientific forums like PKP Community Forum and ResearchGate.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#daily, #monthly, #yearly').dataTable();

    //chart 1
const ctx = document.getElementById('myVChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php foreach($vlabel as $vl){echo '"'. Sanitize::clean($vl).'",';}?>],
        datasets: [{
            label: '# visit trends',
            data: [<?php foreach($vdata as $vd){echo '"'.Sanitize::clean($vd).'",';}?>],
            backgroundColor: [
                'rgba(67, 110, 146, 0.8)'
            ],
            borderColor: [
                'rgba(67, 110, 146, 1)'
            ],
            borderWidth: 1,
            fill:true,
            pointRadius:1,
            tension:0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid:{
                    display:false
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
        }
    }
});

});
    
</script>
