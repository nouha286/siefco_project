<nav class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
    <div class="h5">
        <span class="text-white">{{ __('الصفحة') }}</span>
        <span class="text-white">/</span>
        <span class="text-white text-inline">
            {{ basename(URL::current()) == 'Dashboard' ? __('لوحة التحكم') : '' }}
            {{ basename(URL::current()) == 'operation_commercial' ? __('العمليات التجارية') : '' }}
            {{ basename(URL::current()) == 'Administrateur' ? __('المسؤولين') : '' }}
            {{ basename(URL::current()) == 'Employees' ? __('المستخدمون') : '' }}
            {{ basename(URL::current()) == 'client' ? __('الزبناء') : '' }}
            {{ basename(URL::current()) == 'devise' ? __('العملات') : '' }}
            {{ basename(URL::current()) == 'Profile' ? __('الملف الشخصي') : '' }}
            {{ basename(URL::current()) == 'interface_client' ? __('عملياتي التجارية') : '' }}
            {{ basename(URL::current()) == 'Profile_Client' ? __('الملف الشخصي') : '' }}
        </span>
    </div>
    <div class="d-flex flex-row-reverse justify-content-center align-items-center">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a rel="alternate" hreflang="{{ $localeCode }}" class="btn m-2" style="background-color: var(--base-color);"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        @endforeach
        <button class="border-0 d-none" id="btn_assidBar" style="background-color: var(--second-color);">
            <i class="bi bi-menu-button-wide-fill h4 text-white d-none"></i>
            <i class="bi bi-list h4 text-white" id="icone_menu"></i>
        </button>
    </div>
</nav>
