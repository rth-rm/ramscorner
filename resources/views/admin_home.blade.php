@include('header')
  
    <title>ADMIN - DASHBOARD</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">

@section('title', 'Administrator')


@foreach ($admin as $user)
    @include('sweetalert::alert')
    <!-- header -->
    @include('sidebar_admin')
    <p>RAMS CORNER TESTING</p>

    @include('dashboard')
@endforeach
@include('footer')
