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

        <div class="container-fluid py-4">
            <div class="card border-0 shadow-sm overflow-auto" style="min-height: 350px; max-height: 350px; border-radius: 16px;">
            @if (session('failed_Activation'))
                <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
                    {{ session('failed_Activation') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <div>

                    </div>


                <table class="table mb-0 text-center" id="myTable">
                    <thead>
                        <tr>
                        <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الهاتف</th>
                            <th class="col-4 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البريد الالكتروني</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النسب</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الدور</th>
                            <th>verification</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(session('role')=='Admin')
                        @foreach($Activ_Employe as $User)


                        <tr class="item">

                            <td class="  col-1 d-flex gap-2">
                                <form action="{{route('Activer',$User->id)}}" method="post">
                                    @csrf

                                    <button class="btn bg-success" style="border:none; color:white; background-color:white;" type="submit">Activer </button>
                                </form>
                                <form action="{{route('Supprimer',$User->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-danger btn-edit" style="background-color:white; color:white; border:noifne;" data-bs-toggle="modal" data-bs-target="#exampleModaledit">Supprimer</button>
                                </form>


                            </td>


                            <td class="Phone col-3 ">{{$User->Phone}}</td>
                            <td class="email col-4 ">{{$User->email}}</td>
                            <td class="Last_Name col-2 ">{{$User->Last_Name}}</td>
                            <td class="First_Name col-2 First_Name">{{$User->First_Name}}</td>
                            <td class="First_Name col-2 First_Name">{{$User->Role}}</td>
                            @if ($User->email_verified_at)
                            <td style="color:green;" class="First_Name col-2 First_Name">vérifié</td>
                            @endif
                            @if (!$User->email_verified_at)
                            <td style="color:red;" class="First_Name col-2 First_Name">non vérifié</td>
                            @endif




                        </tr>

                        @endforeach
                       @endif


                       @if(session('role')=='Employe')
                        @foreach($Activ_Client as $User)


                        <tr class="item">

                            <td class="  col-1 d-flex gap-2">
                                <form action="{{route('Activer',$User->id)}}" method="post">
                                    @csrf

                                    <button class="btn bg-success" style="border:none; color:white; background-color:white;" type="submit">Activer </button>
                                </form>
                                <form action="{{route('Supprimer',$User->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-danger btn-edit" style="background-color:white; color:white; border:noifne;" data-bs-toggle="modal" data-bs-target="#exampleModaledit">Supprimer</button>
                                </form>


                            </td>


                            <td class="Phone col-3 ">{{$User->Phone}}</td>
                            <td class="email col-4 ">{{$User->email}}</td>
                            <td class="Last_Name col-2 ">{{$User->Last_Name}}</td>
                            <td class="First_Name col-2 First_Name">{{$User->First_Name}}</td>
                            <td class="First_Name col-2 First_Name">{{$User->Role}}</td>
                            @if ($User->email_verified_at)
                            <td style="color:green;" class="First_Name col-2 First_Name">vérifié</td>
                            @endif
                            @if (!$User->email_verified_at)
                            <td style="color:red;" class="First_Name col-2 First_Name">non vérifié</td>
                            @endif




                        </tr>

                        @endforeach
                       @endif
                    </tbody>




        <!-- Copyright -->
        <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo 2022</div>
    </div>
</div>
@endsection
