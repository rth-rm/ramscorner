<!-- <STYLE>
    #click {
        display: none;
    }

    label {
        position: absolute;
        right: 30px;
        bottom: 20px;
        height: 55px;
        width: 55px;
        background: #05E0E9;
        text-align: center;
        line-height: 55px;
        border-radius: 50px;
        font-size: 30px;
        color: #fff;
        cursor: pointer;
    }

    label i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.4s ease;
    }

    label i.fas {
        opacity: 0;
        pointer-events: none;
    }

    #click:checked~label i.fas {
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, -50%) rotate(180deg);
    }

    #click:checked~label i.material-symbols-outlined {
        opacity: 0;
        pointer-events: auto;
        transform: translate(-50%, -50%) rotate(180deg);
    }

    .wrapper {
        position: absolute;
        right: 30px;
        bottom: 0px;
        width: 400px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
        opacity: 0;
        pointer-events: none;
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    #click:checked~.wrapper {
        opacity: 1;
        bottom: 85px;
        pointer-events: auto;
    }

    .wrapper .head-text {
        line-height: 60px;
        color: #6a6e8c;
        border-radius: 15px 15px 0 0;
        padding: 0 20px;
        font-weight: 500;
        font-size: 20px;
    }

    .wrapper .chat-box {
        padding: 20px;
        width: 100%;
    }

    .chat-box .desc-text {
        color: #797a87;
        text-align: center;
        line-height: 25px;
        font-size: 15px;
        font-weight: 500;
    }

    .chat-box form .field {
        height: 50px;
        width: 100%;
    }

    .chat-box form .field:last-child {
        margin-bottom: 15px;
    }

    form .field button {
        width: 15%;
        height: 20%;
        outline: none;
        border-radius: 25px;
        font-size: 20px;
        transition: all 0.3s ease;
        position: absolute;
        left: 0%;
        margin-left: 80%;
    }

    form .field input,
    form .textarea textarea {
        margin-top: 15px;
        width: 88%;
        height: 10%;
        /* padding-left: 20px; */
        border: 1px solid lightgrey;
        outline: none;
        border-radius: 25px;
        font-size: 16px;
        transition: all 0.3s ease;
        position: relative;
    }

    form .field input::placeholder,
    form .textarea textarea::placeholder {
        color: silver;
        transition: all 0.3s ease;
    }

    form .field input:focus::placeholder,
    form .textarea textarea:focus::placeholder {
        color: lightgrey;
    }

    .chat-box form .textarea {
        height: 70px;
        width: 100%;
    }

    .chat-box form .textarea textarea {
        height: 100%;
        border-radius: 25px;
        resize: none;
        padding: 15px 20px;
        font-size: 16px;
    }

    .chat-box form .field button {
        border: none;
        outline: none;
        cursor: pointer;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        background: #05E0E9;
        transition: all 0.3s ease;
    }

    .chat-box form .field button:active {
        transform: scale(0.97);
    }
</STYLE> -->
<style>
    .chat-container {
        max-width: 50rem;
        max-height: 10rem;
        overflow-y: auto;
        border-radius: 8px;
    }

    .chat-message {
        margin: 10px;
        padding: 10px;
        border-radius: 10px;
        clear: both;
        word-wrap: break-word;
    }

    .sender-message {
        background-color: #05E0E9;
        color: white;
        float: right;
    }

    .received-message {
        background-color: #4CAF50;
        color: white;
        float: left;
    }

    .card-footer {
        border-top: 1px solid #ccc;
    }

    .field {
        display: flex;
    }

    textarea {
        flex: 1;
        resize: none;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        padding: 5px;
    }

    .btn {
        background-color: #008CBA;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px;
        cursor: pointer;
    }

    .btn i {
        margin-right: 5px;
    }
</style>
<!-- CHAT BUTTON -->
<div class="chat dropstart dropup">
    <div class="icon-container ms-3" type="button" data-bs-toggle="dropdown" data-bs-auto-close="false"
        aria-expanded="false"
        style="display: flex; justify-content: center; align-items: center; height: 50px; width: 50px; background: turquoise; border-radius: 50%;">
        <i class="bi bi-chat-left-fill fs-5" style="color: white;"></i>
    </div>
    <ul class="dropdown-menu">
        <div class="border-0" style="width: 40rem; max-height: 40rem;">
            <div class="card-header">
                INC{{ $tickets->t_ID }} Chats
            </div>
            <div class="card-body">
                <div class="chat-container">
                    @if ($chatss == 0)
                        <p>No conversation available.</p>
                    @elseif($chatss > 0)
                        @foreach ($chats as $chatsss)
                            @if ($chatsss->us_id == $userloggedin->u_ID)
                                <div class="chat-message sender-message">
                                    {{ $chatsss->us_id }} | {{ $chatsss->m_content }}
                                </div>
                                <div class="chat-message received-message">
                                    {{ $chatsss->us_id }} | {{ $chatsss->m_content }}
                                </div>
                            @endif
                        @endforeach

                    @endif

                </div>

            </div>
            <div class="card-footer text-body-secondary">
                <form id="chatForm" action="{{ url('sendmessages/' . $tickets->t_ID) }}" enctype="multipart/form-data"
                    method="post">
                    @csrf
                    <div class="field textarea">
                        <textarea id="message" cols="5" rows="2" placeholder="Leave a message here..." required name="message"></textarea>
                        <button class="btn" type="submit"><i class="bi bi-send"></i>Send</button>
                    </div>
                </form>
            </div>
            <script>
                document.getElementById('message').addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault(); // Prevents the newline character
                        document.getElementById('chatForm').submit();
                    }
                });
            </script>
        </div>
    </ul>
</div>



<!-- <div>
    <input type="checkbox" id="click">
    <label for="click">
        <i class="material-symbols-outlined"><i class="bi bi-chat"></i></i>
        <i class="fas fa-times"></i>
    </label>
    <div class="wrapper">
        <div class="head-text">
            INC{{ $tickets->t_ID }} Chats
            <hr class="break">
        </div>
        <div class="chat-box">
            @if ($chatss == 0)
<p>No conversation available.</p>
@elseif($chatss > 0)
@foreach ($chats as $chatsss)
@if ($chatsss->us_id == $userloggedin->u_ID)
<div style="background-color: #008CBA; color: white; align-self: flex-start;">
                {{ $chatsss->us_id }} | {{ $chatsss->m_content }}
            </div>
@else
<div style="background-color: #008CBA; color: white; align-self: flex-end;">
                {{ $chatsss->us_id }} | {{ $chatsss->m_content }}
            </div>
@endif
@endforeach
@endif
            <form action="{{ url('sendmessages/' . $tickets->t_ID) }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="field textarea">
                    <textarea cols="5" rows="4" placeholder="Leave a message here..." required name="message" id="message"></textarea>
                    <button class="btn" type="submit"><i class="bi bi-send"></i></button>
                </div>
            </form>
        </div>
    </div>

</div> -->


<div class="modal fade" id="chatboxModal" tabindex="-1" role="dialog" aria-labelledby="chatboxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatboxModalLabel">Chat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <div id="chat-messages">
                    @if ($chatss == 0)
                        <h5 style="padding: 50px;">No conversation available.</h5>
                    @elseif($chatss > 0)
                        @foreach ($chats as $chatsss)
                            <p>{{ $chatsss->us_id }} | {{ $chatsss->m_content }}</p>
                        @endforeach

                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <form id="chat-form" action="{{ url('sendmessages/' . $tickets->t_ID) }}" enctype="multipart/form-data"
                    method="post">
                    @csrf
                    <input type="text" id="message" name="message" class="form-control" placehol
                        der="Type your message">
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
