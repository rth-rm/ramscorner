@include('header')
<title>Ticket Center | Ram's Corner</title>
<link rel="stylesheet" href="{{ asset('assets/css/ticketcenter.css') }}" type = "text/css">
<!-- data tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- bootstrap link -->
</head>



<body>
    @foreach ($client as $userloggedin)
        @include('sweetalert::alert')

        @include('sidebar_client')



        <div class="home-contents">
            <div class="title mb-5">
                <h1>Ticket Center</h1>
                <div style="display: grid; grid-template-columns: 1fr 1fr">
                    <select class="form-select" aria-label="Default select example" style="border-radius: 25px;">
                        <option selected disabled>View My Ticket</option>
                        <option value="2">Sent Tickets</option>
                        <option value="3">Tagged Tickets</option>
                    </select>

                    <i class="bi bi-arrows-expand ms-5"></i>
                </div>
            </div>

            <div class="dash-contents">
                <div class="dash-container">
                    <div class="tic-filters me-3">
                        <div class="head pt-3 ps-5 pe-5">
                            Ticket Filter
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <hr>
                        <div class="container pt-3 ps-4 dropdiv mt-5">
                            <!-- regency -->
                            <div class="container pb-5 mb-3">
                                <div class="row">
                                    <div class="col titlename">
                                        Regency
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected disabled>Open this select menu</option>
                                            <option value="1">Daily</option>
                                            <option value="2">Weekly</option>
                                            <option value="3">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Catgeory -->
                            <div class="container pb-5 mb-3">
                                <div class="row">
                                    <div class="col titlename">
                                        Category
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected disabled>Open this select menu</option>
                                            <option value="1">Software</option>
                                            <option value="2">Infrastructure</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="container pb-5 mb-3">
                                <div class="row">
                                    <div class="col titlename">
                                        Status
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected disabled>Open this select menu</option>
                                            <option value="1">Pending</option>
                                            <option value="2">New</option>
                                            <option value="3">CLosed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Agent -->
                            <div class="container pb-5 mb-3">
                                <div class="row">
                                    <div class="col titlename">
                                        Agent
                                    </div>
                                    <div class="col">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected disabled>Open this select menu</option>
                                            <option value="1">Vincent Nacor</option>
                                            <option value="2">Ruth Morallos</option>
                                            <option value="3">Patrick Cortez</option>
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
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected disabled>Open this select menu</option>
                                            <option value="1">I</option>
                                            <option value="2">II</option>
                                            <option value="3">III</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ticket-lists">
                        <div class="lists">
                            <table id="example" class="hover" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Requested</th>
                                        <th>Due</th>
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
                                    $('#example').DataTable();
                                });
                            </script>
                        </div>
                        <footer>
                            <hr>
                        </footer>
                    </div>
                </div>
            </div>
        </div>

        </section>
        <script>
            function openDiv(divId) {


                var url = "{{ route('clientOpenTicket', '') }}" + "/" + divId;

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
                var url = "{{ route('clientOpenTicket', '') }}" + "/" + divId;
                window.location = url;
            }
        </script>
    @endforeach
    @include('footer')






















    {{-- @include('header')


    <title>ALL TICKETS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">

@include('sweetalert::alert')
@foreach ($client as $userloggedin)
    @include('sidebar_client')

    <!-- backgound-->
    @include('users_view_ticket')
    {{--
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> --}}
    {{-- @endforeach
@include('footer') --}}
