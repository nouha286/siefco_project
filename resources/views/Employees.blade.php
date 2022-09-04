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
            <div class="container-fluid py-4">
                <div class="card border-0 shadow-sm overflow-auto"
                    style="min-height: 350px; max-height: 350px; border-radius: 16px;">
                    @if (session('success_delete'))
                        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                            {{ session('success_delete') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('success_restore'))
                        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                            {{ session('success_restore') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('failed_delete'))
                        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                            {{ session('failed_delete') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                        <div>
                            <select class="form-select text-center fs-5 fw-bold" id="input_select"
                                onchange="selectEmploye()"
                                style="max-width: 300px; border:none; background-color: var(--second--white-color-color);">
                                <option value="1">{{ __('المستخدمون') }}</option>
                                <option value="0"> {{ __('المستخدمون المحذوفين') }}</option>
                            </select>
                        </div>
                        <div class="input-group me-3" style="width: 25%;">
                            <input type="text" class="form-control" id="input_search" onkeyup="searchEmployee()"
                                placeholder="{{ __('الاسم') }}" style="height: 45px;">
                            <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i
                                    class="bi bi-search"></i></span>
                        </div>
                        @if (session('role') == 'Admin')
                            <button type="button" class="btn btn-primary"
                                style="background-color:white; color:black; border:none;" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bi bi-plus-circle-fill h1"></i>
                            </button>
                        @endif
                        <!-- Modal  Add Employe -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="Post" action="{{ route('add.Employe',app()->getLocale() ) }}" id="form_add_employe">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('اظافة مستخدم') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-4">
                                            <input type="text" name="First_Name" id="add_first_name" class="form-control"
                                                placeholder="*{{ __('الاسم') }}" style="height: 45px;">
                                            <input type="text" name="Last_Name" id="add_last_name" class="form-control"
                                                placeholder="*{{ __('النسب') }}" style="height: 45px;">
                                            <input type="text" name="Email" id="add_email" class="form-control"
                                                placeholder="*{{ __('البريد الالكتروني') }}" style="height: 45px;">
                                            <input type="text" name="Phone" id="add_phone" class="form-control"
                                                placeholder="*{{ __('رقم الهاتف') }}" style="height: 45px;">
                                            <input type="text" name="Password" id="add_password" class="form-control"
                                                placeholder="*{{ __('القن السري') }}" style="height: 45px;">
                                            <input type="text" name="conf_password" id="add_conf_password"
                                                class="form-control" placeholder="{{ __('تأكيد القن السري') }}"
                                                style="height: 45px;">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{ __('اغلاق') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Validation Modal Add Employe
                            const form_add_employe = document.getElementById('form_add_employe');
                            const add_first_name = document.getElementById('add_first_name');
                            const add_last_name = document.getElementById('add_last_name');
                            const add_email = document.getElementById('add_email');
                            const add_phone = document.getElementById('add_phone');
                            const add_password = document.getElementById('add_password');
                            const add_conf_password = document.getElementById('add_conf_password');
                            const pattern_name = /[a-zA-Z]/;
                            const pattern_email = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;
                            const pattern_phone =/^\+([0-9]{6,14})$/;
                            form_add_employe.addEventListener('submit', (e) => {
                                if ((add_first_name.value == "") || (add_first_name.value.length < 3) || (!pattern_name.test(
                                        add_first_name.value))) {
                                    e.preventDefault();
                                    add_first_name.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    add_first_name.style.border = "1px solid green";
                                }
                                if ((add_last_name.value == "") || (add_last_name.value.length < 3) || (!pattern_name.test(add_last_name
                                        .value))) {
                                    e.preventDefault();
                                    add_last_name.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    add_last_name.style.border = "1px solid green";
                                }
                                if ((add_email.value == "") || (!pattern_email.test(add_email.value))) {
                                    e.preventDefault();
                                    add_email.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    add_email.style.border = "1px solid green";
                                }
                                if ((add_phone.value == "") || (!pattern_phone.test(add_phone.value)) ) {
                                    e.preventDefault();
                                    add_phone.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    add_phone.style.border = "1px solid green";
                                }

                                if ((add_password.value == "") || (add_password.value.length < 6)) {
                                    e.preventDefault();
                                    add_password.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    add_password.style.border = "1px solid green";
                                }
                                if ((add_conf_password.value == "") || (add_conf_password.value.length < 6)) {
                                    e.preventDefault();
                                    add_conf_password.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    add_conf_password.style.border = "1px solid green";
                                }
                                if (!(add_conf_password.value == add_password.value)) {
                                    e.preventDefault();
                                    add_conf_password.style.border = "1px solid red";
                                }
                                if ((add_first_name.value != "") && (add_first_name.value.length >= 3) && (pattern_name.test(
                                        add_first_name.value)) &&
                                    (add_last_name.value != "") && (add_last_name.value.length >= 3) && (pattern_name.test(add_last_name
                                        .value)) &&
                                    (add_email.value != "") && (pattern_email.test(add_email.value)) &&
                                    (add_phone.value != "") &&(pattern_phone.test(add_phone.value)) &&
                                    (add_password.value != "") && (add_password.value.length >= 6) &&
                                    (add_conf_password.value == add_password.value)) {
                                    form_add_employe.submit();
                                }
                            });
                        </script>
                        <!-- Modal  Add Employe -->

                        <!-- Modal Edit Emplyee -->
                        <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="Post" action="{{ route('add.Employe',app()->getLocale() ) }}" id="form_edit_employe">
                                        @csrf
                                        <div class="modal-header ">
                                            <h5 class="modal-title " id="exampleModalLabel">{{ __('اظافة عملة') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body  d-flex flex-column gap-4 ">
                                            <input type="hidden" class="id_devise" name="Id">
                                            <input type="text" class="First_Name" id="edit_first_name"
                                                name="First_Name" class="form-control mb-3 "
                                                placeholder="*{{ __('الاسم') }}" style="height: 45px;">
                                            <input type="text" class="Last_Name" id="edit_last_name" name="Last_Name"
                                                class="form-control mb-3 " placeholder="*{{ __('النسب') }}"
                                                style="height: 45px;">
                                            <input type="text" class="Email" id="edit_email" name="Email"
                                                class="form-control mb-3 " placeholder="*{{ __('البريد الالكتروني') }}"
                                                style="height: 45px;">
                                            <input type="text" class="Phone" id="edit_phone" name="Phone"
                                                class="form-control mb-3 " placeholder="*{{ __('رقم الهاتف') }}"
                                                style="height: 45px;">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{ __('اغلاق') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Validation Modal Edit Employe
                            const form_edit_employe = document.getElementById('form_edit_employe');
                            const edit_first_name = document.getElementById('edit_first_name');
                            const edit_last_name = document.getElementById('edit_last_name');
                            const edit_email = document.getElementById('edit_email');
                            const edit_phone = document.getElementById('edit_phone');
                         
                           
                            form_edit_employe.addEventListener('submit', (e) => {
                                if ((edit_first_name.value == "") || (edit_first_name.value.length < 3) || (!pattern_name.test(
                                        edit_first_name.value))) {
                                    e.preventDefault();
                                    edit_first_name.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    edit_first_name.style.border = "1px solid green";
                                }
                                if ((edit_last_name.value == "") || (edit_last_name.value.length < 3) || (!pattern_name.test(
                                        edit_last_name.value))) {
                                    e.preventDefault();
                                    edit_last_name.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    edit_last_name.style.border = "1px solid green";
                                }
                                if ((edit_email.value == "") || (!pattern_email.test(edit_email.value))) {
                                    e.preventDefault();
                                    edit_email.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    edit_email.style.border = "1px solid green";
                                }
                                if ((edit_phone.value == "") || (!pattern_phone.test(edit_phone.value))) {
                                    e.preventDefault();
                                    edit_phone.style.border = "1px solid red";
                                } else {
                                    e.preventDefault();
                                    edit_phone.style.border = "1px solid green";
                                }
                                if ((edit_first_name.value != "") && (edit_first_name.value.length >= 3) && (pattern_name.test(
                                        edit_first_name.value)) &&
                                    (edit_last_name.value != "") && (edit_last_name.value.length >= 3) && (pattern_name.test(
                                        edit_last_name.value)) &&
                                    (edit_email.value != "") && (pattern_email.test(edit_email.value)) &&
                                    (edit_phone.value != "") && (!pattern_phone.test(edit_phone.value))) {
                                    form_edit_employe.submit();
                                }
                            });
                        </script>
                        <!-- Modal Edit Emplyee -->
                    </div>
                    <table class="table mb-0 text-center" id="table_employe">
                        <thead>
                            <tr>
                                @if (session('role') == 'Admin')
                                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                @endif
                                <th class="d-none">{{ __('التفعيل') }}</th>
                                <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('رقم الهاتف') }}</th>
                                <th class="col-4 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('البريد الالكتروني') }}</th>
                                <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('النسب') }}</th>
                                <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('الاسم') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Employee as $Employee)
                                <tr class="item tr_employe">
                                    @if (session('role') == 'Admin')
                                        <td class="col-1 d-flex justify-content-between align-items-center gap-2">
                                            @if ($Employee->Activation == 1)
                                                <form action="{{ route('delete.Employe', [$Employee->id,app()->getLocale() ]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn"
                                                        style="background-color:var(--grey-color); border:none;"
                                                        type="submit"><i class="bi  bi-trash3-fill text-white"></i>
                                                    </button>
                                                </form>
                                                <button type="submit" class="btn btn-edit"
                                                    style="background-color:var(--grey-color); border:none;"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i
                                                        class="bi bi-pen-fill text-white"></i></button>
                                            @endif
                                            @if ($Employee->Activation == 0)
                                                <form action="{{ route('delete.Employe',[$Employee->id,app()->getLocale() ]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn"
                                                        style="background-color:var(--grey-color); border:none;"
                                                        type="submit"><i class="bi bi-arrow-clockwise text-white"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="id_devise d-none col-2">{{ $Employee->id }}</td>
                                    <td class="d-none">{{ $Employee->Activation }}</td>
                                    <td class="Phone col-3">{{ $Employee->Number_phone }}</td>
                                    <td class="Email col-4">{{ $Employee->Email }}</td>
                                    <td class="Last_Name col-2">{{ $Employee->Last_Name }}</td>
                                    <td class="First_Name col-2 First_Name">{{ $Employee->First_Name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                // Search Employee
                function searchEmployee() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("input_search");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("table_employe");
                    tr = table.querySelectorAll('.tr_employe');
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[5];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                    if (filter == '') {
                        selectEmploye();
                    }
                }

                // Select Employee
                selectEmploye();

                function selectEmploye() {
                    var input_select, table_employe, tr, td, i, txtValue;
                    input_select = document.getElementById("input_select");
                    filter = input_select.value;
                    table_employe = document.getElementById("table_employe");
                    tr = table_employe.querySelectorAll('.tr_employe');
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[2];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
                // Update Of Employee
                document.querySelectorAll('.btn-edit').forEach(function(btn) {
                    btn.addEventListener('click', function(event) {
                        let select = event.target.closest('.item');
                        let id_devise = select.querySelector('.id_devise').innerHTML;
                        let First_Name = select.querySelector('.First_Name').innerHTML;
                        let Last_Name = select.querySelector('.Last_Name').innerHTML;
                        let Email = select.querySelector('.Email').innerHTML;
                        let Phone = select.querySelector('.Phone').innerHTML;

                        document.querySelector('#exampleModaledit .id_devise').value = id_devise;
                        document.querySelector('#exampleModaledit .First_Name').value = First_Name;
                        document.querySelector('#exampleModaledit .Last_Name').value = Last_Name;
                        document.querySelector('#exampleModaledit .Email').value = Email;
                        document.querySelector('#exampleModaledit .Phone').value = Phone;
                    })
                })
            </script>
        </div>
    </div>
@endsection
