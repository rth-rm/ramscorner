@include('header')
  
    <title>ADMIN - DASHBOARD</title>

</head>
<body>

@foreach ($admin as $user)
    @include('sweetalert::alert')
    <!-- header -->
    @include('dashboard')
    @include('sidebar_admin')
   

    
@endforeach
@include('footer')
