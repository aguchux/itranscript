<?php

$Route->add('/forms/my/bursary/searchpayment', function () {
    $Core = new Apps\Core;
    
    $Template = new Apps\Template("/my/login");
    $Data = $Core->post($_POST);
    $query = $Data->query;
    $PaymentInfo = $Core->PaymentInfoByAll($query);
    if (isset($PaymentInfo->id)) {

        if((int)$PaymentInfo->tranx_status_int){
    
            $transcriptid = (int)($PaymentInfo->transcriptid);
            $verificationid = (int)($PaymentInfo->verificationid);
            if ($transcriptid > 0 && $verificationid == 0) { 
                $Template->redirect("/my/admin/verifications/{$PaymentInfo->id}/reciept");
                //$Template->redirect("/my/bursary/{$PaymentInfo->id}/verification/{$PaymentInfo->transcriptid}/result");
            } elseif ($verificationid > 0 && $transcriptid == 0) {
                $Template->redirect("/my/admin/transcripts/{$PaymentInfo->id}/reciept");
                //$Template->redirect("/my/bursary/{$PaymentInfo->id}/transcript/{$PaymentInfo->verificationid}/result");
            }else{
                $Template->setError("Verification and Transcript IDs are set for this user, resolve first.", "danger", "/my");
                $Template->redirect("/my");
            }

        }
        $Template->setError("Account or Payment not found.", "danger", "/my");
        $Template->redirect("/my");

    }
    $Template->setError("Account or Payment not found.", "danger", "/my");
    $Template->redirect("/my");
}, 'POST');


$Route->add('/my/bursary/{payid}/transcript/{transcriptid}/result', function ($payid, $transcriptid) {
    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->TranscriptInfo($transcriptid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($payid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");

    $Template->render("admin.invoice_print");
}, 'GET');



$Route->add('/my/bursary/{payid}/verification/{verificationid}/result', function ($payid, $verificationid) {
    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");

    $TranscriptInfo = $Core->VerificationInfo($verificationid);
    $Template->debug($TranscriptInfo);
    
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($payid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");

    $Template->render("admin.invoice_print");
}, 'GET');





$Route->add('/my/bursary/{page}', function ($page) {
    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("UserInfo", $UserInfo);
    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    if ($page == 'transactions') {
        $MyPayments = $Core->adminListSuccessfulPayments();
        $Template->assign("MyPayments", $MyPayments);
    }
    $Template->assign("menukey", $page);
    $Template->render("bursary.{$page}");
}, 'GET');





$Route->add('/bursary/payments/{reference}/verify', function ($reference) {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $data = $Core->post($_REQUEST);

    $accid = $Template->data["accid"];
    $UserInfo = $Core->UserInfo($accid);


    $PaymentInfo = $Core->PaymentInfoByReference($reference);
    if ($PaymentInfo->product == "verification") {
        $Transcript = $Core->VerificationInfo($PaymentInfo->verificationid);
    } elseif ($PaymentInfo->product == "transcript") {
        $Transcript = $Core->TranscriptInfo($PaymentInfo->transcriptid);
    }


    $PayID = $PaymentInfo->id;
    $Paystack = new Yabacon\Paystack(paystack_secrete);

    try {
        $tranx = $Paystack->transaction->verify([
            'reference' => $reference,
        ]);

        //Collected Data//
        $tranx_status = $tranx->status;

        if ($tranx_status == true) {

            $data = $tranx->data;

            if ($data->status == 'success') {
                //When Success//


                if ($PaymentInfo->product == "verification") {
                    $Core->setVerificationInfo($Transcript->id, "progress", 1);
                } elseif ($PaymentInfo->product == "transcript") {
                    $Core->setTrascriptInfo($Transcript->id, "progress", 1);
                }

                $Core->SetPaymentInfo($PayID, "tranx_status_int", $tranx_status);
                $message = $tranx->message;
                $Core->SetPaymentInfo($PayID, "tranx_message", $message);

                //Store Data
                $Core->SetPaymentInfo($PayID, "tranx_data", json_encode($data));

                $id = $data->id;
                $Core->SetPaymentInfo($PayID, "tranx_id", $id);

                $domain = $data->domain;
                $Core->SetPaymentInfo($PayID, "tranx_domain", $domain);

                $status = $data->status;
                $Core->SetPaymentInfo($PayID, "tranx_status", $status);

                $amount = floatval($data->amount) / 100;
                $Core->SetPaymentInfo($PayID, "tranx_amount", $amount);

                $message = $data->message;
                $Core->SetPaymentInfo($PayID, "message", $message);

                $gateway_response = $data->gateway_response;
                $Core->SetPaymentInfo($PayID, "tranx_gateway_response", $gateway_response);

                $paid_at = $data->paid_at;
                $Core->SetPaymentInfo($PayID, "tranx_paid_at", $paid_at);

                $channel = $data->channel;
                $Core->SetPaymentInfo($PayID, "tranx_channel", $channel);

                $currency = $data->currency;
                $Core->SetPaymentInfo($PayID, "tranx_currency", $currency);

                $ip_address = $data->ip_address;
                $Core->SetPaymentInfo($PayID, "tranx_ip_address", $ip_address);

                //Store Log
                $log = $data->log;
                $Core->SetPaymentInfo($PayID, "tranx_log", json_encode($log));

                $Template->redirect("/my/bursary/transactions?verified=true");

                //When Success//
            }

            $Template->redirect("/my/bursary/transactions?verified=false");
        }
        //Collected Data//

    } catch (\Yabacon\Paystack\Exception\ApiException $e) {
        $Template->redirect("/my/bursary/transactions?verified=false");
    }
}, 'GET');






$Route->add('/forms/my/bursary', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    $accid = $Template->data['accid'];
    $data = $Core->post($_POST);
    $query = $data->query;

    //$BursarySearch = $Core->BursarySearch($query);
    //$Template->assign("BursarySearch", $BursarySearch);

    $Template->assign("title", "Dashboard - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "apply");

    $Template->redirect("my.verification-completed");
}, 'POST');
