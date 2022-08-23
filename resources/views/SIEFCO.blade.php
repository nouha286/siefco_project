<!DOCTYPE html>
<html lang="en">

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
        box-sizing: border-box;
        overflow-x: hidden;
        font-family: DejaVu Sans, sans-serif;
        font-size: 13px;
        }
</style>

<body>
    <div style="width: 50%; display: flex; flex-direction: column; gap: 5px; padding: 0 5px;">
        <!-- Logo -->
        <div style="display: flex; justify-content: space-around; align-items: center; border: 2px solid #6F6F6F; border-radius: 16px;">
            <img class="d-none" src="{{asset('assets/logo.png')}}" style="width: 10%;" alt="logo">
            <p> {{ date('Y') }} شركة صرف العملات الدولية</p>
            <div class="text-center" style="display: flex; flex-direction: column; gap: 1px;">
                <span>{{ $Client->First_Name.' '. $Client->Last_Name }}</span>
                <samp>{{ $Client->Email }}</samp>
                <span>{{ $Client->Number_phone }}</span>
                <div><span>{{ $comptOperation }}</span> <span>:عدد العمليات التجارية</span></div>
            </div>
        </div>
        <table class="table table-bordered mb-0 text-center">
            <thead class="table-light">
                <tr>
                    <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('المستخدم')}}</th>
                    <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('البيان')}}/th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('العملة')}}</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('الرصيد')}}</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('مدين')}}</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('دائن')}}</th>
                    <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('التاريخ')}}</th>
                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('رقم العمليات')}}</th>
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
                    <span> : {{__('طبعة')}}</span>
                    <span><span>{{ $Client->First_Name.' '. $Client->Last_Name }}</span></span>
                </div>
                <div class="d-flex flex-row-reverse">
                    <span> : {{__('الساعة')}}/span>
                    <span>{{ date("j-m-y H:i:s"); }}</span>
                </div>
            </div>

            <div class="d-flex flex-row-reverse justify-content-around align-items-center" style="width: 60%; height: 60px; border: 2px solid var(--grey-color); border-radius: 16px;">
                <span> : {{__('المجموع')}} </span>

                <span>{{ $sumDebtor }}</span>
                <span>{{ $sumCreditor }}</span>
                <div class="d-flex gap-4">
                    <span>{{ $sumBalance }}</span>
                    <span> :  {{__('الرصيد')}}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
