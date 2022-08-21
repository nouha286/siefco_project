@extends('master.layout')

@section('content')

    <div class="d-flex flex-column justify-content-center gap-5 py-5" style="width: 90%; margin-left: 5%;">
        <!-- Logo -->
        <div class="d-flex justify-content-around align-items-center" style="border: 2px solid var(--grey-color); border-radius: 16px;">
            <img src="{{asset('assets/logo.png')}}" style="width: 10%;" alt="logo">
            <p> {{ date('Y') }} شركة صرف العملات الدولية</p>
            <div class="d-flex flex-column text-center gap-1">
                <span>{{ $Client->First_Name.' '. $Client->Last_Name }}</span>
                <samp>{{ $Client->Email }}</samp>
                <span>{{ $Client->Number_phone }}</span>
                <div><span>{{ $comptOperation }}</span> <span>:عدد العمليات التجارية</span></div>
            </div>
        </div>
        <table class="table table-bordered mb-0 text-center">
            <thead class="table-light">
                <tr>
                    <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المستخدم</th>
                    <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البيان</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العملة</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الرصيد</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مدين</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دائن</th>
                    <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التاريخ</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($operation as $comercial_Operation)
                    @if($comercial_Operation->Client_id==session('id_Client'))
                        <tr>
                            <td class="col-2">{{ $comercial_Operation->Emloyee_Name }}</td>
                            <td class="col-3">{{ $comercial_Operation->Statement }}</td>
                            <td class="col-1">{{ $comercial_Operation->Currency }}</td>
                            <td class="col-1">{{ $comercial_Operation->Balance }}</td>
                            <td class="col-1">{{ $comercial_Operation->Creditor }}</td>
                            <td class="col-1">{{ $comercial_Operation->Debtor }}</td>
                            <td class="col-2">{{ $comercial_Operation->created_at}}</td>
                            <td class="col-1">{{ $comercial_Operation->id }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="d-flex gap-5">
            <div class="d-flex flex-column" style="width: 40%;">
                <div class="d-flex flex-row-reverse">
                    <span> : طبعة</span>
                    <span><span>{{ $Client->First_Name.' '. $Client->Last_Name }}</span></span>
                </div>
                <div class="d-flex flex-row-reverse">
                    <span> : الساعة</span>
                    <span>{{ date("j-m-y H:i:s"); }}</span>
                </div>
            </div>
            <div class="d-flex flex-row-reverse justify-content-around align-items-center" style="width: 60%; height: 60px; border: 2px solid var(--grey-color); border-radius: 16px;">
                <span> : المجموع </span>
                <span>{{ $sumDebtor }}</span>
                <span>{{ $sumCreditor }}</span>
                <div class="d-flex gap-4">
                    <span>{{ $sumBalance }}</span>
                    <span> : الرصيد</span>
                </div>
            </div>
        </div>
    </div>
@endsection
