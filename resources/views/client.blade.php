@extends('master.layout')

@section('content')
<div class="position-absolute w-100" style="height: 40vh; background-color: var(--second-color);"></div>
<div class="d-flex flex-row-reverse gap-3 mx-3" style="height: 100vh;">
    <!-- AssidBar -->
    @include('master.AssidBar')

    <div class="position-relative w-100">
        <!-- Navbar -->
        @include('master.Navbar')

        <!-- Statistiques , -->
        <div class="container-fluid py-4">
            <div class="card border-0 shadow-sm overflow-auto" style="min-height: 200px; max-height: 560px; border-radius: 16px;">
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <div>
                        <select class="form-select text-center fs-5 fw-bold" id="input_select" onchange="selectClient()" style="max-width: 300px; border:none; background-color: var(--second--white-color-color);">
                            <option value="1">{{__('الزبناء') }}</option>
                            <option value="0">{{__('الزبناء المحذوفين')}}</option>
                        </select>
                    </div>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" class="form-control" id="input_search" onkeyup="searchClient()" placeholder="{{__('الاسم') }}" style="height: 45px;">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>
                    <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle-fill h1"></i>
                    </button>
                </div>
                <table class="table mb-0 text-center" id="table_client">
                    <thead>
                        <tr>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('البيان')}}</th>
                            <th class="d-none"></th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('العملة')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('دائن')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('مدين')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('الرصيد')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('رقم الهاتف') }}</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> {{__('البريد الالكتروني') }}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('النسب')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('الاسم') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($client as $client)
                        <tr class="item tr_client">
                            <td class="col-1 d-flex justify-content-between align-items-center gap-2">
                                @if ($client->Activation == 1)
                                <form action="{{ route('delete.Client',[$client->id, app()->getLocale() ]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" style="background-color:var(--grey-color); border:none;" type="submit"><i class="bi  bi-trash3-fill text-white"></i></button>
                                </form>
                                <button type="submit" class="btn btn-edit" style="background-color:var(--grey-color); color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i class="bi bi-pen-fill text-white"></i></button>
                                @endif
                                @if ($client->Activation == 0)
                                <form action="{{ route('delete.Client',[$client->id, app()->getLocale() ]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" style="background-color:var(--grey-color); border:none;" type="submit"><i class="bi bi-arrow-clockwise text-white"></i></button>
                                </form>
                                @endif
                            </td>
                            <td class="col-2">{{ $client->Statement }}</td>
                            <td class="d-none">{{ $client->Activation }}</td>
                            <td class="col-1 Devise">{{ $client->Currency }}</td>
                            <td class="col-1 Creditor">{{ $client->Creditor }}</td>
                            <td class="col-1 Debtor">{{ $client->Debtor }}</td>
                            <td class="col-1 Balance">{{ $client->Balance }}</td>
                            <td class="col-1 Phone">{{ $client->Number_phone }}</td>
                            <td class="col-2 Email">{{ $client->Email }}</td>
                            <td class="col-1 Last_Name d-none">{{ $client->Last_Name }}</td>
                            <td class="col-1 First_Name d-none">{{ $client->First_Name }}</td>
                            <td class="col-1 "><a href="{{route('Operation',$client->id)}}">{{ $client->Last_Name }}</a></td>
                            <td class="col-1 "><a href="{{route('Operation',$client->id)}}">{{ $client->First_Name }}</a></td>
                            <td class="id_devise d-none">{{ $client->id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Add Client -->
            <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="Post" action="{{ route('add.Client',app()->getLocale() ) }}" id="form_add_client">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> {{__('اظافةزبون') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex flex-column gap-3">
                                <input type="text" name="First_Name" id="add_first_name" class="form- " placeholder="*{{__('الاسم') }}">
                                <input type="text" name="Last_Name" id="add_last_name" class="form-control " placeholder="*{{__('النسب')}}">
                                <input type="text" name="Email" id="add_email" class="form-control " placeholder="*{{__('البريد الالكتروني') }}">
                                <input type="text" name="Phone" id="add_phone" class="form-control " placeholder="*{{__('رقم الهاتف') }}">
                                <input type="text" name="Balance" id="blance" class="form-control " placeholder="* {{__(' الرصيد') }}" style="height: 45px;">
                                <div class="search_select_box w-100">
                                    <select class="selectpicker w-100" id="devise" name="devise" data-live-search="true">
                                        @foreach ($devise as $devise) :
                                        <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" name="Password" id="add_password" class="form-control " placeholder="* {{__('القن السري') }}" style="height: 45px;">
                                <input type="text" name="Password_verif" id="add_conf_password" class="form-control" placeholder="{{__('تأكيد القن السري') }}" style="height: 45px;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('اغلاق')}}</button>
                                <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Validation Modal Add Client
                const form_add_client = document.getElementById('form_add_client');
                const add_first_name = document.getElementById('add_first_name');
                const add_last_name = document.getElementById('add_last_name');
                const add_email = document.getElementById('add_email');
                const add_phone = document.getElementById('add_phone');
                const blance = document.getElementById('blance');
                const add_password = document.getElementById('add_password');
                const add_conf_password = document.getElementById('add_conf_password');
                const devise = document.getElementById('devise');
                const pattern_name = /[a-zA-Z]/;
                const pattern_email = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;
                const pattern_phone = /^\+([0-9]{6,14})$/;
                form_add_client.addEventListener('submit', (e) => {
                    if ((add_first_name.value == "") || (add_first_name.value.length < 3) || (!pattern_name.test(add_first_name.value))) {
                        e.preventDefault();
                        add_first_name.style.border = "1px solid red";
                    } else {
                        add_first_name.style.border = "1px solid green";
                    }

                    if ((add_last_name.value == "") || (add_last_name.value.length < 3) || (!pattern_name.test(add_last_name.value))) {
                        e.preventDefault();
                        add_last_name.style.border = "1px solid red";
                    } else {
                        add_last_name.style.border = "1px solid green";
                    }

                    if ((add_email.value == "") || (!pattern_email.test(add_email.value))) {
                        e.preventDefault();
                        add_email.style.border = "1px solid red";
                    } else {
                        add_email.style.border = "1px solid green";
                    }

                    if ((add_phone.value == "") || (!pattern_phone.test(add_phone.value))) {
                        e.preventDefault();
                        add_phone.style.border = "1px solid red";
                    } else {
                        add_phone.style.border = "1px solid green";
                    }
                 

                    if ((blance.value == "") || (isNaN(blance.value))) {
                        e.preventDefault();
                        blance.style.border = "1px solid red";
                    } else {
                        blance.style.border = "1px solid green";
                    }

                    if (devise.value == "") {
                        e.preventDefault();
                        devise.style.border = "1px solid red";
                    } else {
                        devise.style.border = "1px solid green";
                    }

                    if ((add_password.value == "") || (add_password.value.length < 6)) {
                        e.preventDefault();
                        add_password.style.border = "1px solid red";
                    } else {
                        add_password.style.border = "1px solid green";
                    }

                    if ((add_conf_password.value == "") || (add_conf_password.value.length < 6)) {
                        e.preventDefault();
                        add_conf_password.style.border = "1px solid red";
                    } else {
                        add_conf_password.style.border = "1px solid green";
                    }

                    if (!(add_conf_password.value == add_password.value)) {
                        e.preventDefault();
                        add_conf_password.style.border = "1px solid red";
                    } else {
                        add_conf_password.style.border = "1px solid green";
                    }

                    if ((add_first_name.value != "") && (add_first_name.value.length >= 3) && (pattern_name.test(add_first_name.value)) &&
                        (add_last_name.value != "") && (add_last_name.value.length >= 3) && (pattern_name.test(add_last_name.value)) &&
                        (add_email.value != "") && (pattern_email.test(add_email.value)) &&
                        (add_phone.value != "") && (pattern_phone.test(add_phone.value)) &&
                        (blance.value != "") && !(isNaN(blance.value)) &&
                        (devise.value != "") &&
                        (add_password.value != "") && (add_password.value.length >= 6) &&
                        (add_conf_password.value == add_password.value)) {
                        form_add_client.submit();
                    }
                });
            </script>

            <!-- Modal Add Client -->

            <!-- Modal Edit Client -->
            <div class="modal fade" id="exampleModaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="Post" action="{{ route('add.Client',app()->getLocale() ) }}" id="form_edit_client">
                            @csrf
                            <div class="modal-header ">
                                <h5 class="modal-title " id="exampleModalLabel">{{__('اظافةزبون') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body  d-flex flex-column gap-4 ">
                                <input type="hidden" class="id_devise" name="Id">
                                <input type="text" class="First_Name" id="edit_first_name" name="First_Name" class="form- " placeholder="*{{__('الاسم') }}">
                                <input type="text" class="Last_Name" id="edit_last_name" name="Last_Name" class="form-control " placeholder="*{{__('النسب')}}">
                                <input type="text" class="Email" id="edit_email" name="Email" class="form-control " placeholder="* {{__('البريد الالكتروني') }}">
                                <input type="text" class="Phone" id="edit_phone" name="Phone" class="form-control " placeholder="* {{__('رقم الهاتف') }}">
                                <input type="text" class="Balance" id="edit_blance" name="Balance" class="form-control " placeholder="* {{__(' الرصيد') }}" style="height: 45px;">
                                <div class="search_select_box w-100">
                                    <select class="selectpicker w-100 devise" id="edit_devise" name="devise" data-live-search="true">
                                        @foreach ($devise_edit as $devise) :
                                        <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('اغلاق')}}</button>
                                <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Validation Modal Edit Client
                const form_edit_client = document.getElementById('form_edit_client');
                const edit_first_name = document.getElementById('edit_first_name');
                const edit_last_name = document.getElementById('edit_last_name');
                const edit_email = document.getElementById('edit_email');
                const edit_phone = document.getElementById('edit_phone');
                const edit_blance = document.getElementById('edit_blance');
                const edit_password = document.getElementById('edit_password');
                const edit_conf_password = document.getElementById('edit_conf_password');
                const edit_devise = document.getElementById('edit_devise');
                form_edit_client.addEventListener('submit', (e) => {
                    if ((edit_first_name.value == "") || (edit_first_name.value.length < 3) || (!pattern_name.test(edit_first_name.value))) {
                        e.preventDefault();
                        edit_first_name.style.border = "1px solid red";
                    } else {
                        edit_first_name.style.border = "1px solid green";
                    }

                    if ((edit_last_name.value == "") || (edit_last_name.value.length < 3) || (!pattern_name.test(edit_last_name.value))) {
                        e.preventDefault();
                        edit_last_name.style.border = "1px solid red";
                    } else {
                        edit_last_name.style.border = "1px solid green";
                    }

                    if ((edit_email.value == "") || (!pattern_email.test(edit_email.value))) {
                        e.preventDefault();
                        edit_email.style.border = "1px solid red";
                    } else {
                        edit_email.style.border = "1px solid green";
                    }

                    if ((edit_phone.value == "") || (!pattern_phone.test(edit_phone.value))) {
                        e.preventDefault();
                        edit_phone.style.border = "1px solid red";
                    } else {
                        edit_phone.style.border = "1px solid green";
                    }
                  

                    if ((edit_blance.value == "") || (isNaN(edit_blance.value))) {
                        e.preventDefault();
                        edit_blance.style.border = "1px solid red";
                    } else {
                        edit_blance.style.border = "1px solid green";
                    }

                    if (edit_devise.value == "") {
                        e.preventDefault();
                        edit_devise.style.border = "1px solid red";
                    } else {
                        edit_devise.style.border = "1px solid green";
                    }

                    if ((edit_password.value == "") || (edit_password.value.length < 6)) {
                        e.preventDefault();
                        edit_password.style.border = "1px solid red";
                    } else {
                        edit_password.style.border = "1px solid green";
                    }

                    if ((edit_conf_password.value == "") || (edit_conf_password.value.length < 6)) {
                        e.preventDefault();
                        edit_conf_password.style.border = "1px solid red";
                    } else {
                        edit_conf_password.style.border = "1px solid green";
                    }

                    if (!(edit_conf_password.value == edit_password.value)) {
                        e.preventDefault();
                        edit_conf_password.style.border = "1px solid red";
                    } else {
                        edit_conf_password.style.border = "1px solid green";
                    }

                    if ((edit_first_name.value != "") && (edit_first_name.value.length >= 3) && (pattern_name.test(edit_first_name.value)) &&
                        (edit_last_name.value != "") && (edit_last_name.value.length >= 3) && (pattern_name.test(edit_last_name.value)) &&
                        (edit_email.value != "") && (pattern_email.test(edit_email.value)) &&
                        (edit_phone.value != "") && (pattern_phone.test(edit_phone.value)) &&
                        (edit_blance.value == "") && !(isNaN(edit_blance.value)) &&
                        (edit_devise.value != "") &&
                        (edit_password.value != "") && (edit_password.value.length >= 6) &&
                        (edit_conf_password.value == edit_password.value)) {
                        form_edit_client.submit();
                    }
                });
            </script>

            <!-- Modal Edit Client -->

        </div>
    </div>

    <script>
        // Search Employee
        function searchClient() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("input_search");
            filter = input.value.toUpperCase();
            table = document.getElementById("table_client");
            tr = table.querySelectorAll('.tr_client');
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[10];
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
        selectClient();

        function selectClient() {
            var input_select, table_employe, tr, td, i, txtValue;
            input_select = document.getElementById("input_select");
            filter = input_select.value;
            table_employe = document.getElementById("table_client");
            tr = table_employe.querySelectorAll('.tr_client');
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
        // Update Of Devise
        document.querySelectorAll('.btn-edit').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                let select = event.target.closest('.item');
                let id_devise = select.querySelector('.id_devise').innerHTML;
                let First_Name = select.querySelector('.First_Name').innerHTML;
                let Last_Name = select.querySelector('.Last_Name').innerHTML;
                let Email = select.querySelector('.Email').innerHTML;
                let Phone = select.querySelector('.Phone').innerHTML;
                let Balance = select.querySelector('.Balance').innerHTML;
                let Devise = select.querySelector('.Devise').innerHTML;

                document.querySelector('#exampleModaledit .id_devise').value = id_devise;
                document.querySelector('#exampleModaledit .First_Name').value = First_Name;
                document.querySelector('#exampleModaledit .Last_Name').value = Last_Name;
                document.querySelector('#exampleModaledit .Email').value = Email;
                document.querySelector('#exampleModaledit .Phone').value = Phone;
                document.querySelector('#exampleModaledit .Balance').value = Balance;
                document.querySelector('#exampleModaledit .Devise').value = Devise;
            })
        })
    </script>
    <!-- Copyright -->
    <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo {{ date('Y') }}</div>
</div>
</div>
@endsection