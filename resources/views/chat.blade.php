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
                            @else
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
                        <textarea id="message" cols="5" rows="" placeholder="Leave a message here..." required name="message"></textarea>
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
