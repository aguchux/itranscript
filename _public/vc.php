<?php



$Route->add('/vc', function () {

    $Core = new Apps\Core;

    $Template = new Apps\Template("/my/login");

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $Template->assign("title", "VC Board - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "dashboard");

    $Template->render("vc.my");
}, 'GET');



$Route->add('/my/vc/{page}', function ($page) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $Template->assign("title", "VC Board - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", $page);
    $Template->render("vc.{$page}");
}, 'GET');





$Route->add('/my/vc/transcripts/{verifid}/reciept', function ($verifid) {

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

    $Template->render("vc.invoice_print");

}, 'GET');


$Route->add('/my/vc/payments/{verifid}/reciept', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
    $InvoiceInfo = $Core->InvoiceInfo($verifid);
    if($InvoiceInfo->product=='transcript'){
       $Template->redirect("/my/vc/transcripts/{$InvoiceInfo->transcriptid}/reciept");  
    }elseif($InvoiceInfo->product=='verification'){
        $Template->redirect("/my/vc/verifications/{$InvoiceInfo->verificationid}/reciept");  
    }

}, 'GET');


$Route->add('/my/vc/payments/{verifid}/reciept', function ($verifid) {

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

    $Template->render("vc.invoice_print");

}, 'GET');




$Route->add('/vc/payments/{reference}/verify', function ($reference) {

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

                $Template->redirect("/my/vc/transactions?verified=true");

                //When Success//
            }

            $Template->redirect("/my/vc/transactions?verified=false");
        }
        //Collected Data//

    } catch (\Yabacon\Paystack\Exception\ApiException $e) {
        $Template->redirect("/my/vc/transactions?verified=false");
    }
}, 'GET');
