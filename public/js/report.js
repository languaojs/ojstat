$(document).ready(function () {
    $('.mybox').mouseover(function () {
        $(this).addClass('bg-dark text-light');
    });
    $('.mybox').mouseout(function () {
        $(this).removeClass('bg-dark text-light');
    });

    $('[data-toggle="popover"]').popover();
    
});

function drawChartSingleData(divName, type, labels, label, data)
{
    const ctx = document.getElementById(divName).getContext('2d');
    const myChart = new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: [
                    'rgba(67, 110, 146, 0.8)',
                    'rgba(141, 167, 178, 0.52)'

                ],
                borderColor: [
                    'rgba(67, 110, 146, 1)',
                    'rgba(141, 167, 178, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio:false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


function drawChartDoubleData(divName, labels, type1, label1, data1, type2, label2, data2)
{
    const ctx = document.getElementById(divName).getContext('2d');
    const myChart = new Chart(ctx, {
        //type: type,
        data: {
            labels: labels,
            datasets: [{
                type:type1,
                label: label1,
                data: data1,
                backgroundColor: [
                    'rgba(67, 110, 146, 0.8)'
                ],
                borderColor: [
                    'rgba(67, 110, 146, 1)'
                ],
                borderWidth: 1,
                fill:true
            }, {
                type:type2,
                label: label2,
                data: data2,
                backgroundColor: [
                    'rgba(141, 167, 178, 0.52)'
                ],
                borderColor: [
                    'rgba(141, 167, 178, 1)'
                ],
                borderWidth: 1,
                fill:true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio:false,
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    grid: {
                        display:false
                    }
                }
            }
        }
    });
}

function drawChartSingleDataStackedY(divName, type, labels, label, data)
{
    const ctx = document.getElementById(divName).getContext('2d');
    const myChart = new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: [
                    'rgba(67, 110, 146, 0.8)',
                    'rgba(141, 167, 178, 0.52)'

                ],
                borderColor: [
                    'rgba(67, 110, 146, 1)',
                    'rgba(141, 167, 178, 1)'
                ],
                borderWidth: 1
            }]
        },
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
    });
}

function drawChartSingleDataStackedYFa(divName, type, labels, label, data)
{
    const defaultFont = "'Helvetica Neue', 'Helvetica', 'Arial', 'FontAwesome', sans-serif";
    Chart.defaults.font.family = defaultFont;
    const ctx = document.getElementById(divName).getContext('2d');
    const myChart = new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: [
                    'rgba(67, 110, 146, 0.8)',
                    'rgba(141, 167, 178, 0.52)'

                ],
                borderColor: [
                    'rgba(67, 110, 146, 1)',
                    'rgba(141, 167, 178, 1)'
                ],
                borderWidth: 1
            }]
        },
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
    });
}

function drawChartDoubleDataStackedY(divName, labels, type1, label1, data1, type2, label2, data2)
{
    const ctx = document.getElementById(divName).getContext('2d');
    const myChart = new Chart(ctx, {
        //type: type,
        data: {
            labels: labels,
            datasets: [{
                type:type1,
                label: label1,
                data: data1,
                backgroundColor: [
                    'rgba(67, 110, 146, 0.8)'
                ],
                borderColor: [
                    'rgba(67, 110, 146, 1)'
                ],
                borderWidth: 1,
                fill:true
            }, {
                type:type2,
                label: label2,
                data: data2,
                backgroundColor: [
                    'rgba(141, 167, 178, 0.52)'
                ],
                borderColor: [
                    'rgba(141, 167, 178, 1)'
                ],
                borderWidth: 1,
                fill:true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis:'y',
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    grid: {
                        display:false
                    }
                }
            }
        }
    });
}

function drawChartDoubleDataScrollable(divName, labels, type1, label1, data1, type2, label2, data2)
{
    const data = {
        labels: labels,
        datasets: [{
            type:type1,
            label: label1,
            data: data1,
            backgroundColor: [
                'rgba(67, 110, 146, 0.8)',
                'rgba(67, 110, 146, 0.56)'
            ],
            borderColor: [
                'rgba(67, 110, 146, 0.8)',
                'rgba(67, 110, 146, 0.56)'
            ],
            borderWidth: 1,
            fill:true,
            pointRadius:0.2,
        },{
            type:type2,
            label: label2,
            data: data2,
            backgroundColor: [
                'rgba(141, 167, 178, 0.52)'
            ],
            borderColor: [
                'rgba(141, 167, 178, 1)'
            ],
            borderWidth: 1,
            fill:true,
            pointRadius:0.2,
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
                ctx.strokeStyle = 'rgba(141, 167, 178, 1)';
                ctx.fillStyle = 'white';
                ctx.arc(x1, height / 2 + top, 15, angle + 0, angle * 360, false);
                ctx.stroke();
                ctx.fill();
                ctx.closePath();
                ctx.beginPath();
                ctx.strokeStyle = 'rgba(141, 167, 178, 1)';
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
                ticks:{
                    display:true
                },
                grid:{
                    display:false
                }
            },
            y: {
                beginAtZero: true
            }
        },
        plugins:{
            legend:{
                display:true,
                position:'top',
                align:'end',
            }
        }
    },
    plugins: [moveChart]
};

const widgetChart = new Chart(
    document.getElementById(divName),
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
