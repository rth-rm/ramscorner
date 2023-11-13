@include('header')

<title>ADMIN - DASHBOARD</title>
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" type = "text/css">
</head>

<body>

    @foreach ($admin as $userloggedin)
        @include('sweetalert::alert')
        @include('sidebar_admin')
        @include('dashboard')

        <script>
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".sidebarBtn");

            sidebarBtn.onclick = function() {
                sidebar.classList.toggle("active");
            }
        </script>
    @endforeach
    @include('footer')
