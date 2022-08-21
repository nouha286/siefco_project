@extends('master.layout')

@section('content')

    <div class="d-flex flex-column justify-content-center gap-5 py-5" style="width: 90%; margin-left: 5%;">
            <!-- Logo -->
            <div class="d-flex justify-content-around align-items-center" style="border: 2px solid var(--grey-color);">
                <p>شركة صرف العملات الدولية</p>
                <img src="{{asset('assets/logo.png')}}" style="width: 10%;" alt="logo">
            </div>
        <table class="table table-bordered mb-0 text-center">
            <thead class="table-light">
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
                @foreach($operation as $comercial_Operation)
                    @if($comercial_Operation->Client_id==session('id_Client'))
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
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
