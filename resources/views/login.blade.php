@include('header')
<title>LOGIN | RAMS CORNER</title>
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" type = "text/css">
</head>

<body>
    @include('sweetalert::alert')
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">

                    <!------------     image     ------------->

                    <img src="url('{{ asset('images/ARR2023.png') }}'" alt="">
                    <div class="text">
                        <p>RAMS CORNER</p>
                    </div>

                </div>

                <div class="col-md-6 right">
                    <form class="box needs-validation" novalidate method="POST" enctype="multipart/form-data"
                        action="{{ url('loginUser') }}">
                        @csrf
                        <div class="input-box">

                            <header style="font-size: 31px;">Log In</header>
                            <p style="font-size: 14px; text-align: center; color: #9a9ca1; margin-bottom: 20px;">APC
                                Microsoft 365 Account</p>

                            <div class="input-field">
                                <input type="text" class="form" name = "email" id="email" required=""
                                    autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="form" name = "password" id="password" required="">
                                <label for="pass">Password</label>
                            </div>
                            <div class="input-field">

                                <input type="submit" class="submit" value="Let's go!">
                            </div>
                            <div class="signin">
                                <span>Having troubles? <a href="https://tinyurl.com/kieyl">Click here</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            "use strict";
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll(".needs-validation");
            // Loop over them and prevent submission
            Array.from(forms).forEach((form) => {
                form.addEventListener(
                    "submit",
                    (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>

    @include('footer')
