<div class="home-contents">
    <div class="dashboard-boxes"></div>
    <div class="title mb-5">
        <h1>Admin Dashboards</h1>
        <i class="bi bi-calendar2  me-4"><input class="ms-3" type="text" name="daterange" value="01/01/2023 - 01/15/2023" /></i>
        <script>
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                        .format('YYYY-MM-DD'));
                });
            });

        </script>
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
                            <select class="form-select" aria-label="Default select example" style="width: 200px; margin-left: 150px;">
                                <option selected disabled>Select</option>
                                <option value="1">Daily</option>
                                <option value="2">Weekly</option>
                                <option value="3">Annually </option>
                            </select>
                        </span>
                    </div>
                </div>
                <p class="card-text">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div id="chart" style="width: 100%; height: 500px; padding:10px; background-color: #ffffff">
                            <canvas id="chart_div"></canvas>
                            <canvas id="resolutionChart"></canvas>

                        </div>
                    </div>
                </p>

            </div>
        </div>
        <div class="">
            <div class="grid-stats">
                <div class="items">
                    <div style="border-top: 50px solid #75D481;  border-radius: 25px;">
                    </div>
                    <span style="font-size: 30px; font-weight: 500; color: #333;">{{ $opened }}</span>
                    <h6>Opened Tickets</h6>
                </div>
                <div class="items">
                    <div style="border-top: 50px solid #6257E3;  border-radius: 25px;">
                    </div>
                    <span style="font-size: 30px; font-weight: 500; color: #333;">{{ $all }}</span>
                    <h6>Total Tickets</h6>
                </div>
                <div class="items">
                    <div style="border-top: 50px solid #EEF8EB;  border-radius: 25px;">
                    </div>
                    <span style="font-size: 30px; font-weight: 500; color: #333;">{{ $pending }}</span>
                    <h6>Pending Tickets</h6>
                </div>
                <div class="items">
                    <div style="border-top: 50px solid #8F5D46;  border-radius: 25px;">
                    </div>
                    <span style="font-size: 30px; font-weight: 500; color: #333;">{{ $resolved }}</span>
                    <h6>Resolved Tickets</h6>
                </div>
                <div class="items">
                    <div style="border-top: 50px solid #05E0E9;  border-radius: 25px;">
                    </div>
                    <span style="font-size: 30px; font-weight: 500; color: #333;">{{ $closed }}</span>
                    <h6>Closed Tickets</h6>
                </div>
                <div class="items">
                    <div style="border-top: 50px solid #E0DFD8;  border-radius: 25px;">
                    </div>
                    <span style="font-size: 30px; font-weight: 500; color: #333;">{{ $escalated }}</span>
                    <h6>Escalated Tickets</h6>
                </div>

            </div>
            <a href="{{ url('admin_KB') }}" style="text-decoration: none;">
                <div class="KB" type="button">
                    <div>
                        <p>Create KB Article</p>
                        <p>Let the users know about the most common issues and their solutions!</p>
                    </div>
                    <div style="font-size: 60px; margin-right: 10%;">
                        <!-- <i class="bi bi-lightbulb"></i> -->
                        <img src={{ asset('images/KBBTN.png') }} alt="" style="width: 90px; margin-left: 10px;">
                    </div>
                </div>
            </a>

        </div>

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
                labels: keys
                , datasets: [{
                        label: 'Opened'
                        , data: openedData
                        , backgroundColor: 'rgba(255, 99, 132, 0.7)'
                    , }
                    , {
                        label: 'Ongoing'
                        , data: ongoingData
                        , backgroundColor: 'rgba(45, 99, 132, 0.7)'
                    , }
                    , {
                        label: 'Pending'
                        , data: pendingData
                        , backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    , }
                    , {
                        label: 'Resolved'
                        , data: resolvedData
                        , backgroundColor: 'rgba(255, 206, 86, 0.7)'
                    , }
                    , {
                        label: 'Closed'
                        , data: closedData
                        , backgroundColor: 'rgba(75, 192, 192, 0.7)'
                    , }
                    , {
                        label: 'Software Tickets'
                        , data: softwareData
                        , fill: true
                        , borderColor: 'rgba(255, 206, 86, 1)'
                        , type: 'line'
                        , yAxis: 'y-axis-1'
                        , tension: 0.5
                    , }
                    , {
                        label: 'Hardware Tickets'
                        , data: hardwareData
                        , fill: true
                        , borderColor: 'rgba(75, 192, 192, 1)'
                        , type: 'line'
                        , yAxis: 'y-axis-2'
                        , tension: 0.5
                    , }
                , ]
            , };

            var chartOptions = {
                scales: {
                    x: {
                        stacked: true
                    , }
                    , y: {
                        stacked: true
                    , }
                    , yAxes: [{
                            id: 'y-axis-1'
                            , type: 'linear'
                            , position: 'left'
                            , grid: {
                                display: false
                            , }
                        , }
                        , {
                            id: 'y-axis-2'
                            , type: 'linear'
                            , position: 'right'
                            , grid: {
                                display: false
                            , }
                        , }
                    , ]
                , }
                , tooltips: {
                    mode: 'index'
                    , intersect: false
                    , callbacks: {
                        label: function(tooltipItem, data) {
                            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                            return datasetLabel + ': ' + value;
                        }
                    , }
                , },
                // Other chart options here
            };

            document.addEventListener('DOMContentLoaded', function() {
                var myChart = new Chart(ctx, {
                    type: 'bar'
                    , data: chartData
                    , options: chartOptions
                , });
            });

        </script>











        <script>
            var data = @json($data);

            var labels = data.map(function(item) {
                return item.ticket_id;
            });

            var resolutionTimes = data.map(function(item) {
                return item.resolution_time;
            });

            var ctx = document.getElementById('resolutionChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: labels
                    , datasets: [{
                        label: 'Resolution Time (minutes)'
                        , data: resolutionTimes
                        , backgroundColor: 'rgba(75, 192, 192, 0.2)'
                        , borderColor: 'rgba(75, 192, 192, 1)'
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        </script>








    </div>
</div>
