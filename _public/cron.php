<?php

$Route->add('/crons/delete-upaid-applications', function () {
    $myId = 6719351;
    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $UnpaidInvoices = $Core->UnpaidInvoices(num_to_delete);
    while ($payment = mysqli_fetch_object($UnpaidInvoices)) {
        $created = $payment->created;
        $now = new DateTime();
        $date = new DateTime($created);
        $diff = $now->diff($date);
        $days = (int)$diff->format("%a");
        // echo "{$days} protected id<hr/>";
        if ($days >= day_to_delete) {
            $transcriptid = (int)$payment->transcriptid;
            if ($transcriptid > 0) {
                $Core->setTrascriptInfo($transcriptid, "todelete", 1);
                $Core->SetPaymentInfo($payment->id, "todelete", 1);
            } else {
                $verificationid = (int)$payment->verificationid;
                if ($verificationid > 0) {
                    $Core->setVerificationInfo($verificationid, "todelete", 1);
                    $Core->SetPaymentInfo($payment->id, "todelete", 1);
                }
            }
        }
    }
}, 'GET');


$Route->add('/crons/delete-marked-applications', function () {
    $Core = new Apps\Core;
    $Core->DeleteMarkedApplications();
    $Core->DeleteMarkedInvoices();
}, 'GET');
