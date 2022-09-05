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

                    <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                        <h4>{{ __('العمليات التجارية') }}</h4>

                        <div class="input-group me-3" style="width: 25%;">
                            <input type="text" id="input_search" class="form-control" placeholder="{{ __('الاسم') }}"
                                style="height: 45px;" onkeyup="searchOperation()">

                                <script>
                                    // Search Operation
                                    function searchOperation() {
                                        var input, filter, table, tr, td, i, txtValue;
                                        input = document.getElementById("input_search");
                                        filter = input.value.toUpperCase();
                                        table = document.getElementById("table_operation");
                                        tr = table.querySelectorAll('.tr_operation');
                                        for (i = 0; i < tr.length; i++) {
                                            td = tr[i].getElementsByTagName("td")[9];
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
                                </script>

                            <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary"
                            style="background-color:var(--grey-color); color:var(--white-color); border:none;"
                                data-bs-toggle="modal" data-bs-target="#modal_transfert">
                                {{ __('اظافة عملية') }}</button>

                                <button type="button" class="btn btn-primary"
                                style="background-color:var(--grey-color); color:var(--white-color); border:none;"
                                data-bs-toggle="modal" data-bs-target="#modal_deposit">
                                {{ __('إيداع') }}
                            </button>
                        </div>

                        <!-- Modal Transfert -->
                        <div class="modal fade" id="modal_transfert" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="Post" id="form_transfert" action="{{ route('add.Operation',app()->getLocale() ) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('اظافة عملية تحويل') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-4">
                                            <div class="search_select_box w-100">
                                                <label class="float-end" for="transfert_name">{{ __('المرسل') }}</label>
                                                <select class="selectpicker w-100" id="transfert_name" name="Client_id" data-live-search="true">
                                                    @foreach ($emetteur as $client)
                                                        :
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->First_Name }}
                                                            {{ $client->Last_Name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <label class="float-end" for="transfert_name_receiver">{{ __('المتلقي') }}</label>
                                                <select class="selectpicker w-100" id="transfert_name_receiver"
                                                    name="receiver_id" data-live-search="true" onchange="versementClient()">
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
                                                <div class="d-none flex-column gap-1" id="add_client_for_opperation">
                                                    <div class="d-flex gap-1">
                                                        <input type="text" name="Last_Name" id="transfert_firstname_receiver" placeholder="{{ __('الاسم') }}" class="col-form w-50">
                                                        <input type="text" name="First_Name" id="transfert_lastname_receiver" placeholder="{{ __('النسب') }}" class="col-form w-50">
                                                    </div>
                                                    <input type="text" name="email" id="transfert_email_receiver" placeholder="{{ __('البريد الالكتروني') }}" class="col-form">
                                                    <input type="text" name="phone" id="transfert_phone_receiver" placeholder="{{ __('رقم الهاتف') }}" class="col-form">
                                                </div>
                                            </div>
                                            <input type="text" id="transfert_solde" name="Verse" class="form-control" placeholder="{{ __('المبلغ') }}">
                                            <div class="search_select_box w-100">
                                                <select class="selectpicker w-100" id="transfert_devise" name="devise" data-live-search="true">
                                                    @foreach ($deviseForVersement as $devise)
                                                        :
                                                        <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" id="transfert_benifice" name="Benifice" class="form-control " placeholder="{{ __('الربح') }}">
                                            <input type="hidden" name="Versement" value="Versement">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" name="statement" id="transfert_statement" style="height: 100px"></textarea>
                                                <label for="transfert_statement">{{ __('البيان') }}</label>
                                            </div>
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
                            // Validation Form Transfert
                            const form_transfert = document.getElementById('form_transfert');
                            const transfert_name = document.getElementById('transfert_name');
                            const transfert_name_receiver = document.getElementById('transfert_name_receiver');

                            const transfert_firstname_receiver = document.getElementById('transfert_firstname_receiver');
                            const transfert_lastname_receiver = document.getElementById('transfert_lastname_receiver');
                            const transfert_email_receiver = document.getElementById('transfert_email_receiver');
                            const pattern_email = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;
                            const transfert_phone_receiver = document.getElementById('transfert_phone_receiver');

                            const transfert_solde = document.getElementById('transfert_solde');
                            const transfert_devise = document.getElementById('transfert_devise');
                            const transfert_benifice = document.getElementById('transfert_benifice');
                            const transfert_statement = document.getElementById('transfert_statement');

                            form_transfert.addEventListener('submit', (e) => {
                                if (transfert_name.value == "") {
                                    e.preventDefault();
                                    transfert_name.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    transfert_name.style.border = "1px solid green";
                                }

                                if ((transfert_name_receiver.value == "") || (transfert_name_receiver.value == "0")) {
                                    e.preventDefault();
                                    transfert_name_receiver.style.border = "1px solid red";
                                    versementClient()
                                    if (transfert_firstname_receiver.value == "") {
                                        e.preventDefault();
                                        transfert_firstname_receiver.style.border = "1px solid red";
                                    }else{
                                        e.preventDefault();
                                        transfert_firstname_receiver.style.border = "1px solid green";
                                    }
                                    if (transfert_lastname_receiver.value == "") {
                                        e.preventDefault();
                                        transfert_lastname_receiver.style.border = "1px solid red";
                                    }else{
                                        e.preventDefault();
                                        transfert_lastname_receiver.style.border = "1px solid green";
                                    }
                                    if ((transfert_email_receiver.value == "") || !(pattern_email.test(transfert_email_receiver.value))) {
                                        e.preventDefault();
                                        transfert_email_receiver.style.border = "1px solid red";
                                    }else {
                                        e.preventDefault();
                                        transfert_email_receiver.style.border = "1px solid green";
                                    }
                                    if ((isNaN(transfert_phone_receiver.value)) || (transfert_phone_receiver.value.length != 10)) {
                                        e.preventDefault();
                                        transfert_phone_receiver.style.border = "1px solid red";
                                    }else{
                                        e.preventDefault();
                                        transfert_phone_receiver.style.border = "1px solid green";
                                    }
                                }else{
                                    e.preventDefault();
                                    transfert_name_receiver.style.border = "1px solid green";
                                }

                                if ((transfert_solde.value == "") || (isNaN(transfert_solde.value))) {
                                    e.preventDefault();
                                    transfert_solde.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    transfert_solde.style.border = "1px solid green";
                                }

                                if (transfert_devise.value == "") {
                                    e.preventDefault();
                                    transfert_devise.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    transfert_devise.style.border = "1px solid green";
                                }

                                if ((transfert_benifice.value == "") || (isNaN(transfert_benifice.value))) {
                                    e.preventDefault();
                                    transfert_benifice.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    transfert_benifice.style.border = "1px solid green";
                                }

                                if (transfert_statement.value == "") {
                                    e.preventDefault();
                                    transfert_statement.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    transfert_statement.style.border = "1px solid green";
                                }

                                if((transfert_name.value != "") &&
                                    (transfert_name_receiver.value != "") && ((transfert_name_receiver.value != "0") || ((transfert_name_receiver.value == "0") && (transfert_firstname_receiver.value != "") && (transfert_lastname_receiver.value != "") && (transfert_email_receiver.value != "") && (pattern_email.test(transfert_email_receiver.value)) && (transfert_phone_receiver.value != "") && !(isNaN(transfert_phone_receiver.value)) && (transfert_phone_receiver.value.length == 10))) &&
                                    (transfert_solde.value != "") && !(isNaN(transfert_solde.value)) &&
                                    (transfert_devise.value != "") &&
                                    (transfert_benifice.value != "") && !(isNaN(transfert_benifice.value)) &&
                                    (transfert_statement.value != "")) {
                                    form_transfert.submit();
                                }
                            });
                        </script>
  <!-- Modal Deposit -->
  <div class="modal fade" id="modal_deposit" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="Post" id="form_deposit" action="{{ route('add.Operation',app()->getLocale() ) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('اظافة عملية إيداع') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-4">
                                            <div class="search_select_box w-100">
                                                <select class="selectpicker w-100" id="deposit_name" name="Client_id"
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
                                            <input type="text" id="deposit_solde" name="Creditor"
                                                class="form-control " placeholder="{{ __('المبلغ') }}">
                                            <div class="search_select_box w-100">
                                                <select class="selectpicker w-100" id="deposit_devise" name="devise"
                                                    data-live-search="true">
                                                    @foreach ($deviseForDepot as $devise)
                                                        :
                                                        <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="Depot" value="Depot">
                                            <input type="text" id="deposit_benifice" name="Benifice"
                                                class="form-control " placeholder="{{ __('الربح') }}">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" name="statement" id="deposit_statement"
                                                    style="height: 100px"></textarea>
                                                <label for="deposit_statement">{{ __('البيان') }}</label>
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
                            // Validation Form Deposit
                            const form_deposit = document.getElementById('form_deposit');
                            const deposit_name = document.getElementById('deposit_name');
                            const deposit_benifice = document.getElementById('deposit_benifice');
                            const deposit_solde = document.getElementById('deposit_solde');
                            const deposit_devise = document.getElementById('deposit_devise');
                            const deposit_statement = document.getElementById('deposit_statement');
                            form_deposit.addEventListener('submit', (e) => {
                                if (deposit_name.value == "") {
                                    e.preventDefault();
                                    deposit_name.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    deposit_name.style.border = "1px solid green";
                                }

                                if ((deposit_benifice.value == "") || (isNaN(deposit_benifice.value))) {
                                    e.preventDefault();
                                    deposit_benifice.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    deposit_benifice.style.border = "1px solid green";
                                }

                                if ((deposit_solde.value == "") || (isNaN(deposit_solde.value))) {
                                    e.preventDefault();
                                    deposit_solde.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    deposit_solde.style.border = "1px solid green";
                                }

                                if (deposit_devise.value == "") {
                                    e.preventDefault();
                                    deposit_devise.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    deposit_devise.style.border = "1px solid green";
                                }

                                if (deposit_statement.value == "") {
                                    e.preventDefault();
                                    deposit_statement.style.border = "1px solid red";
                                }else{
                                    e.preventDefault();
                                    deposit_statement.style.border = "1px solid green";
                                }

                                if((deposit_name.value != "") && (deposit_benifice.value != "") && !(isNaN(deposit_benifice.value)) && (deposit_solde.value != "") && !(isNaN(deposit_solde.value)) && (deposit_devise.value != "") && (deposit_statement.value != "")) {
                                    form_deposit.submit();
                                }
                            });

                        </script>

                        <script>
                            // for versement
                            function versementClient() {
                                const add_client_for_opperation = document.getElementById('add_client_for_opperation');
                                const transfert_name_receiver = document.getElementById('transfert_name_receiver');
                                if (transfert_name_receiver.value == 0) {
                                    add_client_for_opperation.classList.remove("d-none");
                                    add_client_for_opperation.classList.add("d-flex");
                                } else {
                                    add_client_for_opperation.classList.remove("d-flex");
                                    add_client_for_opperation.classList.add("d-none");
                                }
                            }
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
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('الربح') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('الرصيد') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('مدين') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('دائن') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('المتلقي') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                    <td class="col-1">{{ $comercial_Operation->created_at }}</td>
                                    <td class="col-2">{{ $comercial_Operation->Statement }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Benifice }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Balance }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Creditor }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Debtor }}</td>
                                    <td class="col-1">{{ $comercial_Operation->receiver }}</td>
                                    <td class="col-1"><a href="{{route('Operation',$comercial_Operation->Client_id)}}">{{ $comercial_Operation->Client_Name }}</a></td>
                                    <td class="col-1 d-none">{{ $comercial_Operation->Client_Name }}</td>
                                    <td class="col-1">{{ $comercial_Operation->id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
