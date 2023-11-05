@include('header')

<title>ADMIN - DASHBOARD</title>
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" type = "text/css">
</head>

<body>

    @foreach ($admin as $user)
        @include('sweetalert::alert')

        @include('sidebar_admin')
        @include('dashboard')
    @endforeach
    @include('footer')
