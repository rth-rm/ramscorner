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
            <a href="{{ url('/adminHome') }}">
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
        <li>
            <a href="{{ url('viewTags') }}">
                <i class="bi bi-tags"></i>
                <span class="link_name">Tags</span>
            </a>
        </li>
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
