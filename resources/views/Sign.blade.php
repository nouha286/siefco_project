<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">

    <title>SIEFCO</title>
</head>

<body>
    <style>
        :root {
            /* Colors */
            --base-color: #3498DB;
            --second-color: #69A8E7;
            --black-color: #000000;
            --grey-color: #6F6F6F;
            --white-color: #FFFFFF;
            --cyan-Blue-color: #F6F9FC;
        }
        /* style of input type:radio */
        input[type="radio"] {
            -webkit-appearance: none;
            appearance: none;
            width: 30px;
            height: 30px;
            margin: calc(0.75em - 11px) 0.25rem 0 0;
            vertical-align: top;
            border: 2px solid #ddd;
            border-radius: 4px;
            background: var(--white-color) no-repeat center center;
        }
        input[type="radio"] {
            border-radius: 50%;
        }
        input[type="radio"]:where(:active:not(:disabled), :focus) {
            border-color: var(--base-color);
            background-color: var(--base-color);
            outline: none;
        }
        input[type="text"],
        [type="password"] {
            width: 100%;
            height: 50px;
            text-align: right;
            padding-right: 15px;
            border-radius: 16px;
        }
        input[type="submit"],
        #btn {
            width: 50%;
            height: 50px;
            margin-left: 25%;
            border-radius: 16px;
            background-color: var(--base-color);
            border: 0px;
            font-weight: bold;
        }
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow-x: hidden;
            background-color: var(--cyan-Blue-color);
        }
        /* Home Page */
        body #home,#sign {
            width: 98%;
            height: 100vh;
            margin: 0 1%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        body #home #home-logo {
            height: 95vh;
        }
        body #home #home-text,#sign-form {
            height: 95vh;
            background-color: var(--second-color);
            border-radius: 16px;
            text-align: right;
        }
        body #home #home-text-text {
            height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        body #home #home-text-text a {
            color: var(--base-color);
        }
        /* Sign Page */
        body #sign #sign-form #menu-sign {
            height: 10vh;
        }
        body #sign #sign-form #menu-sign a {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 16px 16px 0px 0px;
        }
        body #sign #sign-form #menu-sign .active {
            background-color: var(--base-color);
        }
        body #sign #signin,#signup {
            width: 80%;
            height: 85vh;
            margin-left: 10%;
        }
        body #sign p {
            color: var(--grey-color);
        }
        /* Assidbar */
        @media screen and (max-width: 1200px) {
            body #assidBar {
                width: 250px;
                position: absolute !important;
                z-index: 999;
                display: none !important;
            }
            body #btn_assidBar {
                display: block !important;
            }
        }
        /* Tables */
        th,td {
            height: 50px;
        }
        tbody tr:hover {
            background-color: var(--second-color) !important;
            color: var(--white-color) !important;
        }
        tbody tr:hover a {
            color: var(--white-color) !important;
        }
    </style>
    <div id="sign">
        <div class="col-6 d-lg-flex d-none justify-content-center align-items-center" id="home-logo">
            <img src="../resources/views/Asset/logo.png">
        </div>
        <div class="col-lg-6 p-0" id="sign-form">
            <!---------------------- Menu Sign ---------------------->
            <div class="w-100 d-flex" id="menu-sign">
                <a href="Sign_Up" type="button" class="nav-link w-50 h4 text-dark text-center" id="btn_signup">انشاء حساب</a>
                <a href="Sign" type="button" class="nav-link w-50 h4 text-dark text-center active" id="btn_signin">تسجيل الدخول</a>
            </div>
            <!---------------------- Sign In ---------------------->
            <div id="signin">
                <div class="d-flex flex-column justify-content-center gap-2" style="width: 80%; height: 85vh; margin-left: 10%;">
                    <h1 class="text-center">تسجيل الدخول</h1>
                    <p class="text-center" id="error_signin">ادخل بريدك الالكتروني و القن السري لتسجيل الدخول</p>
                    <p id="error_signin"></p>
                    <form class="d-flex flex-column gap-2" method="POST" action="{{ route('connexion.auth') }}" id="form_signin">
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <input type="text" name="email" id="email_signin" placeholder="البريد الالكتروني" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_email"></p>
                        <input type="password" name="password" id="password_signin" placeholder="القن السري" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_password"></p>
                        <div>
                            <label for="checked" class="h6">تذكرني</label>
                            <input type="checkbox" class="mx-1" name="checked" id="checked">
                        </div>
                        <input type="submit" name="signin" value="تسجيل الدخول">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- index.js -->
<script>

    // Validation Form Sign In
    const form_signin = document.getElementById('form_signin');
    const email_signin = document.getElementById('email_signin');
    const password_signin = document.getElementById('password_signin');
    const error_email = document.getElementById('error_email');
    const error_password = document.getElementById('error_password');
    const error_signin = document.getElementById('error_signin');
    const pattern_email = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;
    form_signin.addEventListener('submit', (e) => {
        if ((email_signin.value == "") && (password_signin.value == "")) {
            e.preventDefault();
            error_signin.innerHTML = "<p class='text-danger'>المرجوا ادخل بريدك الالكتروني و القن السري لتسجيل الدخول</p>";
        } else {
            error_signin.innerText = "ادخل بريدك الالكتروني و القن السري لتسجيل الدخول";
            if (email_signin.value == "") {
                e.preventDefault();
                error_email.innerText = "املأ حقل البريد الإلكتروني";
            } else if (pattern_email.test(email_signin.value)) {
                error_email.innerText = "";
            } else if (!pattern_email.test(email_signin.value)) {
                e.preventDefault();
                error_email.innerText = "البريد الإلكتروني غير صالح";
            }
            if (password_signin.value == "") {
                e.preventDefault();
                error_password.innerText = "املأ حقل كلمة المرور";
            } else if (password_signin.value.length < 6) {
                e.preventDefault();
                error_password.innerText = "يجب أن تتكون كلمة المرور من ستة أحرف على الأقل.";
            } else if (password_signin.value.length >= 6) {
                error_password.innerText = "";
            }
            if ((pattern_email.test(email_signin.value)) && (password_signin.value.length >= 6)) {
                form_signin.submit();
            }
        }
    });
</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
