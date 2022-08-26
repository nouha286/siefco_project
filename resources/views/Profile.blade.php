@extends('master.layout')

@section('content')
    <div class="position-absolute w-100" style="height: 40vh; background-color: var(--second-color);"></div>
    <div class="d-flex flex-row-reverse gap-3 mx-3" style="height: 100vh;">
        <!-- AssidBar -->
        @include('master.AssidBar')

        <div class="position-relative w-100">
            <!-- Navbar -->
            @include('master.Navbar')

            <!-- Statistiques -->
            <div class="container shadow-lg p-3" style="border-radius: 16px; width: 80%;">
                <div class="card d-flex flex-column border-1 py-3 px-5">
                    @if (session('error'))
                        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('success_delete'))
                        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                            {{ session('success_delete') }}
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
                    <form class="d-flex flex-column gap-2" method="POST" action="{{ route('edit') }}"
                        enctype="multipart/form-data" id="form_signup">
                        <div class="text-end h4">{{ __('تعديل الملف الشخصي') }}</div>
                        <hr class="mx   -0 my-1 p-0">
                        @csrf
                        <input class="form-control border-1 border-primary form-control-lg" name="image" id="formFileLg"
                            type="file" style="border-radius: 16px;">
                        <div class="w-100 d-flex flex-sm-row-reverse justify-content-between align-items-center">
                            <input type="text" name="Last_Name" id="" value="{{ $User->First_Name }}"
                                placeholder="{{ __('الاسم') }}" class="border-1 border-primary col-form-label"
                                style="width: 49%;">
                            <input type="text" name="First_Name" id="" value="{{ $User->Last_Name }}"
                                placeholder="{{ __('النسب') }}" class="border-1 border-primary col-form-label"
                                style="width: 49%;">
                        </div>
                        <input type="text" name="Email" id="email_signup" value="{{ $User->email }}"
                            placeholder=" {{ __('البريد الالكتروني') }}" class="border-1 border-primary col-form-label">
                        <input type="text" name="Phone" id="phone_signup" value="{{ $User->Phone }}"
                            placeholder="{{ __('رقم الهاتف') }}" class="border-1 border-primary col-form-label">
                        <input type="password" name="old_password" id="password_signup"
                            placeholder="{{ __('كلمة المرور الحالية') }}" class="border-1 border-primary col-form-label">
                        <input type="password" name="password" id="password_signup" placeholder=" {{ __('القن السري') }}"
                            class="border-1 border-primary col-form-label">
                        <input type="password" name="conf_password" id="conf_password_signup"
                            placeholder=" {{ __('تأكيد القن السري') }}" class="border-1 border-primary col-form-label">
                        <input type="hidden" class="id_devise" name="Id" value="{{ session('id') }}">
                        <input type="submit" name="signin" value="{{ __('حفظ') }}">
                    </form>
                </div>
            </div>


            <!-- Copyright -->
            @include('master.Copyright')
        </div>
    </div>
@endsection
