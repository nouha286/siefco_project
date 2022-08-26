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
            <div class="card border-0 shadow-sm overflow-auto" style="min-height: 200px; max-height: 560px; border-radius: 16px;">
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
                    <h4>{{__('العمليات التجارية')}}</h4>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" id="input_search" class="form-control" placeholder="{{__('الاسم')}}" style="height: 45px;" onkeyup="searchOperation()">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>
                    <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle-fill h1"></i>
                    </button>

                    <!-- Modal Add Client -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="Post" id="form_add_client" action="{{ route('add.Operation') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{__('اظافة عملة')}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-4">
                                        <div class="search_select_box w-100">
                                            <select class="selectpicker w-100" id="add_name" name="Client_id" data-live-search="true">
                                                @foreach ($client as $client):
                                                    <option value="{{ $client->id }}">{{ $client->First_Name }} {{ $client->Last_Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" id="add_creditor" name="Creditor" class="form-control " placeholder="{{__('مدين')}}">
                                        <input type="text" id="add_debtor" name="Debtor" class="form-control " placeholder="*{{__('دائن')}}">
                                        <div class="search_select_box w-100">
                                            <select class="selectpicker w-100" id="add_devise" name="devise" data-live-search="true">
                                                @foreach ($devise as $devise) :
                                                    <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('اغلاق')}}/button>
                                        <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Add Client -->

                </div>
                <table class="table mb-0 text-center" id="table_operation">
                    <thead>
                        <tr>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('المستخدم')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('العملة')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('التاريخ')}}</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('البيان')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('الرصيد')}}</th>

                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('مدين')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('دائن')}}</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('اسم الزبون')}} </th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('رقم العمليات')}} </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comercial_Operation as $comercial_Operation)
                            <tr class="tr_operation">
                                <td class="col-1">{{ $comercial_Operation->Emloyee_Name }}</td>
                                <td class="col-1">{{ $comercial_Operation->Currency }}</td>
                                <td class="col-2">{{ $comercial_Operation->created_at}}</td>
                                <td class="col-1">{{ $comercial_Operation->Statement }}</td>
                                <td class="col-1">{{ $comercial_Operation->Balance }}</td>
                                <td class="col-1">{{ $comercial_Operation->Creditor }}</td>
                                <td class="col-1">{{ $comercial_Operation->Debtor }}</td>
                                <td class="col-2">{{ $comercial_Operation->Client_Name }}</td>
                                <td class="col-1">{{ $comercial_Operation->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Copyright -->
        @include('master.Copyright')
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
        }else{
            e.preventDefault();
            add_name.style.border = "1px solid green";
        }
        if ((add_creditor.value == "") || (isNaN(add_creditor.value))) {
            e.preventDefault();
            add_creditor.style.border = "1px solid red";
        }else{
            e.preventDefault();
            add_creditor.style.border = "1px solid green";
        }
        if ((add_debtor.value == "") || (isNaN(add_debtor.value))) {
            e.preventDefault();
            add_debtor.style.border = "1px solid red";
        }else{
            e.preventDefault();
            add_debtor.style.border = "1px solid green";
        }
        if (add_devise.value == "") {
            e.preventDefault();
            add_devise.style.border = "1px solid red";
        }else{
            e.preventDefault();
            add_devise.style.border = "1px solid green !important";
        }
        if ((add_name.value != "") && (add_creditor.value != "") && !(isNaN(add_creditor.value)) && (add_debtor.value != "") && !(isNaN(add_debtor.value)) && (add_devise.value != "")) {
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
            td = tr[i].getElementsByTagName("td")[7];
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

@endsection
