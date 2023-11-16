<!-- sidebar -->
<div class="sidebar">
    <div class="logo-details">
        <center class="profile">
            <img src={{ asset('images/APCLogo.png') }}>

            <!-- <p>Nacor Industries</p> -->
        </center>
    </div>
    <ul class="nav-links" style="padding: 0;">
        <li>
            <a href="{{ url('/clientHome') }}">
                <i class="bi bi-columns-gap"></i>
                <span class="link_name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href = "{{ url('/clientViewTickets') }}">
                <i class="bi bi-ticket-perforated"></i>
                <span class="link_name">Tickets</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user_KB') }}">
                <i class="bi bi-lightbulb"></i>
                <span class="link_name">Knowledge Base</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/viewHelp') }}">
                <i class="bi bi-question-circle"></i>
                <span class="link_name">Help</span>
            </a>
        </li>
    </ul>
</div>

<section class="home-section">
    <!-- nav-header -->
    <nav>
        <div class="sidebar-button">
            <i class="bi bi-list sidebarBtn"></i>
            <!-- <span class="dashboard">Rams Corner</span> -->
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
                        @foreach ($notify as $notifies)
                            <li><a class="dropdown-item" href="{{ url(' openTicketByNotif' . $notifies->ticket_id) }}">
                                    {{ $notifies->n_message }} <i class="bi bi-alarm-fill"></i></a>
                            </li>
                        @endforeach

                    </div>
                    <div id = "chatting" style = "display: none">

                        @foreach ($notifyChat as $notifiesChat)
                            <li><a class="dropdown-item"
                                    href="{{ url(' openTicketByNotif' . $notifiesChat->ticket_id) }}">
                                    {{ $notifiesChat->n_message }} <i class="bi bi-alarm-fill"></i></a>
                            </li>
                        @endforeach
                    </div>

                </ul>
            </div>

            <div class="dropdown2">
                <img src="{{ url('userProfile/' . $userloggedin->u_profile) }}" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><b>{{ $userloggedin->u_name }}</b>
                            <hr>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('/signout') }}"><i class="bi bi-box-arrow-right"></i>Sign
                            out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- dashboard -->
