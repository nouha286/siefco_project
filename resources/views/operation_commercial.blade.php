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
            <div class="card border-0 shadow-sm overflow-auto" style="min-height: 200px; max-height: 560px; border-radius: 16px;">
                <div class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
                    <h4>العمليات التجارية</h4>
                    <div class="input-group me-3" style="width: 25%;">
                        <input type="text" class="form-control" placeholder="الاسم" style="height: 45px;">
                        <span class="input-group-text" style="border-radius: 0px 16px 16px 0px;"><i class="bi bi-search"></i></span>
                    </div>
                    <i class="bi bi-plus-circle-fill h1"></i>
                </div>
                <table class="table mb-0 text-center">
                    <thead>
                        <tr>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المستخدم</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العملة</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التاريخ</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">البيان</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الرصيد</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دائن</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مدين</th>
                            <th class="col-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اسم الزبون</th>
                            <th class="col-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < 8; $i++) : ?>
                            <tr>
                                <td class="col-2"><?php echo "ابت"; ?></td>
                                <td class="col-1"><?php echo "ابت"; ?></td>
                                <td class="col-1"><?php echo "ابت"; ?></td>
                                <td class="col-2"><?php echo "ابت"; ?></td>
                                <td class="col-1"><?php echo "ابت"; ?></td>
                                <td class="col-1"><?php echo "ابت"; ?></td>
                                <td class="col-1"><?php echo "ابت"; ?></td>
                                <td class="col-2"><?php echo "ابت"; ?></td>
                                <td class="col-1"><?php echo "ابت"; ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Copyright -->
        <div class="position-fixed bottom-0 start-50 text-center h6">Copyright &copy; SayfCo 2022</div>
    </div>
</div>
@endsection