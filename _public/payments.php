<?php


$Route->add('/forms/my/payments/{payid}/prepay', function ($payid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $accid = $Template->data["accid"];
    $UserInfo = $Core->UserInfo($accid);

    $InvoiceInfo = $Core->InvoiceInfo($payid);

    if ($InvoiceInfo->product == "verification") {
        $TranscriptInfo = $Core->VerificationInfo($InvoiceInfo->verificationid);
    } elseif ($InvoiceInfo->product == "transcript") {
        $TranscriptInfo = $Core->TranscriptInfo($InvoiceInfo->transcriptid);
    }
    $invoiceid = $InvoiceInfo->id;
    $method = "card";
    $amount = $InvoiceInfo->amount;

    if ($method == "card") {

        $amount = floatval($amount * 100);
        $Paystack = new Yabacon\Paystack(paystack_secrete);

        $reference = md5($InvoiceInfo->reference . time());
        $Core->SetPaymentInfo($invoiceid, "reference", $reference);
        $InvoiceInfo = $Core->InvoiceInfo($payid);

        try {

            if (demo) {

                $tranx = $Paystack->transaction->initialize([
                    'amount' => $amount,
                    'email' => $UserInfo->email,
                    'mobile' => $UserInfo->mobile,
                    'reference' => $reference
                ]);

                $data = $tranx->data;
                $authorization_url = $data->authorization_url;
                $access_code = $data->access_code;
                $reference = $data->reference;

                $Core->SetPaymentInfo($invoiceid, "authorization_url", $authorization_url);
                $Core->SetPaymentInfo($invoiceid, "access_code", $access_code);
                $Core->SetPaymentInfo($invoiceid, "method", $method);
                $Core->SetPaymentInfo($invoiceid, "reference", $reference);
            } else {

                if (use_paystack_split_pay) {

                    $splitit = 0;
                    $SiteSettings = $Core->SiteSettings();
                    $use_default_split = $SiteSettings->use_default_split;
                    $Today = date("l");
                    if ($SiteSettings->$Today && $use_default_split) {
                        $splitit =  1;
                    }

                    if ($InvoiceInfo->product == "verification") {

                        if ($TranscriptInfo->verify == "transcript") {

                            if ($TranscriptInfo->international) {
                                $tranx = $Paystack->transaction->initialize([
                                    'amount' => $amount,
                                    'email' => $UserInfo->email,
                                    'mobile' => $UserInfo->mobile,
                                    'reference' => $reference,
                                    'split_code' => $splitit ? _35k_Split : esut_35k_Split
                                ]);
                            } else {
                                $tranx = $Paystack->transaction->initialize([
                                    'amount' => $amount,
                                    'email' => $UserInfo->email,
                                    'mobile' => $UserInfo->mobile,
                                    'reference' => $reference,
                                    'split_code' =>  $splitit ? _20k_Split : esut_20k_Split
                                ]);
                            }
                        } elseif ($TranscriptInfo->verify == "certificate") {

                            $tranx = $Paystack->transaction->initialize([
                                'amount' => $amount,
                                'email' => $UserInfo->email,
                                'mobile' => $UserInfo->mobile,
                                'reference' => $reference,
                                'split_code' => $splitit ? _20k_Split :  esut_20k_Split
                            ]);
                        }
                    } elseif ($InvoiceInfo->product == "transcript") {

                        if ($TranscriptInfo->international) {
                            $tranx = $Paystack->transaction->initialize([
                                'amount' => $amount,
                                'email' => $UserInfo->email,
                                'mobile' => $UserInfo->mobile,
                                'reference' => $reference,
                                'split_code' => $splitit ? _35k_Split : esut_35k_Split
                            ]);
                        } else {
                            $tranx = $Paystack->transaction->initialize([
                                'amount' => $amount,
                                'email' => $UserInfo->email,
                                'mobile' => $UserInfo->mobile,
                                'reference' => $reference,
                                'split_code' => $splitit ? _15k_Split : esut_15k_Split
                            ]);
                        }
                    }
                } else {
                    $tranx = $Paystack->transaction->initialize([
                        'amount' => $amount,
                        'email' => $UserInfo->email,
                        'mobile' => $UserInfo->mobile,
                        'reference' => $reference
                    ]);
                }

                $data = $tranx->data;
                $authorization_url = $data->authorization_url;
                $access_code = $data->access_code;
                $reference = $data->reference;

                $Core->SetPaymentInfo($invoiceid, "authorization_url", $authorization_url);
                $Core->SetPaymentInfo($invoiceid, "access_code", $access_code);
                $Core->SetPaymentInfo($invoiceid, "method", $method);
                $Core->SetPaymentInfo($invoiceid, "reference", $reference);
            }
            $Template->redirect("/my/apps/{$invoiceid}/prepay");
        } catch (\Yabacon\Paystack\Exception\ApiException $e) {
            $Core->debug($e);
        }
    } elseif ($method == "deposit") {
    }
}, 'POST');




$Route->add('/payment/callback', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $data = $Core->post($_REQUEST);

    $accid = $Template->data["accid"];
    $UserInfo = $Core->UserInfo($accid);

    $trxref = $data->trxref;
    $reference = $data->reference;

    $PaymentInfo = $Core->PaymentInfoByReference($reference);

    //$Template->debug($PaymentInfo);

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
                $data = $tranx->data;
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

                //Email USer//
                $Mailer = new Apps\Emailer();
                $EmailTemplate = new Apps\EmailTemplate('mails.paid');

                $EmailTemplate->fullname = "{$UserInfo->surname} {$UserInfo->firstname}";
                $EmailTemplate->transcriptid = $PaymentInfo->transcriptid;
                $EmailTemplate->invoice = $PayID;
                $EmailTemplate->reference = $PaymentInfo->reference;
                $EmailTemplate->amount = $Core->Money($PaymentInfo->amount);

                $Mailer->subject = "iTranscript Payment Reciept - #{$PayID}";
                $Mailer->SetTemplate($EmailTemplate);
                $Mailer->toEmail = $UserInfo->email;
                $Mailer->toName = "{$UserInfo->surname} {$UserInfo->firstname}";
                $Mailer->send();
                //Email USer//

                $Template->redirect("/payments/{$PayID}/completed");
            }

            $Template->redirect("/payments/{$PayID}/failed");
        }
        //Collected Data//

    } catch (\Yabacon\Paystack\Exception\ApiException $e) {
        $Template->redirect("/payments");
    }
}, 'GET');
