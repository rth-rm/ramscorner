@include('header')


    <title>TAGS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">

@include('sweetalert::alert')
@foreach ($client as $clients)
    @include('sidebar_client')
    @include('tags')
@endforeach
@include('footer')
