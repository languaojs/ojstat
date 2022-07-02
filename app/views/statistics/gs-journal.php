<?php 
    $gs_data = array(
        'h5year'=>Sanitize::cleanAll($data['metric_data']['h5year']),
        'h5index'=>Sanitize::cleanAll($data['metric_data']['h5index']),
        'h5median'=>Sanitize::cleanAll($data['metric_data']['h5median'])
    );
?>
<script>
const data = {
    labels: [<?php foreach(array_reverse($gs_data['h5year']) as $iyear){
        echo '"'.$iyear. '",';
    };?>],
    datasets: [{
    type:'bar',
    label: 'h5-index',
    data: [<?php foreach(array_reverse($gs_data['h5index']) as $h5i){
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
    data: [<?php foreach(array_reverse($gs_data['h5median']) as $h5m){
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
    document.getElementById('gsChart'),
    config
);
</script>