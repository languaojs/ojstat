<?php
$clabel = array();
$cdatall = array();
$cdataunique = array();

foreach($data['data'] as $chartData)
{
    $clabel[] = $chartData['pv_ref_dom'];
    $cdataall[]=$chartData['allVisitor'];
    $cdataunique[]=$chartData['uniqueVisitor'];
}
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="chartBox" style="width:100%; height:300px" class="p-2 shadow">
                <canvas id="widgetChart" title="OJStat | Traffic Sources Widget"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    mainChartV();
    function mainChartV(){
        const data = {
            labels: [<?php foreach($clabel as $l){echo '"'.Sanitize::clean($l).'",';}?>],
        datasets: [{
            type:'bar',
            label: '# all visitors',
            data: [<?php foreach($cdataall as $d){echo '"'.Sanitize::clean($d).'",';}?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },{
            type:'line',
            label: '# unique visitors',
            data: [<?php foreach($cdataunique as $dx){echo '"'.Sanitize::clean($dx).'",';}?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            fill:true
        }]
    };
    const moveChart = {
        id:'moveChart',
        afterEvent(chart, args){
            const { ctx, canvas, chartArea: {left, right, top, bottom, width, height}} = chart;
            canvas.addEventListener('mousemove', (event)=>{
                const x = args.event.x;
                const y = args.event.y;
                
                if(x >= left - 15 && x<= left + 15 && y >= height /2 + top - 15 && y <= height /2 + top + 15){
                    canvas.style.cursor = 'pointer';
                }else if(x >= right - 15 && x<= right + 15 && y >= height /2 + top - 15 && y <= height /2 + top + 15){
                    canvas.style.cursor = 'pointer';
                }else{
                    canvas.style.cursor = 'default';
                }
            })
        },
        afterDraw(chart, args, pluginOptions){
            const { ctx, chartArea: {left, right, top, bottom, width, height}} = chart;
            class CircleChevron {
                draw(ctx, x1, y1, pixel){
                    const angle = Math.PI / 180;
                    ctx.beginPath();
                    ctx.lineWidth = 3;
                    ctx.strokeStyle = 'rgba(102, 102, 102, 1)';
                    ctx.fillStyle = 'white';
                    ctx.arc(x1, height / 2 + top, 15, angle + 0, angle * 360, false);
                    ctx.stroke();
                    ctx.fill();
                    ctx.closePath();
                    ctx.beginPath();
                    ctx.strokeStyle = 'rgba(255, 26, 104, 1)';
                    ctx.moveTo(x1 + pixel, height/2+top -7.5);
                    ctx.lineTo(x1 - pixel, height/2+top);
                    ctx.lineTo(x1 + pixel, height/2+top +7.5);
                    ctx.stroke();
                    ctx.closePath();
                }
            }
            let drawCircleLeft = new CircleChevron();
            drawCircleLeft.draw(ctx, left, 1, 5);

            let drawCircleRight = new CircleChevron();
            drawCircleRight.draw(ctx, right, 1, -5);
        }
    }

    const config = {    
        data,
        options: {
            layout:{
                padding:{
                    right:18,
                    bottom:30
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        scales: {
            x:{
                min:0,
                max:6,
            },
            y: {
            beginAtZero: true
            }
        }
        },
        plugins: [moveChart]
    };

    const widgetChart = new Chart(
        document.getElementById('widgetChart'),
        config
    );

    function moveScroll(){
        const { ctx, canvas, chartArea: {left, right, top, bottom, width, height}} = widgetChart;
        canvas.addEventListener('click', (event)=>{
            const rect = canvas.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;
            if(x >= left - 15 && x<= left + 15 && y >= height /2 + top - 15 && y <= height /2 + top + 15){
                widgetChart.options.scales.x.min = widgetChart.options.scales.x.min - 7;
                widgetChart.options.scales.x.max = widgetChart.options.scales.x.max - 7;
                if(widgetChart.options.scales.x.min <= 0){
                    widgetChart.options.scales.x.min = 0;
                    widgetChart.options.scales.x.max = 6;
                };
            }
            if(x >= right - 15 && x<= right + 15 && y >= height /2 + top - 15 && y <= height /2 + top + 15){
                widgetChart.options.scales.x.min = widgetChart.options.scales.x.min + 7;
                widgetChart.options.scales.x.max = widgetChart.options.scales.x.max + 7;
                if(widgetChart.options.scales.x.max >= data.datasets[0].data.length){
                    widgetChart.options.scales.x.min = data.datasets[0].data.length - 7;
                    widgetChart.options.scales.x.max = data.datasets[0].data.length;
                };
            }
            widgetChart.update();
        })
    }
    widgetChart.ctx.onclick = moveScroll();
}
</script>