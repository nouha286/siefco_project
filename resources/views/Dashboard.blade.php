@extends('master.layout')

@section('content')
<div class="position-absolute w-100" style="height: 40vh; background-color: var(--second-color);"></div>
<div class="d-flex flex-row-reverse gap-3 mx-3" style="height: 100vh;">
    <!-- AssidBar -->
    @include('master.AssidBar');

    <div class="position-relative w-100">
        <!-- Navbar -->
        @include('master.Navbar');

        <!-- Statistiques -->
        <div class="container-fluid py-4">
            <div style="height: 8vh;"></div>
            <div class="row d-flex flex-row-reverse">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card border-0 shadow-sm" style="min-height: 150px; border-radius: 16px;">
                        <div class="card-body d-flex flex-column justify-content-between align-items-center p-3">
                            <h4 class="text-sm mb-0 text-uppercase font-weight-bold">المسؤولين</h4>
                            <h3 class="font-weight-bolder">{{ $Admin }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card border-0 shadow-sm" style="min-height: 150px; border-radius: 16px;">
                        <div class="card-body d-flex flex-column justify-content-between align-items-center p-3">
                            <h4 class="text-sm mb-0 text-uppercase font-weight-bold">المستخدمون</h4>
                            <h3 class="font-weight-bolder">{{ $Employee }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card border-0 shadow-sm" style="min-height: 150px; border-radius: 16px;">
                        <div class="card-body d-flex flex-column justify-content-between align-items-center p-3">
                            <h4 class="text-sm mb-0 text-uppercase font-weight-bold">الزبناء</h4>
                            <h3 class="font-weight-bolder">{{ $Client }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card border-0 shadow-sm" style="min-height: 150px; border-radius: 16px;">
                        <div class="card-body d-flex flex-column justify-content-between align-items-center p-3">
                            <h4 class="text-sm mb-0 text-uppercase font-weight-bold">العمليات التجارية</h4>
                            <h3 class="font-weight-bolder">{{ $Operation_commercial }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo 2022</div>
    </div>
</div>
@endsection
