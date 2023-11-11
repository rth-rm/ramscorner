<div class="home-contents">
    <div class="dashboard-boxes"></div>
    <div class="title mb-5">
        <h1>Admin Dashboard</h1>
        <i class="bi bi-calendar2  me-4"> October 01, 2023 - October 31, 2023</i>
    </div>

    <div class="dash-contents">
        <div class="charts">
            <div class="card-body">
                <div class="row pt-4">
                    <div class="col">
                        <h3 class="card-title ps-3">Ticket Summary</h3>
                    </div>
                    <div class="col">
                        <span class="card-subtitle mb-2 text-body-secondary text-end">
                            <div class="dropstart pe-5">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort by:
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Daily</a></li>
                                    <li><a class="dropdown-item" href="#">Weekly</a></li>
                                    <li><a class="dropdown-item" href="#">Monthly</a></li>
                                </ul>
                            </div>
                        </span>
                    </div>
                </div>
                <p class="card-text">
                <div class="embed-responsive embed-responsive-16by9">
                    <div id="chart" style="width: 100%; height: 500px; padding:10px; background-color: #ffffff">
                        <canvas id="chart_div"></canvas>
                    </div>
                </div>
                </p>

            </div>
        </div>
        <div class="">
            <div class="grid-stats">
                <div class="items" style=" border-top:50px solid #75D481">69
                    <h6>Opened TIckets</h6>
                </div>
                <div class="items" style=" border-top:50px solid #6257E3">420
                    <h6>Opened TIckets</h6>
                </div>
                <div class="items" style=" border-top:50px solid #EEF8EB">69
                    <h6>Opened TIckets</h6>
                </div>
                <div class="items" style=" border-top:50px solid #8F5D46">12
                    <h6>Opened TIckets</h6>
                </div>
                <div class="items" style=" border-top:50px solid #05E0E9">12
                    <h6>Opened TIckets</h6>
                </div>
                <div class="items" style=" border-top:50px solid #E0DFD8">54
                    <h6>Opened TIckets</h6>
                </div>
            </div>
            <div class="KB" type="button">
                <div>
                    <p>Create KB Article</p>
                    <p>Let the users know about the most common issues and their solutions!</p>
                </div>
                <div style="font-size: 60px; margin-right: 10%;">
                    <i class="bi bi-lightbulb"></i>
                </div>
            </div>
        </div>
        {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Year', 'Sales', 'Expenses'],
                    ['2013', 1000, 400],
                    ['2014', 1170, 460],
                    ['2015', 660, 1120],
                    ['2016', 1030, 540]
                ]);

                var options = {
                    title: 'Company Performance',
                    hAxis: {
                        title: 'Year',
                        titleTextStyle: {
                            color: '#333'
                        }
                    },
                    vAxis: {
                        minValue: 0
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script> --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('chart_div').getContext('2d');

            var statusCounts = @json($statusmonth);
            var softwareCounts = @json($softwaremonth);
            var hardwareCounts = @json($hardwaremonth);
            var keys = Object.keys(statusCounts);


            var openedData = keys.map(function(key) {
                return statusCounts[key].opened;
            });

            var ongoingData = keys.map(function(key) {
                return statusCounts[key].ongoing;
            });

            var pendingData = keys.map(function(key) {
                return statusCounts[key].pending;
            });
            var resolvedData = keys.map(function(key) {
                return statusCounts[key].resolved;
            });
            var closedData = keys.map(function(key) {
                return statusCounts[key].closed;
            });

            var softwareData = keys.map(function(key) {
                return softwareCounts[key] || 0;
            });

            var hardwareData = keys.map(function(key) {
                return hardwareCounts[key] || 0;
            });

            var chartData = {
                labels: keys,
                datasets: [{
                        label: 'Opened',
                        data: openedData,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    },
                    {
                        label: 'Ongoing',
                        data: ongoingData,
                        backgroundColor: 'rgba(45, 99, 132, 0.7)',
                    },
                    {
                        label: 'Pending',
                        data: pendingData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    },
                    {
                        label: 'Resolved',
                        data: resolvedData,
                        backgroundColor: 'rgba(255, 206, 86, 0.7)',
                    },
                    {
                        label: 'Closed',
                        data: closedData,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    },
                    {
                        label: 'Software Tickets',
                        data: softwareData,
                        fill: true,
                        borderColor: 'rgba(255, 206, 86, 1)',
                        type: 'line',
                        yAxis: 'y-axis-1',
                        tension: 0.5,
                    },
                    {
                        label: 'Hardware Tickets',
                        data: hardwareData,
                        fill: true,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        type: 'line',
                        yAxis: 'y-axis-2',
                        tension: 0.5,
                    },
                ],
            };

            var chartOptions = {
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                    },
                    yAxes: [{
                            id: 'y-axis-1',
                            type: 'linear',
                            position: 'left',
                            grid: {
                                display: false,
                            },
                        },
                        {
                            id: 'y-axis-2',
                            type: 'linear',
                            position: 'right',
                            grid: {
                                display: false,
                            },
                        },
                    ],
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                            return datasetLabel + ': ' + value;
                        },
                    },
                },
                legend: {
                    display: false,
                },
                legendCallback: function(chart) {
                    var text = [];
                    text.push('<ul class="legend-list">');
                    chart.data.datasets.forEach(function(dataset, index) {
                        text.push('<li><span style="background-color:' + dataset.backgroundColor +
                            ';"></span>');
                        text.push(dataset.label);
                        text.push('</li>');
                    });
                    text.push('</ul>');
                    return text.join('');
                },
            };

            document.addEventListener('DOMContentLoaded', function() {
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: chartData,
                    options: chartOptions,
                });
            });
        </script>
    </div>
</div>
<style>
    .legend-list {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .legend-list li {
        margin: 0 10px;
        display: flex;
        align-items: center;
    }

    .legend-list li span {
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        margin-right: 5px;
    }
</style>
