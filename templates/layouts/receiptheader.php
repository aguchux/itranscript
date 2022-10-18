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

  <!-- SEO -->
  <meta property="og:title" content="iTranscript: Enugu State University of Science & Technology">
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://itranscript.esut.edu.ng">
  <meta property="og:image" content="//itranscript.esut.edu.ng/fb.jpg">
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:image:alt" content="iTranscript: Enugu State University of Science & Technology" />
  <meta property="og:site_name" content="ESUT iTranscript">
  <meta property="og:description" content="iTranscript: Enugu State University of Science & Technology">
  <meta property="fb:app_id" content="639832706868468" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:image:alt" content="itranscript.esut.edu.ng" />
  <!-- SEO -->

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


  <link type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
  <link type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">


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
    
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
