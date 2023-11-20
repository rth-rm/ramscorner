@include('header')
<title>Support Hub - Cliemt| RAMS CORNER</title>
<link rel="stylesheet" href="{{ asset('assets/css/kb.css') }}" type="text/css">
<!-- data tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    @foreach ($client as $userloggedin)
    @include('sweetalert::alert')
    @include('sidebar_client')
    <div class="home-contents">
        <!-- <div class="dashboard-boxes"></div> -->
        <div class="title mb-5">
            <h1>Support Hub</h1>
            <i class="bi bi-arrows-expand"></i>
        </div>

        <div class="dash-contents">
            <div class="dash-container">
                <div class="kb-categories me-3">
                    <div class="kbtitle pt-5; pe-3">
                        <h3 style="margin-top: 25px; margin-bottom: 25px;">KB Categories</h3>

                    </div>
                    <hr>
                    <div class="kb-btns">
                        <div class="d-grid gap-1 col-10 mx-auto m-1">
                            <button class="btn btn-lg" type="button">All</button>
                            <button class="btn btn-lg" type="button">Software</button>
                            <button class="btn btn-lg" type="button">Infrastructure</button>
                        </div>
                    </div>
                </div>
                <div class="kb-list">
                    <div class="card kb-list">
                        <div class="card-body p-0">
                            <div class="lists">
                                <table id="example" class="hover" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th><i class="bi bi-exclamation-circle"></i></th>
                                            <th>KBID#</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Date Modified</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kb_info as $kb_article)
                                        <tr onclick="openDiv({{ $kb_article->kb_ID }})">
                                            <td>

                                                @if ($kb_article->kb_status == 'APPROVED')
                                                <i class="bi bi-circle-fill" style="color:#05E0E9"></i>
                                                @elseif($kb_article->kb_status == 'PENDING')
                                                <i class="bi bi-circle-fill" style="color:#EBDDD7"></i>
                                                @else
                                                <i class="bi bi-circle-fill" style="color:red"></i>
                                                @endif
                                            </td>
                                            <td>{{ $kb_article->kb_ID }}</td>
                                            <td>{{ $kb_article->kb_title }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($kb_article->kb_content, 100) }}
                                            </td>
                                            <td>{{ $kb_article->dateModified }}</td>
                                        </tr>
                                        </a>
                                        @endforeach
                                    </tbody>
                                </table>
                                <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('#example').DataTable();
                                    });

                                </script>
                                <div class="card-footer text-body-secondary" style="display: flex; justify-content: end; background-color: #fff">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>


    <!-- sidebar button script -->
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");

        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
        }

    </script>


    <script>
        function openDiv(divId) {
            var url = "{{ route('userkbView', '') }}" + "/" + divId;
            window.location = url;
        }

    </script>

    <!-- kb category btn color change script -->
    @endforeach
    @include('footer')
