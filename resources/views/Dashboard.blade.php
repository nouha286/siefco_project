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
            <div class="container-fluid pb-3">
                <div style="height: 8vh;"></div>
                <div class="row d-flex flex-row-reverse">
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card border-0 shadow-sm" style="min-height: 150px; border-radius: 16px;">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center p-3">
                                <h4 class="text-sm mb-0 text-uppercase font-weight-bold">{{ __('المسؤولين') }}</h4>
                                <h3 class="font-weight-bolder">{{ $Admin }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card border-0 shadow-sm" style="min-height: 150px; border-radius: 16px;">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center p-3">
                                <h4 class="text-sm mb-0 text-uppercase font-weight-bold">{{ __('المستخدمون') }}</h4>
                                <h3 class="font-weight-bolder">{{ $Employee }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card border-0 shadow-sm" style="min-height: 150px; border-radius: 16px;">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center p-3">
                                <h4 class="text-sm mb-0 text-uppercase font-weight-bold">{{ __('الزبناء') }}</h4>
                                <h3 class="font-weight-bolder">{{ $Client }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card border-0 shadow-sm" style="min-height: 150px; border-radius: 16px;">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center p-3">
                                <h4 class="text-sm mb-0 text-uppercase font-weight-bold">{{ __('العمليات التجارية') }}</h4>
                                <h3 class="font-weight-bolder">{{ $Operation_commercial }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                @if (session('failed_Activation'))
                    <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
                        {{ session('failed_Activation') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
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
                @if (session('success_Activation'))
                    <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        {{ session('success_Activation') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card border-0 shadow-sm overflow-auto"
                    style="min-height: 350px; max-height: 350px; border-radius: 16px;">
                    <div class="m-4">
                        <h4 class="float-end mb-4"> {{ __('حسابات جديدة') }}</h4>
                        <table class="table text-center" id="myTable">
                            <thead>
                                <tr>
                                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                    <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('رقم الهاتف') }}</th>
                                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('تفعيل') }}</th>
                                    <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('البريد الالكتروني') }}</th>
                                    <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('النسب') }}</th>
                                    <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('الاسم') }}</th>
                                    <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('الدور') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session('role') == 'Admin')
                                    @foreach ($Activ_Employe as $User)
                                        <tr class="item">
                                            <td class="col-1 d-flex justify-content-between align-items-center gap-2">
                                                <form action="{{ route('Activer', $User->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn" style="background-color: var(--grey-color);"
                                                        type="submit"><i class="bi bi-check2 text-white"></i></button>
                                                </form>
                                                <form action="{{ route('Supprimer', $User->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-edit"
                                                        style="background-color: var(--grey-color);" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModaledit"><i
                                                            class="bi bi-x-lg text-white"></i></button>
                                                </form>
                                            </td>
                                            <td class="col-2 Phone">{{ $User->Phone }}</td>
                                            @if ($User->email_verified_at)
                                                <td style="color:green;" class="col-1 ">{{ __('مفعل') }}</td>
                                            @endif
                                            @if (!$User->email_verified_at)
                                                <td style="color:red;" class="col-1 First_Name">{{ __('غير مفعل') }}/td>
                                            @endif
                                            <td class="col-3 email">{{ $User->email }}</td>
                                            <td class="col-2 Last_Name">{{ $User->Last_Name }}</td>
                                            <td class="col-2 First_Name">{{ $User->First_Name }}</td>
                                            <td class="col-1 First_Name">{{ $User->Role }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if (session('role') == 'Employe')
                                    @foreach ($Activ_Client as $User)
                                        <tr class="item">
                                            <td class="col-1 d-flex justify-content-between align-items-center gap-2">
                                                <form action="{{ route('Activer', $User->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn" type="submit"
                                                        style="background-color: var(--grey-color);"><i
                                                            class="bi bi-check2 text-white"></i></button>
                                                </form>
                                                <form action="{{ route('Supprimer', $User->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-edit"
                                                        style="background-color: var(--grey-color);"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i
                                                            class="bi bi-x-lg text-white"></i></button>
                                                </form>
                                            </td>
                                            <td class="col-2 Phone">{{ $User->Phone }}</td>
                                            @if ($User->email_verified_at)
                                                <td style="color:green;" class="col-2 First_Name">{{ __('مفعل') }}
                                                </td>
                                            @endif
                                            @if (!$User->email_verified_at)
                                                <td style="color:red;" class="col-1  First_Name"> {{ __('غير مفعل') }}
                                                </td>
                                            @endif
                                            <td class="col-3 email">{{ $User->email }}</td>
                                            <td class="col-2 Last_Name">{{ $User->Last_Name }}</td>
                                            <td class="col-2 First_Name">{{ $User->First_Name }}</td>
                                            <td class="col-1 First_Name">{{ $User->Role }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endsection