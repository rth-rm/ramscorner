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
                    <div id="chart_div" style="width: 100%; height: 500px;"></div>
                </div>
                </p>
                <div class="text-center">
                    <i href="#" class="card-link">Software</i>
                    <i href="#" class="card-link">Hardware</i>
                    <i href="#" class="card-link">Resolved</i>
                </div>
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
                    <p>Let the users know about shit that matters at ipakita mo kung sino ka</p>
                </div>
                <div style="font-size: 60px; margin-right: 10%;">
                    <i class="bi bi-lightbulb"></i>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        </script>
        <script>
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".sidebarBtn");

            sidebarBtn.onclick = function() {
                sidebar.classList.toggle("active");
            }
        </script>
    </div>
</div>
