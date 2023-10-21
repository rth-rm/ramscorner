@include('header')
  
    <title>ADMIN - DASHBOARD</title>

</head>
<body>

@foreach ($admin as $user)
    @include('sweetalert::alert')
    <!-- header -->
    @include('sidebar_admin')
   

    @component('components.dashboard')
        
    @endcomponent
@endforeach
@include('footer')
