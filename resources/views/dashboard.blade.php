<style>

/* dashboard */
.home-section {
  /* z-index: 2; */
  background: #f6f7fb;
  position: fixed;
  min-height: 100vh;
  width: calc(100% - 100px);
  left: 100px;
  transition: all 0.4s ease;
}


.home-section nav {
  height: 80px;
  border-bottom: 2px solid #ffffff;
  padding: 0 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.home-section nav .sidebar-button {
  display: flex;
  align-items: center;
  font-size: 24px;
  font-weight: 500;
}

.home-section nav .sidebar-button i {
  font-size: 30px;
  margin-right: 10px;
}

.home-section nav .profile-details {
  display: flex;
  align-items: center;
  height: 50px;
  font-size: 30px;
}

.home-section nav .profile-details i {
  margin: 15px;
}

.home-contents {
  margin: 30px;
  /* border: #05e0e9 1px solid; */
}

.home-contents .title {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.home-contents .title h1{
  font-weight: 700;
}
.home-contents .title i{
  /* font-weight: 900; */
  font-size: 20px;
}

/* edit dashboard contents here */
.dash-contents {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  /* text-align: center; */
}

.home-contents .dash-contents .charts {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border-radius: 20px;
}

.home-contents .dash-contents .grid-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
}

@media (max-width: 1000px) {
  .dash-contents {
    grid-template-columns: repeat(1, 1fr);
  }

  .home-contents .dash-contents .grid-stats {
    grid-template-columns: repeat(2, 1fr);
  }
  .home-section {
    min-height: 200vh;
  }
}

@media (max-width: 480px) {
  .home-contents .dash-contents .grid-stats {
    grid-template-columns: repeat(1, 1fr);
  }
  .home-section {
    min-height: 350vh;
  }
}

.home-contents .dash-contents .grid-stats .items {
  border-radius: 10%;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  padding: 21px;
  margin: 30px;
  text-align: center;
  font-weight: 500;
  font-size: 30px;
}
.home-contents .dash-contents .KB {
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border-radius: 50px;
  height: 20%;
  background: #56aeff;
  margin: 20px;
  padding: 40px;
}

</style>

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
                          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
          
                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                    ['Year', 'Sales', 'Expenses'],
                    ['2013',  1000,      400],
                    ['2014',  1170,      460],
                    ['2015',  660,       1120],
                    ['2016',  1030,      540]
                  ]);
          
                  var options = {
                    title: 'Company Performance',
                    hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
                    vAxis: {minValue: 0}
                  };
          
                  var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                  chart.draw(data, options);
                }
              </script>
            </div>
        </div>

