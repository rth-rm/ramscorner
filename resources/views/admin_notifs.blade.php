@include('header')

<title>NOTIFICATION</title>

</head>

<body style="background-color: rgb(255, 255, 255); ">
    @section('title', 'Administrator')


    @foreach ($admin as $user)
        @include('sweetalert::alert')
        @include('sidebar_admin')
        @include('notifications')
    @endforeach
    @include('footer')
