@include('header')


<title>REPORTS</title>
<link rel="stylesheet" href="{{ asset('assets/css/reports.css') }}" type = "text/css">
</head>

<body>

    @include('sweetalert::alert')
    @foreach ($admin as $userloggedin)
        @include('sidebar_admin')

        @include('reports')


        <script>
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".sidebarBtn");

            sidebarBtn.onclick = function() {
                sidebar.classList.toggle("active");
            }
        </script>
        </section>
    @endforeach
    @include('footer')
