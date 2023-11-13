<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="max-height: 100vh; overflow-y: auto;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#817E9D"><b>View Device</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tix-details" style="display:grid; grid-template-columns: 1fr 1fr;">
                    <div class="leftS" style="border-right: 2px solid #E9E9E9;">
                        <div style="display: flex; align-items: center;">
                            <h6 style="margin-right: 5%; margin-bottom: 5%; color: #817E9D">Device Code:
                                <b>{{ $device->d_code }}</b>
                            </h6>
                        </div>

                        <div style="display: flex; align-items: center;">
                            <h6 style="margin-right: 5%; margin-bottom: 5%; color: #817E9D">Device Name:
                                <b>{{ $device->d_name }}</b>
                            </h6>
                        </div>

                        <div style="display: flex; align-items: center;">
                            <h6 style="margin-right: 5%; margin-bottom: 5%; color: #817E9D">Device Type:
                                <b>{{ $device->d_type }}</b>
                            </h6>
                        </div>

                        <div style="display: flex; align-items: center;">
                            <h6 style="margin-right: 5%; margin-bottom: 5%; color: #817E9D">Assignment(Floor-Room):
                                <b>{{ $device->d_assignment }}</b>
                            </h6>
                        </div>
                        <button type="button" class="btn" style="border-color: #05e0e9;"><i
                                class="bi bi-paperclip"></i></button>
                    </div>
                    <div class="rightS">
                        <div class="status-display" style="overflow-y: auto; max-height: 55vh;">
                            <h6 style = "margin-left: 5%; color: #817E9D; font-weight:bold">Repair History
                            </h6>
                            <ul style="list-style: none; padding: 10px;">

                                @foreach ($repair as $repairs)
                                    <li style="margin: 10px 0; padding: 10px; border-left: 5px solid #6644A8;">
                                        <h5 style="font-weight: 600; color: #6644a8">
                                            {{ $repairs->created_at }}
                                        </h5>
                                        <h5>Problem: {{ $repairs->rh_problem }}</h5>
                                        <h5>Solution: {{ $repairs->rh_solution }}</h5>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>
