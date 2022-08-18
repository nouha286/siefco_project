<div class="position-relative" id="assidBar">
    <aside class="d-flex flex-column align-items-center" id="assidbar" style="width: 100%; height: 95vh; margin-top: 2.5vh; background-color: var(--white-color); border-radius: 16px;">
        <!-- Logo -->
        <div class="d-flex justify-content-center align-items-center">

            <img src="{{asset('assets/logo.png')}}" style="width: 38%;" alt="logo">
        </div>
        <hr class="w-75 m-0 p-0">
        <!-- Info Profile -->
        <div class="d-flex flex-column text-center justify-content-center align-items-center py-2 gap-1">
            <a href="Profile" class=""><img class="rounded-circle" src="{{asset('assets/'.$User->image)}}" style="width: 65%;" alt="avatar"></a>
            
            <span class="fs-5 test-center" style="color:#3498DB;">  {{$User->First_Name.' '.$User->Last_Name}}</span>
            <div class="d-flex flex-column justify-content-center align-items-center py-2 gap-1">
            
            <hr class="w-75 m-0 p-0"> 

            <span class="">@if (session()->has('role')) {{{session('role')}}}@endif</span>
        </div>

       
       
        <div>
            <ul class="navbar-nav d-flex flex-column justify-content-center align-items-center my-2 gap-3">
                <li class="nav-item text-center {{ basename(URL::current()) == 'Dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="Dashboard">
                        <span class="{{ basename(URL::current()) == 'Dashboard' ? 'text-light' : 'text-dark' }}">لوحة التحكم</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'operation_commercial' ? 'active' : '' }}">
                    <a class="nav-link" href="operation_commercial">
                        <span class="{{ basename(URL::current()) == 'operation_commercial' ? 'text-light' : 'text-dark' }}">العمليات التجارية</span>
                    </a>
                </li>

                <li class="nav-item text-center {{ basename(URL::current()) == 'Employees' ? 'active' : '' }}">
                    <a class="nav-link" href="Employees">
                        <span class="{{ basename(URL::current()) == 'Employees' ? 'text-light' : 'text-dark' }}">المستخدمون</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'client' ? 'active' : '' }}">
                    <a class="nav-link" href="client">
                        <span class="{{ basename(URL::current()) == 'client' ? 'text-light' : 'text-dark' }}">الزبناء</span>
                    </a>
                </li>
                <li class="nav-item text-center {{ basename(URL::current()) == 'devise' ? 'active' : '' }}">
                    <a class="nav-link" href="devise">
                        <span class="{{ basename(URL::current()) == 'devise' ? 'text-light' : 'text-dark' }}">العملات</span>
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

<style>
    body .active{
        background-color: var(--second-color);
        border-radius: 50px 0 0 50px;
        width: 226px;
        padding: 6px 0px;
    }
</style>
