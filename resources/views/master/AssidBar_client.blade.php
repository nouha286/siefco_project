<div class="col-3 position-relative" id="assidBar">
    <aside class="d-flex flex-column align-items-center" id="assidbar" style="width: 100%; height: 93vh; margin-top: 2vh; background-color: var(--white-color); border-radius: 16px;">
        <!-- Logo -->
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ asset('assets/image/logo.png') }}" style="width: 38%;" alt="logo">
        </div>
        <hr class="w-75 m-0 p-0">
        <!-- Info Profile -->
        <div class="d-flex flex-column text-center justify-content-center align-items-center py-3 gap-4">
            <a href="Profile_Client">
                <img class="rounded-circle" src="{{ asset('assets/image/' . $User->image) }}" style="width: 60%;"
                    alt="logo">
            </a>
            <span>{{ $Client->First_Name . ' ' . $Client->Last_Name }}</span>
            <span>{{ $Client->Balance }}</span>
            <span>{{ $Client->Email }}</span>
            <span>{{ $Client->Number_phone }}</span>
        </div>
        <!-- Logout -->
        <hr class="w-75 m-0 p-0">
        <ul class="navbar-nav d-flex flex-column justify-content-center align-items-center my-2 gap-2">
            <li class="nav-item text-center {{ basename(URL::current()) == 'Profile_Client' ? 'active_assidBar' : '' }}">
                <a class="nav-link" href="Profile_Client">
                    <span class="{{ basename(URL::current()) == 'Profile_Client' ? 'text-light' : 'text-dark' }}"> {{__('الملف الشخصي')}}</span>
                </a>
            </li>
            <li class="nav-item text-center {{ basename(URL::current()) == 'interface_client' ? 'active_assidBar' : '' }}">
                <a class="nav-link" href="interface_client">
                    <span class="{{ basename(URL::current()) == 'interface_client' ? 'text-light' : 'text-dark' }}"> {{__('عملياتي التجارية')}}</span>
                </a>
            </li>
        </ul>
        <hr class="w-75 m-0 p-0">
        <div>
            <a class="nav-link" href="logout">
                <span class="text-dark">{{ __('تسجيل الخروج') }}</span>
            </a>
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
