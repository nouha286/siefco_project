<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <!--  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="shortcut icon" href="http://localhost/siefco_project/public/assets/logo.png"/>
    <title>SIEFCO</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: DejaVu Sans, sans-serif;
        font-size: 13px;
    }
</style>
<body>
    <div class="d-flex gap-5">
        <div style="text-align: right">{{ date('j-m-y') }}</div>
        <!-- Logo -->
        <div style="border: 2px solid #6F6F6F; border-radius: 16px;">
            {{-- <img class="d-none" src="{{asset('assets/logo.png')}}" style="width: 10%;" alt="logo"> --}}
            <div style="text-align: left"> {{ date('Y') }} شركة صرف العملات الدولية</div>
            <div style="text-align: right">
                <span>{{ $Client->First_Name.' '. $Client->Last_Name }}</span>
                <span>{{ $Client->Email }}</span>
                <span>{{ $Client->Number_phone }}</span>
                <span>{{ $comptOperation }} : عدد العمليات التجارية</span>
            </div>
        </div>
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th class="col-2">{{__('المستخدم')}}</th>
                    <th class="col-3">{{__('البيان')}}</th>
                    <th class="col-1">{{__('العملة')}}</th>
                    <th class="col-1">{{__('الرصيد')}}</th>
                    <th class="col-1">{{__('مدين')}}</th>
                    <th class="col-1">{{__('دائن')}}</th>
                    <th class="col-2">{{__('التاريخ')}}</th>
                    <th class="col-1">{{__('رقم العمليات')}}</th>
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
        <div>
            <div>
                <div>
                    {{__('طبعة')}} : {{ $Client->First_Name.' '. $Client->Last_Name }}
                </div>
                <div>
                    {{__('الساعة')}} : {{ date("j-m-y H:i:s") }}
                </div>
            </div>
            <div style="width: 50%; border: 2px solid #6F6F6F; border-radius: 16px;">
                <span>{{__('المجموع')}} : </span>
                <span>{{ $sumDebtor }}</span>
                <span>{{ $sumCreditor }}</span>
                <span>{{__('الرصيد')}} : {{ $sumBalance }}</span>
            </div>
        </div>
    </div>
</body>
</html>
