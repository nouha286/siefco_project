<nav class="d-flex flex-row-reverse justify-content-between align-items-center m-4">
    <div class="h5">
        <span class="text-white">الصفحة</span>
        <span class="text-white">/</span>
        <span class="text-white text-inline">
            {{ basename(URL::current()) == 'Dashboard' ? 'لوحة التحكم' : '' }}
            {{ basename(URL::current()) == 'operation_commercial' ? 'العمليات التجارية' : '' }}
            {{ basename(URL::current()) == 'Administrateur' ? 'المسؤولين' : '' }}
            {{ basename(URL::current()) == 'Employees' ? 'المستخدمون' : '' }}
            {{ basename(URL::current()) == 'client' ? 'الزبناء' : '' }}
            {{ basename(URL::current()) == 'devise' ? 'العملات' : '' }}
        </span>
    </div>
    <div class="d-flex flex-row-reverse justify-content-center align-items-center gap-3">
        <select class="form-select" style="max-width: 100px; border:none; background-color: var(--second-color);">
            <option value="English">English</option>
            <option value="Arabe">Arabe</option>
        </select>
        <button class="border-0 d-none" id="btn_assidBar" style="background-color: var(--second-color);">
            <i class="bi bi-menu-button-wide-fill h4 text-white d-none"></i>
            <i class="bi bi-list h4 text-white" id="icone_menu"></i>
        </button>
    </div>
</nav>
