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
    #pdf{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 10px;
    }
    body #date{
        text-align: right;
    }
</style>
<body>
    <div id="pdf">
        <div id="date">{{ date('j-m-y') }}</div>
        <!-- Logo -->
        <div id="formation" style="width: 100%; border: 2px solid #6F6F6F; border-radius: 16px;">
            {{-- <img src="{{asset('assets/logo.png')}}" style="width: 10%;" alt="logo"> --}}
            <div> {{ date('Y') }} شركة صرف العملات الدولية</div>
            <div>
                <div>{{ $Client->First_Name.' '. $Client->Last_Name }}</div>
                <div>{{ $Client->Email }}</div>
                <div>{{ $Client->Number_phone }}</div>
                <div>{{ $comptOperation }} : عدد العمليات التجارية</div>
            </div>
        </div>
        <table class="table table-bordered text-center" style="text-align: center; border-collapse: collapse;">
            <thead class="table-light">
                <tr>
                    <th style="width: 16.66%;">{{__('المستخدم')}}</th>
                    <th style="width: 25%;">{{__('البيان')}}</th>
                    <th style="width: 8.33%;">{{__('العملة')}}</th>
                    <th style="width: 8.33%;">{{__('الرصيد')}}</th>
                    <th style="width: 8.33%;">{{__('مدين')}}</th>
                    <th style="width: 8.33%;">{{__('دائن')}}</th>
                    <th style="width: 16.66%;">{{__('التاريخ')}}</th>
                    <th style="width: 8.33%;">{{__('رقم العمليات')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($operation as $comercial_Operation)
                    @if($comercial_Operation->Client_id==session('id_Client'))
                        <tr>
                            <td style="width: 16.66%;">{{ $comercial_Operation->Emloyee_Name }}</td>
                            <td style="width: 25%;">{{ $comercial_Operation->Statement }}</td>
                            <td style="width: 8.33%;">{{ $comercial_Operation->Currency }}</td>
                            <td style="width: 8.33%;">{{ $comercial_Operation->Balance }}</td>
                            <td style="width: 8.33%;">{{ $comercial_Operation->Creditor }}</td>
                            <td style="width: 8.33%;">{{ $comercial_Operation->Debtor }}</td>
                            <td style="width: 16.66%;">{{ $comercial_Operation->created_at}}</td>
                            <td style="width: 8.33%;">{{ $comercial_Operation->id }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div>
            <div>
                <div>{{__('طبعة')}} : {{ $Client->First_Name.' '. $Client->Last_Name }}</div>
                <div>{{__('الساعة')}} : {{ date("j-m-y H:i:s") }}</div>
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
