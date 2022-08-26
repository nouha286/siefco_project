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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="shortcut icon" href="http://localhost/siefco_project/public/assets/logo.png"/>
    <title>SIEFCO</title>
</head>

<body>
    <div id="sign">
        <div class="col-6 d-lg-flex d-none justify-content-center align-items-center" id="home-logo">
            <img src="{{asset('assets/logo.png')}}">
        </div>
        <div class="col-lg-6 p-0 overflow-auto" id="sign-form">
            <!---------------------- Menu Sign ---------------------->
            <div class="w-100 d-flex" id="menu-sign">
                <a href="Sign_Up" type="button" class="nav-link w-50 h4 text-dark text-center active" id="btn_signup">{{__('انشاء حساب') }}</a>
                <a href="Sign" type="button" class="nav-link w-50 h4 text-dark text-center" id="btn_signin"> {{__('تسجيل الدخول') }}</a>
            </div>
            <!---------------------- Sign Up ---------------------->
            <div id="signup">
                <div class="px-5" style="height: 5vh;">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a rel="alternate" hreflang="{{ $localeCode }}" class="btn m-2" style="background-color: var(--base-color);" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
                <div class="d-flex flex-column justify-content-center" style="width: 80%; min-height: 80vh; margin-left: 10%;">
                    <h1 class="text-center">{{__('انشاء حساب') }} </h1>
                    <p class="text-center" id="error_signup">{{__(' املأ معلوماتك لانشاء حسابك') }} </p>
                    <form class="d-flex flex-column" method="POST" action="{{ route('inscription.auth') }}" id="form_signup">
                        @csrf
                        @if (session('failed'))
                            <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                {{ session('failed') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
                                {{ session('warning') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <div class="d-flex flex-sm-row-reverse justify-content-between align-items-center">
                            <input type="text" name="Last_Name" id="last_name" placeholder="{{__('الاسم') }}" class="border-0 col-form-label" style="width: 48%;">
                            <input type="text" name="First_Name" id="first_name" placeholder="{{__('النسب') }}" class="border-0 col-form-label" style="width: 48%;">
                        </div>
                        <p class="text-danger float-end me-4" id="error_name"></p>
                        <input type="text" name="email" id="email_signup" placeholder="{{__('البريد الالكتروني') }}" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_email_signup"></p>
                        <input type="text" name="phone" id="phone_signup" placeholder="{{__('رقم الهاتف') }}" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_phone_signup"></p>
                        <input type="password" name="password" id="password_signup" placeholder="{{__('القن السري') }}" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_password_signup"></p>
                        <input type="password" name="conf_password" id="conf_password_signup" placeholder=" {{__('تأكيد القن السري') }}" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_conf_password_signup"></p>
                        <div class="d-flex flex-row-reverse justify-content-between align-items-center gap-3">
                            <div onsubmit="return (checkForm())" name="userForm">
                                <label for="client" class="h6">{{__('زبون') }}</label>
                                <input id="client" name="role" type="radio" onclick="n_identif_off()" value="">
                            </div>
                            <div class="d-flex">
                                <label for="employee" class="h6">{{__('مستخدم') }}</label>
                                <input id="employee" name="role" type="radio" onclick="n_identif_on()" value="">
                            </div>
                            <div>
                                <input type="text" name="n_identif" id="n_identif" placeholder="{{__('رقم التسجيل ') }}" class="border-0 col-form-label d-none" style="height: 35px;">
                            </div>
                        </div>
                        <p class="text-danger float-end me-4" id="error_role_signup"></p>
                        <input class="mb-3" type="submit" name="signin" value="{{__('انشاء حساب') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    // Number Of Identification
    function n_identif_on() {
        const n_identif = document.getElementById('n_identif');
        n_identif.classList.remove('d-none');
        n_identif.classList.add('d-block');
    }
    function n_identif_off() {
        const n_identif = document.getElementById('n_identif');
        n_identif.classList.remove('d-block');
        n_identif.classList.add('d-none');
    }


    // Validation Form Sign Up
    const form_signup = document.getElementById('form_signup');
    const first_name = document.getElementById('first_name');
    const last_name = document.getElementById('last_name');
    const error_name = document.getElementById('error_name');
    const email_signup = document.getElementById('email_signup');
    const error_email_signup = document.getElementById('error_email_signup');
    const phone_signup = document.getElementById('phone_signup');
    const error_phone_signup = document.getElementById('error_phone_signup');
    const password_signup = document.getElementById('password_signup');
    const error_password_signup = document.getElementById('error_password_signup');
    const conf_password_signup = document.getElementById('conf_password_signup');
    const error_conf_password_signup = document.getElementById('error_conf_password_signup');
    const client = document.getElementById('client');
    const employee = document.getElementById('employee');
    const n_identif = document.getElementById('n_identif');
    const role_signup = document.getElementById('error_role_signup');
    const error_signup = document.getElementById('error_signup');
    const pattern_email = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;
    const pattern_name = /[a-zA-Z]/;
    const pattern_phone = /[0-9]/;

    client.addEventListener('click' , () => {
        employee.value = '';
        client.value = 'Client';
    })
    employee.addEventListener('click' , () => {
        client.value = '';
        employee.value = 'Employe';
    })


    form_signup.addEventListener('submit', (e) => {
        if ((first_name.value == "") && (last_name.value == "") && (email_signup.value == "") && (phone_signup.value == "") && (password_signup.value == "") && (conf_password_signup.value == "") && client.value == "" && employee.value == "") {
            e.preventDefault();
            error_signup.innerHTML = "<p class='text-danger'>{{__('المرجوا ملأ معلوماتك لانشاء حسابك') }}</p>";
        } else {
            error_signup.innerText = "{{__('املأ معلوماتك لانشاء حسابك') }}";
            if ((first_name.value == "") || (last_name.value == "")) {
                e.preventDefault();
                error_name.innerText =  "{{__('املأ حقل الاسم و النسب') }}";
            }else{
                if ((pattern_name.test(first_name.value)) && (first_name.value.length >= 3) && (pattern_name.test(last_name.value)) && (last_name.value.length >= 3)) {
                    error_name.innerText = "";
                } else if ((!pattern_name.test(first_name.value)) || (first_name.value.length < 3) || (!pattern_name.test(last_name.value)) || (last_name.value.length < 3)) {
                    e.preventDefault();
                    error_name.innerText = "{{__('يجب أن يتكون الاسم و النسب من ثلاثة أحرف على الأقل') }}";
                }
            }

            if (email_signup.value == "") {
                e.preventDefault();
                error_email_signup.innerText = "{{__('املأ حقل البريد الإلكتروني') }}";
            }else{
                if (pattern_email.test(email_signup.value)) {
                    error_email_signup.innerText = "";
                } else if (!pattern_email.test(email_signup.value)) {
                    e.preventDefault();
                    error_email_signup.innerText = "{{__('البريد الإلكتروني غير صالح') }}";
                }
            }

            if (phone_signup.value == "") {
                e.preventDefault();
                error_phone_signup.innerText =  "{{__('املأ حقل رقم الهاتف') }}";
            } else if (pattern_phone.test(phone_signup.value) && (phone_signup.value.length == 10)) {
                error_phone_signup.innerText = "";
            } else if (!pattern_phone.test(phone_signup.value) || (phone_signup.value.length != 10)) {
                e.preventDefault();
                error_phone_signup.innerText = "{{__('رقم الهاتف غير صالح') }}";
            }

            if (password_signup.value == "") {
                e.preventDefault();
                error_password_signup.innerText =  "{{__('املأ حقل كلمة المرور') }}";
            } else if (password_signup.value.length < 6) {
                e.preventDefault();
                error_password_signup.innerText =  "{{__('يجب أن تتكون كلمة المرور من ستة أحرف على الأقل') }}";
            } else if (password_signup.value.length >= 6) {
                error_password_signup.innerText = "";
                if (conf_password_signup.value == "") {
                    e.preventDefault();
                    error_conf_password_signup.innerText = "{{__('املأ حقل تاكيد كلمة المرور') }}";
                } else if (conf_password_signup.value != password_signup.value) {
                    e.preventDefault();
                    error_conf_password_signup.innerText = "{{__('تاكيد من كلمة المرور') }}";
                } else if (conf_password_signup.value == password_signup.value) {
                    e.preventDefault();
                    error_conf_password_signup.innerText = "";
                }
            }

            if (client.value == "" && employee.value == "") {
                e.preventDefault();
                role_signup.innerText = "{{__('اختر دورك') }}";
            }else if(employee.value != "" && n_identif.value == ""){
                e.preventDefault();
                role_signup.innerText = "{{__('ادخل رقم التسجيل') }}";
            }else{
                role_signup.innerText="";
            }

            if ((error_name.textContent == "") && (error_email_signup.textContent == "") && (error_phone_signup.textContent == "") && (error_password_signup.textContent == "") && (error_conf_password_signup.textContent == "") && (role_signup.textContent == "")) {
                form_signup.submit();
            }
        }
    });
    conf_password_signup.addEventListener('keyup', (e) => {
        if (conf_password_signup.value == password_signup.value) {
            conf_password_signup.style.color = "green";
        } else {
            conf_password_signup.style.color = "red";
        }
    });

</script>
