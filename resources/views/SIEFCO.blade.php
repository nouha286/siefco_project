<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <!--  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="shortcut icon" href={{ asset('assets/image/logo.png') }}/>
    <title>SIEFCO</title>
</head>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: DejaVu Sans, sans-serif;
        font-size: 8px;
    }

    th,
    td {
        border: 1px solid #6F6F6F;
    }
</style>

<body>
    <div id="pdf">
        <div style="{{ explode("/", URL::current())[5] == "en" ? __('text-align: left;') : 'text-align: right;' }}">{{ date('j-m-y') }}</div>
        <!-- Logo -->
        <div style="width: 100%; border: 1px solid #6F6F6F; text-align: center;">
            <img src="{{ asset('assets/image/logoFacture.jpg') }}" style="width: 70px;">
            <div>{{ __('شركة صرف العملات الدولية') }} {{ date('Y') }}</div>
            <div>{{ __('رقم الهاتف') }} : 06.00.00.00.00 -- 05.00.00.00.00</div>
            <div>siefco.contact@gmail.com : {{ __('البريد الالكتروني') }}</div>
        </div>
        <div style="text-align: center;">
            <div>{{ $Client->First_Name . ' ' . $Client->Last_Name }}</div>
            <div>{{ $Client->Email }}</div>
            <div>{{ $Client->Number_phone }}</div>
        </div>
        <div style="{{ explode("/", URL::current())[5] == "en" ? __('text-align: left;') : 'text-align: right;' }}">
            <span>{{ __('العمليات التجارية') }} : {{ $comptOperation }}</span>
        </div>
        <div>
            <table class="table table-bordered" style="text-align: center;">
                <thead style="background-color: #6F6F6F;">
                    <tr>
                        <th style="width: 13%;">{{ __('المستخدم') }}</th>
                        <th style="width: 18%;">{{ __('البيان') }}</th>
                        <th style="width: 7%;">{{ __('الربح') }}</th>
                        <th style="width: 6%;">{{ __('العملة') }}</th>
                        <th style="width: 8%;">{{ __('الرصيد') }}</th>
                        <th style="width: 8%;">{{ __('مدين') }}</th>
                        <th style="width: 8%;">{{ __('دائن') }}</th>
                        <th style="width: 8%;">{{ __('المتلقي') }}</th>
                        <th style="width: 16%;">{{ __('التاريخ') }}</th>
                        <th style="width: 7%;">{{ __('رقم العمليات') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operation as $comercial_Operation)
                        @if ($comercial_Operation->Client_id == session('id_Client'))
                            <tr>
                                <td style="width: 13%;">{{ $comercial_Operation->Emloyee_Name }}</td>
                                <td style="width: 18%;">{{ $comercial_Operation->Statement }}</td>
                                <td style="width: 7%;">{{ $comercial_Operation->Benifice}}</td>
                                <td style="width: 6%;">{{ $comercial_Operation->Currency }}</td>
                                <td style="width: 8%;">{{ $comercial_Operation->Balance }}</td>
                                <td style="width: 8%;">{{ $comercial_Operation->Creditor }}</td>
                                <td style="width: 8%;">{{ $comercial_Operation->Debtor }}</td>
                                <td style="width: 8%;">{{ $comercial_Operation->receiver }}</td>
                                <td style="width: 16%;">{{ $comercial_Operation->created_at }}</td>
                                <td style="width: 7%;">{{ $comercial_Operation->id }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <span style="border: 1px solid #6F6F6F; text-align: right;">
                <div>{{ __('دائن') }} : {{ $sumDebtor }}</div>
                <div>{{ __('مدين') }} : {{ $sumCreditor }}</div>
                <div>
                    <hr>
                    <hr>
                </div>
                <div>{{ __('الرصيد') }} : {{ $sumBalance }}</div>
            </span>
            <span style="text-align: center;">
                <div>{{ __('طبعه') }} : {{ $Client->First_Name . ' ' . $Client->Last_Name }}</div>
                <div>{{ __('التاريخ') }} : {{ date('j-m-y H:i:s') }}</div>
            </span>
        </div>
    </div>
</body>

</html>
