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
<!-- 
  <div class="preloader">
    <div class="sk-double-bounce">
      <div class="sk-child sk-double-bounce1"></div>
      <div class="sk-child sk-double-bounce2"></div>
    </div>
  </div> -->

  <!-- Header Layout -->
  <div class="mdk-header-layout js-mdk-header-layout">

    <!-- Header -->
    <div id="header" class="mdk-header bg-light js-mdk-header mb-0" data-effects="waterfall blend-background" data-fixed="" data-condenses="">
      <div class="mdk-header__content">
        <div class="navbar navbar-expand-sm navbar-light bg-light pr-0 pr-md-16pt" id="default-navbar" data-primary="">

          <div class="container">

            <!-- Navbar toggler -->
            <button class="navbar-toggler navbar-toggler-right d-block d-md-none" type="button" data-toggle="sidebar">
              <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Brand -->
            <a href="./" class="navbar-brand">
              <img class="navbar-brand-icon mr-0 mr-md-8pt mt-2 mb-1" src="<?= $assets ?>images\esut_logo.png" width="100%">
            </a>

            <!-- Main Navigation -->

            <ul class="nav navbar-nav ml-auto flex-nowrap" style="white-space: nowrap;">

              <?php if ($Self->auth) : ?>

                <li class="ml-16pt nav-item">
                  <a href="./help/support" class="nav-link">
                    <i class="material-icons">help_outline</i>&nbsp;
                    <span>Support</span>
                  </a>
                </li>

                <li class="d-none d-sm-flex nav-item">
                  <a href="./my" class="nav-link text-primary">
                    <i class="material-icons">account_circle</i>&nbsp;
                    <span>My Applications</span>
                  </a>
                </li>

                <li class="ml-16pt nav-item">
                  <a href="./auth/logout" class="nav-link">
                    <i class="material-icons">lock_open</i>&nbsp;
                    <span>Logout</span>
                  </a>
                </li>

              <?php else : ?>

                <li class="ml-16pt nav-item">
                  <a href="./help/support" class="nav-link">
                    <i class="material-icons">help_outline</i>&nbsp;
                    <span>Support</span>
                  </a>
                </li>
                <li class="ml-16pt nav-item">
                  <a href="./my/login" class="nav-link">
                    <i class="material-icons">lock_open</i>&nbsp;
                    <span>Login</span>
                  </a>
                </li>
                <li class="d-none d-sm-flex nav-item">
                  <a href="./my/register" class="btn btn-primary">Start Application</a>
                </li>

              <?php endif; ?>

            </ul>


          </div>

          <!-- // END Main Navigation -->

        </div>

      </div>
    </div>

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">

      <?php if ($Self->auth && isset($dashboard)) : ?>

        <div class="bg-primary border-bottom-white py-32pt">
          <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
            <img src="<?= $assets ?>admin\images\illustration\student\128\white.svg" width="104" class="mr-md-32pt mb-32pt mb-md-0" alt="student">
            <div class="flex mb-32pt mb-md-0">
              <h2 class="text-white mb-0"><?= "{$UserInfo->surname} {$UserInfo->firstname}" ?></h2>
              <p class="lead text-white-50 d-flex align-items-center">Application ID&nbsp;:&nbsp;<strong><?= $UserInfo->accid ?></strong> <span class="ml-16pt d-flex align-items-center"><i class="material-icons icon-16pt mr-4pt">opacity</i> Status&nbsp;:&nbsp;<strong>Profile</strong> </span></p>
            </div>
            <a href="./my/apps/edit-profile" class="btn btn-outline-white">Edit Profile</a>
          </div>
        </div>
        <div class="navbar navbar-expand-sm navbar-dark-white bg-primary p-sm-0 ">
          <div class="container page__container">

            <!-- Navbar toggler -->
            <button class="navbar-toggler ml-n16pt" type="button" data-toggle="collapse" data-target="#navbar-submenu2">
              <span class="material-icons">people_outline</span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-submenu2">
              <div class="navbar-collapse__content pb-16pt pb-sm-0">
                <ul class="nav navbar-nav">

                  <?php if ($UserInfo->is_admin == 0) : ?>

                    <li class="nav-item <?= ($menukey == 'dashboard') ? 'active' : '' ?>">
                      <a href="./my" class="nav-link">Dashboard</a>
                    </li>

                    <li class="nav-item <?= ($menukey == 'applications') ? 'active' : '' ?>">
                      <a href="./my/apps/applications" class="nav-link">My Transcripts</a>
                    </li>
                    <li class="nav-item <?= ($menukey == 'verifications') ? 'active' : '' ?>">
                      <a href="./my/apps/verifications" class="nav-link">My Verifications</a>
                    </li>
                    <li class="nav-item <?= ($menukey == 'payments') ? 'active' : '' ?>">
                      <a href="./my/apps/payments" class="nav-link">My Payments</a>
                    </li>

                  <?php elseif ($UserInfo->is_admin == 1) : ?>

                    <li class="nav-item <?= ($menukey == 'dashboard') ? 'active' : '' ?>">
                      <a href="./my" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item <?= ($menukey == 'accounts') ? 'active' : '' ?>">
                      <a href="./my/admin/accounts" class="nav-link">Accounts (<?= $Core->CountAccounts() ?>)</a>
                    </li>
                    <li class="nav-item <?= ($menukey == 'transcripts') ? 'active' : '' ?>">
                      <a href="./my/admin/transcripts" class="nav-link">iTranscripts</a>
                    </li>

                    <li class="nav-item <?= ($menukey == 'verifications') ? 'active' : '' ?>">
                      <a href="./my/admin/verifications" class="nav-link">Verifications</a>
                    </li>
                    <li class="nav-item <?= ($menukey == 'transactions') ? 'active' : '' ?>">
                      <a href="./my/admin/transactions" class="nav-link">Transactions</a>
                    </li>

                    <li class="nav-item <?= ($menukey == 'reports') ? 'active' : '' ?>">
                      <a href="./my/admin/reports" class="nav-link">Reports</a>
                    </li>

                    <li class="nav-item <?= ($menukey == 'logs') ? 'active' : '' ?>">
                      <a href="./my/admin/logs" class="nav-link">Logs</a>
                    </li>

                  <?php elseif ($UserInfo->is_admin == 2) : ?>

                    <li class="nav-item <?= ($menukey == 'dashboard') ? 'active' : '' ?>">
                      <a href="./my" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item <?= ($menukey == 'transactions') ? 'active' : '' ?>">
                      <a href="./my/bursary/transactions" class="nav-link">Payments & Approvals</a>
                    </li>

                  <?php elseif ($UserInfo->is_admin == 3) : ?>

                    <li class="nav-item <?= ($menukey == 'dashboard') ? 'active' : '' ?>">
                      <a href="./my" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item <?= ($menukey == 'transactions') ? 'active' : '' ?>">
                      <a href="./my/vc/transactions" class="nav-link">Payments & Approvals</a>
                    </li>

                  <?php elseif ($UserInfo->is_admin == 4) : ?>

                    <li class="nav-item <?= ($menukey == 'dashboard') ? 'active' : '' ?>">
                      <a href="./my" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item <?= ($menukey == 'transactions') ? 'active' : '' ?>">
                      <a href="./my/updates" class="nav-link">Applications</a>
                    </li>

                  <?php else : ?>

                    <li class="nav-item <?= ($menukey == 'dashboard') ? 'active' : '' ?>">
                      <a href="./my" class="nav-link">Dashboard</a>
                    </li>

                  <?php endif; ?>

                </ul>
                <ul class="nav navbar-nav ml-auto">

                  <li class="nav-item <?= ($menukey == 'edit-profile') ? 'active' : '' ?>">
                    <a href="./my/apps/edit-profile" class="nav-link">My Profile</a>
                  </li>

                  <?php if ($UserInfo->is_owner == 1) : ?>
                    <li class="nav-item <?= ($menukey == 'edit-settings') ? 'active' : '' ?>">
                      <a href="./my/admin/edit-settings" class="nav-link">Settings</a>
                    </li>
                  <?php endif; ?>

                </ul>
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>