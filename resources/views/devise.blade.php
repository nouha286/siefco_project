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
       
        @if (session('success_restore'))
        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
          {{ session('success_restore') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

   
                <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <div>
                        <select class="form-select text-center fs-5 fw-bold" id="input_select" onchange="selectDevise()" style="max-width: 300px; border:none; background-color: var(--second--white-color-color);">
                            <option value="1" selected>{{__('العملات')}}</option>
                            <option value="0">{{__('العملات المحذوفين')}} </option>
                        </select>
                    </div>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" class="form-control" id="input_search" onkeyup="searchDevise()" placeholder="{{__('الاسم') }}" style="height: 45px;">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>
                    <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle-fill h1"></i>
                    </button>

                    <!-- Modal Add Devise -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="Post" action="{{ route('add.devise',app()->getLocale() ) }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> {{__('اظافة عملة')}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-4">
                                        <input type="text" name="Name" class="form-control" placeholder="*{{__('العملة')}}" style="height: 45px;">
                                        <input type="text" name="Value" class="form-control" placeholder="* {{__('القيمة مقابل الدولار') }}" style="height: 45px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('اغلاق')}}</button>
                                        <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Add Devise -->
                </div>
                <table class="table mb-0 text-center" id="table_devise">
                    <thead>
                        <tr>
                            <th class="col-2"></th>
                            <th class="d-none"></th>
                            <th class="col-5 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  {{__('القيمة مقابل الدولار') }}</th>
                            <th class="col-5 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('اسم العملة') }}</th>
                            <th class="d-none"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devise as $devise)
                            <tr class="item tr_devise">
                                <td class="col-2 d-flex justify-content-between align-items-center gap-3">
                                    @if ($devise->Activation == 1)
                                        <form action="{{ route('delete.devise',[$devise->id, app()->getLocale() ]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn" style="background-color:var(--grey-color); border:none;" type="submit"><i class="bi bi-trash3-fill text-white"></i> </button>
                                        </form>
                                        <button type="submit" class="btn btn-edit" style="background-color:var(--grey-color); border:none;" data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i class="bi bi-pen-fill text-white"></i></button>
                                    @endif
                                    @if ($devise->Activation == 0)
                                        <form action="{{ route('delete.devise',[$devise->id,app()->getLocale() ]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn" style="background-color:var(--grey-color); border:none;" type="submit"><i class="bi bi-arrow-clockwise text-white"></i> </button>
                                        </form>
                                    @endif
                                </td>
                                <td class="value_devise col-5">{{$devise->Dollar_value}}</td>
                                <td class="d-none">{{$devise->Activation}}</td>
                                <td class="name_devise col-5">{{$devise->Name}}</td>
                                <td class="id_devise d-none">{{$devise->id}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

     

        <!-- Modal Edit Devise -->
        <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="Post" action="{{ route('add.devise',app()->getLocale() ) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title " id="exampleModalLabel"> {{__('اظافة عملة')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column gap-4">
                            <input type="hidden" class="id_devise" name="Id"  class="form-control">
                            <input type="text" class="name_devise" name="Name" class="form-control mb-2" placeholder="*{{__('العملة') }}" style="height: 45px;">
                            <input type="text" class="value_devise" name="Value" class="form-control" placeholder="*{{__('القيمة مقابل الدولار') }}" style="height: 45px;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('اغلاق')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Edit Devise -->

        <script>
            // Search Devise
            function searchDevise() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("input_search");
                filter = input.value.toUpperCase();
                table = document.getElementById("table_devise");
                tr = table.querySelectorAll('.tr_devise');
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[3];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
                if(filter == ''){
                    selectEmploye();
                }
            }
            // Select Devise
            selectDevise();
            function selectDevise() {
                var input_select, table_employe, tr, td, i, txtValue;
                input_select = document.getElementById("input_select");
                filter = input_select.value;
                table_employe = document.getElementById("table_devise");
                tr = table_employe.querySelectorAll('.tr_devise');
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[2];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
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
        </script>


    </div>
</div>
@endsection
