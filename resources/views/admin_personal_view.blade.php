@include('header')


    <title>TICKETS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">

@include('sweetalert::alert')
@foreach ($client as $clients)
    @foreach ($client as $user)
        @include('sidebar_admin')

        <!-- backgound-->
        @include('users_view_ticket')
        {{--
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> --}}
    @endforeach
@endforeach
@include('footer')
