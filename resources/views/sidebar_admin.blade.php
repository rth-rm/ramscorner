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

<div class="sidebar">
      <div class="logo-details">
        <center class="profile">
          <img src="/resources/APCLogo.png" alt="">
          <!-- <p>Nacor Industries</p> -->
        </center>
      </div>
      <ul class="nav-links" style="padding: 0;">
        <li>
          <a href="dashboard3.html">
            <i class="bi bi-columns-gap"></i>
            <span class="link_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="ticketcenter.html">
            <i class="bi bi-ticket-perforated"></i>
            <span class="link_name">Tickets</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bi bi-lightbulb"></i>
            <span class="link_name">Knowledge Base</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bi bi-bar-chart"></i>
            <span class="link_name">Reports</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bi bi-tags"></i>
            <span class="link_name">Tags</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bi bi-pc-display"></i>
            <span class="link_name">Personal Tickets</span>
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
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                      </ul>
                    </div>
            </div>
        </nav>
    </section>
