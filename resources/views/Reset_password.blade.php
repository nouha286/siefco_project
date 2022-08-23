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
        <div class="col-lg-6 p-0" id="sign-form">
            <!---------------------- Menu Sign ---------------------->
            <div class="w-100 d-flex" id="menu-sign">
                <a href="Sign_Up" type="button" class="nav-link w-50 h4 text-dark text-center" id="btn_signup">{{__('انشاء حساب') }}/a>
                <a href="Sign" type="button" class="nav-link w-50 h4 text-dark text-center " id="btn_signin">{{__('تسجيل الدخول') }} </a>
            </div>
            <!---------------------- Sign In ---------------------->
            <div id="signin">
                <div class="d-flex flex-column justify-content-center gap-2" style="width: 80%; height: 85vh; margin-left: 10%;">
                    <h1 class="text-center">{{__(' استعادة القن السري') }}</h1>
                    <p class="text-center" id="error_signin">{{__('ادخل بريدك الالكتروني ') }}</p>
                    <p id="error_signin"></p>
                    <form class="d-flex flex-column gap-2" method="POST" action="{{ route('reset.password',$id) }}" id="form_signin">
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

                        <input type="password" name="password" id="password_signup" placeholder="القن السري" class="border-0 col-form-label">
                       <input type="password" name="conf_password" id="conf_password_signup" placeholder=" تأكيد القن السري" class="border-0 col-form-label">


                        <input type="submit" name="signin" value="تسجيل الدخول">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


