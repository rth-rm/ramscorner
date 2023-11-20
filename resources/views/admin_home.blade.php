@include('header')

<title>ADMIN - DASHBOARD</title>
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" type="text/css">
</head>

<body>

    @foreach ($admin as $userloggedin)
    @include('sweetalert::alert')
    @include('sidebar_admin')
    @include('dashboard')

    @endforeach
    @include('floatingReminder')
    @include('footer')
