@include('header')


    <title>TAGS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($admin as $user)
    @include('sidebar_admin')
    @include('tags')
@endforeach
@include('footer')
