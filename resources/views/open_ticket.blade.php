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


                    <div class="ticket-status me-2" style="border-right: 5px solid #F6F7FB;">
                        <h4 style="color: #817e9d; font-size: 21px; font-weight: 700;" class="pt-4 ps-4 pb-3 fw-bold">
                            Status Tracking</h4>
                        <div class="status-display" style="overflow-y: auto; max-height: 55vh; ">
                            <ul style="list-style: none; padding: 10px;">
                                @foreach ($status as $status_tracking)
                                    <li
                                        style="margin: 10px 0; padding: 10px; border-left: 5px solid #6644A8;{{ $status_tracking == $last ? 'background-color: #CDB9D9; color: black' : '' }}">
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
                                <h5>Sent by: {{ $client->u_name }}</h5>
                                <h5>Assigned to: {{ $tickets->t_assignedTo }}</h5>
                            </div>
                            <div class="tic-id">
                                @if ($tickets->t_category == 'INFRASTRUCTURE')
                                    <h6>Hardware ID: ITRO-P12345</h6>
                                    <h6><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                            Repair History</a></h6>
                                    @include('view_device_details')
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



                    @include('chat')


                    <div class="dropdown" id="updateButton">
                        <button class="btn dropdown-toggle btn-lg me-3" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="background: #6644A8; color: white; border-radius: 25px;">
                            Update
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="statusUpdate('PENDING')" id="pending">Resource
                                    Pending</a></li>
                            <li><a class="dropdown-item" onclick="statusUpdate('ONGOING')" id="ongoing">Ongoing</a>
                            </li>
                            <li><a class="dropdown-item" onclick="statusUpdate('RESOLVED')" id="resolved">Resolve</a>
                            </li>
                            <li><a class="dropdown-item" onclick="statusUpdate('REJECTED')" id="rejected">Reject</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
        <div class="modal fade" id="statusUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form method="POST" enctype="multipart/form-data" action="{{ url('updateTicket/' . $tickets->t_ID) }}">

                @csrf
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                                <input type="text" value="{{ $tickets->t_status }}" class="form-control mb-2"
                                    id="status" name="status" hidden>
                            </div>
                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                                <select class="form-select mb-2" aria-label="Default select example" name="category"
                                    title="Select appropriate category for the ticket for easier identifying the solution for the problem and assigning of ticket.">
                                    <option value="INFRASTRUCTURE" @if (old('INFRASTRUCTURE', $tickets->t_urgency) == 'INFRASTRUCTURE') selected @endif>
                                        Infrastructure</option>
                                    <option value="SOFTWARE" @if (old('SOFTWARE', $tickets->t_urgency) == 'SOFTWARE') selected @endif>
                                        Software</option>


                                </select>
                            </div>


                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">


                                <select class="form-select mb-2" aria-label="Default select example" id="urgency"
                                    name="urgency">

                                    <option value="1" @if (old('1', $tickets->t_urgency) == '1') selected @endif>Critical
                                    </option>
                                    <option value="2" @if (old('2', $tickets->t_urgency) == '2') selected @endif>Urgent
                                    </option>
                                    <option value="3" @if (old('3', $tickets->t_urgency) == '3') selected @endif>Normal
                                    </option>
                                </select>
                            </div>

                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                                <select class="form-select mb-2" aria-label="Default select example" id="impact"
                                    name="impact">
                                    <option value="1" @if (old('1', $tickets->t_impact) == '1') selected @endif>High
                                    </option>
                                    <option value="2" @if (old('2', $tickets->t_impact) == '2') selected @endif>Medium
                                    </option>
                                    <option value="3" @if (old('3', $tickets->t_impact) == '3') selected @endif>Low
                                    </option>
                                </select>
                            </div>

                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                                <input type="text" readonly value="{{ $tickets->t_priority }}"
                                    class="form-control mb-2" id="priority" name="priority">
                            </div>





                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                                <select class="form-select mb-2" aria-label="Default select example"
                                    id="assign_group">
                                    <option selected="" value="All">All</option>
                                    <option value="Infrastructure">Infrastructure</option>
                                    <option value="Software">Software</option>

                                </select>
                                <br>
                            </div>
                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                                <select class="form-select mb-2" aria-label="Default select example" id="assign_to"
                                    name="assign">
                                    @if ($tickets->t_assignTo != 'Not Assigned')
                                        <option selected="" disable="" value="{{ $tickets->t_assignedTo }}">
                                            {{ $tickets->t_assignedTo }}</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->u_name }}" class="{{ $staff->u_division }}">
                                                {{ $staff->u_name }}</option>
                                        @endforeach
                                    @else
                                        <option selected value="Not Assigned">Not Assigned</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->u_name }}" class="{{ $staff->u_division }}">
                                                {{ $staff->u_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>


                            <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                                <textarea class="form-control mb-2" rows="5" id="message-text" name="message"></textarea>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
            </form>
        </div>








    </div>








</div>

{{-- resolution modal --}}


<div class="modal fade" id="resolveUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form method="POST" enctype="multipart/form-data" action="{{ url('updateTicket/' . $tickets->t_ID) }}">

        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Resolution Steps</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                        <input type="text" class="form-control mb-2" id="rdcode" name="rdcode"
                            value={{ $tickets->dev_code }}>
                    </div>
                    <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                        <input type="text" class="form-control mb-2" id="rtitle" name="rtitle">
                    </div>

                    <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                        <input type="text" class="form-control mb-2" id="rsteps" name="rsteps">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if ($tickets->t_category == 'INFRASTRUCTURE')
                        <button type="submit" class="btn btn-primary">Send Resolution and Save to Repair
                            History</button>
                    @else
                        <button type="submit" class="btn btn-primary">Send Resolution </button>
                    @endif
                </div>
    </form>
</div>
<script>
    function statusUpdate(item) {

        var modal = new bootstrap.Modal(document.getElementById('statusUpdate'));
        var modal_resolve = new bootstrap.Modal(document.getElementById('resolveUpdate'));
        var modalText = document.getElementsByName('status')[0];

        modalText.setAttribute('value', item);

        if (item == 'RESOLVED') {
            modal_resolve.show();

        } else {
            modal.show();
        }




    }
</script>

<script>
    window.onload = function() {

        var updateButton = document.getElementById("updateButton");

        if (updateButton && (document.getElementById("status").value == "RESOLVED" ||
                document.getElementById("status").value == "CLOSED" ||
                document.getElementById("status").value == "CANCELLED" ||
                document.getElementById("status").value == "REJECTED")) {
            updateButton.style.display = 'none';
        }



    };
</script>

{{-- impact/urgency/priority script  --}}
<script>
    const urgency = document.getElementById("urgency"),
        impact = document.getElementById("impact"),
        priority = document.getElementById("priority");
    urgency.addEventListener('change', updateInputValue);
    impact.addEventListener('change', updateInputValue);

    function updateInputValue() {
        const urge = urgency.value,
            imp = impact.value;
        if (urge == 1 && imp == 1) {
            priority.value = 1;
        } else if (urge == 1 && imp == 2) {
            priority.value = 2;

        } else if (urge == 1 && imp == 3) {
            priority.value = 2;

        } else if (urge == 2 && imp == 1) {
            priority.value = 1;

        } else if (urge == 2 && imp == 2) {
            priority.value = 2;

        } else if (urge == 2 && imp == 3) {
            priority.value = 3;

        } else if (urge == 3 && imp == 1) {
            priority.value = 2;

        } else if (urge == 3 && imp == 2) {
            priority.value = 2;

        } else if (urge == 3 && imp == 3) {
            priority.value = 3;

        } else {
            priority.value = 3;

        }

    }
</script>


{{-- assigngroup script --}}
<script>
    $('#assign_group').on('change', function() {
        var selectedGroup = $(this).val();
        console.log(selectedGroup);

        if (selectedGroup == "All") {
            $(".Infrastructure").show();
            $(".Software").show();
        } else if (selectedGroup == "Infrastructure") {
            $(".Infrastructure").show();
            $(".Software").hide();
        } else {
            $(".Infrastructure").hide();
            $(".Software").show();
        }


    });
</script>

</div>



</div>
