<?php
$gs_data = array(
    'year'=>Sanitize::cleanAll($data['metric_data']['year']),
    'value'=>Sanitize::cleanAll($data['metric_data']['value']),
);
?>
<script>
const data = {
    labels: [<?php foreach($gs_data['year'] as $l){echo '"'.$l.'",';}?>],
    datasets: [{
    type:'line',
    label: '# Google Scholar Citations',
    data: [<?php foreach($gs_data['value'] as $d){echo '"'.$d.'",';}?>],
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
    document.getElementById('gsChart'),
    config
);
</script>