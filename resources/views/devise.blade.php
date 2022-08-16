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
            <div class="card border-0 shadow-sm overflow-auto" style="min-height:350px; max-height:  350px; border-radius: 16px;">
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
                <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <div>
                        <select class="form-select text-center fs-5 fw-bold" id="selectDevise" style="max-width: 300px; border:none; background-color: var(--second--white-color-color);">
                            <option value="devise" selected>العملات</option>

                        </select>
                    </div>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>
                    <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle-fill h1"></i>
                    </button>

                    <!-- Modal Add Devise -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="Post" action="{{ route('add.devise') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">اظافة عملة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-4">
                                        <input type="text" name="Name" class="form-control" placeholder="*العملة" style="height: 45px;">
                                        <input type="text" name="Value" class="form-control" placeholder="*القيمة مقابل الدولار" style="height: 45px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Add Devise -->
                </div>
                <table class="table mb-0 text-center">
                    <thead>
                        <tr>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            <th class="col-5 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">القيمة مقابل الدولار</th>
                            <th class="col-5 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devise as $devise)
                            {{-- Activation --}}
                            <div id="devise">
                                <tr class="item activation">
                                    @if($devise->Activation == 1)
                                        <td class="col-2 d-flex gap-3">
                                            <form action="{{ route('delete.devise',$devise->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" style="border:none; background-color:white;" type="submit"><i class="bi bi-trash3-fill"></i> </button>
                                            </form>
                                            <button type="submit" class="btn btn-edit" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i class="bi bi-pen-fill"></i></button>
                                        </td>
                                        <td class="value_devise col-5">{{$devise->Dollar_value}}</td>
                                        <td class="name_devise col-5">{{$devise->Name}}</td>
                                        <td class="id_devise d-none">{{$devise->id}}</td>
                                    @endif
                                </tr>
                            </div>

                        @endforeach
                    </tbody>

                    <!-- Modal Edit Devise -->
                    <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="Post" action="{{ route('add.devise') }}" >
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title " id="exampleModalLabel">اظافة عملة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-4">
                                        <input type="hidden" class="id_devise" name="Id" class="form-control">
                                        <input type="text" class="name_devise" name="Name" class="form-control mb-2" placeholder="*العملة" style="height: 45px;">
                                        <input type="text" class="value_devise" name="Value" class="form-control" placeholder="*القيمة مقابل الدولار" style="height: 45px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit Devise -->
                </table>
            </div>
        </div>

        <div class="container-fluid py-4 ">
            <div class="card border-0 shadow-sm overflow-auto" style="min-height: 350px; max-height: 350px; border-radius: 16px;">
                @if (session('success_restore'))

                <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                    {{ session('success_restore') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <div>
                        <select class="form-select text-center fs-5 fw-bold" id="selectDevise" style="max-width: 300px; border:none; background-color: var(--second--white-color-color);">

                            <option value="devise_deleted">العملات المحذوفين</option>
                        </select>
                    </div>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>


                </div>
                <table class="table mb-0 text-center">
                    <thead>
                        <tr>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            <th class="col-5 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">القيمة مقابل الدولار</th>
                            <th class="col-5 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(   $devise_deleted as $devise)
                            {{-- Activation --}}
                            <div id="devise">
                                <tr class="item activation">
                                    @if($devise->Activation == 0)
                                        <td class="col-2">
                                            <form action="{{ route('delete.devise',$devise->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" style="border:none; background-color:white;" type="submit"><i class="bi bi-arrow-clockwise"></i> </button>
                                            </form>
                                             </td>
                                        <td class="value_devise col-5">{{$devise->Dollar_value}}</td>
                                        <td class="name_devise col-5">{{$devise->Name}}</td>
                                        <td class="id_devise d-none">{{$devise->id}}</td>
                                    @endif
                                </tr>
                            </div>

                        @endforeach
                    </tbody>

                    <!-- Modal Edit Devise -->
                    <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="Post" action="{{ route('add.devise') }}" >
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title " id="exampleModalLabel">اظافة عملة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-4">
                                        <input type="hidden" class="id_devise" name="Id" class="form-control">
                                        <input type="text" class="name_devise" name="Name" class="form-control mb-2" placeholder="*العملة" style="height: 45px;">
                                        <input type="text" class="value_devise" name="Value" class="form-control" placeholder="*القيمة مقابل الدولار" style="height: 45px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit Devise -->
                </table>
            </div>
        </div>

        <script>
            // Update Of Devise
            document.querySelectorAll('.btn-edit').forEach(function(btn){
                btn.addEventListener('click',function(event){
                    let select = event.target.closest('.item');
                    let id_devise = select.querySelector('.id_devise').innerHTML;
                    let name_devise = select.querySelector('.name_devise').innerHTML;
                    let value_devise = select.querySelector('.value_devise').innerHTML;

                    document.querySelector('#exampleModaledit .id_devise').value = id_devise;
                    document.querySelector('#exampleModaledit .name_devise').value = name_devise;
                    document.querySelector('#exampleModaledit .value_devise').value = value_devise;
                })
            })

            // // Switch To Active AndDesctive Of Devise
            // var selectDevise = document.getElementById('selectDevise');
            // selectDevise.addEventListener('change', (event) =>{
            //     var Activation = document.querySelector('.activation');
            //     var Desactivation = document.querySelector('.desactivation');
            //     var devise = document.querySelector('.devise');
            //     if(selectDevise.value == "devise"){
            //         Activation.classList.remove("d-none");
            //         Desactivation.classList.add("d-none");
            //     }
            //     if(selectDevise.value == "devise_deleted"){
            //         Desactivation.classList.remove("d-none");
            //         Activation.classList.add("d-none");
            //     }
            // })
        </script>

        <!-- Copyright -->
        <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo 2022</div>
    </div>
</div>
@endsection
