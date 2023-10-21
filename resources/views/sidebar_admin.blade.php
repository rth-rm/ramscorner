<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  min-height: 100vh;
  width: 100%;
}

.sidebar {
  position: fixed;
  height: 100%;
  width: 100px;
  background: #ffffff;
  transition: all 0.4s ease;
  -moz-box-shadow: -3px 0 5px 0 #555;
  -webkit-box-shadow: -3px 0 5px 0 #555;
  box-shadow: -3px 0 5px 0 #555;
  /* box-shadow: 0 0 10px rgba(0, 0, 0, 1); */
}

.sidebar.active {
  width: 300px;
}

.sidebar .logo-details {
  margin-bottom: 5vh;
  /* align-items: center; */
}
.sidebar .logo-details .profile img {
  width: 40px;
  height: 40px;
  margin-top: 20px;
}

.sidebar.active .logo-details .profile img {
  width: 80px;
  height: 80px;
  margin-top: 20px;
}

.sidebar .logo-details .profile p {
  display: none;
}

.sidebar.active .logo-details .profile p {
  display: block;
  margin-top: 2vh;
}

.sidebar .nav-links li {
  height: 100px;
  width: 100%;
  list-style: none;
}

.sidebar .nav-links li a {
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  text-decoration: none;
  transition: all 0.4s ease;
  border-radius: 50px;
  justify-content: center;
}
.sidebar.sidebar.active .nav-links li a {
  justify-content: start;
  transition: all 0.4s ease;
}

.sidebar .nav-links li a:hover {
  background: #05e0e9;
  width: 100%;
}

.sidebar .nav-links li a i {
  min-width: 60px;
  text-align: center;
  color: #2e266d;
  font-size: 30px;
}

.sidebar .nav-links li a .link_name {
  color: #2e266d;
  font-size: 20px;
  font-weight: 400;
  display: none;
  transition: all 0.4s ease;
}
.sidebar.sidebar.active .nav-links li a .link_name {
  display: contents;
  transition: all 0.4s ease;
}
.sidebar .grp-name {
  margin-left: 60px;
  position: absolute;
  align-items: center;
  bottom: -15px;
  width: 100%;
  transition: all 0.5ms ease;
}

/* dashboard */
.home-section {
  /* z-index: 2; */
  background: #f6f7fb;
  position: relative;
  min-height: 100vh;
  width: calc(100% - 100px);
  left: 100px;
  transition: all 0.4s ease;
}

.sidebar.active ~ .home-section {
  width: calc(100% - 300px);
  left: 300px;
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




</style>
    <!-- sidebar -->
    <div class="sidebar">
      <div class="logo-details">
        <center class="profile">
          <img src={{ asset('images/APCLogo.png') }} alt="">
          <!-- <p>Nacor Industries</p> -->
        </center>
      </div>
      <ul class="nav-links" style="padding: 0;">
        <li>
          <a href="{{ url('/adminHome') }}">
            <i class="bi bi-columns-gap"></i>
            <span class="link_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ url('viewAllTickets') }}">
            <i class="bi bi-ticket-perforated"></i>
            <span class="link_name">Tickets</span>
          </a>
        </li>
        <li>
          <a href="{{ url('admin_KB') }}">
            <i class="bi bi-lightbulb"></i>
            <span class="link_name">Knowledge Base</span>
          </a>
        </li>
        <li>
          <a href="{{ url('generateReport') }}">
            <i class="bi bi-bar-chart"></i>
            <span class="link_name">Reports</span>
          </a>
        </li>
        <li>
          <a href="{{ url('viewTags') }}">
            <i class="bi bi-tags"></i>
            <span class="link_name">Tags</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bi bi-pc-display"></i>
            <span class="link_name">Devices</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- header/contents -->
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bi bi-list sidebarBtn"></i>
                <!-- <span class="dashboard">Rams Corner</span> -->
            </div>
            <div class="profile-details">
              
                  <div class="dropdown1">
                    <i class="bi bi-bell" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" style="">
                      <li><span class="dropdown-item-text">Notifications</span></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Notifications  1</a></li>
                      <li><a class="dropdown-item" href="#">Notifications 2</a></li>
                    </ul>
                  </div>

                  <div class="dropdown2">
                    <i class="bi bi-person-circle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    
                      <ul class="dropdown-menu" style="">
                        <li><a class="dropdown-item" href="{{ url('/signout') }}">Sign out</a></li>
                      </ul>
                    </div>
            </div>
        </nav>

        {{-- <div class="home-contents">
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
            </div> --}}
        </div>

    </section>
    

    <!-- sidebar button script -->
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");

        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>

