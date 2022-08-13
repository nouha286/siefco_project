@extends('master.layout')
@section('content')
<div class="row" id="home">
    <div class="col-6 d-md-flex d-none justify-content-center align-items-center" id="home-logo">
        <img src="{{ asset('/logo.png') }}">
    </div>
    <div class="col-md-6 p-3" id="home-text">
        <select class="form-select" style="max-width: 100px; border:none; background-color: var(--second-color);">
            <option value="English">English</option>
            <option value="Arabe">Arabe</option>
        </select>
        <div id="home-text-text">
            <div>
                <h1>! مرحبًا</h1>
                <div class="h3">
                    <div><span style="color: var(--base-color);">SIEFCO</span> قم بالتسجيل لبدء صرف العملات الدولية مع</div>
                    <div>.هل لديك <a href="">حساب</a>؟ تسجيل الدخول من <a href="Sign">هنا</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection