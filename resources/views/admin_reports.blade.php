@include('header')


<title>REPORTS</title>
<link rel="stylesheet" href="{{ asset('assets/css/reports.css') }}" type = "text/css">
</head>

<body>

    @include('sweetalert::alert')
    @foreach ($admin as $user)
        @include('sidebar_admin')

        @include('reports')


        <script>
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".sidebarBtn");

            sidebarBtn.onclick = function() {
                sidebar.classList.toggle("active");
            }
        </script>
    @endforeach
    @include('footer')
