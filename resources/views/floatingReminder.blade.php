<style>
    /* Style for the floating panel */
    .floating-panel {
        position: fixed;
        top: 90%;
        right: 0;
        max-height: 25vh;
        width: 20%;
        overflow-y: auto;
        transform: translateY(-50%);
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;

    }

    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 18px;
        color: #888;

    }

</style>

<div class="floating-panel" id="panelContent">
</div>


<script>
    // Function to set a cookie
    function setCookie(name, value, days) {
        var expires = '';
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + value + expires + '; path=/';
    }


    function getCookie(name) {
        var nameEQ = name + '=';
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }


    function hideFloatingPanel() {
        document.querySelector('.floating-panel').style.display = 'none';
        setCookie('panelClosed', 'true', 365); // Set a cookie to remember the closed state
    }

    window.onload = function() {
        var panelClosed = getCookie('panelClosed');
        if (panelClosed === 'true') {
            hideFloatingPanel();
        }
    };






    function playRefreshSound() {
        var audio = new Audio('sounds/notif.mp3');
        audio.play()
    }



    function checkAndRefresh() {
        // Make an Ajax request to your server to check if there are tickets that meet the criteria
        fetch('checkTickets')
            .then(response => response.json())
            .then(data => {
                if (data.shouldRefresh) {
                    // Update the content of the floating panel with the new ticket information
                    document.getElementById('panelContent').innerHTML = generateTicketHtml(data.tix);

                    // Play the refresh sound
                    playRefreshSound();
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function generateTicketHtml(ticket) {
        let html = '';
        ticket.forEach(tickets => {
            html += `
                    <div class="ticket">
                   
                        <a href="{{ url('openTicket/${tickets.t_ID}') }}">
                            <ul>
                            <li style= "border-left: 5px solid #6644A8; color: black">
                            Ticket ID: ${tickets.t_ID} - 
                            Status: ${tickets.t_status}
                            </ul>
                        </a>
                        
                    </div>
                    `;
        });
        return html;
    }

    // Refresh the panel content every 10 minutes (600,000 milliseconds)
    setInterval(checkAndRefresh, 60000);

    // Initial check on page load
    checkAndRefresh();

</script>
