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
            <div class="card  border-0 shadow-sm overflow-auto" style="min-height: 350px; max-height: 350px; border-radius: 16px;">
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
                @if (session('failed_delete'))
                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    {{ session('failed_delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class=" d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <h4>المسؤولين</h4>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>
                    @if(session('role')=='Admin')
                    <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle-fill h1"></i>
                    </button>
                  @endif
                    <!-- Modal Add Admin -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="Post" action="{{route('add.Admin')}}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">اظافة مسؤول</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-4">
                                        <input type="text" name="First_Name" class="form-control" placeholder="*الاسم">
                                        <input type="text" name="Last_Name" class="form-control" placeholder="*النسب">
                                        <input type="text" name="Email" class="form-control" placeholder="*البريد الالكتروني">
                                        <input type="text" name="Phone" class="form-control" placeholder="*رقم الهاتف">
                                        <input type="text" name="Password" class="form-control" placeholder="*القن السري">
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Add Admin -->

                </div>
                <table class="table  mb-0 text-center">
                    <thead>
                        <tr>
                        @if(session('role')=='Admin') <th></th>@endif
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الهاتف</th>
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البريد الالكتروني</th>
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النسب</th>
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Admin as $Admin)
                        @if($Admin->Activation==1)
                        <tr class="mx-2 item">
                        @if(session('role')=='Admin')
                            <td class="col-1 d-flex  gap-3">
                                <form action="{{ route('delete.Admin',$Admin->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" style="border:none; background-color:white;" type="submit"><i class="bi  bi-trash3-fill"></i> </button>
                                </form>
                                <button type="submit" class="btn btn-edit" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i class="bi bi-pen-fill"></i></button>

                            </td>
                            @endif
                            <td class="Phone col-3">{{$Admin->Number_phone}}</td>
                            <td class="Email col-4">{{$Admin->Email}}</td>
                            <td class="Last_Name col-2">{{$Admin->Last_Name}}</td>
                            <td class="First_Name col-2">{{$Admin->First_Name}}</td>
                            <td class="id_devise col-2 d-none  ">{{$Admin->id}}</td>
                        </tr>
                        @endif
                        @endforeach

                        <!-- Modal Edit Admin -->
                        <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="Post" action="{{ route('add.Admin') }}">
                                        @csrf
                                        <div class="modal-header ">
                                            <h5 class="modal-title " id="exampleModalLabel">اظافة عملة</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-4">
                                            <input type="hidden" class="id_devise" name="Id" >
                                            <input type="text" class="First_Name" name="First_Name" class="form- mb-3" placeholder="*الاسم">
                                            <input type="text" class="Last_Name" name="Last_Name" class="form-control mb-3" placeholder="*النسب">
                                            <input type="text" class="Email" name="Email" class="form-control mb-3" placeholder="*البريد الالكتروني">
                                            <input type="text" class="Phone" name="Phone" class="form-control mb-3" placeholder="*رقم الهاتف">
                                            <input type="hidden" name="edit_add" class="form-control" value="2">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                            <button type="submit" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit Admin -->
                    </tbody>
                </table>
            </div>
        </div>

        @if(session('role')=='Admin')
        <!-- Admin Supprimé -->
        <div class="container-fluid py-4">
            <div class="card  border-0 shadow-sm overflow-auto" style="min-height: 350px; max-height: 350px; border-radius: 16px;">
                @if (session('success_restore'))
                <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                    {{ session('success_restore') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('failed_delete'))
                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    {{ session('failed_delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class=" d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <h4>المسؤولين</h4>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>
                </div>
                <table class="table  mb-0 text-center">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الهاتف</th>
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البريد الالكتروني</th>
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النسب</th>
                            <th class="col-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Admin_deleted as $Admin)
                        @if($Admin->Activation==0)
                        <tr class="mx-2">
                            <td class="col-1 ">
                                <form action="{{ route('delete.Admin',$Admin->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" style="border:none; background-color:white;" type="submit"><i class="bi bi-arrow-clockwise"></i> </button>
                                </form>
                            </td>
                            <td class="col-3">{{$Admin->Number_phone}}</td>
                            <td class="col-4">{{$Admin->Email}}</td>
                            <td class="col-2">{{$Admin->Last_Name}}</td>
                            <td class="col-2">{{$Admin->First_Name}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <script>
            // Update Of Devise
            document.querySelectorAll('.btn-edit').forEach(function(btn){
                btn.addEventListener('click',function(event){
                    let select = event.target.closest('.item');
                    let id_devise = select.querySelector('.id_devise').innerHTML;
                    let First_Name = select.querySelector('.First_Name').innerHTML;
                    let Last_Name = select.querySelector('.Last_Name').innerHTML;
                    let Email = select.querySelector('.Email').innerHTML;
                    let Phone = select.querySelector('.Phone').innerHTML;

                    document.querySelector('#exampleModaledit .id_devise').value = id_devise;
                    document.querySelector('#exampleModaledit .First_Name').value = First_Name;
                    document.querySelector('#exampleModaledit .Last_Name').value = Last_Name;
                    document.querySelector('#exampleModaledit .Email').value = Email;
                    document.querySelector('#exampleModaledit .Phone').value = Phone;
                })
            })
        </script>
        <!-- Copyright -->
        <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo 2022</div>
    </div>
</div>
@endsection
