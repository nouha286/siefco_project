@extends('master.layout')

@section('content')
    <div class="position-absolute w-100" style="height: 40vh; background-color: var(--second-color);"></div>
    <div class="d-flex flex-row-reverse gap-3 mx-3" style="height: 100vh;">
        <!-- AssidBar Client -->
        @include('master.AssidBar_client')

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
                    <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                        <h4>{{ __('عملياتي التجارية') }}</h4>
                        <a href="generatePDF">
                            <button class="px-5 py-2 fw-bold" type="button"
                                style="background-color: var(--base-color); border: 0px; border-radius: 16px;">
                                <i class="bi bi-file-earmark-arrow-down-fill"></i> {{ __('تحميل') }}
                            </button>
                        </a>
                    </div>
                    <table class="table mb-0 text-center">
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
                                    {{ __('الرصيد') }}</th>

                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('مدين') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('دائن') }}</th>
                                <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('اسم الزبون') }}</th>
                                <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('رقم العمليات') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($operation as $comercial_Operation)
                                @if ($comercial_Operation->Client_id == session('id_Client'))
                                    <tr>
                                        <td class="col-1">{{ $comercial_Operation->Emloyee_Name }}</td>
                                        <td class="col-1">{{ $comercial_Operation->Currency }}</td>
                                        <td class="col-2">{{ $comercial_Operation->created_at }}</td>
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
            </div>
        </div>
    </div>
@endsection
