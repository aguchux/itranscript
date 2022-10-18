<?php



$Route->add('/admin', function () {

    $Core = new Apps\Core;

    $Template = new Apps\Template("/my/login");

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "dashboard");

    $Template->render("admin.admin");
}, 'GET');


$Route->add('/my/admin/{page}', function ($page) {

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
        $MyPayments = $Core->adminListPayments(500);
        $Template->assign("MyPayments", $MyPayments);
    } elseif ($page == 'accounts') {
        $pagenum = 1;
        if (!empty($_GET['pagenum'])) {
            $pagenum = filter_input(INPUT_GET, 'pagenum', FILTER_VALIDATE_INT);
            if (false === $pagenum) {
                $pagenum = 1;
            }
        }
        $Users = $Core->adminListPagesAccounts($pagenum);
        $Template->assign("CurrentPage", $pagenum);
        $Template->assign("Users", $Users);
    } elseif ($page == 'edit-settings') {
        $SiteSettings = $Core->SiteSettings();
        $Template->assign("SiteSettings", $SiteSettings);
    }

    $Template->assign("menukey", $page);
    if ($page == "apply") {
        $Template->assign("menukey", "applications");
    }
    $Template->render("admin.{$page}");
}, 'GET');



$Route->add('/my/admin/accounts/{thisaccid}/view', function ($thisaccid) {

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


    $Template->render("admin.account_info");
}, 'GET');





$Route->add('/my/admin/verifications/{verifid}/view', function ($verifid) {

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


    $Template->render("admin.verification_info");
}, 'GET');



$Route->add('/my/admin/transcripts/{verifid}/edit', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->TranscriptInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);
    $Template->assign("Transcript", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($TranscriptInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");

    $Template->render("admin.edit-application");
}, 'GET');



$Route->add('/forms/admin/transcript/{transcriptid}/apply-update-admin', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    //$token = $Template->data['token'];
    //$Template->token($token );
    $accid = $Template->storage('accid');
    // $UserInfo = $Core->UserInfo($accid);

    $data = $Core->post($_POST);

    // $Core->setTrascriptInfo($transcriptid, "dob_day", $data->dob_day);
    // $Core->setTrascriptInfo($transcriptid, "dob_month", $data->dob_month);
    // $Core->setTrascriptInfo($transcriptid, "dob_year", $data->dob_year);
    // $Core->setTrascriptInfo($transcriptid, "dob", "{$data->dob_day}-{$data->dob_month}-{$data->dob_year}");

    $Core->setTrascriptInfo($transcriptid, "sendname", $data->sendname);
    $Core->setTrascriptInfo($transcriptid, "sendorg", $data->sendorg);
    $Core->setTrascriptInfo($transcriptid, "sendaddress", $data->sendaddress);
    $Core->setTrascriptInfo($transcriptid, "sendcountry", $data->sendcountry);

    $Core->setTrascriptInfo($transcriptid, "sessionadmitted", $data->sessionadmitted);
    $Core->setTrascriptInfo($transcriptid, "sessiongraduated", $data->sessiongraduated);
    $Core->setTrascriptInfo($transcriptid, "entrymode", $data->entrymode);
    $Core->setTrascriptInfo($transcriptid, "faculty", $data->faculty);
    $Core->setTrascriptInfo($transcriptid, "department", $data->department);
    $Core->setTrascriptInfo($transcriptid, "instructions", $data->instructions);

    $Core->setTrascriptInfo($transcriptid, "sendemail", $data->sendemail);
    $Core->setTrascriptInfo($transcriptid, "sendmobile", $data->sendmobile);

    $FileDir = "./_store/transcripts/{$accid}/documents";
    $handle = new \Verot\Upload\Upload($_FILES['documents']);
    if ($handle->uploaded) {
        $handle->file_new_name_body = sha1($_FILES['documents']['name'] .  time());
        $handle->dir_auto_create = true;
        $handle->file_overwrite = true;
        $handle->dir_chmod = 0777;
        $handle->process($FileDir);
        if ($handle->processed) {
            $file_url =  $handle->file_dst_pathname;
            $handle->clean();
            $Core->setTrascriptInfo($transcriptid, "documents", $file_url);
        }
    }

    // $Core->setTrascriptInfo($transcriptid, "progress", 2);

    //Email USer//
    // $Mailer = new Apps\Emailer();
    // $EmailTemplate = new Apps\EmailTemplate('mails.submitapplication');

    // $EmailTemplate->name = "{$UserInfo->surname} {$UserInfo->firstname}";
    // $EmailTemplate->applyId = $transcriptid;

    // $Mailer->subject = "iTranscript Submitted - #{$transcriptid}";
    // $Mailer->SetTemplate($EmailTemplate);
    // $Mailer->toEmail = $UserInfo->email;
    // $Mailer->toName = "{$UserInfo->surname} {$UserInfo->firstname}";
    // $Mailer->send();
    //Email USer//

    $Template->redirect("/my/admin/transcripts/{$transcriptid}/edit");
}, 'POST');



$Route->add('/my/admin/transcripts/{verifid}/view', function ($verifid) {

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

    $Template->render("admin.transcript_info");
}, 'GET');




$Route->add('/my/admin/transcripts/{verifid}/update', function ($verifid) {

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


    $Template->render("admin.transcript_status_update");
}, 'GET');


$Route->add('/admin/payments/{reference}/verify', function ($reference) {

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

                $Template->redirect("/my/admin/transactions?verified=true");

                //When Success//
            }

            $Template->redirect("/my/admin/transactions?verified=false");
        }
        //Collected Data//

    } catch (\Yabacon\Paystack\Exception\ApiException $e) {
        $Template->redirect("/my/admin/transactions?verified=false");
    }
}, 'GET');





$Route->add('/my/admin/transcripts/{verifid}/print', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
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

    $Template->render("admin.transcript_print");
}, 'GET');



$Route->add('/my/admin/transcripts/{verifid}/reciept', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
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

    $Template->render("admin.invoice_print");
}, 'GET');






$Route->add('/my/admin/verifications/{verifid}/print', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->VerificationInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($TranscriptInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");

    $Template->render("admin.verification_print");
}, 'GET');




$Route->add('/my/admin/verifications/{verifid}/reciept', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->VerificationInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);

    $InvoiceInfo = $Core->InvoiceInfo($TranscriptInfo->paymentid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);

    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $Template->assign("title", "Administrator - iTranscript");
    $Template->assign("dashboard", true);
    $Template->assign("menukey", "transcripts");

    $Template->render("admin.invoice_print");
}, 'GET');



$Route->add('/my/admin/payments/{verifid}/reciept', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.receiptheader");
    $Template->addfooter("layouts.receiptfooter");
    $InvoiceInfo = $Core->InvoiceInfo($verifid);
    if ($InvoiceInfo->product == 'transcript') {
        $Template->redirect("/my/admin/transcripts/{$InvoiceInfo->transcriptid}/reciept");
    } elseif ($InvoiceInfo->product == 'verification') {
        $Template->redirect("/my/admin/verifications/{$InvoiceInfo->verificationid}/reciept");
    }
}, 'GET');


$Route->add('/admin/payments/edit/{verifid}/reference', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $Template->assign("title", "Administrator - iTranscript");

    $InvoiceInfo = $Core->InvoiceInfo($verifid);
    $ThisUser = $Core->UserInfo($InvoiceInfo->accid);
    $Template->assign("InvoiceInfo", $InvoiceInfo);
    $Template->assign("ThisUser", $ThisUser);

    $Template->render("admin.reference");
}, 'GET');


$Route->add('/forms/my/admin/{verifid}/switch', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $VerificatinInfo = $Core->VerificationInfo($verifid);
    $Template->assign("VerificatinInfo", $VerificatinInfo);
    $AccidInfo = $Core->UserInfo($VerificatinInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $data = $Core->post($_POST);
    $switch = $data->target;

    $transcriptid = $Core->Verification2Transcript($verifid, $switch);

    $Template->redirect("my/admin/transcripts/{$transcriptid}/view");
}, 'POST');



$Route->add('/forms/my/admin/searchpayment', function () {
    $Core = new Apps\Core;

    $Template = new Apps\Template("/my/login");
    $Data = $Core->post($_POST);
    $query = $Data->query;

    $ThisUserInfo = $Core->UserInfo($query);
    $is_user = isset($ThisUserInfo->accid) ? true : false;
    if ($is_user) {
        $Template->redirect("/my/admin/accounts/{$ThisUserInfo->accid}/applications");
    }

    $TranscriptInfo = $Core->TranscriptInfo($query);
    $is_transcript = isset($TranscriptInfo->id) ? true : false;
    if ($is_transcript) {
        $Template->redirect("/my/admin/transcripts/{$TranscriptInfo->id}/view");
    }

    $VerificationInfo = $Core->VerificationInfo($query);
    $is_verification = isset($VerificationInfo->id) ? true : false;
    if ($is_verification) {
        $Template->redirect("/my/admin/verifications/{$VerificationInfo->id}/view");
    }

    $PaymentInfo = $Core->PaymentInfoByAll($query);
    $is_invoice = isset($PaymentInfo->id) ? true : false;
    if ($is_invoice) {
        $Template->redirect("/my/admin/payments/{$PaymentInfo->id}/reciept");
    }

    $Template->setError("No result found on the database for this search query.", "danger", "/my");
    $Template->redirect("/my");
}, 'POST');


$Route->add('/forms/my/admin/{verifid}/searchreference', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");

    $Transcript = $Core->TranscriptInfo($verifid);
    $TranscriptOwner = $Core->UserInfo($Transcript->accid);
    $TranscriptOwnerEmail = $TranscriptOwner->email;

    $Data = $Core->post($_POST);
    $reference = $Data->reference;

    $PaymentInfo = $Core->PaymentInfoByReference($reference);
    if (isset($PaymentInfo->accid)) {
        $Paystack = new Yabacon\Paystack(paystack_secrete);
        try {
            $tranx = $Paystack->transaction->verify([
                'reference' => $reference,
            ]);
            //Collected Data//
            $tranx_status = $tranx->status;
            if (!(int)$tranx_status) {
                $Template->setError("Payment not completed.", "danger", "/my/admin/transcripts/{$verifid}/view");
                $Template->redirect("/my/admin/transcripts/{$verifid}/view");
            }

            $PaymentData = $tranx->data;
            $PaymentCustomer = $PaymentData->customer;
            $PaymentEmail = $PaymentCustomer->email;

            $PayID = $PaymentInfo->id;

            if ($TranscriptOwnerEmail == $PaymentEmail) {

                if ($PaymentInfo->product == "verification") {
                    $Core->setVerificationInfo($Transcript->id, "progress", 1);
                } elseif ($PaymentInfo->product == "transcript") {
                    $Core->setTrascriptInfo($Transcript->id, "progress", 1);
                }

                $Core->SetPaymentInfo($PayID, "tranx_status_int", $tranx_status);
                $message = $tranx->message;
                $Core->SetPaymentInfo($PayID, "tranx_message", $message);

                //Store Data
                $Core->SetPaymentInfo($PayID, "tranx_data", json_encode($PaymentData));

                $id = $PaymentData->id;
                $Core->SetPaymentInfo($PayID, "tranx_id", $id);

                $domain = $PaymentData->domain;
                $Core->SetPaymentInfo($PayID, "tranx_domain", $domain);

                $status = $PaymentData->status;
                $Core->SetPaymentInfo($PayID, "tranx_status", $status);

                $amount = floatval($PaymentData->amount) / 100;
                $Core->SetPaymentInfo($PayID, "tranx_amount", $amount);

                $message = $PaymentData->message;
                $Core->SetPaymentInfo($PayID, "message", $message);

                $gateway_response = $PaymentData->gateway_response;
                $Core->SetPaymentInfo($PayID, "tranx_gateway_response", $gateway_response);

                $paid_at = $PaymentData->paid_at;
                $Core->SetPaymentInfo($PayID, "tranx_paid_at", $paid_at);

                $channel = $PaymentData->channel;
                $Core->SetPaymentInfo($PayID, "tranx_channel", $channel);

                $currency = $PaymentData->currency;
                $Core->SetPaymentInfo($PayID, "tranx_currency", $currency);

                $ip_address = $PaymentData->ip_address;
                $Core->SetPaymentInfo($PayID, "tranx_ip_address", $ip_address);

                //Store Log
                $log = $PaymentData->log;
                $Core->SetPaymentInfo($PayID, "tranx_log", json_encode($log));

                $Template->setError("Payment is successfully linked.", "success", "/my/admin/transcripts/{$verifid}/view");
                $Template->redirect("/my/admin/transcripts/{$verifid}/view");
            }

            //Collected Data//

        } catch (\Yabacon\Paystack\Exception\ApiException $e) {
            $Template->redirect("/my/admin/transcripts/{$verifid}/view");
        }
    }

    $TranscriptInfo = $Core->TranscriptInfo($verifid);


    $Template->assign("TranscriptInfo", $TranscriptInfo);
    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $data = $Core->post($_POST);
    $switch = $data->target;

    $transcriptid = $Core->Transcript2Verification($verifid, $switch);

    $Template->redirect("my/admin/verifications/{$transcriptid}/view");
}, 'POST');




$Route->add('/forms/my/admin/{verifid}/switch2verification', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->TranscriptInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);
    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $data = $Core->post($_POST);
    $switch = $data->target;

    $transcriptid = $Core->Transcript2Verification($verifid, $switch);

    $Template->redirect("my/admin/verifications/{$transcriptid}/view");
}, 'POST');



$Route->add('/forms/my/admin/{verifid}/transcript/statusupdate', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->TranscriptInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);
    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $data = $Core->post($_POST);
    $status = $data->status;
    $status_message = $data->status_message;

    $Core->AdminUpdateStatus($verifid, $TranscriptInfo->accid, $status, $status_message, $accid);

    $Template->redirect("/my/admin/transcripts/{$verifid}/update");
}, 'POST');




$Route->add('/forms/my/admin/{verifid}/transcript/userstatusupdate', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->TranscriptInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);
    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $data = $Core->post($_POST);
    $status_message = $data->status_message;

    $Core->UserUpdateStatus($verifid, $TranscriptInfo->accid, $status_message, $accid);

    $Template->redirect("/my/apps/transcripts/{$verifid}/status");
}, 'POST');


$Route->add('/forms/my/admin/{statusid}/transcript/statusupdate/delete', function ($statusid) {

    $Template = new Apps\Template("/my/login");
    $Core = new Apps\Core;
    $StatusUpdateInfo = $Core->StatusUpdateInfo($statusid);
    $verifid = $StatusUpdateInfo->productid;

    $del = $Core->mysqli("DELETE esut_updates.* FROM esut_updates WHERE id='$statusid'");

    $Template->redirect("/my/admin/transcripts/{$verifid}/update");
}, 'GET');



$Route->add('/forms/my/user/{statusid}/transcript/statusupdate/delete', function ($statusid) {

    $Template = new Apps\Template("/my/login");
    $Core = new Apps\Core;
    $StatusUpdateInfo = $Core->StatusUpdateInfo($statusid);
    $verifid = $StatusUpdateInfo->productid;

    $del = $Core->mysqli("DELETE esut_updates.* FROM esut_updates WHERE id='$statusid'");

    $Template->redirect("/my/apps/transcripts/{$verifid}/status");
}, 'GET');


$Route->add('/forms/my/admin/{verifid}/switch2transcript', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);

    $TranscriptInfo = $Core->VerificationInfo($verifid);
    $Template->assign("TranscriptInfo", $TranscriptInfo);
    $AccidInfo = $Core->UserInfo($TranscriptInfo->accid);
    $Template->assign("AccidInfo", $AccidInfo);

    $data = $Core->post($_POST);
    $switch = $data->target;

    $transcriptid = $Core->Verification2Transcript($verifid, $switch);

    $Template->redirect("my/admin/transcripts/{$transcriptid}/view");
}, 'POST');



$Route->add('/my/admin/accounts/{thisaccid}/applications', function ($thisaccid) {

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


    $Template->render("admin.user_transcripts");
}, 'GET');


$Route->add('/my/admin/accounts/{thisaccid}/transactions', function ($thisaccid) {

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


    $Template->render("admin.user_transactions");
}, 'GET');



$Route->add('/forms/my/user/{uaccid}/setadmin', function ($uaccid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $AccidInfo = $Core->UserInfo($uaccid);

    $Data = $Core->post($_POST);
    if (isset($Data->is_admin)) {
        $is_admin = $Data->is_admin;
        $Core->setUserInfo($AccidInfo->accid, "is_admin", $is_admin);
    } else {
        $Core->setUserInfo($AccidInfo->accid, "is_admin", 0);
    }
    $Template->redirect("/my/admin/accounts/{$AccidInfo->accid}/view");
}, 'POST');




$Route->add('/forms/my/user/{uaccid}/setaccid', function ($uaccid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $AccidInfo = $Core->UserInfo($uaccid);

    $Data = $Core->post($_POST);


    if (isset($Data->email))
        $Core->setUserInfo($uaccid, "email", $Data->email);
    if (isset($Data->surname))
        $Core->setUserInfo($uaccid, "surname", $Data->surname);
    if (isset($Data->firstname))
        $Core->setUserInfo($uaccid, "firstname", $Data->firstname);
    if (isset($Data->middlename))
        $Core->setUserInfo($uaccid, "middlename", $Data->middlename);
    if (isset($Data->mobile))
        $Core->setUserInfo($uaccid, "mobile", $Data->mobile);
    if (isset($Data->sex))
        $Core->setUserInfo($uaccid, "sex", $Data->sex);
    if (isset($Data->address))
        $Core->setUserInfo($uaccid, "address", $Data->address);
    if (isset($Data->country))
        $Core->setUserInfo($uaccid, "country", $Data->country);
    if (isset($Data->dob_day))
        $Core->setUserInfo($uaccid, "dob_day", $Data->dob_day);
    if (isset($Data->dob_month))
        $Core->setUserInfo($uaccid, "dob_month", $Data->dob_month);
    if (isset($Data->dob_year))
        $Core->setUserInfo($uaccid, "dob_year", $Data->dob_year);

    $Template->redirect("/my/admin/accounts/{$AccidInfo->accid}/view");
}, 'POST');
