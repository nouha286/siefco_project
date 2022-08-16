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
      <div class="card border-0 shadow-sm overflow-auto" style="min-height: 200px; max-height: 560px; border-radius: 16px;">
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
          <h4>الزبناء</h4>
          <div class="input-group me-3" style="width: 25%;">
            <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
            <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
          </div>
          <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-circle-fill h1"></i>
          </button>

          <!-- Modal Add Client -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="Post" action="{{ route('add.Client') }}">
                  @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اظافة زبون</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body d-flex flex-column gap-4">
                    <input type="text" name="First_Name" class="form- " placeholder="*الاسم">
                    <input type="text" name="Last_Name" class="form-control " placeholder="*النسب">
                    <input type="text" name="Email" class="form-control " placeholder="*البريد الالكتروني">
                    <input type="text" name="Phone" class="form-control " placeholder="*رقم الهاتف">
                    <input type="text" name="Balance" class="form-control " placeholder="* الرصيد" style="height: 45px;">
                    <input type="text" name="Password" class="form-control " placeholder="*القن السري" style="height: 45px;">
                    <input type="text" name="Password_verif" class="form-control" placeholder="  تأكيد القن السري" style="height: 45px;">
                    <div class="search_select_box w-100">
                        <select class="selectpicker w-100" name="devise" data-live-search="true">
                            @foreach ($devise as $devise) :
                                <option value="{{ $devise->id }}">{{ $devise->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Modal Add Client -->
        </div>

        <table class="table mb-0 text-center">
          <thead>
            <tr>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
              <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البيان</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العملة</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دائن</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مدين</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الرصيد</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الهاتف</th>
              <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البريد الالكتروني</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النسب</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
            </tr>
          </thead>
          <tbody>
            @foreach($client as $client)
            @if($client->Activation==1)
            <tr class="item">
              <td class="  col-1 d-flex  gap-2">
                <form action="{{ route('delete.Client',$client->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn" style="border:none; background-color:white;" type="submit"><i class="bi  bi-trash3-fill"></i> </button>
                </form>
                <button type="submit" class="btn btn-edit" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i class="bi bi-pen-fill"></i></button>
              </td>
              <td class="col-2">{{ $client->Statement }}</td>
              <td class="col-1 Devise">{{ $client->Currency }}</td>
              <td class="col-1">{{ $client->Creditor }}</td>
              <td class="col-1">{{ $client->Debtor }}</td>
              <td class="col-1 Balance">{{ $client->Balance }}</td>
              <td class="col-1 Phone">{{ $client->Number_phone }}</td>
              <td class="col-2 Email">{{ $client->Email }}</td>
              <td class="col-1 Last_Name">{{ $client->Last_Name }}</td>
              <td class="col-1 First_Name">{{ $client->First_Name }}</td>
              <td class="col-1 id_devise d-none">{{ $client->id }}</td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>
        <!-- Modal for edit -->
        <div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="Post" action="{{ route('add.Client') }}">
                @csrf
                <div class="modal-header ">
                  <h5 class="modal-title " id="exampleModalLabel">اظافة زبون</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body  d-flex flex-column gap-4 ">
                    <input type="hidden" class="id_devise" name="Id">
                    <input type="text" class="First_Name" name="First_Name" class="form- " placeholder="*الاسم">
                    <input type="text" class="Last_Name" name="Last_Name" class="form-control " placeholder="*النسب">
                    <input type="text"class="Email" name="Email" class="form-control " placeholder="*البريد الالكتروني">
                    <input type="text" class="Phone" name="Phone" class="form-control " placeholder="*رقم الهاتف">
                    <input type="text" class="Balance" name="Balance" class="form-control " placeholder="* الرصيد" style="height: 45px;">
                    <div class="search_select_box w-100">
                        <select class="selectpicker w-100 devise" name="devise" data-live-search="true">
                            @foreach ($devise_edit as $devise) :
                            <option  value="{{ $devise->id }}">{{ $devise->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                  <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- client supprimés -->

    <div class="container-fluid py-4">
      <div class="card border-0 shadow-sm overflow-auto" style="min-height: 200px; max-height: 560px; border-radius: 16px;">
        @if (session('success_restore'))
        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
          {{ session('success_restore') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
          <h4>الزبناء المحذوفين</h4>
          <div class="input-group me-3" style="width: 25%;">
            <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
            <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
          </div>
          <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-circle-fill h1"></i>
          </button>

        </div>

        <table class="table mb-0 text-center">
          <thead>
            <tr>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
              <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البيان</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العملة</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دائن</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مدين</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الرصيد</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الهاتف</th>
              <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البريد الالكتروني</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النسب</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
            </tr>
          </thead>
          <tbody>
            @foreach($client_delete as $client)
            <tr class="item">
              @if($client->Activation==0)
              <td class="  col-1 d-flex  gap-2">
                <form action="{{ route('delete.Client',$client->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn" style="border:none; background-color:white;" type="submit"><i class="bi bi-arrow-clockwise"></i> </button>
                </form>
              </td>
              <td class="col-2">{{ $client->Statement }}</td>
              <td class="col-1 Devise">{{ $client->Currency }}</td>
              <td class="col-1">{{ $client->Creditor }}</td>
              <td class="col-1">{{ $client->Debtor }}</td>
              <td class="col-1 Balance">{{ $client->Balance }}</td>
              <td class="col-1 Phone">{{ $client->Number_phone }}</td>
              <td class="col-2 Email">{{ $client->Email }}</td>
              <td class="col-1 Last_Name">{{ $client->Last_Name }}</td>
              <td class="col-1 First_Name">{{ $client->First_Name }}</td>
              <td class="col-1 id_devise d-none">{{ $client->id }}</td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
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
                    let Balance = select.querySelector('.Balance').innerHTML;
                    let Devise = select.querySelector('.Devise').innerHTML;

                    document.querySelector('#exampleModaledit .id_devise').value = id_devise;
                    document.querySelector('#exampleModaledit .First_Name').value = First_Name;
                    document.querySelector('#exampleModaledit .Last_Name').value = Last_Name;
                    document.querySelector('#exampleModaledit .Email').value = Email;
                    document.querySelector('#exampleModaledit .Phone').value = Phone;
                    document.querySelector('#exampleModaledit .Balance').value = Balance;
                    document.querySelector('#exampleModaledit .Devise').value = Devise;
                })
            })
        </script>
    <!-- Copyright -->
    <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo 2022</div>
  </div>
</div>
@endsection
