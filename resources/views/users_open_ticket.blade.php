<div class="home-contents">
    <div class="dash-contents">
        <div class="dash-container">

            <div class="card border-0">
                <div class="card-header p-4" style="background: #fff; border-radius: 25px; display: flex; justify-content: space-between; color: #242934; font-size: 26.2px; font-weight: 700;">
                    {{ $tickets->t_title }}
                    <span style="font-weight: 300; color:#817e9d; font-size: 21px">{{ $tickets->t_datetime }}<i class="bi bi-info-circle ms-4 me-2"></i></span>
                </div>
                <div class="card-body" style="padding: 5px;   display: grid; grid-template-columns: 1fr 1fr 1fr 1fr;">


                    <div class="ticket-status me-2" style="border-right: 5px solid #F6F7FB;">
                        <h4 style="color: #817e9d; font-size: 21px; font-weight: 700;" class="pt-4 ps-4 pb-3 fw-bold">
                            Status Tracking</h4>
                        <div class="status-display" style="overflow-y: auto; max-height: 55vh; ">
                            <ul style="list-style: none; padding: 10px;">
                                @foreach ($status as $status_tracking)
                                <li style="margin: 10px 0; padding: 10px; border-left: 5px solid #6644A8;{{ $status_tracking == $last ? 'background-color: #CDB9D9; color: black' : '' }}">
                                    <h5 style="font-weight: 600; color: #6644a8">
                                        {{ $status_tracking->sh_Status }}</h5>
                                    <h5>{{ $status_tracking->sh_datetime }}</h5>
                                    <h5>{{ $status_tracking->sh_AssignedTo }}</h5>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="ticket-details" style="grid-column: span 3;">
                        <div class="header p-5" style="display: flex; justify-content: space-between; ">
                            <div class="tic-header deets fw-semibold">
                                <h5>Sent by: {{ $userinfo->u_name }}</h5>
                                <h5>Assigned to: {{ $tickets->t_assignedTo }}</h5>
                            </div>

                        </div>
                        <div class="tic-description p-5">
                            <h5><strong>Problem:<br></strong>

                                {{ $tickets->t_description }}
                            </h5>
                        </div>
                        <hr>
                        @if($tickets->t_resolution != "Not Yet Resolved")
                        <div class="tic-description p-5">
                            <h5><strong>Resolution: <br></strong>
                                {{ $tickets->t_resolution }}
                            </h5>
                        </div>
                        @endif

                        <div class="tic-attachment ps-5">
                            <h5>
                                @if ($tickets->t_image != '')
                                Attachment:
                                <h6>
                                    <a href="{{ url('ticketImages/' . $tickets->t_image) }}" download>
                                        {{ $tickets->t_image }}
                                    </a>
                                </h6>
                                @endif
                            </h5>
                        </div>
                        @if($tickets->t_status == "RESOLVED")
                        <div class="tic-description p-5">

                            <span><button onclick="close()" class="btn-lg me-3" type="button" style="background: transparent; color: #6644A8; border-radius: 25px;">
                                    Yes, close my ticket.
                                </button>
                            </span>
                            <span>
                                <button onclick="ongoing()" class="btn-lg me-3" type="button" style="background: transparent ; color: #6644A8; border-radius: 25px;">
                                    Not Yet.
                                </button>

                            </span>

                        </div>
                        @endif
                        <script>
                            function close() {

                            }
                            <script>

                    </div>
                </div>
                <div class="card-footer text-body-secondary p-4" style="background: #fff; border-radius: 25px; display: flex; justify-content: end; align-items: center;">

                    @include('chat')

                    <div class="dropdown" id="updateButton">
                        <button class="btn dropdown-toggle btn-lg me-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: #6644A8; color: white; border-radius: 25px;">
                            Update
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="statusUpdate('cancelled')" id="cancelled">Cancel</a>
                            </li>
                            <li><a class="dropdown-item" onclick="statusUpdate('reopened')" id="reopened" hidden>Reopened
                                </a></li>
                        </ul>
                    </div>

                </div>
            </div>
            <input type="text" value="{{ $tickets->t_status }}" class="form-control mb-2" id="status" name="status" hidden>
        </div>
        <div class="modal fade" id="statusUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form method="POST" enctype="multipart/form-data" action="{{ url('cancelTicket/' . $tickets->t_ID) }}">

                @csrf
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Ticket Cancellation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                                <h6>Are you sure you want to cancel your ticket?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
            </form>
        </div>

        {{-- <div class="modal fade" id="statusUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form method="POST" enctype="multipart/form-data" action="{{ url('cancelTicket/' . $tickets->t_ID) }}">

        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ticket Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                        <h6>Are you sure you want to cancel your ticket?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                    </form>
                </div> --}}
            </div>
        </div>
        <script>
            function statusUpdate(item) {

                var modal = new bootstrap.Modal(document.getElementById('statusUpdate'));
                var modalText = document.getElementsByName('status')[0];
                console.log(modalText);
                modalText.setAttribute('value', item);
                modal.show();
            }

                        </script>
                        <script>
                            window.onload = function() {

                                var updateButton = document.getElementById("updateButton");

                                if (updateButton && (
                                        document.getElementById("status").value == "CANCELLED" ||
                                        document.getElementById("status").value == "REJECTED")) {
                                    updateButton.style.display = 'none';
                                }

                                if (document.getElementById("status").value == "CLOSED") {
                                    document.getElementById("reopened").removeAttribute('hidden');
                                    document.getElementById("cancelled").setAttribute('hidden', true);
                                }
                            };

                        </script>

                    </div>
                </div>
