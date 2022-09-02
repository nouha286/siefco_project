<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href={{ asset('assets/image/logo.png') }}/>
    <title>SIEFCO</title>
</head>

<body>
    <div id="sign">
        <div class="col-6 d-lg-flex d-none justify-content-center align-items-center" id="home-logo">
            <img src="{{ asset('assets/image/logo.png') }}">
        </div>
        <div class="col-lg-6 p-0" id="sign-form">
            <!---------------------- Menu Sign ---------------------->
            <div class="w-100 d-flex" id="menu-sign">
                <a href="Sign_Up" type="button" class="nav-link w-50 h4 text-dark text-center" style="background-color: var(--base-color); border-radius: 16px 0px 0px 0px;">{{ __('انشاء حساب') }}</a>
                <a href="Sign" type="button" class="nav-link w-50 h4 text-dark text-center">{{ __('تسجيل الدخول') }}</a>
            </div>
            <!---------------------- Sign In ---------------------->
            <div id="signin">
                <div class="px-5" style="height: 5vh;">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a rel="alternate" hreflang="{{ $localeCode }}" class="btn m-2"
                            style="background-color: var(--base-color);"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
                <div class="d-flex flex-column justify-content-center gap-2"
                    style="width: 80%; height: 80vh; margin-left: 10%;">
                    <h1 class="text-center">{{ __('تسجيل الدخول') }}</h1>
                    <p class="text-center" id="error_signin">
                        {{ __('ادخل بريدك الالكتروني و القن السري لتسجيل الدخول') }}</p>
                    <p id="error_signin"></p>
                    <form class="d-flex flex-column gap-2" method="POST" action="{{ route('connexion.auth') }}"
                        id="form_signin">
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="text" name="email" id="email_signin"
                            placeholder="{{ __('البريد الالكتروني') }}" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_email"></p>
                        <input type="password" name="password" id="password_signin"
                            placeholder="{{ __('القن السري') }}" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_password"></p>
                        <input type="submit" name="signin" value="{{ __('تسجيل الدخول') }}">
                        <a class="text-center mt-3" href="Forget_password">{{ __('نسيت كلمة المرور') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

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
            error_signin.innerHTML =
                "<p class='text-danger'>{{ __('المرجوا ادخال بريدك الالكتروني و القن السري لتسجيل الدخول') }}</p>";
        } else {
            error_signin.innerText = "{{ __('ادخل بريدك الالكتروني و القن السري لتسجيل الدخول') }}";
            if (email_signin.value == "") {
                e.preventDefault();
                error_email.innerText = "{{ __('املأ حقل البريد الإلكتروني') }}";
            } else if (pattern_email.test(email_signin.value)) {
                error_email.innerText = "";
            } else if (!pattern_email.test(email_signin.value)) {
                e.preventDefault();
                error_email.innerText = "{{ __('البريد الإلكتروني غير صالح') }}";
            }
            if (password_signin.value == "") {
                e.preventDefault();
                error_password.innerText = "{{ __('املأ حقل كلمة المرور') }}";
            } else if (password_signin.value.length < 6) {
                e.preventDefault();
                error_password.innerText = "{{ __('يجب أن تتكون كلمة المرور من ستة أحرف على الأقل') }}";
            } else if (password_signin.value.length >= 6) {
                error_password.innerText = "";
            }
            if ((pattern_email.test(email_signin.value)) && (password_signin.value.length >= 6)) {
                form_signin.submit();
            }
        }
    });
</script>

<?php
    if(explode("/", URL::current())[5] == "en") {
        echo '<style>
                input[type="text"],[type="password"], [type="email"] {
                    text-align: left !important;
                    padding-left: 15px !important;
                }
                .float-end{
                    text-align: left !important;
                }
            </style>';
    }
?>

