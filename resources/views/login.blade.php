@include('header')
<title>LOGIN | RAMS CORNER</title>

<style>
    .wrapper {
        background: #f6f7fb;
        padding: 0 20px 0 20px;
    }

    .main {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .side-image {
        background-image: url("{{ asset('images/ARR.png') }}");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        border-radius: 10px 0 0 10px;
        position: relative;
    }

    .row {
        width: 900px;
        height: 550px;
        border-radius: 10px;
        background: #fff;
        padding: 0px;
        box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.2);
    }

    .text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .text p {
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        text-align: center;
        vertical-align: bottom;
        display: inline-block;
        /* or display: inline-flex; */
    }

    .right {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .input-box {
        width: 330px;
        box-sizing: border-box;
    }

    img {
        width: 35px;
        position: absolute;
        top: 30px;
        left: 30px;
    }

    .input-box header {
        margin-top: 75px;
        /*kailangan ng margin w/out affecting the bg image */
        font-weight: 700;
        text-align: center;
        color: #2e266d;
        /*margin-bottom: 15px;*/
    }

    .input-field {
        display: flex;
        flex-direction: column;
        position: relative;
        padding: 0 10px 0 10px;
        color: #9a9ca1;
    }

    .form {
        height: 45px;
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        outline: none;
        margin-bottom: 20px;
        color: #242938;
    }

    .input-box .input-field label {
        position: absolute;
        top: 10px;
        left: 10px;
        pointer-events: none;
        transition: 0.5s;
    }

    .input-field input:focus~label {
        top: -20px;
        font-size: 13px;
    }

    .input-field input:valid~label {
        top: -10px;
        font-size: 13px;
        color: #5d5076;
    }

    .input-field .input:focus,
    .input-field .input:valid {
        border-bottom: 1px so lid #743ae1;
    }

    .submit {
        border: none;
        outline: none;
        height: 45px;
        background: #ececec;
        border-radius: 51px;
        transition: 0.4s;
    }

    .submit:hover {
        background: rgba(37, 95, 156, 0.937);
        color: #fff;
    }

    .signin {
        text-align: center;
        font-size: small;
        margin-top: 25px;
        margin-bottom: 85px;
    }

    span a {
        text-decoration: none;
        font-weight: 700;
        color: #000;
        transition: 0.5s;
    }

    span a:hover {
        text-decoration: underline;
        color: #000;
    }

    @media only screen and (max-width: 768px) {
        .side-image {
            border-radius: 10px 10px 0 0;
        }

        img {
            width: 35px;
            position: absolute;
            top: 20px;
            left: 47%;
        }

        .text {
            position: absolute;
            top: 70%;
            text-align: center;
        }

        .text p,
        i {
            font-size: 16px;
        }

        .row {
            max-width: 420px;
            width: 100%;
        }
    }
</style>

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
