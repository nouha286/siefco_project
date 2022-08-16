
//AssidBar
const assidBar = document.getElementById('assidBar');
const btn_assidBar = document.getElementById('btn_assidBar');
const icone_menu = document.getElementById('icone_menu');

btn_assidBar.onclick = function() {
    if (icone_menu.classList.contains('bi-list')) {
        icone_menu.classList.remove('bi-list');
        icone_menu.classList.add('bi-x-lg');
        assidBar.style.removeProperty('display');
        assidBar.setAttribute("style", "display: block !important;");
        assidBar.classList.remove('d-none');
        assidBar.classList.add('d-block');
    } else {
        icone_menu.classList.remove('bi-x-lg');
        icone_menu.classList.add('bi-list');
        assidBar.style.removeProperty('display');
        assidBar.setAttribute("style", "display: none !important;");
    }
}


// Number Of Identification
function n_identif_on() {
    const n_identif = document.getElementById('n_identif');
    n_identif.classList.remove('d-none');
    n_identif.classList.add('d-block');
}
function n_identif_off() {
    const n_identif = document.getElementById('n_identif');
    n_identif.classList.remove('d-block');
    n_identif.classList.add('d-none');
}


// Validation Form Sign In
const form_signin = document.getElementById('form_signin');
const email_signin = document.getElementById('email_signin');
const password_signin = document.getElementById('password_signin');
const error_email = document.getElementById('error_email');
const error_password = document.getElementById('error_password');
const error_signin = document.getElementById('error_signin');
const pattern_email = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;
form_signin.addEventListener('submit', (e) => {
    if ((email_signin.value == "") && (password_signin.value == "")) {
        e.preventDefault();
        error_signin.innerHTML = "<p class='text-danger'>المرجوا ادخل بريدك الالكتروني و القن السري لتسجيل الدخول</p>";
    } else {
        error_signin.innerText = "ادخل بريدك الالكتروني و القن السري لتسجيل الدخول";
        if (email_signin.value == "") {
            e.preventDefault();
            error_email.innerText = "املأ حقل البريد الإلكتروني";
        } else if (pattern_email.test(email_signin.value)) {
            error_email.innerText = "";
        } else if (!pattern_email.test(email_signin.value)) {
            e.preventDefault();
            error_email.innerText = "البريد الإلكتروني غير صالح";
        }
        if (password_signin.value == "") {
            e.preventDefault();
            error_password.innerText = "املأ حقل كلمة المرور";
        } else if (password_signin.value.length < 6) {
            e.preventDefault();
            error_password.innerText = "يجب أن تتكون كلمة المرور من ستة أحرف على الأقل.";
        } else if (password_signin.value.length >= 6) {
            error_password.innerText = "";
        }
        if ((pattern_email.test(email_signin.value)) && (password_signin.value.length >= 6)) {
            form_signin.submit();
        }
    }
});


// Validation Form Sign Up
const form_signup = document.getElementById('form_signup');
const first_name = document.getElementById('first_name');
const last_name = document.getElementById('last_name');
const error_name = document.getElementById('error_name');
const email_signup = document.getElementById('email_signup');
const error_email_signup = document.getElementById('error_email_signup');
const phone_signup = document.getElementById('phone_signup');
const error_phone_signup = document.getElementById('error_phone_signup');
const password_signup = document.getElementById('password_signup');
const error_password_signup = document.getElementById('error_password_signup');
const conf_password_signup = document.getElementById('conf_password_signup');
const error_conf_password_signup = document.getElementById('error_conf_password_signup');
const error_signup = document.getElementById('error_signup');
const pattern_name = /[a-zA-Z]/;
const pattern_phone = /[0-9]/;

form_signup.addEventListener('submit', (e) => {
    if ((first_name.value == "") && (last_name.value == "") && (email_signup.value == "") && (phone_signup.value == "") && (password_signup.value == "") && (conf_password_signup.value == "")) {
        e.preventDefault();
        error_signup.innerHTML = "<p class='text-danger'>المرجوا ملأ معلوماتك لانشاء حسابك</p>";
    } else {
        error_signup.innerText = "املأ معلوماتك لانشاء حسابك";
        if ((first_name.value == "") || (last_name.value == "")) {
            e.preventDefault();
            error_name.innerText = "املأ حقل الاسم و النسب";
        } else if ((pattern_name.test(first_name.value)) && (first_name.value.length >= 3) && (pattern_name.test(last_name.value)) && (last_name.value.length >= 3)) {
            error_name.innerText = "";
        } else if ((!pattern_name.test(first_name.value)) || (first_name.value.length < 3) || (!pattern_name.test(last_name.value)) || (last_name.value.length < 3)) {
            e.preventDefault();
            error_name.innerText = "يجب أن يتكون الاسم و النسب من ثلاثة أحرف على الأقل";
        }

        if (email_signup.value == "") {
            e.preventDefault();
            error_email_signup.innerText = "املأ حقل البريد الإلكتروني";
        } else if (pattern_email.test(email_signup.value)) {
            error_email_signup.innerText = "";
        } else if (!pattern_email.test(email_signup.value)) {
            e.preventDefault();
            error_email_signup.innerText = "البريد الإلكتروني غير صالح";
        }

        if (phone_signup.value == "") {
            e.preventDefault();
            error_phone_signup.innerText = "املأ حقل رقم الهاتف";
        } else if (pattern_phone.test(phone_signup.value) && (phone_signup.value.length == 10)) {
            error_phone_signup.innerText = "";
        } else if (!pattern_phone.test(phone_signup.value) || (phone_signup.value.length != 10)) {
            e.preventDefault();
            error_phone_signup.innerText = " رقم الهاتف غير صالح";
        }

        if (password_signup.value == "") {
            e.preventDefault();
            error_password_signup.innerText = "املأ حقل كلمة المرور";
        } else if (password_signup.value.length < 6) {
            e.preventDefault();
            error_password_signup.innerText = "يجب أن تتكون كلمة المرور من ستة أحرف على الأقل.";
        } else if (password_signup.value.length >= 6) {
            error_password_signup.innerText = "";
            if (conf_password_signup.value == "") {
                e.preventDefault();
                error_conf_password_signup.innerText = "املأ حقل تاكيد كلمة المرور";
            } else if (conf_password_signup.value != password_signup.value) {
                e.preventDefault();
                error_conf_password_signup.innerText = "تاكيد من كلمة المرور";
            } else if (conf_password_signup.value == password_signup.value) {
                e.preventDefault();
                error_conf_password_signup.innerText = "";
            }
        }

        if ((error_name.textContent == "") && (error_email_signup.textContent == "") && (error_phone_signup.textContent == "") && (error_password_signup.textContent == "") && (error_conf_password_signup.textContent == "")) {
            form_signup.submit();
        }
    }
});
conf_password_signup.addEventListener('keyup', (e) => {
    if (conf_password_signup.value == password_signup.value) {
        conf_password_signup.style.color = "green";
    } else {
        conf_password_signup.style.color = "red";
    }
});
