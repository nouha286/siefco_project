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
        <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
          <h4>الزبناء</h4>
          <div class="input-group me-3" style="width: 25%;">
            <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
            <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
          </div>
         <button type="button" class="btn btn-primary" style="background-color:white; color:black; border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle-fill h1"></i>
                    </button>

                    <!-- Modal -->
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
                                    <input type="text" name="First_Name" class="form- " placeholder="*الاسم">
                                        <input type="text" name="Last_Name" class="form-control " placeholder="*النسب">
                                        <input type="email" name="Email" class="form-control " placeholder="*البريد الالكتروني">
                                        <input type="text" name="Phone" class="form-control " placeholder="*رقم الهاتف">
                                        <input type="text" name="Password" class="form-control " placeholder="*القن السري" style="height: 45px;">
                                        <input type="text" name="Password" class="form-control " placeholder="* الرصيد" style="height: 45px;">
                                        <input type="text" name="Name" class="form-control" placeholder="*العملة" style="height: 45px;">
                                        
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
        <table class="table mb-0 text-center">
          <thead>
            <tr>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
              <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البيان</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العملة</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دائن</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مدين</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الرصيد</th>
              <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البريد الالكتروني</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النسب</th>
              <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
            </tr>
          </thead>
          <tbody>
            @foreach($client as $client)
              <tr>
                <td class="col-1">
                  <a class="text-dark me-1" href=""><i class="bi bi-pen-fill"></i></a>
                  <a class="text-dark ms-1" href=""><i class="bi bi-trash3-fill"></i></a>
                </td>
                <td class="col-2">{{ $client->Statement }}</td>
                <td class="col-1">{{ $client->Currency }}</td>
                <td class="col-1">{{ $client->Creditor }}</td>
                <td class="col-1">{{ $client->Debtor }}</td>
                <td class="col-1">{{ $client->Blance }}</td>
                <td class="col-2">{{ $client->Email }}</td>
                <td class="col-1">{{ $client->Last_Name }}</td>
                <td class="col-1">{{ $client->First_Name }}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Copyright -->
    <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo 2022</div>
  </div>
</div>
@endsection
