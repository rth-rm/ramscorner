@include('header')


    <title>STAFF - DASHBOARD</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">

@include('sweetalert::alert')
@foreach ($staff as $user)
    @include('sidebar_staff')
    @include('dashboard')
@endforeach
@include('footer')
