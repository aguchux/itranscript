<?php



$Route->add('/forms/my/admin/searchtransactions', function () {
    $Core = new Apps\Core;

    $Template = new Apps\Template("/my/login");
    $Data = $Core->post($_POST);

    $Template->debug($Data);

    $Template->redirect("/my");
}, 'POST');





$Route->add('/forms/my/login', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;

    //$token = $Template->data['token'];
    //$Template->token($token );

    $data = $Core->post($_POST);

    $email = $data->email;
    $password = $data->password;

    $Login = $Core->EsutLogin($email, $password);
    $accid = (int)$Login->accid;

    if ($accid) {

        if (use_quick_login) {
            if (demo) {
                if (in_array($email, demo_account)) {
                    $Template->authorize($accid);
                    $Template->redirect("/my");
                }
                $Template->setError("We are currently updating the site, try again later.", "danger", "/my/login");
                $Template->redirect("/my/login");
            } else {
                $Template->authorize($accid);
                $Template->redirect("/my");
            }
        } else {
            $verified = (int)$Login->verified;
            if ($verified) {
                if (demo) {
                    if (in_array($email, demo_account)) {
                        $Template->authorize($accid);
                        $Template->redirect("/my");
                    }
                    $Template->setError("We are currently updating the site, try again later.", "danger", "/my/login");
                    $Template->redirect("/my/login");
                } else {
                    $Template->authorize($accid);
                    $Template->redirect("/my");
                }
            } else {
                //Email USer//
                $Mailer = new Apps\Emailer();
                $EmailTemplate = new Apps\EmailTemplate('mails.do_verify');
                $EmailTemplate->vericode =  $Login->vericode;

                $Mailer->subject = "Verify your email";
                $Mailer->SetTemplate($EmailTemplate);
                $Mailer->toEmail = $Login->email;
                $Mailer->send();
                //Email USer//

                $Template->store("vericode", $Login->vericode);
                $Template->redirect("/my/do-verify");
            }
        }
    }
    $Template->setError("Invalid Username and Password.", "danger", "/my/login");
    $Template->redirect("/my/login");
}, 'POST');



$Route->add('/forms/my/user/quicklogin', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $data = $Core->post($_POST);

    $Template->cleanAll(session_delete_timout);

    $email = $data->email;
    $password = $data->password;

    $Login = $Core->EsutLogin($email, $password, false);

    $accid = (int)$Login->accid;

    if ($accid) {
        $Template->authorize($accid);
        $Template->redirect("/my");
    }

    $Template->redirect("/my/accounts?failed=+");
}, 'POST');



$Route->add('/forms/my/register', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;

    //$token = $Template->data['token'];
    //$Template->token($token );

    $data = $Core->post($_POST);

    $surname = $data->surname;
    $firstname = $data->firstname;

    $email = $data->email;
    $password = $data->password;
    $password_repeat = $data->password_repeat;
    if ($password_repeat != $password) {
        $Template->redirect("/my/register");
    }

    $HasUser = $Core->UserInfo($email);
    $exist = (int)$HasUser->accid;
    if ($exist) {
        $Template->setError("Email is already registered with us", "danger", "/my/register");
        $Template->redirect("/my/register");
    }

    $accid = $Core->EsutRegister($email, $password, $surname, $firstname);
    if ($accid) {

        $UserInfo = $Core->UserInfo($accid);

        //Email USer//
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.signup');
        $EmailTemplate->vericode =  $UserInfo->vericode;

        $Mailer->subject = "Welcome, verify your email";
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $UserInfo->email;
        $Mailer->send();
        //Email USer//

        if (use_quick_login) {
            $Template->authorize($accid);
            $Template->redirect("/my");
        }

        $Template->store("vericode", $UserInfo->vericode);
        $Template->redirect("/my/verify");
    }

    $Template->setError("Account registration failed", "danger", "/my/register");
    $Template->redirect("/my/register");
}, 'POST');



$Route->add('/forms/my/reset', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;

    //$token = $Template->data['token'];
    //$Template->token($token );

    $data = $Core->post($_POST);

    $email = $data->email;
    $UserInfo = $Core->UserInfo($email);

    if (!$UserInfo->accid) {
        $Template->redirect("/my/reset");
    }

    //Email USer//
    $Mailer = new Apps\Emailer();
    $EmailTemplate = new Apps\EmailTemplate('mails.reset');
    $EmailTemplate->vericode =  $UserInfo->vericode;
    $Mailer->subject = "Reset password request";
    $Mailer->SetTemplate($EmailTemplate);
    $Mailer->toEmail = $UserInfo->email;
    $Mailer->send();
    //Email USer//

    $Template->store('vericode', $UserInfo->vericode);
    $Template->redirect("/my/reset-done");
}, 'POST');



$Route->add('/forms/my/edit-profile', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    //$token = $Template->data['token'];
    //$Template->token($token );
    $accid = $Template->storage('accid');

    $data = $Core->post($_POST);

    $Core->SetUserInfo($accid, "surname", $data->surname);
    $Core->SetUserInfo($accid, "firstname", $data->firstname);
    $Core->SetUserInfo($accid, "middlename", $data->middlename);
    $Core->SetUserInfo($accid, "mobile", $data->mobile);
    $Core->SetUserInfo($accid, "address", $data->address);
    $Core->SetUserInfo($accid, "sex", $data->sex);
    $Core->SetUserInfo($accid, "country", $data->country);
    $Core->SetUserInfo($accid, "dob_day", $data->dob_day);
    $Core->SetUserInfo($accid, "dob_month", $data->dob_month);
    $Core->SetUserInfo($accid, "dob_year", $data->dob_year);
    $Core->SetUserInfo($accid, "dob", "{$data->dob_year}-{$data->dob_month}-{$data->dob_day}");

    $Template->redirect("/my");
}, 'POST');





$Route->add('/forms/my/edit-settings', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    $data = $Core->post($_POST);

    $use_default_split = 0;
    if (isset($data->use_default_split)) {
        $use_default_split = $data->use_default_split;
    }
    $Core->SetSettingsInfo(1, "use_default_split", $use_default_split);


    $Monday = 0;
    if (isset($data->Monday)) {
        $Monday = $data->Monday;
    }
    $Core->SetSettingsInfo(1, "Monday", $Monday);

    $Tuesday = 0;
    if (isset($data->Tuesday)) {
        $Tuesday = $data->Tuesday;
    }
    $Core->SetSettingsInfo(1, "Tuesday", $Tuesday);

    $Wednesday = 0;
    if (isset($data->Wednesday)) {
        $Wednesday = $data->Wednesday;
    }
    $Core->SetSettingsInfo(1, "Wednesday", $Wednesday);

    $Thursday = 0;
    if (isset($data->Thursday)) {
        $Thursday = $data->Thursday;
    }
    $Core->SetSettingsInfo(1, "Thursday", $Thursday);

    $Friday = 0;
    if (isset($data->Friday)) {
        $Friday = $data->Friday;
    }
    $Core->SetSettingsInfo(1, "Friday", $Friday);

    $Saturday = 0;
    if (isset($data->Saturday)) {
        $Saturday = $data->Saturday;
    }
    $Core->SetSettingsInfo(1, "Saturday", $Saturday);

    $Sunday = 0;
    if (isset($data->Sunday)) {
        $Sunday = $data->Sunday;
    }
    $Core->SetSettingsInfo(1, "Sunday", $Sunday);


    $Template->redirect("/my/admin/edit-settings");
}, 'POST');




$Route->add('/forms/my/transcript/apply', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    //$token = $Template->data['token'];
    //$Template->token($token );
    $accid = $Template->storage('accid');
    $UserInfo = $Core->UserInfo($accid);

    $data = $Core->post($_POST);

    $international = 0;
    if (isset($data->international)) {
        $international = 1;
    }

    $matricnumber = $data->matricnumber;
    $payment_mode = $data->payment_mode;

    $applyId = $Core->StartApplyTranscript($accid, $matricnumber, $payment_mode, $international);
    if ($applyId) {

        //Email USer//
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.newapplication');

        $EmailTemplate->name = "{$UserInfo->surname} {$UserInfo->firstname}";
        $EmailTemplate->applyId = $applyId;

        $Mailer->subject = "iTranscript Application - #{$applyId}";
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $UserInfo->email;
        $Mailer->toName = "{$UserInfo->surname} {$UserInfo->firstname}";
        $Mailer->send();
        //Email USer//

    }

    $Template->redirect("/my/apps/payments");
}, 'POST');





$Route->add('/forms/my/transcript/transcript-verification', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    $token = $Template->data['token'];
    $Template->token($token);

    $accid = $Template->storage('accid');
    $UserInfo = $Core->UserInfo($accid);

    $data = $Core->post($_POST);

    $international = 0;
    if (isset($data->international)) {
        $international = 1;
    }

    $matricnumber = $data->matricnumber;
    $payment_mode = $data->payment_mode;

    $applyId = $Core->StartVerifyTranscript($accid, $matricnumber, $payment_mode, $international);
    if ($applyId) {

        //Email USer//
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.newtranscriptverify');

        $EmailTemplate->name = "{$UserInfo->surname} {$UserInfo->firstname}";
        $EmailTemplate->applyId = $applyId;

        $Mailer->subject = "iTranscript Verification - #{$applyId}";
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $UserInfo->email;
        $Mailer->toName = "{$UserInfo->surname} {$UserInfo->firstname}";
        $Mailer->send();
        //Email USer//

    }
    $Template->redirect("/my/apps/payments");
}, 'POST');




$Route->add('/forms/my/transcript/certificate-verification', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    $token = $Template->data['token'];
    $Template->token($token);

    $accid = $Template->storage('accid');
    $UserInfo = $Core->UserInfo($accid);

    $data = $Core->post($_POST);

    $matricnumber = $data->matricnumber;
    $payment_mode = $data->payment_mode;

    $applyId = $Core->StartVerifyCertificate($accid, $matricnumber, $payment_mode);
    if ($applyId) {

        //Email USer//
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.newcertificateverify');

        $EmailTemplate->name = "{$UserInfo->surname} {$UserInfo->firstname}";
        $EmailTemplate->applyId = $applyId;

        $Mailer->subject = "Certificate Verification - #{$applyId}";
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $UserInfo->email;
        $Mailer->toName = "{$UserInfo->surname} {$UserInfo->firstname}";
        $Mailer->send();
        //Email USer//

    }

    $Template->redirect("/my/apps/payments");
}, 'POST');



$Route->add('/forms/my/transcript/{transcriptid}/apply-start', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    //$token = $Template->data['token'];
    //$Template->token($token );
    $accid = $Template->storage('accid');
    $UserInfo = $Core->UserInfo($accid);

    $data = $Core->post($_POST);

    $Core->setTrascriptInfo($transcriptid, "dob_day", $data->dob_day);
    $Core->setTrascriptInfo($transcriptid, "dob_month", $data->dob_month);
    $Core->setTrascriptInfo($transcriptid, "dob_year", $data->dob_year);
    $Core->setTrascriptInfo($transcriptid, "dob", "{$data->dob_day}-{$data->dob_month}-{$data->dob_year}");

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

    $Core->setTrascriptInfo($transcriptid, "progress", 2);

    //Email USer//
    $Mailer = new Apps\Emailer();
    $EmailTemplate = new Apps\EmailTemplate('mails.submitapplication');

    $EmailTemplate->name = "{$UserInfo->surname} {$UserInfo->firstname}";
    $EmailTemplate->applyId = $transcriptid;

    $Mailer->subject = "iTranscript Submitted - #{$transcriptid}";
    $Mailer->SetTemplate($EmailTemplate);
    $Mailer->toEmail = $UserInfo->email;
    $Mailer->toName = "{$UserInfo->surname} {$UserInfo->firstname}";
    $Mailer->send();
    //Email USer//

    $Template->redirect("/my/{$transcriptid}/apply-completed");
}, 'POST');



$Route->add('/forms/my/transcript/{transcriptid}/apply-start-verify-certificate', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    $token = $Template->data['token'];
    $Template->token($token);

    $accid = $Template->storage('accid');
    $UserInfo = $Core->UserInfo($accid);

    $data = $Core->post($_POST);

    $Core->setTrascriptInfo($transcriptid, "dob_day", $data->dob_day);
    $Core->setTrascriptInfo($transcriptid, "dob_month", $data->dob_month);
    $Core->setTrascriptInfo($transcriptid, "dob_year", $data->dob_year);
    $Core->setTrascriptInfo($transcriptid, "dob", "{$data->dob_day}-{$data->dob_month}-{$data->dob_year}");

    $Core->setVerificationInfo($transcriptid, "sendname", $data->sendname);
    $Core->setVerificationInfo($transcriptid, "sendorg", $data->sendorg);
    $Core->setVerificationInfo($transcriptid, "sendaddress", $data->sendaddress);
    $Core->setVerificationInfo($transcriptid, "sendcountry", $data->sendcountry);

    $Core->setVerificationInfo($transcriptid, "sessionadmitted", $data->sessionadmitted);
    $Core->setVerificationInfo($transcriptid, "sessiongraduated", $data->sessiongraduated);
    $Core->setVerificationInfo($transcriptid, "entrymode", $data->entrymode);
    $Core->setVerificationInfo($transcriptid, "faculty", $data->faculty);
    $Core->setVerificationInfo($transcriptid, "department", $data->department);

    $Core->setVerificationInfo($transcriptid, "sendemail", $data->sendemail);
    $Core->setVerificationInfo($transcriptid, "sendmobile", $data->sendmobile);

    $Core->setVerificationInfo($transcriptid, "progress", 2);

    //Email USer//
    $Mailer = new Apps\Emailer();
    $EmailTemplate = new Apps\EmailTemplate('mails.submitapplication');

    $EmailTemplate->name = "{$UserInfo->surname} {$UserInfo->firstname}";
    $EmailTemplate->applyId = $transcriptid;

    $Mailer->subject = "Verification Submitted - #{$transcriptid}";
    $Mailer->SetTemplate($EmailTemplate);
    $Mailer->toEmail = $UserInfo->email;
    $Mailer->toName = "{$UserInfo->surname} {$UserInfo->firstname}";
    $Mailer->send();
    //Email USer//

    $Template->redirect("/my/{$transcriptid}/apply-completed");
}, 'POST');


$Route->add('/forms/my/transcript/{transcriptid}/apply-start-verify-transcript', function ($transcriptid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/my/login");

    $token = $Template->data['token'];
    $Template->token($token);

    $accid = $Template->storage('accid');
    $UserInfo = $Core->UserInfo($accid);

    $data = $Core->post($_POST);

    $Core->setTrascriptInfo($transcriptid, "dob_day", $data->dob_day);
    $Core->setTrascriptInfo($transcriptid, "dob_month", $data->dob_month);
    $Core->setTrascriptInfo($transcriptid, "dob_year", $data->dob_year);
    $Core->setTrascriptInfo($transcriptid, "dob", "{$data->dob_day}-{$data->dob_month}-{$data->dob_year}");

    $Core->setVerificationInfo($transcriptid, "sendname", $data->sendname);
    $Core->setVerificationInfo($transcriptid, "sendorg", $data->sendorg);
    $Core->setVerificationInfo($transcriptid, "sendaddress", $data->sendaddress);
    $Core->setVerificationInfo($transcriptid, "sendcountry", $data->sendcountry);

    $Core->setVerificationInfo($transcriptid, "sessionadmitted", $data->sessionadmitted);
    $Core->setVerificationInfo($transcriptid, "sessiongraduated", $data->sessiongraduated);
    $Core->setVerificationInfo($transcriptid, "entrymode", $data->entrymode);
    $Core->setVerificationInfo($transcriptid, "faculty", $data->faculty);
    $Core->setVerificationInfo($transcriptid, "department", $data->department);

    $Core->setVerificationInfo($transcriptid, "sendemail", $data->sendemail);
    $Core->setVerificationInfo($transcriptid, "sendmobile", $data->sendmobile);

    $Core->setVerificationInfo($transcriptid, "progress", 2);

    //Email USer//
    $Mailer = new Apps\Emailer();
    $EmailTemplate = new Apps\EmailTemplate('mails.submitapplication');

    $EmailTemplate->name = "{$UserInfo->surname} {$UserInfo->firstname}";
    $EmailTemplate->applyId = $transcriptid;

    $Mailer->subject = "Verification Submitted - #{$transcriptid}";
    $Mailer->SetTemplate($EmailTemplate);
    $Mailer->toEmail = $UserInfo->email;
    $Mailer->toName = "{$UserInfo->surname} {$UserInfo->firstname}";
    $Mailer->send();
    //Email USer//

    $Template->redirect("/my/{$transcriptid}/apply-completed");
}, 'POST');



$Route->add('/form/payments/edit/{verifid}/reference', function ($verifid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template;

    $data = $Core->post($_POST);
    $reference = $data->reference;

    $PaymentInfo = $Core->PaymentInfoByAll($verifid);
    $clientAccid = $PaymentInfo->accid;
    $Client = $Core->UserInfo($clientAccid);
    $clientEmail = strtolower($Client->email);

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
        //Collected Data//

        $PaymentData = $tranx->data;
        $PaymentCustomer = $PaymentData->customer;
        $PaymentEmail = strtolower($PaymentCustomer->email);

        //Only allow reference lined to user email on paystack//
        if ($clientEmail == $PaymentEmail) {

            $done = (int)$Core->SetPaymentInfo($verifid, "reference", $reference);
            if ($done) {
                $Template->redirect("/admin/payments/edit/{$verifid}/reference?done=true");
            }
            $Template->redirect("/admin/payments/edit/{$verifid}/reference?done=false");
        }
        //Only allow reference lined to user email on paystack//
        $Template->redirect("/admin/payments/edit/{$verifid}/reference");
    } catch (\Yabacon\Paystack\Exception\ApiException $e) {
        $Template->redirect("/my/admin/transcripts/{$verifid}/view");
    }
}, 'POST');



$Route->add('/forms/my/new-password', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;

    //$token = $Template->data['token'];
    //$Template->token($token );

    $data = $Core->post($_POST);

    $vericode = $Template->storage("vericode");
    $UserInfo = $Core->UserInfo($vericode);

    $password = $data->password;
    $password_repeat = $data->password_repeat;
    if ($password != $password_repeat) {
        $Template->redirect("/my/{vericode}/reset");
    }

    $password = $Core->Passwordify($password);
    $done = (int)$Core->SetUserInfo($vericode, "password", $password);

    if ($done) {
        //Email USer//
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.passwordchanged');
        $EmailTemplate->vericode =  $UserInfo->vericode;
        $Mailer->subject = "Password Changed";
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $UserInfo->email;
        $Mailer->send();
        //Email USer//
    }

    $Template->removedata('vericode');
    $Template->redirect("/my/password-changed");
}, 'POST');
