<?php
if ($Self->auth) {
    $accid = $Self->storage("accid");
    $UserInfo = $Core->UserInfo($accid);
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <base href="<?= domain ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <title><?= $title ?></title>

    <!-- icons -->
    <link rel="shortcut icon" href="<?= $assets ?>images\favicon.png" type="image/png" />
    <link rel="shortcut icon" href="<?= $assets ?>images\favicon.png" type="image/x-icon" />
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <!-- Perfect Scrollbar -->
    <link type="text/css" href="<?= $assets ?>admin\vendor\perfect-scrollbar.css" rel="stylesheet">
    <!-- Fix Footer CSS -->
    <link type="text/css" href="<?= $assets ?>admin\vendor\fix-footer.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link type="text/css" href="<?= $assets ?>admin\css\material-icons.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link type="text/css" href="<?= $assets ?>admin\css\fontawesome.css" rel="stylesheet">
    <!-- Preloader -->
    <link type="text/css" href="<?= $assets ?>admin\css\preloader.css" rel="stylesheet">

    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/css/intlTelInput.min.css" rel="stylesheet">
    <!-- App CSS -->
    <link type="text/css" href="<?= $assets ?>admin\css\app.css" rel="stylesheet">
    <link type="text/css" href="<?= $assets ?>admin\css\custom.css" rel="stylesheet">
</head>

<body class="layout-navbar-mini-fixed-bottom">

    <div class="preloader">
        <div class="sk-double-bounce">
            <div class="sk-child sk-double-bounce1"></div>
            <div class="sk-child sk-double-bounce2"></div>
        </div>
    </div>


    <iframe src="https://esutitranscript.tawk.help/" frameborder="0" style="position: relative; margin:0 auto; width: 100%;">

    </iframe>



    <!-- jQuery -->
    <script src="<?= $assets ?>admin\vendor\jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= $assets ?>admin\vendor\popper.min.js"></script>
    <script src="<?= $assets ?>admin\vendor\bootstrap.min.js"></script>
    <!-- Perfect Scrollbar -->
    <script src="<?= $assets ?>admin\vendor\perfect-scrollbar.min.js"></script>
    <!-- DOM Factory -->
    <script src="<?= $assets ?>admin\vendor\dom-factory.js"></script>
    <!-- MDK -->
    <script src="<?= $assets ?>admin\vendor\material-design-kit.js"></script>
    <!-- Fix Footer -->
    <script src="<?= $assets ?>admin\vendor\fix-footer.js"></script>
    <!-- Chart.js -->
    <script src="<?= $assets ?>admin\vendor\Chart.min.js"></script>
    <!-- App JS -->
    <script src="<?= $assets ?>admin\js\app.js"></script>
    <!-- Highlight.js -->
    <script src="<?= $assets ?>admin\js\hljs.js"></script>
    <script src="<?= $assets ?>myhq\js\index.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/intlTelInput.min.js" integrity="sha512-p7KMhWOBzQOB7XHRi5pMula0Z4n8zxb09+ftlz+4lor1ZwmEp8SGi9Ki/JQ4VTrJEImAyrnw2vnE5faPPu3c0w==" crossorigin="anonymous"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            initialCountry: 'ng',
            nationalMode: false,
            autoHideDialCode: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/utils.min.js"
        });
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5f85817b4704467e89f70085/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->


    <!-- App Settings (safe to remove) -->
    <script src="<?= $assets ?>admin\js\app-settings.js"></script>
    
</body>

</html>