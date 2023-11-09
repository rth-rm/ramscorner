@include('header')
<title>KBid # {{ $kb_info->kb_ID }} </title>
<link rel="stylesheet" href="clicked_kb.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
    @foreach ($admin as $userloggedin)
        @include('sidebar_admin')
        @include('sweetalert::alert')
        <div class="home-contents">
            <!-- <div class="dashboard-boxes"></div> -->
            <div class="title mb-5">
                <h1>Knowledge Base</h1>
                <i class="bi bi-arrows-expand"></i>
            </div>

            <div class="dash-contents">
                <div class="dash-container">
                    <div class="card card-contents">
                        <div class="cardheader mt-4 ms-5">
                            <i class="bi bi-exclamation-circle me-5"></i>
                            <span class="me-5">ID</span>
                            <span>{{ $kb_info->kb_title }}</span>
                        </div>
                        <hr>
                        <div class="card-body p-0 kb-contents ms-5 pe-5">
                            <i class="bi bi-exclamation-circle me-5"></i>
                            <span class="me-5">{{ kb_info->kb_ID }}</span>
                            <div class="kb-details">
                                <h3 class="mb-4">{{ $kb_info->kb_category }}</h3>
                                <h3>Modified by: {{ $kb_info->kb_modify }}</h3>
                                <h5 class="p-5">
                                    {{ $kb_info->kb_content }}
                                </h5>

                            </div>
                        </div>
                        <div class="card-footer text-body-secondary" style="display: flex; justify-content: end;">
                            <button type="button" class="btn btn-primary btn-lg me-5 m-3 "
                                style="border-radius: 25px;">Create KB Article</button>
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
