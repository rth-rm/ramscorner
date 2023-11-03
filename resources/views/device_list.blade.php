@include('header')
<title>DEVICE LIST | RAMS CORNER</title>
    <!-- data tables cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

  </head>

  <body>

@foreach ($user as $users)
    @include('sweetalert::alert')
    
    @if($users->u_role == 'Admin')
      @include('sidebar_admin')
    @endif
    

<div class="home-contents">
          <!-- <div class="dashboard-boxes"></div> -->
            <div class="title mb-5">
              <h1>Device List</h1>
              <i class="bi bi-arrows-expand"></i>
            </div>

            <div class="dash-contents">
              <div class="dash-container">
                <div class="device-filters me-3">
                  <div class="head pt-3 ps-5 pe-5">
                    Device Filters
                    <i class="bi bi-arrow-repeat"></i>
                  </div>
                  <hr>
                  <div class="cont pt-3 dropdowns">
                    <!-- Device Type -->
                    <div class="container pb-5 mb-3 droptstyle">
                      <div class="row">
                        <div class="col titlename">
                          Device Type
                        </div>
                        <div class="col">
                          <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- Assignement -->
                    <div class="container pb-5 mb-3 droptstyle">
                      <div class="row">
                        <div class="col titlename">
                          Assignment
                        </div>
                        <div class="col">
                          <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- Recency -->
                    <div class="container pb-5 mb-3 droptstyle">
                      <div class="row">
                        <div class="col titlename">
                          Recency
                        </div>
                        <div class="col">
                          <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="device-lists">
                  <div class="lists">
                    <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Position</th>
                              <th>Office</th>
                              <th>Age</th>
                              <th>Start date</th>
                              <th>Salary</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>Tiger Nixon</td>
                              <td>System Architect</td>
                              <td>Edinburgh</td>
                              <td>61</td>
                              <td>2011-04-25</td>
                              <td>$320,800</td>
                          </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
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


@endforeach
@include('footer')