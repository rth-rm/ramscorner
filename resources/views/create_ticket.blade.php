@include('header')
<title>Create a Ticket</title>
<link rel="stylesheet" href="{{ asset('assets/css/create_ticket.css') }}" type="text/css">
</head>

<body>
    <section class="container">
        <div class="title">Create Ticket</div>
        <form action="{{ url('/createTicket') }}" class="form" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="input-box">
                <label for="autocomplete">CC</label>
                <input type="text" placeholder="Tag a Persona" maxlength="15" name="cc" id="autocomplete" />
            </div>

            <div class="input-box">
                <label for="title">Ticket Title</label>
                <input type="text" placeholder="Enter Title" required name="title" id="title" />
            </div>

            <div class="device-type">
                <label>Device Type</label>
                <div class="device-option">
                    <div class="device">
                        <input type="radio" value="INFRASTRUCTURE" id="Infrastructure" name="category" />
                        <label for="Infrastructure">Hardware</label>
                    </div>
                    <div class="device">
                        <input type="radio" value="INFRASTRUCTURE" id="Software" name="category" />

                        <label for="Software">Software</label>
                    </div>
                </div>
            </div>
            <div class="input-box" id="device-id">
                <label for="device-id">Device ID</label>
                <input type="text" placeholder="ITRO-DEV-ID" required maxlength="15" style="text-transform: uppercase; margin-bottom: 10px" name="devcode" />
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const hardwareRadio = document.getElementById("Infrastructure");
                    const softwareRadio = document.getElementById("Software");
                    const deviceIdDiv = document.getElementById("device-id");

                    // Function to hide the Device ID div
                    function hideDeviceId() {
                        deviceIdDiv.style.display = "none";
                    }

                    // Function to show the Device ID div
                    function showDeviceId() {
                        deviceIdDiv.style.display = "block";
                    }

                    // Initially, hide the Device ID div
                    hideDeviceId();

                    // Add event listeners to the radio buttons
                    hardwareRadio.addEventListener("change", showDeviceId);
                    softwareRadio.addEventListener("change", hideDeviceId);
                });

            </script>


            <div class="Description" style=" margin-top: 16px;">
                <label for="Description">Description</label>
                <textarea id="Description1" name="content" placeholder="Enter Description" style="resize:vertical; width:100%; border-radius:25px; padding:.5rem; font-size:1rem; color: #817e9d; border: 1px solid  #ddd; height: 12vh; margin-top: 10px;"></textarea>
            </div>


            <div class="upload" style="margin-top: 10px;">
                <label>Upload File</label>
                <input type="file" class="upload-box" accept="image/*" style="margin-top: 10px;" name="profile" />

            </div>

            <div class="buttons">
                <button type="reset" class="button cancel-btn">Cancel</button>
                <button type="submit" class="button add-btn">Submit</button>
            </div>

        </form>
        </div>
        </div>
    </section>


    <script>
        var autocompleteData = [
            @foreach($allUser as $users)
            '{{ $users->u_name }}'
            , @endforeach
        ];
        var autocompleteInput = document.getElementById('autocomplete');
        var suggestionsList = document.createElement('ul');
        suggestionsList.classList.add('autocomplete-list', 'list-group');

        autocompleteInput.addEventListener('input', function() {
            var inputText = autocompleteInput.value;
            var suggestions = [];

            // Filter the autocompleteData array for suggestions that match the input text
            for (var i = 0; i < autocompleteData.length; i++) {
                if (autocompleteData[i].toLowerCase().indexOf(inputText.toLowerCase()) !== -1) {
                    suggestions.push(autocompleteData[i]);
                }
            }

            // Limit the suggestions to the first 10 items
            suggestions = suggestions.slice(0, 5);

            // Remove any existing suggestions from the list
            while (suggestionsList.firstChild) {
                suggestionsList.removeChild(suggestionsList.firstChild);
            }

            // Add the filtered suggestions to the list
            for (var i = 0; i < suggestions.length; i++) {
                var suggestionItem = document.createElement('li');
                suggestionItem.classList.add('list-group-item');
                suggestionItem.textContent = suggestions[i];
                suggestionItem.addEventListener('click', function(event) {
                    autocompleteInput.value = event.target.textContent;
                    suggestionsList.innerHTML = '';
                });
                suggestionsList.appendChild(suggestionItem);
            }

            // Show the suggestions list after the input field but before the next input field
            var nextInput = autocompleteInput.nextElementSibling;
            if (nextInput) {
                autocompleteInput.parentNode.insertBefore(suggestionsList, nextInput);
            } else {
                autocompleteInput.parentNode.appendChild(suggestionsList);
            }
        });

        // Hide the suggestions list when the user clicks outside the input field or suggestions list
        document.addEventListener('click', function(event) {
            if (event.target !== autocompleteInput && event.target !== suggestionsList) {
                suggestionsList.innerHTML = '';
            }
        });

        // Hide the suggestions list when the user clicks outside the input field or suggestions list
        document.addEventListener('click', function(event) {
            if (event.target !== autocompleteInput && event.target !== suggestionsList) {
                suggestionsList.innerHTML = '';
            }
        });

    </script>
    @include('footer')
