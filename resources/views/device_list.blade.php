@include('header')
<title>DEVICE LIST | RAMS CORNER</title>
<link rel="stylesheet" href="{{ asset('assets/css/device-list.css') }}" type="text/css">
<!-- data tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    @foreach ($user_loggedin as $userloggedin)
    @include('sweetalert::alert')


    @include('sidebar_admin')


    <!-- header/contents -->


    <div class="home-contents">
        <!-- <div class="dashboard-boxes"></div> -->
        <div class="title mb-5">
            <h1>Device List</h1>
            <!-- EDIT sort button -->
            <i id="sortButton" type="button" class="bi bi-arrows-expand ms-5"></i>
        </div>

        <div class="dash-contents">
            <div class="dash-container">
                <div class="device-filters me-2" style="background-color: #fff;">
                    {{-- <div class="head pt-3 ps-5 pe-5"> --}}
                    <div class="head pt-4 ps-3 pe-3" style="color: #817e9d; font-size: 21px; font-weight: 700;">
                        Device Filters
                        <!-- EDIT reset button -->
                        <i type="button" id="resetButton" class="bi bi-arrow-repeat"></i>
                    </div>
                    <hr>
                    <div class="cont pt-2 dropdiv mt-1 dropdowns">
                        <!-- Device Type -->
                        <div class="container pb-1 mb-4 droptstyle">
                            <div class="row">
                                <div class="col titlename">
                                    Device Type
                                </div>
                                <div class="col">
                                    <select id="deviceSelect" class="form-select" aria-label="Default select example" style="border: none">
                                        <option selected value="All">All</option>
                                        <option value="Networking">Networking</option>
                                        <option value="Audio/Visual">Audio/Visual</option>
                                        <option value="Utility">Utility</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Assignement -->
                        <div class="container pb-1 mb-4 droptstyle">
                            <div class="row">
                                <div class="col titlename">
                                    Assignment
                                </div>
                                <div class="col">
                                    <select id="assignmentSelect" class="form-select" aria-label="Default select example" style="border: none">
                                        <option selected value="All">All</option>
                                        <option value="1">1st Floor</option>
                                        <option value="2">2nd Floor</option>
                                        <option value="3">3rd Floor</option>
                                        <option value="4">4th Floor</option>
                                        <option value="5">5th Floor</option>
                                        <option value="6">6th Floor</option>
                                        <option value="7">7th Floor</option>
                                        <option value="8">8th Floor</option>
                                        <option value="9">9th Floor</option>
                                        <option value="10">10th Floor</option>
                                        <option value="11">11th Floor</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Recency -->
                        <div class="container pb-1 mb-4 droptstyle" style="border: none">
                            <div class="row">
                                <div class="col titlename">
                                    Recency
                                </div>
                                <div class="col">
                                    <select id="recencySelect" class="form-select" aria-label="Default select example" style="border: none">
                                        <option selected>All</option>
                                        <option value="Latest">Latest</option>
                                        <option value="Oldest">Oldest</option>
                                        <option value="Past Due">Past Due</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- reset button script -->
                        <script>
                            document.getElementById('resetButton').addEventListener('click', function() {
                                // Reset the values of all select elements
                                resetSelect(document.getElementById('recencySelect'));
                                resetSelect(document.getElementById('assignmentSelect'));
                                resetSelect(document.getElementById('deviceSelect'));
                            });

                            function resetSelect(selectElement) {
                                // Set the first option as selected
                                selectElement.selectedIndex = 0;
                            }

                        </script>
                    </div>
                </div>
                <div class="device-lists">
                    <div class="lists">
                        <table id="devicestable" class="hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Device Code</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Assignment</th>
                                    <th>Date Modified</th>
                                    <th>Modified By</th>
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
                                    <td>{{ $devices->d_submittedby }}</td>


                                    <td>
                                        <span data-toggle="tooltip" data-placement="left" title="Edit" onclick="editDevice(this)">
                                            <i style="background-color: #C8C4F5; color: white; font-size: 80%; border: 5px solid #C8C4F5;border-radius:100%" class="bi bi-pencil-fill">
                                                <a class="editIcon"></a>
                                            </i>
                                        </span>

                                        <span data-toggle="tooltip" data-placement="left" title="Archive" onclick="archiveDevice(this)" id="archive">
                                            <i style="margin-left: 10%; background-color: red; color: white;  font-size: 80%; border: 5px solid red;border-radius:100%" class="bi bi-archive-fill">
                                                <a class="archiveIcon"></a>
                                            </i>
                                        </span>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer text-body-secondary" style="display: flex; justify-content: end;">
                            <a href="{{ url('addDevicePage') }}">
                                <button type="button" class="btn btn-primary btn-lg me-2 m-3 " style="border-radius: 25px;">Add
                                    a
                                    Device</button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Archive Ticket</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
                                <button type="submit" class="btn btn-primary" id="confirmButton">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>





                <!-- EDIT sort script -->
                <script>
                    $(document).ready(function() {
                        var table = $('#devicestable').DataTable();

                        // Add event listener for sorting button
                        $('#sortButton').on('click', function() {
                            // Toggle between ascending and descending order on each click
                            table.order(table.order()[0][0], table.order()[0][1] === 'asc' ? 'desc' : 'asc').draw();
                        });

                        $('#deviceSelect').on('click', function() {
                            if (this.value == "All") {
                                table.columns(3).search('').draw();
                            } else if (this.value == "Networking") {
                                table.columns(3).search('NETWORKING').draw();
                            } else if (this.value == "Audio/Visual") {
                                table.columns(3).search('AV').draw();
                            } else if (this.value == "Utility") {
                                table.columns(3).search('UTILITY').draw();
                            }
                        });

                        $('#assignmentSelect').on('click', function() {
                            if (this.value == "All") {
                                table.columns(2).search('').draw();
                            } else if (this.value == "1") {
                                table.columns(2).search('1').draw();
                            } else if (this.value == "2") {
                                table.columns(2).search('2').draw();
                            } else if (this.value == "3") {
                                table.columns(2).search('3').draw();
                            } else if (this.value == "4") {
                                table.columns(2).search('4').draw();
                            } else if (this.value == "5") {
                                table.columns(2).search('5').draw();
                            } else if (this.value == "6") {
                                table.columns(2).search('6').draw();
                            } else if (this.value == "7") {
                                table.columns(2).search('7').draw();
                            } else if (this.value == "8") {
                                table.columns(2).search('8').draw();
                            } else if (this.value == "9") {
                                table.columns(2).search('9').draw();
                            } else if (this.value == "10") {
                                table.columns(2).search('10').draw();
                            } else if (this.value == "11") {
                                table.columns(2).search('11').draw();
                            }
                        });
                    });

                </script>

                <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#devicestable').DataTable();
                    });

                </script>
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
    {{-- @include('footer') --}}
