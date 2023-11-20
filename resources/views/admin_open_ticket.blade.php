@include('header')

<title>Ticket | Ram's Corner</title>
<link rel="stylesheet" href="{{ asset('assets/css/opened_sent_ticket.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- bootstrap link -->
</head>

<body>
    @foreach ($admin as $userloggedin)
    @include('sweetalert::alert')

    @include('sidebar_admin')

    @include('open_ticket')
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
    <script type="text/javascript">
        function refreshPage() {
            // check if page has already been refreshed
            if (!sessionStorage.getItem('refreshed')) {
                sessionStorage.setItem('refreshed', 'true');
                location.reload();
            }
        }

        setTimeout(refreshPage, 1000); // Refresh after 5 seconds

    </script>
    @include('footer')
