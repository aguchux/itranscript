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

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">




        <nav class="navbar navbar-light">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a href="./my/apps/payments" class="nav-link"><i class="material-icons icon--left">keyboard_backspace</i> Back to Payments</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="page-section bg-white border-bottom-2">
            <div class="container page__container">
                <div class="row">

                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-6 mb-24pt mb-lg-0">
                                <p class="text-black-70 mb-0"><strong>Prepared for</strong></p>
                                <h2><?= "<strong>{$UserInfo->surname}</strong>, {$UserInfo->firstname} {$UserInfo->middlename} " ?></h2>
                                <p class="text-black-50"><?= $UserInfo->address ?><br><?= $Core->CountryInfo($UserInfo->nationality) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-black-70 mb-0"><strong>Prepared by</strong></p>
                                <div>
                                    <img class="navbar-brand-icon mr-0 mr-md-8pt mt-2 mb-1" src="<?= $assets ?>images\esut_logo.png" width="100%">
                                </div>
                                <p class="text-black-50">Enugu State, Nigeria</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-lg-right d-flex flex-lg-column mb-24pt mb-lg-0 border-bottom border-lg-0 pb-16pt pb-lg-0">
                        <div class="flex">
                            <p class="text-black-70 my-0"><strong>Invoice Number</strong></p>
                            <h2 class="my-1"><?= $InvoiceInfo->id ?></h2>
                            <p class="text-black-50">
                                <?= date("F jS, Y", strtotime($InvoiceInfo->created)) ?><br>
                            </p>
                        </div>
                        <?php if ($InvoiceInfo->tranx_status == "pending") : ?>

                            <?php if ($TranscriptInfo->payment_mode == "online") : ?>
                                <form action="./forms/my/payments/<?= $InvoiceInfo->id ?>/prepay" method="POST" class="p-0 mx-auto">
                                    <?= $Self->tokenize() ?>
                                    <div><button class="btn btn-accent blink-me">Make Payment Now<i class="material-icons icon--right">payment</i></button></div>
                                </form>
                            <?php elseif ($TranscriptInfo->payment_mode == "offline") : ?>
                                <a href="./my/payments/<?= $InvoiceInfo->id ?>/slip" class="btn btn-accent">Print Payment Slip<i class="material-icons icon--right">print</i></a>
                            <?php endif; ?>

                        <?php else : ?>

                            <div><a href="./forms/my/payments/<?= $InvoiceInfo->id ?>/reciept" class="btn btn-accent">Download Payment Reciept<i class="material-icons icon--right">file_download</i></a></div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>


        <div class="container page__container">
            <form>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="page-section">
                            <h4>Transcript Payment Information (#<?= $TranscriptInfo->id ?>)</h4>

                            <div class="card table-responsive">
                                <table class="table table-flush table--elevated">
                                    <thead>
                                        <tr>
                                            <th>Description of Payment</th>
                                            <th style="width: 60px;" class="text-right">Amount(&#8358;)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p class="mb-0"><strong>Transcript Processing Fee - (<?= $TranscriptInfo->international ? "International" : "National/Local" ?>)</strong></p>
                                                <p class="text-50 mt-3 mb-1 ml-2">Application Number: <strong>#<?= $TranscriptInfo->id ?></strong></p>
                                                <p class="text-50 my-1 ml-2">Matriculation Number: <strong><?= $TranscriptInfo->matricnumber ?></strong></p>
                                            </td>
                                            <td class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Logistics</strong></td>
                                            <td class="text-right"><strong>+inclusive</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-flush">
                                    <tfoot>
                                        <tr>
                                            <td class="text-right text-70"><strong>Subtotal</strong></td>
                                            <td style="width: 60px;" class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right text-70"><strong>Total</strong></td>
                                            <td style="width: 60px;" class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="px-16pt">

                                <?php if ($InvoiceInfo->tranx_status == "pendig") : ?>
                                    <p class="text-70 mb-8pt text-danger"><strong>This invoice is pending payment</strong></p>
                                    <div class="media">
                                        <div class="media-body text-50">
                                            Payment for this invoice in easy and online, we also provided several payment options to ensure you find the method that best suites your convienience.
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <p class="text-70 mb-8pt text-success"><strong>Invoice is paid</strong></p>
                                    <div class="media">
                                        <div class="media-body text-50">
                                            You don’t need to take further action. You just sit back and waiit while our team processes your transcript. You will be updated on the progress through email and SMS.
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>

        <center>
            <script language="javascript" type="text/javascript">
                /* <![CDATA[ */
                document.write('<a href="./makepdf?url=' + encodeURIComponent(location.href) + '">');
                document.write('Create PDF file of this page');
                document.write('</a>');
                /* ]]> */
            </script>
        </center>

    </div>
    <!-- // END Header Layout Content -->





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