<title>{{ $device_detail->d_code }}| RAMS Corner</title>
<link rel="stylesheet" href="{{ asset('assets/css/edit-device.css') }}" type = "text/css">

</head>

<body>
    <section class="container">
        <div class="title">Edit Device</div>
        <form method="POST" enctype="multipart/form-data" action="{{ url('editDevices') }}" class="form">
            @csrf

            <div class="input-box" hidden>
                <label>Device Name</label>
                <input type="text" name = "dcode" value = "{{ $device_detail->d_code }}" readonly />

            </div>
            <div class="input-box">
                <label>Device Name</label>
                <input type="text" placeholder="Enter Device Name" name = "dname"
                    value = "{{ $device_detail->d_name }}" required />

            </div>

            <div class="column">
                <div class="input-box">
                    <label>Inventory Number</label>
                    <input type="number" placeholder="Enter Inventory number" name= "dinvnum" required maxlength="4"
                        value={{ $device_detail->d_inventorynum }} />
                </div>
                <div class="input-box">
                    <label>Purchase Date</label>
                    <input type="date" placeholder="Enter purchase date" value={{ $device_detail->d_purchase_date }}
                        name = "dpurchased" required />
                </div>
            </div>
            <div class="device-type">
                <label>Device Type</label>
                <div class="device-option">
                    <div class="device">
                        <input type="radio" id="check-computing" name="device" value = "COMPUTING"
                            @if (old('COMPUTING', $device_detail->d_type) == 'COMPUTING') checked @endif readonly />
                        <label for="check-computing">Computing</label>
                    </div>
                    <div class="device">
                        <input type="radio" id="check-networking" name="device" value = "NETWORKING"
                            @if (old('NETWORKING', $device_detail->d_type) == 'NETWORKING') checked @endif readonly />
                        <label for="check-networking">Networking</label>
                    </div>
                    <div class="device">
                        <input type="radio" id="check-av" name="device" value = "AV"
                            @if (old('AV', $device_detail->d_type) == 'AV') checked @endif readonly />
                        <label for="check-av">Audio/Visual</label>
                    </div>
                    <div class="device">
                        <input type="radio" id="check-utilities" name="device" value = "UTILITY"
                            @if (old('UTILITY', $device_detail->d_type) == 'UTILITY') checked @endif readonly />
                        <label for="check-utilities">Utility</label>
                    </div>
                </div>
            </div>
            <div class="input-box designation">
                <label>Device Assignment</label>
                <div class="column">
                    <div class="select-box">
                        <select name = "dfloor">
                            <option hidden>Floor</option>
                            <option value= "1" @if (old('1', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '1') selected @endif>1st floor</option>
                            <option value= "2" @if (old('2', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '2') selected @endif>2nd floor</option>
                            <option value= "3" @if (old('3', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '3') selected @endif>3rd floor</option>
                            <option value= "4" @if (old('4', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '4') selected @endif>4th floor</option>
                            <option value= "5" @if (old('5', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '5') selected @endif>5th floor</option>
                            <option value= "6" @if (old('6', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '6') selected @endif>6th floor</option>
                            <option value= "7" @if (old('7', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '7') selected @endif>7th floor
                            </option>
                            <option value= "8" @if (old('8', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '8') selected @endif>8th floor
                            </option>
                            <option value= "9" @if (old('9', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '9') selected @endif>9th floor
                            </option>
                            <option value= "10" @if (old('10', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '10') selected @endif>10th floor
                            </option>
                            <option value= "11" @if (old('11', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '11') selected @endif>11th floor
                            </option>
                            <option value= "12" @if (old('12', \Illuminate\Support\Str::before($device_detail->d_assignment, '-')) == '12') selected @endif>12th floor
                            </option>
                        </select>
                    </div>
                    <input type="number" placeholder="Room Number" name="droom"
                        value={{ \Illuminate\Support\Str::after($device_detail->d_assignment, '-') }} required />
                </div>
            </div>
            <div class="buttons">
                <button class="button cancel-btn" type = "reset">Cancel</button>
                <button class="button save-btn" type = "submit">Submit</button>
            </div>
        </form>
    </section>
