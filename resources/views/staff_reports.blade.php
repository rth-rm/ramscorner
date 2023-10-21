@include('header')



    <title>REPORTS</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">
@include('sweetalert::alert')
@foreach ($staff as $user)
    @include('sidebar_staff')
    @include('reports')
@endforeach
@include('footer')
