@include('header')


    <title>ALL TICKETS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($staff as $user)
    @include('sidebar_staff')

    @include('view_all_tickets')
@endforeach
@include('footer')
