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
    <!--  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <title>SIEFCO</title>
</head>

<body>
    <style>
        :root {
            /* Colors */
            --base-color: #3498DB;
            --second-color: #69A8E7;
            --black-color: #000000;
            --grey-color: #6F6F6F;
            --white-color: #FFFFFF;
            --cyan-Blue-color: #F6F9FC;
        }

        /* style of input type:radio */
        input[type="radio"] {
            -webkit-appearance: none;
            appearance: none;
            width: 30px;
            height: 30px;
            margin: calc(0.75em - 11px) 0.25rem 0 0;
            vertical-align: top;
            border: 2px solid #ddd;
            border-radius: 4px;
            background: var(--white-color) no-repeat center center;
        }
        input[type="radio"] {
            border-radius: 50%;
        }
        input[type="radio"]:where(:active:not(:disabled), :focus) {
            border-color: var(--base-color);
            background-color: var(--base-color);
            outline: none;
        }
        input[type="text"],
        [type="password"], [type="email"] {
            width: 100%;
            height: 50px;
            text-align: right;
            padding-right: 15px;
            border-radius: 16px;
        }
        input[type="submit"],#btn {
            width: 50%;
            height: 50px;
            margin-left: 25%;
            border-radius: 16px;
            background-color: var(--base-color);
            border: 0px;
            font-weight: bold;
        }

        /* Style of select */
        .search_select_box button{
            height: 50px;
            border: 0.5px solid var(--grey-color);
            border-radius: 16px;
            background-color: var(--white-color);
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow-x: hidden;
            background-color: var(--cyan-Blue-color);
        }

        /* Home Page */
        body #home,#sign {
            width: 98%;
            height: 100vh;
            margin: 0 1%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        body #home #home-logo {
            height: 95vh;
        }
        body #home #home-text,#sign-form {
            height: 95vh;
            background-color: var(--second-color);
            border-radius: 16px;
            text-align: right;
        }
        body #home #home-text-text {
            height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        body #home #home-text-text a {
            color: var(--base-color);
        }

        /* Sign Page */
        body #sign #sign-form #menu-sign {
            height: 10vh;
        }
        body #sign #sign-form #menu-sign a {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 16px 16px 0px 0px;
        }
        body #sign #sign-form #menu-sign .active {
            background-color: var(--base-color);
        }
        body #sign #signin,#signup {
            width: 80%;
            height: 85vh;
            margin-left: 10%;
        }
        body #sign p {
            color: var(--grey-color);
        }

        /* Assidbar */
        body #assidBar{
            width: 270px;
        }
        @media screen and (max-width: 1200px) {
            body #assidBar{
                position: absolute !important;
                z-index: 999;
                display: none !important;
            }
            body #btn_assidBar{
                display: block !important;
            }
        }

        body .active{
            background-color: var(--second-color);
            border-radius: 50px 0 0 50px;
            width: 226px;
            padding: 6px 0px;
        }

        /* Tables */
        th,td {
            height: 50px;
        }
        tbody tr:hover {
            background-color: var(--second-color) !important;
            color: var(--white-color) !important;
        }
        tbody tr:hover a {
            color: var(--white-color) !important;
        }
    </style>
    @yield('content')

</body>

</html>
<!-- Dashboard JS -->
<script>
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
</script>
@yield('script')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!--  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
