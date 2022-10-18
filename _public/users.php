<?php


$Route->add(
    '/users',
    function () {
        $Core = new Apps\Core;
        $Template = new Apps\Template("/auth/users/login");

        $uid = $Template->data['uid'];
        $ClientInfo = $Core->UserInfo($uid);

        $Template->assign("Transactions", $Core->ClientTransactions($Template->data['uid']));
        $Template->assign("UserInfo", $ClientInfo);

        $Template->addheader("layouts.users.header");
        $Template->addfooter("layouts.users.footer");
        $Template->assign("menukey", "dashboard");

        $Template->render("users.dashboard");
    },
    'GET'
);



$Route->add('/users/{page}', function ($page) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/auth/users/login");
    $Template->addheader("layouts.users.header");
    $Template->addfooter("layouts.users.footer");

    $uid = $Template->data['uid'];
    $UserInfo = $Core->ClientInfo($uid);
    $Template->assign("UserInfo", $UserInfo);

    $Template->assign("menukey", $page);
    switch ($page) {
        case 'tickets':
            # code...
            break;
        case 'shop':
            $Template->assign("has_stake", false);
            $Template->assign("Transactions", $Core->ClientTransactions($Template->data['uid']));
            $Template->assign("Odds", $Core->Odds());
            if(isset($Template->data['stake'])){
                $stake = $Template->data['stake'];
                $Template->assign("Stake", $stake);
                $Template->assign("has_stake", true);
                $odds = count($stake['odds']);
                $Template->assign("odds_stakes", $stake['odds']);
                $Template->assign("count_stakes", $odds);
            }
            break;
        case 'odds':
            $Odds = $Core->AdminOdds();
            $Template->assign("Odds", $Odds);
            $MyTransactions = $Core->ClientTransactions($Template->data['uid']);
            $Template->assign("Transactions", $MyTransactions);
            # code...
            break;
        case 'payments':
            $MyTransactions = $Core->ClientTransactions($Template->data['uid']);
            $Template->assign("Transactions", $MyTransactions);
            break;
    }

    $Template->render("users.{$page}");
}, 'GET');






$Route->add('/users/shop/odds/{oddid}/play', function ($oddid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/auth/login");
    $Template->addheader("layouts.users.header");
    $Template->addfooter("layouts.users.footer");

    $uid = $Template->data['uid'];
    $UserInfo = $Core->ClientInfo($uid);
    $Template->assign("UserInfo", $UserInfo);
    $Template->assign("menukey", "shop");

    $Template->assign("Transactions", $Core->ClientTransactions($uid));
    $Template->assign("Odds", $Core->Odds());
    $Template->assign("OddsInfo", $Core->OddsInfo($oddid));

    $Template->render("users.shop");
}, 'GET');




$Route->add('/users/shop/odds/{oddid}/combine', function ($oddid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/auth/login");

    $uid = $Template->data['uid'];

    $stake = array();
    if (isset($Template->data['stake'])) {
        $stake = $Template->data["stake"];
        $stake['uid'] = $uid;
        $odds = $stake['odds'];
        $odds[] = $oddid;
        $stake = array(
            "uid" => $uid,
            "odds" => array_unique($odds)
        );
        $Template->store("stake", $stake);
    } else {
        $odds = array();
        $odds[] = $oddid;
        $stake = array(
            "uid" => $uid,
            "odds" => array_unique($odds)
        );
        $Template->store("stake", $stake);
    }

    $Template->redirect("/users/shop");

}, 'GET');


$Route->add('/users/shop/odds/{oddid}/combine', function ($oddid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/auth/login");

    $uid = $Template->data['uid'];

    $stake = array();
    if (isset($Template->data['stake'])) {
        $stake = $Template->data["stake"];
        $stake['uid'] = $uid;
        $odds = $stake['odds'];
        $odds[] = $oddid;
        $stake = array(
            "uid" => $uid,
            "odds" => array_unique($odds)
        );
        $Template->store("stake", $stake);
    } else {
        $odds = array();
        $odds[] = $oddid;
        $stake = array(
            "uid" => $uid,
            "odds" => array_unique($odds)
        );
        $Template->store("stake", $stake);
    }

    $Template->redirect("/users/shop");

}, 'GET');



$Route->add('/users/shop/transactions/{transid}/invoice', function ($transid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template("/auth/login");
    $Template->addheader("layouts.users.header");
    $Template->addfooter("layouts.users.footer");

    $accid = $Template->data['accid'];
    $UserInfo = $Core->UserInfo($accid);
    $role = $UserInfo->role;

    $TransactionInfo = $Core->TransactionInfo($transid);
    $Template->assign("TransactionInfo", $TransactionInfo);
    $ClientInfo = $Core->ClientInfo($TransactionInfo->clientid);
    $Template->assign("MyClient", $ClientInfo);

    $oddid = $TransactionInfo->odd;

    $Template->assign("menukey", "shop");

    $Template->assign("Transactions", $Core->MyTransactions($Template->data['accid']));
    $Template->assign("Agents", $Core->adminUsers());
    $Template->assign("Odds", $Core->Odds());
    $Template->assign("ThisOddInfo", $Core->OddsInfo($oddid));

    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
    $BarCode = $generator->getBarcode($TransactionInfo->id, $generator::TYPE_CODE_93);
    $Template->assign("BarCode", $BarCode);

    $Template->render("{$role}.shop");
}, 'GET');




$Route->add('/form/users/order/{oddid}', function ($oddid) {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $uid = $Template->data['uid'];

    $data = $Core->post($_POST);
    $OddsInfo = $Core->OddsInfo($oddid);

    $fullname = $data->fullname;
    $email = $data->email;
    $mobile = $data->mobile;
    $amount = $data->amount;

    $UserInfo = $Core->ClientInfo($uid);
    $credit =  (float) $UserInfo->credit;
    $_amount = (float) $amount;

    if ($credit < $_amount) {
        $Template->redirect("/users/shop/odds/{oddid}/play");
    }

    $multiple = false;
    if (isset($data->multiple)) {
        $multiple = true;
    }

    $orderid = $Core->NewTransaction(root_accid, $uid, $oddid, $amount, true);

    if ($orderid) {
        $Core->DebitClient($uid, $amount);

        $transid = $orderid;

        $TransactionInfo = $Core->TransactionInfo($transid);
        $Template->assign("TransactionInfo", $TransactionInfo);
        $MyClient = $Core->ClientInfo($TransactionInfo->clientid);
        $Template->assign("MyClient", $MyClient);

        $oddid = $TransactionInfo->odd;
        $ThisOddInfo = $Core->OddsInfo($oddid);
        $Template->assign("ThisOddInfo", $ThisOddInfo);

        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $BarCode = $generator->getBarcode($TransactionInfo->id, $generator::TYPE_CODE_93);
        $BarCode = "{$BarCode}";
        $Template->assign("BarCode", $BarCode);

        $PDF = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [100, 300]]);

        ob_start();
?>

        <!DOCTYPE html>
        <html lang="en" class="light">
        <!-- BEGIN: Head -->

        <head>
            <meta charset="utf-8">
            <base href="<?= domain ?>">
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <!------ Include the above in your HEAD tag ---------->
        </head>

        <body style="padding: 0; margin: 5; color: #000000;">
            <div id="invoice-POS">
                <div class="text-center">
                    <div class="text-3xl">
                        <h2><small style="color:#000000;">Game I.D:</small><br /><?= $TransactionInfo->id ?></h2>
                    </div>
                    <div style="margin: 1px auto;font-size: 150%;">Bet IdealStake GAMES</div>
                </div>
                <hr class="my-0 p-0" />
                <div class="text-left" style="margin-left: 0px; font-size: 140%; padding-left:5px">
                    <p style="border-bottom: 1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Full Name:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $MyClient->fullname ?></p>
                    <p style="border-bottom: 1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Telephone:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $MyClient->mobile ?></p>
                </div>
                <div class="text-left" style="margin-left: 0px; font-size: 140%; padding-left:5px">
                    <p style="border-bottom: 1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Your Odd:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $Core->Monify($ThisOddInfo->odds) ?></p>
                    <p style="border-bottom: 1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Your Stake:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $Core->Monify($TransactionInfo->amount) ?></p>
                    <p style="border-bottom: 1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Your Winning:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $Core->Monify($TransactionInfo->amount * $ThisOddInfo->odds)  ?></p>
                </div>

                <div class="text-left" style="margin-left: 0px; font-size: 140%; padding-left:5px">
                    <p style="border-bottom: 1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Stake Date:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $TransactionInfo->created ?></p>
                    <p style="border-bottom: 1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Draw Date:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $ThisOddInfo->playdate ?></p>
                    <p style="border-bottom: 1px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Winning Date:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $ThisOddInfo->windate ?></p>
                </div>

            </div>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

        </body>

        </html>

<?php

        $HTMLoutput = ob_get_contents();
        ob_end_clean();
        $PDF->WriteHTML($HTMLoutput);
        $PDF->Output("./_store/transactions/{$transid}.pdf", 'D');
        $Template->assign("pdf_file", "BetClickers-Ticket-{$transid}.pdf");


        $Template->redirect("/dashboard/shop/transactions/{$orderid}/invoice");
    }
}, 'POST');




