<div class="col-2 position-relative" id="assidBar">
    <aside class="d-flex flex-column align-items-center" id="assidbar" style="width: 100%; height: 95vh; margin-top: 2.5vh; background-color: var(--white-color); border-radius: 16px;">
        <!-- Logo -->
        <div class="d-flex justify-content-center align-items-center">
            <img src="../resources/views/Asset/logo.png" style="width: 38%;" alt="logo">
        </div>
        <hr class="w-75 m-0 p-0">
        <!-- Info Profile -->
        <div class="d-flex flex-column justify-content-center align-items-center py-2 gap-1">
            <img src="../resources/views/Asset/avatar.png" style="width: 65%;" alt="logo">
            <span class="fs-5" style="color:#3498DB;">  @if (session()->has('name')) {{{session('name')}}}@endif </span>
            <span class="">@if (session()->has('role')) {{{session('role')}}}@endif</span>
        </div>
        <hr class="w-75 m-0 p-0">
        <!-- Pages -->
        <div>
            <ul class="navbar-nav d-flex flex-column justify-content-center align-items-center my-3 gap-3">
                <li class="nav-item">
                    <a class="nav-link" href="Dashboard">
                        <span class="text-dark">لوحة التحكم</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="operation_commercial">
                        <span class="text-dark">العمليات التجارية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Administrateur">
                        <span class="text-dark">المسؤولين</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Employees">
                        <span class="text-dark">المستخدمون</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="client">
                        <span class="text-dark">الزبناء</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="devise">
                        <span class="text-dark">العملات</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Logout -->
        <hr class="w-75 m-0 p-0">
        <div>
            <a class="nav-link" href="logout">
                <span class="text-dark">تسجيل الخروج</span>
            </a>
        </div>
    </aside>
</div>