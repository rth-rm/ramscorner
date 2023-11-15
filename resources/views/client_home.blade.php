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
                <a href="{{ url('createTicketPage') }}"><button type="button" class="btn btn-lg"
                        style="border-radius: 25px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); background-color: #6644A8">Create
                        Ticket</button>
                </a>
            </div>

            <div class="contents">
                <!-- carousel -->
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel"
                    style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);">
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
                            <a href="https://www.facebook.com/asiapacificcollege.edu/posts/pfbid02BrxRBUkodFkfxH2cNiFstY1oQmDUaXdgs9EhtiH8zcJwfFmXWCHfv3ki1ZDWLUKTl"
                                target="_blank">
                                <img src={{ asset('carousel/3.png') }} class="d-block w-100" alt="...">

                            </a>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000" target="_blank">
                            <a href="https://alumni.apc.edu.ph">
                                <img src={{ asset('carousel/4.png') }} class="d-block w-100" alt="...">
                            </a>
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- cards -->
                <div class="cardssection mt-5">
                    <div class="card" type="button" onclick="location.href='your-page.html';">
                        <div class="card-body">
                            <h5 class="card-title">Blue Screen of Death</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card" type="button" onclick="location.href='your-page.html';">
                        <div class="card-body">
                            <h5 class="card-title">Knowledge Based</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card" type="button" onclick="location.href='your-page.html';">
                        <div class="card-body">
                            <h5 class="card-title">Status Levels</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card kb-card" type="button" onclick="location.href='your-page.html';">
                        <div class="card-body">
                            <h5 class="card-title">Button for KB</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
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
