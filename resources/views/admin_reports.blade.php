@include('header')


<title>REPORTS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">

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
