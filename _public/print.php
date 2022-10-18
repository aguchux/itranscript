<?php




$Route->add('/my/payments/{paymentid}/print/{page}', function ($paymentid,$page) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("UserInfo", $UserInfo);

    $InvoiceInfo = $Core->InvoiceInfo($paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $TranscriptInfo = $Core->TranscriptInfo($InvoiceInfo->transcriptid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $Template->assign("title", "Invoice Payment #{$paymentid} - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "payments");

    $Template->render("my.print-{$page}");
}, 'GET');
