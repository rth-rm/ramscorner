@include('header')


    <title>ADMIN - ALL TICKETS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($admin as $user)
    @include('sidebar_admin')
    @include('view_all_tickets')
@endforeach
@include('footer')
