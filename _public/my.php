<?php



$Route->add('/my', function () {

    $Core = new Apps\Core;

    $Template = new Apps\Template("/my/login");

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $Template->assign("title", "Dashboard - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "dashboard");

    if ($UserInfo->is_admin == 0) {
        $Template->render("my.my");
    } elseif ($UserInfo->is_admin == 1) {
        $Template->render("admin.my");
    } elseif ($UserInfo->is_admin == 2) {
        $Template->render("bursary.my");
    } elseif ($UserInfo->is_admin == 3) {
        $Template->render("vc.my");
    } elseif ($UserInfo->is_admin == 4) {
        $Template->render("updater.my");
    } elseif ($UserInfo->is_admin == 5) {
        $Template->render("my.my");
    }
}, 'GET');


$Route->add('/my/apps/{page}', function ($page) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("title", "{$UserInfo->surname} {$UserInfo->firstname} - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", $page);
    if ($page == "apply") {
        $Template->assign("menukey", "applications");
    }
    $route = $Core->Reroute("my.{$page}");
    $Template->render($route);
}, 'GET');


$Route->add('/my/{transcriptid}/apply-completed', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("title", "{$UserInfo->surname} {$UserInfo->firstname} - iTranscript");
    $Template->assign("Transcript", $Core->TranscriptInfo($transcriptid));
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "apply");

    $Template->render("my.apply-completed");
}, 'GET');


$Route->add('/my/{transcriptid}/verification-completed', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];

    $Template->assign("Transcript", $Core->VerificationInfo($transcriptid));

    $Template->assign("title", "Dashboard - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "apply");

    $Template->render("my.verification-completed");
}, 'GET');


$Route->add('/my/apps/{transcriptid}/apply', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];

    $Template->assign("Transcript", $Core->TranscriptInfo($transcriptid));


    $Template->assign("title", "Dashboard - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "apply");

    $Template->render("my.apply-start");
}, 'GET');



$Route->add('/my/apps/transcripts/{transcriptid}/edit', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];

    $Template->assign("Transcript", $Core->TranscriptInfo($transcriptid));

    $Template->assign("title", "Status - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "applications");

    $Template->render("my.edit-application");
}, 'GET');



$Route->add('/my/apps/transcripts/{transcriptid}/status', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];

    $Template->assign("TranscriptInfo", $Core->TranscriptInfo($transcriptid));

    $Template->assign("title", "Status - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "applications");

    $Template->render("my.status");
}, 'GET');



$Route->add('/my/apps/verify/transcript/{verifid}/apply', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];

    $VerificationInfo = $Core->VerificationInfo($verifid);
    $Template->assign("Transcript", $VerificationInfo);

    $InvoiceInfo = $Core->InvoiceInfo($VerificationInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $Template->assign("title", "Dashboard - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "verifications");

    $Template->render("my.apply-start-verify-transcript");
}, 'GET');



$Route->add('/my/apps/verify/certificate/{verifid}/apply', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];

    $VerificationInfo = $Core->VerificationInfo($verifid);
    $Template->assign("Transcript", $VerificationInfo);

    $InvoiceInfo = $Core->InvoiceInfo($VerificationInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $Template->assign("title", "Dashboard - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "verifications");

    $Template->render("my.apply-start-verify-certificate");
}, 'GET');





$Route->add('/my/apps/{paymentid}/invoice', function ($paymentid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("UserInfo", $UserInfo);

    $InvoiceInfo = $Core->InvoiceInfo($paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $Template->assign("title", "Invoice Payment #{$paymentid} - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "payments");

    if ($InvoiceInfo->product == "verification") {
        $TranscriptInfo = $Core->VerificationInfo($InvoiceInfo->verificationid);
        $Template->assign("TranscriptInfo", $TranscriptInfo);
        $Template->render("my.verification_invoice");
    } elseif ($InvoiceInfo->product == "transcript") {
        $TranscriptInfo = $Core->TranscriptInfo($InvoiceInfo->transcriptid);
        $Template->assign("TranscriptInfo", $TranscriptInfo);
        $Template->render("my.invoice");
    }
}, 'GET');





$Route->add('/my/apps/{paymentid}/print', function ($paymentid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("UserInfo", $UserInfo);

    $InvoiceInfo = $Core->InvoiceInfo($paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);


    $Template->assign("title", "Invoice Payment #{$paymentid} - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "payments");
    $Template->assign("printpage", true);

    if ($InvoiceInfo->product == "verification") {
        $TranscriptInfo = $Core->VerificationInfo($InvoiceInfo->verificationid);
        $Template->assign("TranscriptInfo", $TranscriptInfo);
        $Template->render("my.verification_invoice");
    } elseif ($InvoiceInfo->product == "transcript") {
        $TranscriptInfo = $Core->TranscriptInfo($InvoiceInfo->transcriptid);
        $Template->assign("TranscriptInfo", $TranscriptInfo);
        $Template->render("my.print-receipt");
    }
}, 'GET');





$Route->add('/my/apps/{appid}/transcript/delete', function ($appid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $TranscriptInfo = $Core->TranscriptInfo($appid);
    $paymentid = $TranscriptInfo->paymentid;

    $dp = $Core->mysqli("DELETE esut_transcripts.* FROM esut_transcripts WHERE id='$appid'");
    $dt = $Core->mysqli("DELETE esut_payments.* FROM esut_payments WHERE id='$paymentid'");

    $Template->redirect("/my/apps/applications");
}, 'GET');




$Route->add('/my/apps/{verid}/verification/delete', function ($verid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $VerificationInfo = $Core->VerificationInfo($verid);
    $paymentid = $VerificationInfo->paymentid;

    $dp = $Core->mysqli("DELETE esut_verifications.* FROM esut_verifications WHERE id='$verid'");
    $dt = $Core->mysqli("DELETE esut_payments.* FROM esut_payments WHERE id='$paymentid'");

    $Template->redirect("/my/apps/verifications");
}, 'GET');





$Route->add('/my/apps/{paymentid}/prepay', function ($paymentid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("UserInfo", $UserInfo);

    $InvoiceInfo = $Core->InvoiceInfo($paymentid);
    $Template->assign("PaymentInfo", $InvoiceInfo);

    $TranscriptInfo = $Core->TranscriptInfo($InvoiceInfo->transcriptid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $Template->assign("title", "Invoice Payment #{$paymentid} - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "payments");

    $Template->render("my.prepay");
}, 'GET');




$Route->add('/payments/{paymentid}/completed', function ($paymentid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("UserInfo", $UserInfo);

    $InvoiceInfo = $Core->InvoiceInfo($paymentid);
    $Template->assign("PaymentInfo", $InvoiceInfo);

    $TranscriptInfo = $Core->TranscriptInfo($InvoiceInfo->transcriptid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $Template->assign("title", "Payment Successful #{$paymentid} - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "payments");

    $Template->render("my.completed");
}, 'GET');






$Route->add('/my/password-changed', function () {
    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "PAssword changed - iTranscript");
    $Template->render("password-changed");
}, 'GET');


$Route->add('/my/login', function () {
    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Login - iTranscript");
    $Template->render("login");
}, 'GET');

$Route->add('/my/reset-done', function () {

    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $Core = new Apps\Core;

    if (isset($_GET['resend'])) {

        $vericode = $Template->storage("vericode");
        $UserInfo = $Core->UserInfo($vericode);

        //Email USer//
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.reset');
        $EmailTemplate->vericode =  $UserInfo->vericode;

        $Mailer->subject = "Reset password request";
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $UserInfo->email;
        $Mailer->send();
        //Email USer//

    }

    $Template->assign("title", "Check your email - iTranscript");
    $Template->render("reset-done");
}, 'GET');


$Route->add('/my/{vericode}/reset', function ($vericode) {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    //$UserInfo = $Core->UserInfo($vericode);

    $Template->assign("title", "Set new password - iTranscript");
    $Template->render("reset-password");
}, 'GET');




$Route->add('/my/register', function () {
    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Register - iTranscript");
    $Template->render("register");
}, 'GET');

$Route->add('/my/reset', function () {
    $Template = new Apps\Template;
    if ($Template->auth) {
        $Template->redirect("/my");
    }
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Forgot Account - iTranscript");
    $Template->render("reset");
}, 'GET');


$Route->add('/my/{vericode}/verify', function ($vericode) {
    $Template = new Apps\Template;
    $Core = new Apps\Core;
    $UserInfo = $Core->UserInfo($vericode);
    if ($UserInfo->verified) {
        $Template->redirect("/my/{$vericode}/already-verified");
    } else {
        $updated = $Core->setUserInfo($UserInfo->accid, "verified", 1);
        if ($updated) {

            $Mailer = new Apps\Emailer();
            $EmailTemplate = new Apps\EmailTemplate('mails.verified');
            $Mailer->subject = "Your email is verified";
            $Mailer->SetTemplate($EmailTemplate);
            $Mailer->toEmail = $UserInfo->email;
            $Mailer->send();
            $Template->redirect("/my/{$vericode}/verified");
        }
        $Template->redirect("/my/{$vericode}/un-verified");
    }
}, 'GET');


$Route->add('/my/{vericode}/verified', function ($vericode) {
    $Template = new Apps\Template;
    $Core = new Apps\Core;
    $UserInfo = $Core->UserInfo($vericode);

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "You are verified - iTranscript");

    $Template->render("verified");
}, 'GET');

$Route->add('/my/{vericode}/already-verified', function ($vericode) {

    $Template = new Apps\Template;
    $Core = new Apps\Core;
    $UserInfo = $Core->UserInfo($vericode);

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "You are verified - iTranscript");

    $Template->render("already-verified");
}, 'GET');


$Route->add('/my/{vericode}/un-verified', function ($vericode) {

    $Template = new Apps\Template;
    $Core = new Apps\Core;
    $UserInfo = $Core->UserInfo($vericode);

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Verification failed - iTranscript");

    $Template->render("un-verified");
}, 'GET');


$Route->add('/my/verify', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;

    if (isset($_GET['resend'])) {

        $vericode = $Template->storage("vericode");
        $UserInfo = $Core->UserInfo($vericode);

        //Email USer//
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.do_verify');
        $EmailTemplate->vericode =  $UserInfo->vericode;

        $Mailer->subject = "Verify your email";
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $UserInfo->email;
        $Mailer->send();
        //Email USer//

    }


    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Verification required - iTranscript");

    $Template->render("verify");
}, 'GET');


$Route->add('/my/do-verify', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;

    if (isset($_GET['resend'])) {

        $vericode = $Template->storage("vericode");
        $UserInfo = $Core->UserInfo($vericode);

        //Email USer//
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.do_verify');
        $EmailTemplate->vericode =  $UserInfo->vericode;

        $Mailer->subject = "Verify your email";
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $UserInfo->email;
        $Mailer->send();
        //Email USer//

    }

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Verification required - iTranscript");

    $Template->render("do-verify");
}, 'GET');
