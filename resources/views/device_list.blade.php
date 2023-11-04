@include('header')
<title>DEVICE LIST | RAMS CORNER</title>
<link rel="stylesheet" href="{{ asset('assets/css/device-list.css') }}" type = "text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- data tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- bootstrap link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</head>



<body>

    @foreach ($user_loggedin as $userloggedin)
        @include('sweetalert::alert')

        @if ($userloggedin->u_role == 'Admin')
            @component('sidebar_admin')
            @endcomponent
        @endif



        <!-- header/contents -->
        <section class="home-section">
            <nav>
                {{-- <div class="sidebar-button">
                    <i class="bi bi-list sidebarBtn"></i>
                </div> --}}
                <div class="profile-details">

                    <div class="dropdown1">
                        <i class="bi bi-bell-fill" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"></i>
                        <ul class="dropdown-menu" style="">
                            <li><span class="dropdown-item-text">Notifications</span></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Notifications 1</a></li>
                            <li><a class="dropdown-item" href="#">Notifications 2</a></li>
                        </ul>
                    </div>

                    <div class="dropdown2">
                        <i class="bi bi-person-fill" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"></i>

                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

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
                                <table id="example" class="hover" style="width: 100%">
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
                                <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('#example').DataTable();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

        </section>


        {{-- <!-- sidebar button script -->
        <script>
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".sidebarBtn");

            sidebarBtn.onclick = function() {
                sidebar.classList.toggle("active");
            }
        </script> --}}
    @endforeach
    @include('footer')
