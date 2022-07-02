<?php 
require_once 'top-row.php';
?>
<div class="container">
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">Systems and Devices</p>
        </div>
    </div>
    <div class="row mt-3 pl-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <p><strong>Operating Systems</strong></p>
                    <div id="sysChartBox1" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="osChart"></canvas>
                    </div>
                    <br>
                    <table class="table table-sm table-hover table-condensed">
                        <thead>
                            <tr class="bg-unique text-light">
                                <th>Operating Systems</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($data['os_table'] as $os_table)
                                {
                                    $icon = "<img src='". BASEURL ."/public/img/icons/$os_table[pv_os].png' width='30' height='30'/>";
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $icon . " " . $os_table['pv_os'];
                                    echo "<td class='text-center'>";
                                    $uniquePerc = ($os_table['uniqueVisitor']/$os_table['allVisitor'])*100;
                                    echo Sanitize::clean(number_format($uniquePerc,1)) . "%" ;
                                    echo "<td class='text-center'>";
                                    $retPerc = ($os_table['allVisitor']-$os_table['uniqueVisitor'])/$os_table['allVisitor']*100;
                                    echo Sanitize::clean(number_format($retPerc, 1)) . "%"  ;
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <p><strong>Browsers</strong></p>
                    <div id="sysChartBox2" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="browserChart"></canvas>
                    </div>
                    <br>
                    <table class="table table-sm table-hover table-condensed">
                        <thead>
                            <tr class="bg-unique text-light">
                                <th>Browsers</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($data['browser_table'] as $browser_table)
                                {
                                    $icon = "<img src='". BASEURL ."/public/img/icons/$browser_table[pv_browser].png' width='30' height='30'/>";
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $icon . " " . $browser_table['pv_browser'];
                                    echo "<td class='text-center'>";
                                    $uniquePerc = ($browser_table['uniqueVisitor']/$browser_table['allVisitor'])*100;
                                    echo Sanitize::clean(number_format($uniquePerc,1)) . "%" ;
                                    echo "<td class='text-center'>";
                                    $retPerc = ($browser_table['allVisitor']-$browser_table['uniqueVisitor'])/$browser_table['allVisitor']*100;
                                    echo Sanitize::clean(number_format($retPerc, 1)) . "%"  ;
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <p><strong>Devices</strong></p>
                    <div id="sysChartBox3" style="width:100%; height:300px" class="p-2 shadow">
                        <canvas id="deviceChart"></canvas>
                    </div>
                    <br>
                    <table class="table table-sm table-hover table-condensed">
                        <thead>
                            <tr class="bg-unique text-light">
                                <th>Devices</th>
                                <th class='text-center'>Unique</th>
                                <th class='text-center'>Returning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($data['device_table'] as $device_table)
                                {
                                    $icon = "<img src='". BASEURL ."/public/img/icons/$device_table[pv_device].png' width='30' height='30'/>";
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $icon . " " . $device_table['pv_device'];
                                    echo "<td class='text-center'>";
                                    $uniquePerc = ($device_table['uniqueVisitor']/$device_table['allVisitor'])*100;
                                    echo Sanitize::clean(number_format($uniquePerc,1)) . "%" ;
                                    echo "<td class='text-center'>";
                                    $retPerc = ($device_table['allVisitor']-$device_table['uniqueVisitor'])/$device_table['allVisitor']*100;
                                    echo Sanitize::clean(number_format($retPerc, 1)) . "%"  ;
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function()
    {
        drawChartDoubleDataStackedY("osChart", [<?php foreach($data['os_data']['os_label'] as $c){echo '"'. $c.'",';}?>], 'bar', 'Returning', [<?php foreach($data['os_data']['os_ret'] as $c1){echo '"'. $c1.'",';}?>],'line', 'Unique', [<?php foreach($data['os_data']['os_u'] as $c2){echo '"'. $c2.'",';}?>]);

        drawChartDoubleDataStackedY("browserChart", [<?php foreach($data['browser_data']['browser_label'] as $d){echo '"'. $d.'",';}?>], 'bar', 'Returning', [<?php foreach($data['browser_data']['browser_ret'] as $d1){echo '"'. $d1.'",';}?>],'line', 'Unique', [<?php foreach($data['browser_data']['browser_u'] as $d2){echo '"'. $d2.'",';}?>]);

        drawChartDoubleData("deviceChart", [<?php foreach($data['device_data']['device_label'] as $e){echo '"'. $e.'",';}?>], 'bar', 'Returning', [<?php foreach($data['device_data']['device_ret'] as $e1){echo '"'. $e1.'",';}?>],'line', 'Unique', [<?php foreach($data['device_data']['device_u'] as $e2){echo '"'. $e2.'",';}?>]);

    });
</script>