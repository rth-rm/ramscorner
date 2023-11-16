<!-- sidebar -->
<div class="sidebar">
    <div class="logo-details">
        <center class="profile">
            <img src={{ asset('images/APCLogo.png') }} alt="">
            <!-- <p>Nacor Industries</p> -->
        </center>
    </div>
    <ul class="nav-links" style="padding: 0;">
        <li>
            <a href="{{ url('adminHome') }}">
                <i class="bi bi-columns-gap"></i>
                <span class="link_name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ url('viewAllTickets') }}">
                <i class="bi bi-ticket-perforated"></i>
                <span class="link_name">Tickets</span>
            </a>
        </li>
        <li>
            <a href="{{ url('admin_KB') }}">
                <i class="bi bi-lightbulb"></i>
                <span class="link_name">Knowledge Base</span>
            </a>
        </li>
        <li>
            <a href="{{ url('generateReport') }}">
                <i class="bi bi-bar-chart"></i>
                <span class="link_name">Reports</span>
            </a>
        </li>
        {{-- <li>
            <a href="{{ url('viewTags') }}">
                <i class="bi bi-tags"></i>
                <span class="link_name">Tags</span>
            </a>
        </li> --}}
        <li>
            <a href="{{ url('devices') }}">
                <i class="bi bi-pc-display"></i>
                <span class="link_name">Devices</span>
            </a>
        </li>
    </ul>
</div>

<!-- header/contents -->
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class="bi bi-list sidebarBtn"></i>

        </div>
        <div class="profile-details">

            <div class="dropdown1">
                <i class="bi bi-bell" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                    data-bs-auto-close="outside"><span class="badge">{{ $notifCount + $notifChatCount }}</span></i>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><span class="dropdown-item-text" style="font-weight: 700; ">Notifications<span
                                class="badge"></span></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <button class="btn" type="button"
                        style="border-radius: 25px; background-color: #F6F7FB; font-weight:700; color: #817E9D; margin: 10px;"
                        id="updates" onclick = "updates()"> Ticket
                        Updates
                        @if ($notifCount > 0)
                            <span class="badge">{{ $notifCount }}</span>
                        @endif
                    </button>
                    <button class="btn" type="button" onclick = "updates()"
                        style="border-radius: 25px; background-color: #F6F7FB; font-weight:700; color: #817E9D;  margin: 10px;">Ticket
                        Chats
                        @if ($notifCount > 0)
                            <span class="badge">{{ $notifChatCount }}</span>
                        @endif
                    </button>
                    <div class="d-grid gap-2 d-md-block m-3">

                        <style>
                            button:focus {
                                background-color: #E9E9E9;
                            }
                        </style>
                    </div>
                    <div id = "updating">
                        <li><a class="dropdown-item" href="#">Notifications 1 <i class="bi bi-alarm-fill"></i></a>
                        </li>

                    </div>
                    <div id = "chatting" style = "display: none">

                        <li><a class="dropdown-item" href="#">Notifications 2 <i class="bi bi-alarm-fill"></i></a>
                        </li>
                    </div>

                </ul>
            </div>

            <div class="dropdown2">
                <img src="{{ url('userProfile/' . $userloggedin->u_profile) }}" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item"
                            href="#"><b>{{ $userloggedin->u_name }}</b><br><em>{{ $userloggedin->u_divRole }}</em>
                            <hr>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('/signout') }}"><i class="bi bi-box-arrow-right"></i>Sign
                            out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <style>
        .badge {
            background-color: red;
            /* Set your preferred background color */
            color: white;
            /* Set your preferred text color */
            padding: 5px 10px;
            /* Adjust padding as needed */
            border-radius: 50%;
            /* Make it circular */
            font-size: 12px;
            /* Adjust font size as needed */
        }
    </style>
    <script>
        function updates() {
            var updating = document.getElementById('updating');
            var chatting = document.getElementById('chatting');

            // Toggle the visibility of the divs
            if (updating.style.display === 'none') {
                updating.style.display = 'block';
                chatting.style.display = 'none';
            } else if (updating.style.display === 'none') {
                updtaing.style.display = 'none';
                chatting.style.display = 'block';
            } else {
                updtaing.style.display = 'block';
            }
        }
    </script>
