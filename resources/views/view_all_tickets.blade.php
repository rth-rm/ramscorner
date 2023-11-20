@include('header')
<title>Ticket Center | RAMS Corner</title>
<link rel="stylesheet" href="{{ asset('assets/css/ticketcenter.css') }}" type="text/css">
<!-- data tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- bootstrap link -->
</head>



<body>
    @foreach ($user_loggedin as $userloggedin)
    @include('sweetalert::alert')

    @include('sidebar_admin')



    <div class="home-contents">
        <div class="title mb-5">
            <h1>Ticket Center</h1>
            <div style="color: #9a9ca1; display: grid; grid-template-columns: 1fr .5fr .5fr">
                <a href="{{ url('createTicketPage') }}">
                    <button type="button" class="btn btn-lg me-5 m-3 mt-1" style="border-radius: 25px; background-color:#6644A8; color: #ffffff;">Create Ticket</button>
                </a>
                <select id="filterSelect" class="form-select" aria-label="Default select example" style="border-radius: 25px; border: 2px solid #6644A8; color:#6644A8; font-weight: 700; height: 80%; width: 200px">
                    <option selected value="RecievedTickets">Recieved Tickets</option>
                    <option value="TaggedTickets">Tagged Tickets</option>
                    <option value="MyTickets">My Tickets</option>
                </select>

                <!-- EDIT  sort button -->
                <i id="sortButton" type="button" class="bi bi-arrows-expand ms-5"></i>
            </div>
        </div>

        <div class="dash-contents">
            <div class="dash-container">
                <div class="tic-filters me-3">
                    {{-- edited --}}
                    <div class="head pt-4 ps-3 pe-3" style="color: #817e9d; font-size: 21px; font-weight: 700;">
                        Ticket Filter
                        <!-- EDIT reset button -->
                        <i type="button" id="resetButton" class="bi bi-arrow-repeat"></i>
                    </div>
                    <hr>
                    {{-- EDITED --}}
                    <div class="container pt-2 ps-2 dropdiv mt-1">
                        <!-- recency -->
                        <div class="container pb-1 mb-4">
                            <div class="row">
                                <div class="col titlename">
                                    Recency
                                </div>
                                <div class="col">
                                    <select id="recencySelect" class="form-select" aria-label="Default select example" style="border: block; color: eeeff1">
                                        <option selected disabled>All</option>
                                        <option value="Daily">Daily</option>
                                        <option value="Weekly">Weekly</option>
                                        <option value="Monthly">Monthly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Catgeory -->
                        <div class="container pb-1 mb-4">
                            <div class="row">
                                <div class="col titlename">
                                    Category
                                </div>
                                <div class="col">
                                    <select id="categorySelect" class="form-select" aria-label="Default select example" style="border: block; color: eeeff1">
                                        <option selected value="All">All</option>
                                        <option value="Software">Software</option>
                                        <option value="Infrastructure">Infrastructure</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="container pb-1 mb-4">
                            <div class="row">
                                <div class="col titlename">
                                    Status
                                </div>
                                <div class="col">
                                    <select id="statusSelect" class="form-select" aria-label="Default select example" style="border: block; color: eeeff1">
                                        <option selected>All</option>
                                        <option value="Pending">Pending</option>
                                        <option value="New">New</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Agent -->
                        <div class="container pb-1 mb-4">
                            <div class="row">
                                <div class="col titlename">
                                    Agent
                                </div>
                                <div class="col">
                                    <select id="agentSelect" class="form-select" aria-label="Default select example" style="border: block; color: eeeff1">
                                        <option selected>All</option>
                                        <option value="Jose Castillo">Jose Castillo</option>
                                        <option value="Val Rodelas">Val Rodelas</option>
                                        <option value="Lenard">Lenard</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Level -->
                        <div class="container pb-5">
                            <div class="row">
                                <div class="col titlename">
                                    Level
                                </div>
                                <div class="col">
                                    <select id="levelSelect" class="form-select" aria-label="Default select example" style="border: block; color: eeeff1">
                                        <option selected>All</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- reset button script -->
                        <script>
                            document.getElementById('resetButton').addEventListener('click', function() {
                                // Reset the values of all select elements
                                resetSelect(document.getElementById('recencySelect'));
                                resetSelect(document.getElementById('categorySelect'));
                                resetSelect(document.getElementById('statusSelect'));
                                resetSelect(document.getElementById('agentSelect'));
                                resetSelect(document.getElementById('levelSelect'));
                            });

                            function resetSelect(selectElement) {
                                // Set the first option as selected
                                selectElement.selectedIndex = 0;
                            }

                        </script>
                    </div>
                </div>
                <div class="ticket-lists">
                    <div class="lists">
                        <table id="tickets" class="hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject</th>
                                    <th>Requested</th>
                                    <th>Due</th>
                                    <th>Category</th>
                                    <th style="display: none;">Status</th>
                                    <th style="display: none;">Level</th>
                                    <th style="display: none;">Assgined To</th>
                                    <th>Date</th>
                                    <th><i class="bi bi-exclamation-circle"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                <tr onclick="openDiv({{ $ticket->t_ID }})">
                                    <td>INC{{ $ticket->t_ID }}</td>
                                    <td>{{ $ticket->t_title }}</td>
                                    <td>{{ $ticket->t_datetime }}</td>
                                    <td>{{ $ticket->t_due }}</td>
                                    <td>{{ $ticket->t_category }}</td>
                                    <td style="display: none;">{{ $ticket->t_status }}</td>
                                    <td style="display: none;">{{ $ticket->t_priority }}</td>
                                    <td style="display: none;">{{ $ticket->t_assignedTo }}</td>
                                    <td>{{ $ticket->t_datetime }}</td>
                                    <td>
                                        @if ($ticket->breaches == true)
                                        <i class="bi-bi-circle-fill" style="color:red"></i>
                                        @else
                                        <i class="bi bi-circle-fill" style="color:green"></i>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                var table = $('#tickets').DataTable({
                                    order: [
                                        [2, 'asc']
                                    ]
                                });

                                // Add event listener for sorting button
                                $('#sortButton').on('click', function() {
                                    table.order(table.order()[0][0], table.order()[0][1] === 'asc' ? 'desc' : 'asc').draw();
                                });

                                $('#recencySelect').on('click', function() {
                                    if (this.value == "All") {
                                        table.columns(4).search('').draw();
                                    } else if (this.value == "Software") {
                                        table.columns(4).search('SOFTWARE').draw();
                                    } else if (this.value == "Infrastructure") {
                                        table.columns(4).search('INFRASTRUCTURE').draw();
                                    }
                                });

                                $('#categorySelect').on('click', function() {
                                    if (this.value == "All") {
                                        table.columns(4).search('').draw();
                                    } else if (this.value == "Software") {
                                        table.columns(4).search('SOFTWARE').draw();
                                    } else if (this.value == "Infrastructure") {
                                        table.columns(4).search('INFRASTRUCTURE').draw();
                                    }
                                });
                                $('#statusSelect').on('click', function() {
                                    if (this.value == "All") {
                                        table.columns(5).search('').draw();
                                    } else if (this.value == "Pending") {
                                        table.columns(5).search('OPENED').draw();
                                    } else if (this.value == "New") {
                                        table.columns(5).search('NEW').draw();
                                    } else if (this.value == "Closed") {
                                        table.columns(5).search('REJECTED').draw();
                                    }
                                });
                                $('#agentSelect').on('click', function() {
                                    if (this.value == "All") {
                                        table.columns(7).search('').draw();
                                    } else if (this.value == "Jose Castillo") {
                                        table.columns(7).search('Jose Castillo').draw();
                                    } else if (this.value == "Val Rodelas") {
                                        table.columns(7).search('Val Rodelas').draw();
                                    }
                                });
                                $('#levelSelect').on('click', function() {
                                    if (this.value == "All") {
                                        table.columns(6).search('').draw();
                                    } else if (this.value == "1") {
                                        table.columns(6).search('1').draw();
                                    } else if (this.value == "2") {
                                        table.columns(6).search('2').draw();
                                    } else if (this.value == "3") {
                                        table.columns(6).search('3').draw();
                                    }
                                });


                            });

                        </script>
                    </div>
                    {{-- <footer>
                            <hr>
                        </footer> --}}
                </div>
            </div>
        </div>
    </div>

    </section>

    <script>
        function openDiv(divId) {


            var url = "{{ route('openTicket', '') }}" + "/" + divId;

            window.location = url;
        }

    </script>


    <!-- sidebar button script -->
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");

        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
        }

    </script>
    <script>
        function openDiv(divId) {
            var url = "{{ route('openTicket', '') }}" + "/" + divId;
            window.location = url;
        }

    </script>
    @endforeach
    @include('footer')

    {{--
    <div>
        <!-- 1st -->

        <div class="overflow-auto"
            style=" text-align: center; border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; left: 7%; height: 89%; width: 92%;">
            <div class="px-5 pt-4">
                <div class="col">
                    <table id="example" class="table table-hover">
                        <thead class="table-warning">
                            <tr>

                                <th>Breaches<br><br></th>
                                <th data-orderable="true">Ticket ID<br><br></th>
                                <th>Category

                                    <select id="docTypeDrop" class="form-select form-select-sm md-flex mx-auto w-50"
                                        aria-label="Default select example" style="height:25px">
                                        <option value='' selected>All</option>
                                        <option value="INFRASTRUCTURE">INFRASTRUCTURE</option>
                                        <option value="SOFTWARE">SOFTWARE</option>
                                    </select>


                                </th>

                                <th>Staff Assigned
                                    <select id="docTypeDrop1" class="form-select form-select-sm md-flex mx-auto w-50"
                                        aria-label="Default select example" style="height:25px">
                                        <option value='' selected>All</option>
                                        <option value='Not Assigned'>Not Assigned</option>
                                        @foreach ($allStaff as $staffs)
                                            <option value='{{ $staffs->u_name }}'>{{ $staffs->u_name }}</option>
    @endforeach
    </select>
    </th>
    <th>Description<br><br></th>
    <th>Status
        <select id="docTypeDrop2" class="form-select form-select-sm md-flex mx-auto w-50" aria-label="Default select example" style="height:25px">
            <option value='' selected>All</option>
            <option value='New'>New</option>
            <option value='Opened'>Opened</option>
            <option value='Pending'>Pending</option>
            <option value='Ongoing'>Ongoing</option>
            <option value='Resolved'>Resolved</option>
            <option value='Closed'>Closed</option>
            <option value='Reopened'>Reopened</option>
            <option value='Rejected'>Rejected</option>
            <option value='Cancelled'>Cancelled</option>

        </select>
    </th>
    <th>Priority
        <select id="docTypeDrop3" class="form-select form-select-sm md-flex mx-auto w-60" aria-label="Default select example" style="height:25px">
            <option value='' selected>All</option>
            <option value='P0'>P0</option>
            <option value='P1'>P1</option>
            <option value='P2'>P2</option>
            <option value='P3'>P3</option>


        </select>
    </th>
    <th data-orderable="true">Sent<br><br></th>
    <th data-orderable="true">Due<br><br></th>



    </tr>
    </thead>

    <tbody>
        @foreach ($tickets as $ticket)
        <tr onclick="openDiv({{ $ticket->t_ID }})">
            <td>

                @if ($ticket->breaches == true)
                <i class="bi bi-circle-fill" style="color:red"></i>
                @else
                <i class="bi bi-circle-fill" style="color:green"></i>
                @endif


            </td>
            <td>{{ $ticket->t_ID }}</td>
            <td>{{ $ticket->t_category }}</td>
            <td>{{ $ticket->t_assignedTo }}</td>
            <td>{{ $ticket->t_title }}</td>
            <td>{{ $ticket->t_status }}</td>
            <td>P{{ $ticket->t_priority }}</td>
            <td>{{ $ticket->t_datetime }}</td>
            <td>{{ $ticket->t_due }}</td>


        </tr>
        @endforeach
    </tbody>


    </div>
    </div>

    </div>

    </div>





    <!-- download buttons -->
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,

                // "bSort": false,



            });



            // Category

            $('#docTypeDrop').on('change', function() {
                // console.log(this.value);
                if (this.value == "") {
                    table.columns(2).search('').draw();
                } else {
                    table.columns(2).search("^" + this.value + "$", true, false, true).draw();
                }
            });

            //Staff
            $('#docTypeDrop1').on('change', function() {

                if (this.value == "") {
                    table.columns(3).search('').draw();
                } else {
                    table.columns(3).search("^" + this.value + "$", true, false, true).draw();
                }
            });

            //Status
            $('#docTypeDrop2').on('change', function() {

                if (this.value == "") {
                    table.columns(5).search('').draw();
                } else {
                    table.columns(5).search("^" + this.value + "$", true, false, true).draw();
                }
            });

            //Priority
            $('#docTypeDrop3').on('change', function() {

                if (this.value == "") {
                    table.columns(6).search('').draw();
                } else {
                    table.columns(6).search("^" + this.value + "$", true, false, true).draw();
                }
            });
        });

    </script>

    <script>
        function openDiv(divId) {


            var url = "{{ route('openTicket', '') }}" + "/" + divId;

            window.location = url;
        }

    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="app.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
    {{--
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> --}} --}}
