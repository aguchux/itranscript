<?php



$Route->add('/updater', function () {

    $Core = new Apps\Core;

    $Template = new Apps\Template("/my/login");

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $Template->assign("title", "VC Board - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "dashboard");

    $Template->render("updater.my");
}, 'GET');


$Route->add('/updater/transcripts/{verifid}/update', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $Core->debug($verifid);

    $TranscriptInfo = $Core->TranscriptInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($TranscriptInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Update Status - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");


    $Template->render("updater.transcript_status_update");
}, 'GET');


$Route->add('/updater/verifications/{verifid}/update', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->TranscriptInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($TranscriptInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Update Status - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");


    $Template->render("updater.verification_status_update");
}, 'GET');

$Route->add('/my/updater/{page}', function ($page) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $Template->assign("title", "VC Board - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", $page);
    $Template->render("updater.{$page}");
}, 'GET');





$Route->add('/my/updater/transcripts/{verifid}/reciept', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
    $accid = $Template->data['accid'];

    $TranscriptInfo = $Core->TranscriptInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($TranscriptInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "VC Board - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");

    $Template->render("updater.invoice_print");

}, 'GET');




$Route->add('/forms/my/updater/searchpayment', function () {
    $Core = new Apps\Core;

    $Template = new Apps\Template("/my/login");
    $Data = $Core->post($_POST);
    $query = $Data->query;

    $PaymentInfo = $Core->PaymentInfoByAll($query);
    $ThisUserInfo = $Core->UserInfo($query);

    if (isset($ThisUserInfo->accid)) {
        
        $Template->redirect("/my/updater/accounts/{$ThisUserInfo->accid}/applications");

    } elseif (isset($PaymentInfo->id)) {

        $transcriptid = (int)($PaymentInfo->transcriptid);
        $verificationid = (int)($PaymentInfo->verificationid);

        if ($transcriptid > 0 && $verificationid == 0) {
            $Template->redirect("/my/updater/verifications/{$PaymentInfo->id}/reciept");
            //$Template->redirect("/my/bursary/{$PaymentInfo->id}/verification/{$PaymentInfo->transcriptid}/result");
        } elseif ($verificationid > 0 && $transcriptid == 0) {
            $Template->redirect("/my/updater/transcripts/{$PaymentInfo->id}/reciept");
            //$Template->redirect("/my/bursary/{$PaymentInfo->id}/transcript/{$PaymentInfo->verificationid}/result");
        } else {
            $Template->setError("Verification and Transcript IDs are set for this user, resolve first.", "danger", "/my");
            $Template->redirect("/my");
        }

        $Template->setError("Account or Payment not found.", "danger", "/my");
        $Template->redirect("/my");

    }


    $Template->setError("Account or Payment not found.", "danger", "/my");
    $Template->redirect("/my");
}, 'POST');





$Route->add('/my/updater/accounts/{thisaccid}/view', function ($thisaccid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $AccidInfo = $Core->UserInfo($thisaccid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "accounts");


    $Template->render("updater.account_info");
}, 'GET');





$Route->add('/my/updater/verifications/{verifid}/view', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $VerificatinInfo = $Core->VerificationInfo($verifid);
    $Template->assign("VerificatinInfo", $VerificatinInfo);

    $InvoiceInfo = $Core->InvoiceInfo($VerificatinInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($VerificatinInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "verifications");


    $Template->render("updater.verification_info");
}, 'GET');



$Route->add('/my/updater/transcripts/{verifid}/view', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->TranscriptInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($TranscriptInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");

    $Template->render("updater.transcript_info");

}, 'GET');




$Route->add('/my/updater/accounts/{thisaccid}/applications', function ($thisaccid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $AccidInfo = $Core->UserInfo($thisaccid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");


    $Template->render("updater.user_transcripts");
}, 'GET');


$Route->add('/my/updater/accounts/{thisaccid}/transactions', function ($thisaccid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $AccidInfo = $Core->UserInfo($thisaccid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transactions");


    $Template->render("updater.user_transactions");
}, 'GET');



