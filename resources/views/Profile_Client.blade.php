@extends('master.layout')

@section('content')
    <div class="position-absolute w-100" style="height: 40vh; background-color: var(--second-color);"></div>
    <div class="d-flex flex-row-reverse gap-3 mx-3" style="height: 100vh;">
        <!-- AssidBar Client -->
        @include('master.AssidBar_client')

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

                    <!-- Form Modification Profile -->
                    <form class="d-flex flex-column gap-2" method="POST" id="form_profile" action="{{ route('edit',app()->getLocale() ) }}" enctype="multipart/form-data" id="form_signup">
                        <div class="d-flex flex-row-reverse justify-content-between align-items-center">
                            <div class="text-end h4">{{ __('تعديل الملف الشخصي') }}</div>
                            <a href="interface_client" class="bi bi-x-circle h2 fw-bold" style="color: var(--black-color);"></a>
                        </div>
                        <hr class="mx-0 my-1 p-0">
                        @csrf
                        <input class="form-control border-2 border-primary form-control-lg" id="image" name="image" id="formFileLg"
                            type="file" style="border-radius: 16px;">
                        <div class="w-100 d-flex flex-sm-row-reverse justify-content-between align-items-center">
                            <input type="text" name="Last_Name" id="Last_Name" value="{{ $User->First_Name }}"
                                placeholder="{{ __('الاسم') }}" class="border-2 border-primary col-form-label"
                                style="width: 49%;">
                            <input type="text" name="First_Name" id="" value="{{ $User->Last_Name }}"
                                placeholder="{{ __('النسب') }}" class="border-2 border-primary col-form-label"
                                style="width: 49%;">
                        </div>
                        <input type="text" name="Email" id="email" value="{{ $User->email }}"
                            placeholder=" {{ __('البريد الالكتروني') }}" class="border-2 border-primary col-form-label">
                        <input type="text" name="Phone" id="phone" value="{{ $User->Phone }}"
                            placeholder="{{ __('رقم الهاتف') }}" class="border-2 border-primary col-form-label">
                        <input type="text" name="password" id="password" placeholder="{{ __('القن السري') }}" class="border-2 border-primary col-form-label">
                        <input type="hidden" class="id_profile" name="Id" value="{{ session('id') }}">
                        <input type="submit" name="signin" value="{{ __('حفظ') }}">
                    </form>
                    <script>
                        // Validation Form Profil
                        const form_profile = document.getElementById('form_profile');
                        const image = document.getElementById('image');
                        const Last_Name = document.getElementById('Last_Name');
                        const First_Name = document.getElementById('First_Name');
                        const email = document.getElementById('email');
                        const phone = document.getElementById('phone');
                        const password = document.getElementById('password');
                        form_profile.addEventListener('submit', (e) => {
                            if ((password.value == "") || (password.value.length < 6)){
                                e.preventDefault();
                                password.classList.remove("border-primary");
                                password.classList.add("border-danger");
                            }else{
                                e.preventDefault();
                                password.classList.remove("border-danger");
                                password.classList.add("border-success");
                            }

                            if (((password.value != "") && (password.value.length >= 6)) && ((image.value != "") || (Last_Name.value != "") || (First_Name.value != "") || (email.value != "") || (phone.value != ""))) {
                                form_profile.submit();
                            }
                        });
                    </script>

                    <!-- Modal Modification Password -->
                    <input type="submit" class="mt-3" value="{{ __('تغيير كلمة المرور') }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="form_password_profile" method="POST" action="">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">{{ __('تغيير كلمة المرور') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-4">
                                        <input type="password" name="old_password" id="old_password" placeholder="{{ __('كلمة المرور الحالية') }}" class="col-form-label">
                                        <input type="password" name="new_password" id="new_password" placeholder=" {{ __('كلمة المرور الجديدة') }}"class="col-form-label">
                                        <input type="password" name="conf_new_password" id="conf_new_password" placeholder=" {{ __('تأكيد كلمة المرور الجديدة') }}" class="col-form-label">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('اغلاق') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        // Validation Form Password Profil
                        const form_password_profile = document.getElementById('form_password_profile');
                        const old_password = document.getElementById('old_password');
                        const new_password = document.getElementById('new_password');
                        const conf_new_password = document.getElementById('conf_new_password');
                        form_password_profile.addEventListener('submit', (e) => {
                            if ((old_password.value == "") || (old_password.value.length < 6)){
                                e.preventDefault();
                                old_password.style.border = '1px solid red';
                            }else{
                                e.preventDefault();
                                old_password.style.border = '1px solid green';
                            }

                            if ((new_password.value == "") || (new_password.value.length < 6)){
                                e.preventDefault();
                                new_password.style.border = '1px solid red';
                            }else{
                                e.preventDefault();
                                new_password.style.border = '1px solid green';
                            }

                            if ((conf_new_password.value == "") || (conf_new_password.value.length < 6) || (new_password.value != conf_new_password.value)){
                                e.preventDefault();
                                conf_new_password.style.border = '1px solid red';
                            }else{
                                e.preventDefault();
                                conf_new_password.style.border = '1px solid green';
                            }

                            if ((old_password.value != "") && (old_password.value.length >= 6) && (new_password.value != "") && (new_password.value.length >= 6) && (conf_new_password.value != "") && (conf_new_password.value.length >= 6) && (new_password.value == conf_new_password.value)) {
                                form_password_profile.submit();
                            }
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
