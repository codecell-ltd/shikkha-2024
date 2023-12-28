<!DOCTYPE HTML>
<html>

<head>
    {{-- <script>
        window.onload = function() {

            var options = {
                animationEnabled: true,
                title: {
                    text: "School Chart",
                    fontColor: "Peru"
                },
                axisY: {
                    tickThickness: 0,
                    lineThickness: 0,
                    valueFormatString: " ",
                    includeZero: true,
                    gridThickness: 0
                },
                axisX: {
                    tickThickness: 0,
                    lineThickness: 0,
                    labelFontSize: 18,
                    labelFontColor: "Peru"
                },
                data: [{
                    indexLabelFontSize: 26,
                    toolTipContent: "<span style=\"color:#62C9C3\">{indexLabel}:</span> <span style=\"color:#CD853F\"><strong>{y}</strong></span>",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "white",
                    indexLabelFontWeight: 600,
                    indexLabelFontFamily: "Verdana",
                    color: "#62C9C3",
                    type: "bar",
                    dataPoints: [{
                        y: 214,
                        label: "21%",
                        indexLabel: "Video"
                    }, ]
                }]
            };

            $("#chartContainer").CanvasJSChart(options);
        }
    </script> --}}
</head>

<body>
    <div id="myChart" style="height: 300px; width: 100%;"></div>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
        var xValues = @json($xValues);
        var yValues = @json($yValues);
        var barColors = @json($colors);
        // var barColors = ['red', 'green', 'blue', 'orange'];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'traffic',
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                }
            }
        });
    </script>

</body>

</html>
