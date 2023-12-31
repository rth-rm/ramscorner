@include('header')


    <title>MY TICKETS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($client as $clients)
    @foreach ($client as $user)
        @include('sidebar_staff')
        @include('users_open_ticket')

        @include('cancel_ticket')
    @endforeach
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
