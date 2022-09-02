<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <!--  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="http://parsleyjs.org/src/parsley.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href={{ asset('assets/image/logo.png') }}/>

    <title>SIEFCO</title>
</head>

<body>

    @yield('content')

</body>

</html>

<script>
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
</script>

@yield('script')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- JavaScript Bundle with Popper -->

<!--  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


<?php
    if(explode("/", URL::current())[5] == "en") {
        echo '<style>
                input[type="text"],[type="password"], [type="email"] {
                    text-align: left !important;
                    padding-left: 15px !important;
                }
                .active{
                    border-radius: 0 50px 50px 0 !important;
                }
                .text-end{
                    text-align: left !important;
                }
                .float-end{
                    float: left !important;
                }
                .flex-row-reverse{
                    flex-direction: row !important;
                }
            </style>';
    }
?>
