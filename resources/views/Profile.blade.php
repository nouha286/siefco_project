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
        <div class="container shadow-lg p-3 mb-5  py-4">
            <div class="card border-1 shadow-sm overflow-auto" style="  border-radius: 16px;">
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

                <form class="d-flex flex-column gap-1 m-5" method="POST" action="{{ route('edit') }}" enctype="multipart/form-data" id="form_signup">
                    @csrf
                    <div class="mb-3">

                        <input class="form-control border-1 border-primary form-control-lg" name="image"  id="formFileLg" type="file">
                    </div>
                    <div class="d-flex flex-sm-row-reverse justify-content-between align-items-center">
                        <input type="text" name="Last_Name" id="" value="{{$User->First_Name}}" placeholder="الاسم" class="border-1 border-primary col-form-label" style="width: 48%;">
                        <input type="text" name="First_Name" id="" value="{{$User->Last_Name}}" placeholder="النسب" class="border-1 border-primary col-form-label" style="width: 48%;">
                    </div>
                    <p class="text-danger float-end me-4" id="error_name"></p>
                    <input type="text" name="Email" id="email_signup" value="{{$User->email}}" placeholder="البريد الالكتروني" class="border-1 border-primary col-form-label">
                    <p class="text-danger float-end me-4" id="error_email_signup"></p>
                    <input type="text" name="Phone" id="phone_signup" value="{{$User->Phone}}" placeholder="رقم الهاتف" class="border-1 border-primary col-form-label">
                    <p class="text-danger float-end me-4" id="error_phone_signup"></p>
                    <input type="password" name="old_password" id="password_signup"  placeholder="القن السري  الحالي" class="border-1 border-primary col-form-label">

                    <input type="password" name="password" id="password_signup"  placeholder="القن السري" class="border-1 border-primary col-form-label">
                    <p class="text-danger float-end me-4" id="error_password_signup"></p>
                    <input type="password" name="conf_password" id="conf_password_signup" placeholder=" تأكيد القن السري" class="border-1 border-primary col-form-label">
                    <p class="text-danger float-end me-4" id="error_conf_password_signup"></p>

                    <p class="text-danger float-end me-4" id="error_role_signup"></p>
                    <input type="hidden" class="id_devise" name="Id" value="{{session('id')}}">
                    <input class="mt-3" type="submit" name="signin" value=" حفظ">
                </form>

            </div>
        </div>


        <!-- Copyright -->
        <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo {{ date('Y') }}</div>
    </div>
</div>
@endsection
