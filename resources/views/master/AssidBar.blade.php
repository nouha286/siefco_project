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
                <li class="nav-item text-center {{ basename(URL::current()) == 'Profile' ? 'active_assidBar' : '' }}">
                    <a class="nav-link" href="Profile">
                        <span class="{{ basename(URL::current()) == 'Profile' ? 'text-light' : 'text-dark' }}"> {{__('الملف الشخصي')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'Dashboard' ? 'active_assidBar' : '' }}">
                    <a class="nav-link" href="Dashboard">
                        <span class="{{ basename(URL::current()) == 'Dashboard' ? 'text-light' : 'text-dark' }}"> {{__('لوحة التحكم')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'operation_commercial' ? 'active_assidBar' : '' }}">
                    <a class="nav-link" href="operation_commercial">
                        <span class="{{ basename(URL::current()) == 'operation_commercial' ? 'text-light' : 'text-dark' }}">{{__('العمليات التجارية')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'Employees' ? 'active_assidBar' : '' }}">
                    <a class="nav-link" href="Employees">
                        <span class="{{ basename(URL::current()) == 'Employees' ? 'text-light' : 'text-dark' }}">{{__('المستخدمون')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'client' ? 'active_assidBar' : '' }}">
                    <a class="nav-link" href="client">
                        <span class="{{ basename(URL::current()) == 'client' ? 'text-light' : 'text-dark' }}">{{__('الزبناء')}}</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'devise' ? 'active_assidBar' : '' }}">
                    <a class="nav-link" href="devise">
                        <span class="{{ basename(URL::current()) == 'devise' ? 'text-light' : 'text-dark' }}">{{__('العملات')}}</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Logout -->
        <hr class="w-75 m-0 p-0">
        <div>
            <a class="nav-link" href="logout"><span class="text-dark"> {{__('تسجيل الخروج') }}</span></a>
        </div>
    </aside>
    <!-- Copyright -->
    <div class="text-center mt-2 h6">Copyright &copy; SIEFCO {{ date('Y') }}</div>
</div>

<style>
    body .active_assidBar{
        background-color: var(--second-color);
        border-radius: 50px 0 0 50px;
        width: 226px;
        padding: 6px 0px;
    }
</style>
