<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    
    <title>SIEFCO</title>
</head>
<body>
<style>
        :root {
    /* Colors */
    --base-color      : #3498DB;
    --second-color    : #69A8E7;
    --black-color     : #000000;
    --grey-color      : #6F6F6F;
    --white-color     : #FFFFFF;
    --cyan-Blue-color : #F6F9FC;
}
/* style of input type:radio */
input[type="radio"]{
    -webkit-appearance : none;
    appearance         : none;
    width              : 30px;
    height             : 30px;
    margin             : calc(0.75em - 11px) 0.25rem 0 0;
    vertical-align     : top;
    border             : 2px solid #ddd;
    border-radius      : 4px;
    background         : var(--white-color) no-repeat center center;
}
input[type="radio"]{
    border-radius      : 50%;
}
input[type="radio"]:where(:active:not(:disabled), :focus){
    border-color      : var(--base-color);
    background-color  : var(--base-color);
    outline           : none;
}

input[type="text"],[type="password"]{
    width             : 100%;
    height            : 50px;
    text-align        : right;
    padding-right     : 15px;
    border-radius     : 16px;
}

input[type="submit"],#btn{
    width             : 50%;
    height            : 50px;
    margin-left       : 25%;
    border-radius     : 16px;
    background-color  : var(--base-color);
    border            : 0px;
    font-weight       : bold;
}


body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    overflow-x: hidden;
    background-color: var(--cyan-Blue-color);
}


/* Home Page */
body #home,#sign{
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
body #home #home-logo{
    height: 95vh;
}
body #home #home-text,#sign-form{
    height: 95vh;
    background-color: var(--second-color);
    border-radius: 16px;
    text-align:right;
}
body #home #home-text-text{
    height: 80%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
body #home #home-text-text a{
    color: var(--base-color);
}


/* Sign Page */
body #sign #sign-form #menu-sign{
    height: 10vh;
}
body #sign #sign-form #menu-sign a{
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 16px 16px 0px 0px;
}
body #sign #sign-form #menu-sign .active{
    background-color: var(--base-color);
}

body #sign #signin,#signup{
    width: 80%;
    height: 85vh;
    margin-left: 10%;
}
body #sign p{
    color: var(--grey-color);
}


/* Assidbar */
@media screen and (max-width: 1200px) {
    body #assidBar{
        width: 250px;
        position: absolute !important;
        z-index: 999;
        display: none !important;
    }
    body #btn_assidBar{
        display: block !important;
    }
}
  /* Tables */
  th,td{
        height: 50px;
    }
    tbody tr:hover{
        background-color: var(--second-color) !important;
        color: var(--white-color) !important;
    }
    tbody tr:hover a{
        color: var(--white-color) !important;
    }
    </style>
    <div class="row" id="sign">
        <div class="col-6 d-md-flex d-none justify-content-center align-items-center" id="home-logo">
            <img src="../Assets/logo.png">
        </div>
        <div class="col-md-6 p-0" id="sign-form">
            <!---------------------- Menu Sign ---------------------->
            <div class="w-100 d-flex" id="menu-sign">
                <a href="#signup" type="button" class="nav-link w-50 h4 text-dark text-center" id="btn_signup">انشاء حساب</a>
                <a href="#signin" type="button" class="nav-link w-50 h4 text-dark text-center" id="btn_signin">تسجيل الدخول</a>
            </div>
            <!---------------------- Sign In ---------------------->
            <div id="signin">
                <div class="d-flex flex-column justify-content-center gap-2" style="width: 80%; height: 85vh; margin-left: 10%;">
                    <h1 class="text-center">تسجيل الدخول</h1>
                    <p class="text-center" id="error_signin">ادخل بريدك الالكتروني و القن السري لتسجيل الدخول</p>
                    <p id="error_signin"></p>
                    <form class="d-flex flex-column gap-2" method="POST" action="" id="form_signin">
                        <input type="text" name="email" id="email_signin" placeholder="البريد الالكتروني" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_email"></p>
                        <input type="password" name="password" id="password_signin" placeholder="القن السري" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_password"></p>
                        <div>
                            <label for="checked" class="h6">تذكرني</label>
                            <input type="checkbox" class="mx-1" name="checked" id="checked">
                        </div>
                        <input type="submit" name="signin" value="تسجيل الدخول"></input>
                    </form>
                </div>
            </div>
            <!---------------------- Sign Up ---------------------->
            <div id="signup">
                <div class="d-flex flex-column justify-content-center" style="width: 80%; height: 85vh; margin-left: 10%;">
                    <h1 class="text-center">انشاء حساب</h1>
                    <p class="text-center" id="error_signup">املأ معلوماتك لانشاء حسابك</p>
                    <p id="error_signup"></p>
                    <form class="d-flex flex-column gap-1" method="POST" action="" id="form_signup">
                        <div class="d-flex flex-sm-row-reverse justify-content-between align-items-center">
                            <input type="text" name="last_name" id="last_name" placeholder="الاسم" class="border-0 col-form-label" style="width: 48%;">
                            <input type="text" name="first_name" id="first_name" placeholder="النسب" class="border-0 col-form-label" style="width: 48%;">
                        </div>
                        <p class="text-danger float-end me-4" id="error_name"></p>
                        <input type="text" name="email" id="email_signup" placeholder="البريد الالكتروني" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_email_signup"></p>
                        <input type="text" name="email" id="phone_signup" placeholder="رقم الهاتف" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_phone_signup"></p>
                        <input type="password" name="password" id="password_signup" placeholder="القن السري" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_password_signup"></p>
                        <input type="password" name="conf_password" id="conf_password_signup" placeholder=" تأكيد القن السري" class="border-0 col-form-label">
                        <p class="text-danger float-end me-4" id="error_conf_password_signup"></p>
                        <div>
                            <label for="2" class="h6">زبون</label>
                            <input type="radio" id="2" required>
                            <label for="1" class="h6">مستخدم</label>
                            <input type="radio" id="1" required>
                        </div>
                        <input type="submit" name="signin" value="انشاء حساب"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!-- index.js -->
<script >// Sign in && Sign up
const btn_signin = document.getElementById('btn_signin');
const btn_signup = document.getElementById('btn_signup');
const signin = document.getElementById('signin');
const signup = document.getElementById('signup');
// Loading Page Defoalt
signin.style.display = "block";
signup.style.display = "none";
btn_signup.classList.remove('active');
btn_signin.classList.add('active');

btn_signin.addEventListener('click', () => {
    console.log('btn_signin');
    signup.style.display = "none";
    signin.style.display = "block";
    btn_signup.classList.remove('active');
    btn_signin.classList.add('active');
});
btn_signup.addEventListener('click', () => {
    console.log('btn_signup');
    signin.style.display = "none";
    signup.style.display = "block";
    btn_signup.classList.add('active');
    btn_signin.classList.remove('active');
});



// Validation Form Sign In
const form_signin = document.getElementById('form_signin');
const email_signin = document.getElementById('email_signin');
const password_signin = document.getElementById('password_signin');
const error_email = document.getElementById('error_email');
const error_password = document.getElementById('error_password');
const error_signin = document.getElementById('error_signin');
const pattern_email = /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;

form_signin.addEventListener('submit', (e)=> {
    if((email_signin.value == "") && (password_signin.value == "")){
        e.preventDefault();
        error_signin.innerHTML = "<p class='text-danger'>المرجوا ادخل بريدك الالكتروني و القن السري لتسجيل الدخول</p>";
    }
    else{
        error_signin.innerText = "ادخل بريدك الالكتروني و القن السري لتسجيل الدخول";
        if(email_signin.value == ""){
            e.preventDefault();
            error_email.innerText = "املأ حقل البريد الإلكتروني";
        }
        else if(pattern_email.test(email_signin.value)){
            error_email.innerText = "";
        }
        else if(!pattern_email.test(email_signin.value)){
            e.preventDefault();
            error_email.innerText = "البريد الإلكتروني غير صالح";
        } 

        if(password_signin.value == ""){
            e.preventDefault();
            error_password.innerText = "املأ حقل كلمة المرور";
        }
        else if(password_signin.value.length < 6){
            e.preventDefault();
            error_password.innerText = "يجب أن تتكون كلمة المرور من ستة أحرف على الأقل.";
        }
        else if(password_signin.value.length >= 6){
            error_password.innerText = "";
        }

        if((pattern_email.test(email_signin.value))&&(password_signin.value.length >= 6)){
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

form_signup.addEventListener('submit', (e)=> {
    if((first_name.value == "") && (last_name.value == "") && (email_signup.value == "") && (phone_signup.value == "") && (password_signup.value == "") && (conf_password_signup.value == "")){
        e.preventDefault();
        error_signup.innerHTML = "<p class='text-danger'>المرجوا ملأ معلوماتك لانشاء حسابك</p>";
    }
    else{
        error_signup.innerText = "املأ معلوماتك لانشاء حسابك";
        if((first_name.value == "") || (last_name.value == "")){
            e.preventDefault();
            error_name.innerText = "املأ حقل الاسم و النسب";
        }
        else if((pattern_name.test(first_name.value)) && (first_name.value.length >= 3) && (pattern_name.test(last_name.value)) && (last_name.value.length >= 3)){
            error_name.innerText = "";
        }
        else if((!pattern_name.test(first_name.value)) || (first_name.value.length < 3) || (!pattern_name.test(last_name.value)) || (last_name.value.length < 3)){
            e.preventDefault();
            error_name.innerText = "يجب أن يتكون الاسم و النسب من ثلاثة أحرف على الأقل";
        }

        if(email_signup.value == ""){
            e.preventDefault();
            error_email_signup.innerText = "املأ حقل البريد الإلكتروني";
        }
        else if(pattern_email.test(email_signup.value)){
            error_email_signup.innerText = "";
        }
        else if(!pattern_email.test(email_signup.value)){
            e.preventDefault();
            error_email_signup.innerText = "البريد الإلكتروني غير صالح";
        } 

        if(phone_signup.value == ""){
            e.preventDefault();
            error_phone_signup.innerText = "املأ حقل رقم الهاتف";
        }
        else if(pattern_phone.test(phone_signup.value) && (phone_signup.value.length == 10)){
            error_phone_signup.innerText = "";
        }
        else if(!pattern_phone.test(phone_signup.value) || (phone_signup.value.length != 10)){
            e.preventDefault();
            error_phone_signup.innerText = " رقم الهاتف غير صالح";
        } 

        if(password_signup.value == ""){
            e.preventDefault();
            error_password_signup.innerText = "املأ حقل كلمة المرور";
        }
        else if(password_signup.value.length < 6){
            e.preventDefault();
            error_password_signup.innerText = "يجب أن تتكون كلمة المرور من ستة أحرف على الأقل.";
        }
        else if(password_signup.value.length >= 6){
            error_password_signup.innerText = "";
            if(conf_password_signup.value == ""){
                e.preventDefault();
                error_conf_password_signup.innerText = "املأ حقل تاكيد كلمة المرور";
            }
            else if(conf_password_signup.value != password_signup.value){
                e.preventDefault();
                error_conf_password_signup.innerText = "تاكيد من كلمة المرور";
            }else if(conf_password_signup.value == password_signup.value){
                e.preventDefault();
                error_conf_password_signup.innerText = "";
            }
        }
        
        if((error_name.textContent == "") && (error_email_signup.textContent == "") && (error_phone_signup.textContent == "") && (error_password_signup.textContent == "") && (error_conf_password_signup.textContent == "")){
            form_signup.submit();
        }
    }
});

conf_password_signup.addEventListener('keyup', (e)=> {
    if(conf_password_signup.value == password_signup.value){
        conf_password_signup.style.color = "green";
    }else{
        conf_password_signup.style.color = "red";
    }
});</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
