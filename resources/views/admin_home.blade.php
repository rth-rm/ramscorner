@include('header')
  
    <title>ADMIN - DASHBOARD</title>

</head>
<body>

@foreach ($admin as $user)
    @include('sweetalert::alert')
    <!-- header -->
    @include('sidebar_admin')
   

    @include('dashboard')
@endforeach
@include('footer')
