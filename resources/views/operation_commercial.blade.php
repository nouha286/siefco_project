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
                    style="min-height: 200px; max-height: 560px; border-radius: 16px;">
                    @if (session('success_delete'))
                        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                            {{ session('success_delete') }}
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
                        <h4>{{ __('العمليات التجارية') }}</h4>

                        <div class="input-group me-3" style="width: 25%;">
                            <input type="text" id="input_search" class="form-control" placeholder="{{ __('الاسم') }}"
                                style="height: 45px;" onkeyup="searchOperation()">
                            <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i
                                    class="bi bi-search"></i></span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary"
                                style="background-color:var(--grey-color); color: var(--white-color); border:none;"
                                data-bs-toggle="modal" data-bs-target="#modal_transfert">
                                {{ __('تحويل') }}
                            </button>
                            <button type="button" class="btn btn-primary"
                                style="background-color:var(--grey-color); color:var(--white-color); border:none;"
                                data-bs-toggle="modal" data-bs-target="#modal_deposit">
                                {{ __('إيداع') }}
                            </button>
                            <button type="button" class="btn btn-primary"
                                style="background-color:var(--grey-color); color:var(--white-color); border:none;"
                                data-bs-toggle="modal" data-bs-target="#modal_retrait">
                                {{ __('سحب') }}
                            </button>
                        </div>

                        <!-- Modal Transfert -->
                        <div class="modal fade" id="modal_transfert" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="Post" action="{{ route('add.Operation') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('اظافة عملية تحويل') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-4">
                                            <div class="search_select_box w-100">
                                                <label class="float-end" for="Username">{{ __('المرسل') }}</label>
                                                <select class="selectpicker w-100" id="Username" name="Client_id"
                                                    data-live-search="true">
                                                    @foreach ($emetteur as $client)
                                                        :
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->First_Name }}
                                                            {{ $client->Last_Name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <label class="float-end"
                                                    for="Username_client_receiver">{{ __('المتلقي') }}</label>
                                                <select class="selectpicker w-100" id="Username_client_receiver"
                                                    name="receiver_id" data-live-search="true">
                                                    <option value="0">{{ __('الى زبون اخر') }}</option>
                                                    @foreach ($destinataire as $client)
                                                        :
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->First_Name }}
                                                            {{ $client->Last_Name }}
                                                        </option>
                                                    @endforeach
                                                    @foreach ($destinataireExclu as $client)
                                                        :
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->First_Name }}
                                                            {{ $client->Last_Name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" id="add_creditor" name="Verse" class="form-control"
                                                placeholder="{{ __('المبلغ') }}">
                                            <div class="search_select_box w-100">
                                                <select class="selectpicker w-100" id="add_devise" name="devise"
                                                    data-live-search="true">
                                                    @foreach ($deviseForVersement as $devise)
                                                        :
                                                        <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-body d-none flex-column gap-1"
                                                id="add_client_for_opperation">
                                                <input type="text" name="Last_Name" id="last_name"
                                                    placeholder="{{ __('الاسم') }}" class="col-form">
                                                <input type="text" name="First_Name" id="first_name"
                                                    placeholder="{{ __('النسب') }}" class="col-form">
                                                <input type="text" name="email" id="email_signup"
                                                    placeholder="{{ __('البريد الالكتروني') }}" class="col-form">
                                                <input type="text" name="phone" id="phone_signup"
                                                    placeholder="{{ __('رقم الهاتف') }}" class="col-form">
                                            </div>
                                            <input type="text" id="add_creditor" name="Benifice"
                                                class="form-control " placeholder="{{ __('الربح') }}">
                                            <input type="hidden" name="Versement" value="Versement">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" name="statement" id="floatingTextarea2"
                                                    style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">{{ __('البيان') }}</label>
                                            </div>
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

                        <!-- Modal Deposit -->
                        <div class="modal fade" id="modal_deposit" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="Post" id="form_add_client" action="{{ route('add.Operation') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('اظافة عملية إيداع') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-4">
                                            <div class="search_select_box w-100">
                                                <select class="selectpicker w-100" id="add_name" name="Client_id"
                                                    data-live-search="true">
                                                    @foreach ($clientForDepot as $client)
                                                        :
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->First_Name }}
                                                            {{ $client->Last_Name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" id="add_creditor" name="Creditor"
                                                class="form-control " placeholder="{{ __('المبلغ') }}">
                                            <div class="search_select_box w-100">
                                                <select class="selectpicker w-100" id="add_devise" name="devise"
                                                    data-live-search="true">
                                                    @foreach ($deviseForDepot as $devise)
                                                        :
                                                        <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="Depot" value="Depot">
                                            <input type="text" id="add_creditor" name="Benifice"
                                                class="form-control " placeholder="{{ __('الربح') }}">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" name="statement" id="floatingTextarea2"
                                                    style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">{{ __('البيان') }}</label>
                                            </div>
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

                        <!-- Modal Retrait -->
                        <div class="modal fade" id="modal_retrait" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="Post" id="form_retrait" action="{{ route('add.Operation') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('اظافة عملية سحب') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-4">
                                            <div class="search_select_box w-100">
                                                <select class="selectpicker w-100" id="retrait_name" name="Client_id"
                                                    data-live-search="true">
                                                    @foreach ($clientForRetrait as $client)
                                                        :
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->First_Name }}
                                                            {{ $client->Last_Name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" id="retrait_solde" name="Debtor" class="form-control "
                                                placeholder="{{ __('المبلغ') }}">
                                            <div class="search_select_box w-100">
                                                <select class="selectpicker w-100" id="add_devise" name="devise"
                                                    data-live-search="true">
                                                    @foreach ($deviseForRetrait as $devise)
                                                        :
                                                        <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" id="retrait_benifice" name="Benifice"
                                                class="form-control " placeholder="{{ __('الربح') }}">
                                            <input type="hidden" name="Retrait" value="Retrait">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" name="statement" id="retrait_statement"
                                                    style="height: 100px"></textarea>
                                                <label for="retrait_statement">{{ __('البيان') }}</label>
                                            </div>
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
                            // Validation Form Retrait
                            const form_retrait = document.getElementById('form_retrait');
                            const retrait_name = document.getElementById('retrait_name');
                            const retrait_benifice = document.getElementById('retrait_benifice');
                            const retrait_solde = document.getElementById('retrait_solde');
                            const retrait_statement = document.getElementById('retrait_statement');
                            form_retrait.addEventListener('submit', (e) => {
                                if (retrait_name.value == "") {
                                    e.preventDefault();
                                    retrait_name.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    retrait_name.style.border = "1px solid green";
                                }

                                if ((retrait_benifice.value == "") || (isNaN(retrait_benifice.value))) {
                                    e.preventDefault();
                                    retrait_benifice.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    retrait_benifice.style.border = "1px solid green";
                                }

                                if ((retrait_solde.value == "") || (isNaN(retrait_solde.value))) {
                                    e.preventDefault();
                                    retrait_solde.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    retrait_solde.style.border = "1px solid green";
                                }

                                if (retrait_statement.value == "") {
                                    e.preventDefault();
                                    retrait_statement.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    retrait_statement.style.border = "1px solid green";
                                }

                                if((retrait_name.value != "") && (retrait_benifice.value != "") && !(isNaN(retrait_benifice.value)) && (retrait_solde.value != "") && !(isNaN(retrait_solde.value)) && (retrait_statement.value != "")) {
                                    form_retrait.submit();
                                }
                            });

                        </script>

                    </div>
                    <table class="table mb-0 text-center" id="table_operation">
                        <thead>
                            <tr>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('المستخدم') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('العملة') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('التاريخ') }}</th>
                                <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('البيان') }}</th>
                                <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('الربح') }}</th>

                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('الرصيد') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('مدين') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('دائن') }}</th>
                                <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('المتلقي') }}</th>
                                <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('المرسل/اسم الزبون') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('رقم العمليات') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comercial_Operation as $comercial_Operation)
                                <tr class="tr_operation">
                                    <td class="col-1">{{ $comercial_Operation->Emloyee_Name }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Currency }}</td>
                                    <td class="col-2">{{ $comercial_Operation->created_at }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Statement }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Benifice }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Balance }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Creditor }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Debtor }}</td>
                                    <td class="col-2">{{ $comercial_Operation->receiver }}</td>
                                    <td class="col-2"><a
                                            href="{{ route('Operation', $comercial_Operation->Client_id) }}">{{ $comercial_Operation->Client_Name }}</a>
                                    </td>
                                    <td class="col-2 d-none">{{ $comercial_Operation->Client_Name }}</td>
                                    <td class="col-1">{{ $comercial_Operation->id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validation Modal Add Client
        const form_add_client = document.getElementById('form_add_client');
        const add_name = document.getElementById('add_name');
        const add_creditor = document.getElementById('add_creditor');
        const add_debtor = document.getElementById('add_debtor');
        const add_devise = document.getElementById('add_devise');
        const pattern_number = /[0-9]/;
        form_add_client.addEventListener('submit', (e) => {
            if (add_name.value == "") {
                e.preventDefault();
                add_name.style.border = "1px solid red";
            } else {
                e.preventDefault();
                add_name.style.border = "1px solid green";
            }
            if ((add_creditor.value == "") || (isNaN(add_creditor.value))) {
                e.preventDefault();
                add_creditor.style.border = "1px solid red";
            } else {
                e.preventDefault();
                add_creditor.style.border = "1px solid green";
            }
            if ((add_debtor.value == "") || (isNaN(add_debtor.value))) {
                e.preventDefault();
                add_debtor.style.border = "1px solid red";
            } else {
                e.preventDefault();
                add_debtor.style.border = "1px solid green";
            }
            if (add_devise.value == "") {
                e.preventDefault();
                add_devise.style.border = "1px solid red";
            } else {
                e.preventDefault();
                add_devise.style.border = "1px solid green !important";
            }
            if ((add_name.value != "") && (add_creditor.value != "") && !(isNaN(add_creditor.value)) && (add_debtor
                    .value != "") && !(isNaN(add_debtor.value)) && (add_devise.value != "")) {
                form_add_client.submit();
            }
        });

        // Search Operation
        function searchOperation() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("input_search");
            filter = input.value.toUpperCase();
            table = document.getElementById("table_operation");
            tr = table.querySelectorAll('.tr_operation');
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[8];
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
        // for versement

        const add_client_for_opperation = document.getElementById('add_client_for_opperation');
        const Username_client_receiver = document.getElementById('Username_client_receiver');
        Username_client_receiver.addEventListener('change', (e) => {
            if (Username_client_receiver.value == 0) {
                add_client_for_opperation.classList.remove("d-none");
                add_client_for_opperation.classList.add("d-flex");
            } else {
                add_client_for_opperation.classList.remove("d-flex");
                add_client_for_opperation.classList.add("d-none");
            }
        });
    </script>

@endsection
