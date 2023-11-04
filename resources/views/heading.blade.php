<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class="bi bi-list sidebarBtn"></i>
            <!-- <span class="dashboard">Rams Corner</span> -->
        </div>
        <div class="profile-details">

            <div class="dropdown1">
                <i class="bi bi-bell" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu" style="">
                    <li><span class="dropdown-item-text">Notifications</span></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Notifications 1</a></li>
                    <li><a class="dropdown-item" href="#">Notifications 2</a></li>
                </ul>
            </div>

            <div class="dropdown2">
                <i class="bi bi-person-circle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"></i>

                <ul class="dropdown-menu" style="">
                    <li><a class="dropdown-item" href="{{ url('/signout') }}">Sign out</a></li>
                </ul>
            </div>
        </div>
    </nav>
