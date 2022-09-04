@extends('master.layout')

@section('content')
<div class="position-absolute w-100" style="height: 40vh; background-color: var(--second-color);"></div>
<div class="d-flex flex-row-reverse gap-3 mx-3" style="height: 100vh;">
    <!-- AssidBar -->
    <div class="position-relative" id="assidBar">
    <aside class="d-flex flex-column align-items-center" id="assidbar" style="width: 100%; height: 93vh; margin-top: 2vh; background-color: var(--white-color); border-radius: 16px;">
        <!-- Logo -->
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/image/logo.png')}}" style="width: 38%;" alt="logo">
        </div>
        <hr class="w-75 m-0 p-0">
        <!-- Info Profile -->
        <div class="d-flex flex-column text-center justify-content-center align-items-center py-2 gap-1">
            <a href="Profile"><img class="rounded-circle" src="{{asset('assets/image/'.$User->image)}}" style="width: 60%;" alt="avatar"></a>
            <span class="fs-5 test-center" style="color:#3498DB;">  {{$User->First_Name.' '.$User->Last_Name}}</span>
            <div class="d-flex flex-column justify-content-center align-items-center py-2 gap-1">
            <span class="">@if (session()->has('role')) {{{session('role')}}}@endif</span>
            <hr class="w-100 m-0 p-0">
        </div>
        <div>
            <ul class="navbar-nav d-flex flex-column justify-content-center align-items-center my-2 gap-2">
                <li class="nav-item text-center {{ basename(URL::current()) == 'Profile' ? 'active' : '' }}">
                    <a class="nav-link" href=" {{ route('Profile')}}">
                        <span class="{{ basename(URL::current()) == 'Profile' ? 'text-light' : 'text-dark' }}"> {{__('الملف الشخصي')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'Dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('Dashboard')}}">
                        <span class="{{ basename(URL::current()) == 'Dashboard' ? 'text-light' : 'text-dark' }}"> {{__('لوحة التحكم')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'operation_commercial' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('operation_commercial')}}">
                        <span class="{{ basename(URL::current()) == 'operation_commercial' ? 'text-light' : 'text-dark' }}">{{__('العمليات التجارية')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'Employees' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('Employees')}}">
                        <span class="{{ basename(URL::current()) == 'Employees' ? 'text-light' : 'text-dark' }}">{{__('المستخدمون')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'client' ? 'active' : '' }}">
                    <a class="nav-link" href=" {{ route('client')}}">
                        <span class="{{ basename(URL::current()) == 'client' ? 'text-light' : 'text-dark' }}">{{__('الزبناء')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'devise' ? 'active' : '' }}">
                    <a class="nav-link" href=" {{ route('devise')}}">
                        <span class="{{ basename(URL::current()) == 'devise' ? 'text-light' : 'text-dark' }}">{{__('العملات')}}</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Logout -->
        <hr class="w-75 m-0 p-0">
        <div>
            <a class="nav-link" href=" {{ route('logout')}}"><span class="text-dark"> {{__('تسجيل الخروج') }}</span></a>
        </div>
    </aside>
    <!-- Copyright -->
    <div class="text-center mt-2 h6">Copyright &copy; SIEFCO {{ date('Y') }}</div>
</div>

<style>
    body .active{
        background-color: var(--second-color);
        border-radius: 50px 0 0 50px;
        width: 226px;
        padding: 6px 0px;
    }
</style>

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
                <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <h4>{{__('عملياتي التجارية')}}</h4>
                    <a href="{{route('generatePDF')}}">
                        <button class="px-5 py-2 fw-bold" type="button" style="background-color: var(--base-color); border: 0px; border-radius: 16px;">
                            <i class="bi bi-file-earmark-arrow-down-fill"></i> {{__('تحميل') }}
                        </button>
                    </a>
                </div>
                <table class="table mb-0 text-center">
                    <thead>
                        <tr>
                            
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('المستخدم')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('العملة')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('التاريخ')}}</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('البيان')}}</th>
                      
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('الرصيد')}}</th>

                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('مدين')}}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('دائن')}}</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('المتلقي') }}</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('المرسل/اسم الزبون') }}</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('رقم العمليات')}}</th>
                         </tr>
                    </thead>
                    <tbody>
                        @foreach($operation as $comercial_Operation)
                           
                                <tr>
                                    <td class="col-1">{{ $comercial_Operation->Emloyee_Name }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Currency }}</td>
                                    <td class="col-2">{{ $comercial_Operation->created_at}}</td>
                                    <td class="col-2">{{ $comercial_Operation->Statement }}</td>
                                   
                                    <td class="col-1">{{ $comercial_Operation->Balance }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Creditor }}</td>
                                    <td class="col-1">{{ $comercial_Operation->Debtor }}</td>
                                    <td class="col-2">{{ $comercial_Operation->receiver }}</td>
                                    <td class="col-2">{{ $comercial_Operation->Client_Name }}</td>
                                    <td class="col-1">{{ $comercial_Operation->id }}</td>
                                </tr>
                          
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo {{ date('Y') }}</div>
    </div>
</div>
@endsection
