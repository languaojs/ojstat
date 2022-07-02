<?php 
$data_label = array();
$data_set = array();
foreach($data['metric_data']['year'] as $year)
{
    $data_label[] = Sanitize::clean($year);
}
foreach($data['metric_data']['value'] as $value)
{
    $data_set[] = Sanitize::clean($value);
}
require_once 'top-row.php';
?>
<div class="container">
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="list-group-item border-left-main">Index Copernicus</p>
        </div>
    </div>
    <div class="row mt-3 pl-2">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div id="chartBox" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="iciChart"></canvas>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <p class="list-group-item border-left-main">
                <strong>What is Index Copernicus?</strong>
                <p class="text-justify">Index Copernicus (IC) is an online database of user-contributed information, including profiles of scientists, as well as of scientific institutions, publications and projects established in 1999 in Poland, and operated by Index Copernicus International. The database, named after Nicolaus Copernicus (who triggered the Copernican Revolution), has several assessment tools to track the impact of scientific works and publications, individual scientists, or research institutions. In addition to the productivity aspects, IC also offers the traditional abstracting and indexing of scientific publications.</p>
                <a href="https://en.wikipedia.org/wiki/Index_Copernicus" target="blank">Read more about Index Copernicus</a>
            </p>
        </div>
    </div>
</div>
<script>
    const data = {
    labels: [<?php foreach(array_reverse($data_label) as $tccl){echo '"'.$tccl.'",';}?>],
    datasets: [{
    label: 'ICI Meth.',
    data: [<?php foreach(array_reverse($data_set) as $tccd){echo '"'.$tccd.'",';}?>],
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
    document.getElementById('iciChart'),
    config
);
</script>
