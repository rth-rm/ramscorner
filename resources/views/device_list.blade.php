@include('header')
<title>DEVICE LIST | RAMS CORNER</title>
<link rel="stylesheet" href="{{ asset('assets/css/device-list.css') }}" type = "text/css">
<!-- data tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    @foreach ($user_loggedin as $userloggedin)
        @include('sweetalert::alert')

        @if ($userloggedin->u_role == 'Admin')
            @include('sidebar_admin')
        @endif



        <!-- header/contents -->


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
                                        <th>Device Code</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Assignment</th>
                                        <th>Date Modified</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($device_list as $devices)
                                        <tr>
                                            <td>{{ $devices->d_code }}</td>
                                            <td>{{ $devices->d_name }}</td>
                                            <td>{{ $devices->d_type }}</td>
                                            <td>Floor {{ \Illuminate\Support\Str::before($devices->d_assignment, '-') }}
                                            </td>
                                            <td>{{ $devices->updated_at }}</td>
                                            <td>
                                                <span data-toggle="tooltip" data-placement="left" title="Edit"
                                                    onclick="editDevice(this)">
                                                    <i style="background-color: #C8C4F5; color: white; font-size: 80%; border: 5px solid #C8C4F5;border-radius:100%"
                                                        class="bi bi-pencil-fill">
                                                        <a class="editIcon"></a>
                                                    </i>
                                                </span>

                                                <span data-toggle="tooltip" data-placement="left" title="Archive"
                                                    onclick="archiveDevice(this)" id="archive">
                                                    <i style="margin-left: 10%; background-color: red; color: white;  font-size: 80%; border: 5px solid red;border-radius:100%"
                                                        class="bi bi-archive-fill">
                                                        <a class="archiveIcon"></a>
                                                    </i>
                                                </span>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Archive Ticket</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close" onclick = "closeModal()">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                onclick = "closeModal()">Close</button>
                                            <button type="submit" class="btn btn-primary"
                                                id = "confirmButton">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>







                            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#example').DataTable();
                                });
                            </script>
                        </div>
                        <div class="card-footer text-body-secondary" style="display: flex; justify-content: end;">
                            <a href = "{{ url('addDevicePage') }}">
                                <button type="button" class="btn btn-primary btn-lg me-5 m-3 "
                                    style="border-radius: 25px;">Add a
                                    Device</button>
                            </a>
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

        <script>
            function editDevice(editIcon) {
                // Get the row of the clicked icon
                var row = editIcon.parentNode.parentNode;

                // Check if it's the last row
                var data = row.cells[0] ? row.cells[0].innerText : null;

                var url = "{{ route('editDeviceDetail', '') }}" + "/" + data;
                window.location.href = url;

            }

            function archiveDevice(archiveIcon) {
                // Get the row of the clicked icon
                var row = archiveIcon.parentNode.parentNode;

                // Check if it's the last row

                var deviceCode = row.cells[0] ? row.cells[0].innerText : null;
                var deviceName = row.cells[1] ? row.cells[1].innerText : null;

                $('#myModal .modal-body').html('Do you want to archive device ' + deviceCode + ' - ' + deviceName + '?');

                $("#myModal").modal('show');

                $('#confirmButton').off('click').on('click', function() {
                    // Handle the confirm button click event
                    // You can access the data (deviceCode, deviceName, etc.) here
                    var url = "{{ route('archiveDevice', '') }}" + "/" + deviceCode;
                    window.location = url;
                    $("#myModal").modal('hide');
                });

            }

            function closeModal() {
                $("#myModal").modal('hide');
            }
        </script>
    @endforeach
    @include('footer')
