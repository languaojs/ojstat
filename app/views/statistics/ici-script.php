<?php 
if(is_array($data['datalabel'])&&is_array($data['dataset']))
{
    $data_label = array();
    $data_set = array();
    foreach($data['datalabel']as $label)
    {
        $data_label[] = Sanitize::clean($label);
    }
    foreach($data['dataset']as $set)
    {
        $data_set[] = Sanitize::clean($set);
    }
}
?>
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
