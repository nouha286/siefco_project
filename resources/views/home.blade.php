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
    <title>SIEFCO</title>
</head>

<body>
    <div id="home">
        <div class="col-6 d-lg-flex d-none justify-content-center align-items-center" id="home-logo">
            <img src="{{asset('assets/logo.png')}}">
        </div>
       
        <div class="col-lg-6 p-3" id="home-text">
            <ul>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                
                    
                        <a rel="alternate" hreflang="{{ $localeCode }}" class="form-select" style="max-width: 100px; border:none; background-color: var(--second-color);" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
               
                @endforeach
            </ul> 
            <div id="home-text-text">
                <div>
                    
                    <div class="h3  p-5">
                        <h1 >{{__('!!مرحبا ')}}</h1>
                        <div>{{__('قم بالتسجيل لبدء صرف العملات الدولية معنا')}} </div>
                        <div><span>{{__('.هل لديك')}}</span><a href="Sign_Up">{{__('حساب')}}</a>{{__('؟ تسجيل الدخول من')}}<a href="Sign">{{__('هنا')}}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
