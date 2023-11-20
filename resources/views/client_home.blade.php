@include('header')
@foreach ($client as $userloggedin)
<title>{{ $userloggedin->u_name }}'s Dashboard</title>
<link rel="stylesheet" href="{{ asset('assets/css/client_dashboard.css') }}">
</head>


<body>

    @include('sidebar_client')
    @include('sweetalert::alert')

    <div class="home-contents">
        <div class="dashboard-boxes"></div>
        <div class="title mb-5">
            <h1>Hello, {{ $userloggedin->u_name }}</h1>
            <a href="{{ url('createTicketPage') }}"><button type="button" class="btn btn-lg" style="border-radius: 25px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); background-color: #6644A8">Create
                    Ticket</button>
            </a>
        </div>

        <div class="contents">
            <!-- carousel -->
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);">
                <div class="carousel-inner">

                    <div class="carousel-item active" data-bs-interval="3000">
                        <a href="https://www.facebook.com/asiapacificcollege.edu" target="_blank">
                            <img src={{ asset('carousel/1.png') }} class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <a href="https://www.apc.edu.ph" target="_blank">
                            <img src={{ asset('carousel/2.png') }} class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <a href="https://www.facebook.com/asiapacificcollege.edu/posts/pfbid02BrxRBUkodFkfxH2cNiFstY1oQmDUaXdgs9EhtiH8zcJwfFmXWCHfv3ki1ZDWLUKTl" target="_blank">
                            <img src={{ asset('carousel/3.png') }} class="d-block w-100" alt="...">

                        </a>
                    </div>
                    <div class="carousel-item" data-bs-interval="3000" target="_blank">
                        <a href="https://alumni.apc.edu.ph">
                            <img src={{ asset('carousel/4.png') }} class="d-block w-100" alt="...">
                        </a>
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- cards -->
            <div class="cardssection mt-5">
                <div class="card" type="button" onclick="location.href='https://socitcloud.apc.edu.ph/ramscorner/userkbView/2';">

                    <div class="card-body">
                        <h5 class="card-title">Blue Screen of Death</h5>
                        <p class="card-text">Blue screen error on device...</p>

                    </div>
                </div>
                <div class="card" type="button" onclick="location.href='https://socitcloud.apc.edu.ph/ramscorner/userkbView/1';">

                    <div class="card-body">
                        <h5 class="card-title">Computer Not Booting</h5>
                        <p class="card-text">When a computer does not start, it typically means that the system is unable to boot up and display the operating system... </p>

                    </div>
                </div>
                <div class="card" type="button" onclick="location.href='https://socitcloud.apc.edu.ph/ramscorner/userkbView/33';">

                    <div class="card-body">
                        <h5 class="card-title">Classroom TV</h5>
                        <p class="card-text">Classroom TV does not display anything that the screen should be able to project (students connecting their devices into the TV but it is not showing anything).</p>

                    </div>
                </div>
                <div class="card kb-card" type="button" onclick="location.href='https://socitcloud.apc.edu.ph/ramscorner/user_KB';">

                    <div class="card-body">
                        <h5 class="card-title">Support Hub</h5>
                        <p class="card-text">Find the quickest way to solve your problems without having to go to ITRO. </p>
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
