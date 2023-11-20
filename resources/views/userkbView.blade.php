@include('header')
<title>Support ID# {{ $kb_info->kb_ID }} </title>
<link rel="stylesheet" href="{{ asset('assets/css/kb_clicked_admin.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
    @foreach ($client as $userloggedin)
    @include('sidebar_client')
    @include('sweetalert::alert')
    <div class="home-contents">
        <!-- <div class="dashboard-boxes"></div> -->
        <div class="title mb-5">
            <h1>Support Hub</h1>
            <i class="bi bi-arrows-expand"></i>
        </div>

        <div class="dash-contents">
            <div class="dash-container">
                <div class="card card-contents">
                    <div class="cardheader mt-4 ms-5">
                        <a class="bi bi-arrow-left me-5" href="{{ url()->previous() }}"></a>
                        <span class="me-5">ID</span>
                        <span>{{ $kb_info->kb_title }}</span>
                    </div>
                    <hr>
                    <div class="card-body p-0 kb-contents ms-5 pe-5">
                        <i class="bi bi-exclamation-circle me-5"></i>
                        <span class="me-5">{{ $kb_info->kb_ID }}</span>
                        <div class="kb-details">
                            <h5 class="mb-4"><strong>Category: </strong>{{ $kb_info->kb_category }}</h5>
                            <h5><strong>Modified by:</strong> {{ $kb_info->kb_modify }}</h5>


                            <h5 class="p-5"><strong>Problem<br> </strong>
                                {{ $kb_info->kb_content }}
                            </h5>
                            <hr>
                            <h5 class="p-5"><strong>Resolution<br></strong>
                                {{ $kb_info->kb_resolution }}
                            </h5>
                        </div>
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
    @endforeach
    @include('footer')
