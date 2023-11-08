<div class="home-contents">
    <div class="dash-contents">
        <div class="dash-container">

            <div class="card border-0">
                <div class="card-header p-4"
                    style="background: #fff; border-radius: 25px; display: flex; justify-content: space-between; color: #242934; font-size: 26.2px; font-weight: 700;">
                    {{ $tickets->t_title }}
                    <span style="font-weight: 300; color:#817e9d; font-size: 21px">{{ $tickets->t_datetime }}<i
                            class="bi bi-info-circle ms-4 me-2"></i></span>
                </div>
                <div class="card-body" style="padding: 5px;   display: grid; grid-template-columns: 1fr 1fr 1fr 1fr;">

                    <!-- ticket status -->
                    <div class="ticket-status me-2" style="border-right: 5px solid #F6F7FB;">
                        <h4 style="color: #817e9d; font-size: 21px; font-weight: 700;" class="pt-4 ps-4 pb-3 fw-bold">
                            Status Tracking</h4>
                        <div class="status-display" style="overflow-y: auto; max-height: 55vh; ">
                            <ul style="list-style: none; padding: 10px;">
                                @foreach ($status as $status_tracking)
                                    <li style="margin: 10px 0; padding: 10px; border-left: 5px solid #6644A8;">
                                        <h5 style="font-weight: 600; color: #6644a8">
                                            {{ $status_tracking->sh_Status }}</h5>
                                        <h5>{{ $status_tracking->sh_datetime }}</h5>
                                        <h5>{{ $status_tracking->sh_AssignedTo }}</h5>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- ticket details -->
                    <div class="ticket-details" style="grid-column: span 3;">
                        <div class="header p-5" style="display: flex; justify-content: space-between; ">
                            <div class="tic-header deets fw-semibold">
                                <h5>Sent by: {{ $client->u_name }}</h5>
                                <h5>Assigned to: {{ $tickets->t_assignedTo }}</h5>
                            </div>
                            <div class="tic-id">
                                @if ($tickets->t_category == 'HARDWARE')
                                    <h6>Hardware ID: ITRO-P12345</h6>
                                    <h6><a href="#">View Repair History</a></h6>
                                @endif

                            </div>
                        </div>
                        <div class="tic-description p-5">
                            <h5>
                                {{ $tickets->t_description }}
                            </h5>
                        </div>
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

                    </div>
                </div>
                <div class="card-footer text-body-secondary p-4"
                    style="background: #fff; border-radius: 25px; display: flex; justify-content: end; align-items: center;">

                    <!-- CHAT BUTTON -->
                    <div class="dropdown">
                        <div class="icon-container me-3" type="button" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" aria-expanded="false"
                            style="display: flex; justify-content: center; align-items: center; height: 40px; width: 40px; background: turquoise; border-radius: 50%;">
                            <i class="bi bi-chat-left-fill fs-5" style="color: white;"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <div class="border-0" style="width: 30rem; max-height: 30rem;">
                                <div class="card-header">
                                    Ticket #N
                                </div>
                                <div class="card-body">
                                    Chat Code in here
                                </div>
                                <div class="card-footer text-body-secondary">
                                    Chat input In here
                                </div>
                            </div>
                        </ul>
                    </div>

                    <!-- update dropup -->
                    <div class="dropdown">
                        <button class="btn dropdown-toggle btn-lg me-3" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="background: #6644A8; color: white; border-radius: 25px;">
                            Update
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
