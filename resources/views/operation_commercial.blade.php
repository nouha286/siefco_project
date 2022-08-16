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
                <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <h4>العمليات التجارية</h4>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>

                    <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle-fill h1"></i>
                    </button>

                    <!-- Modal Add Client -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="Post" action="{{ route('add.Operation') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">اظافة عملة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-4">
                                        <div class="search_select_box w-100">
                                            <select class="selectpicker w-100" name="Client_id" data-live-search="true">
                                                @foreach ($client as $client):
                                                    <option value="{{ $client->id }}">{{ $client->First_Name }} {{ $client->Last_Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" name="Creditor" class="form-control " placeholder="مدين">
                                        <input type="text" name="Debtor" class="form-control " placeholder="* دائن">
                                      <div class="search_select_box w-100">
                                            <select class="selectpicker w-100" name="devise" data-live-search="true">
                                                @foreach ($devise as $devise) :
                                                    <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Add Client -->

                </div>
                <table class="table mb-0 text-center">
                    <thead>
                        <tr>

                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المستخدم</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العملة</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التاريخ</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البيان</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الرصيد</th>

                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مدين</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دائن</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اسم الزبون</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comercial_Operation as $comercial_Operation)
                            <tr>

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
        <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo 2022</div>
    </div>
</div>
@endsection
