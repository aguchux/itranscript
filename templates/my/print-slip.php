<nav class="navbar navbar-light">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="./my/apps/payments" class="nav-link"><i class="material-icons icon--left">keyboard_backspace</i> Back to Payments</a>
            </li>
        </ul>
    </div>


</nav>

<?php if ($TranscriptInfo->payment_mode == "offline") : ?>
    <div class="container">
        <div class="alert alert-info mb-0">
            Your chosen mode of payment is bank direct deposit. Print the Payment Slip and visit any bank close to you and make payment, after payment return to this portal to conclude your applications.
        </div>
    </div>
<?php endif; ?>

<div class="page-section bg-white border-bottom-2">
    <div class="container page__container">
        <div class="row">



            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6 mb-24pt mb-lg-0">
                        <p class="text-black-70 mb-0"><strong>Prepared for</strong></p>
                        <h2><?= "<strong>{$UserInfo->surname}</strong>, {$UserInfo->firstname} {$UserInfo->middlename} " ?></h2>
                        <p class="text-black-50"><?= $UserInfo->address ?><br><?= $Core->CountryInfo($UserInfo->nationality) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-black-70 mb-0"><strong>Prepared by</strong></p>
                        <h2>ENUGU STATE UNIVERSITY OF SCIENCE AND TECHNOLOGY.</h2>
                        <p class="text-black-50">Enugu State, Nigeria</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-lg-right d-flex flex-lg-column mb-24pt mb-lg-0 border-bottom border-lg-0 pb-16pt pb-lg-0">
                <div class="flex">
                    <p class="text-black-70 my-0"><strong>Invoice Number</strong></p>
                    <h2 class="my-1"><?= $InvoiceInfo->id ?></h2>
                    <p class="text-black-50">
                        <?= date("F jS, Y", strtotime($InvoiceInfo->created)) ?><br>
                    </p>
                </div>
                <?php if ($InvoiceInfo->tranx_status == "pending") : ?>

                    <?php if ($TranscriptInfo->payment_mode == "online") : ?>
                        <form action="./forms/my/payments/<?= $InvoiceInfo->id ?>/prepay" method="POST" class="p-0 mx-auto">
                            <?= $Self->tokenize() ?>
                            <div><button class="btn btn-accent blink-me">Make Payment Now<i class="material-icons icon--right">payment</i></button></div>
                        </form>
                    <?php elseif ($TranscriptInfo->payment_mode == "offline") : ?>
                        <a href="./my/payments/<?= $InvoiceInfo->id ?>/print/slip" class="btn btn-accent">Print Payment Slip<i class="material-icons icon--right">print</i></a>
                    <?php endif; ?>

                <?php else : ?>

                    <div><a href="./my/payments/<?= $InvoiceInfo->id ?>/print/receipt" class="btn btn-accent">Download Payment Reciept<i class="material-icons icon--right">print</i></a></div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>


<div class="container page__container">
    <form>
        <div class="row">
            <div class="col-lg-9">

                <div class="page-section">
                    <h4>Transcript Payment Information (#<?= $TranscriptInfo->id ?>)</h4>

                    <div class="card table-responsive">
                        <table class="table table-flush table--elevated">
                            <thead>
                                <tr>
                                    <th>Description of Payment</th>
                                    <th style="width: 60px;" class="text-right">Amount(&#8358;)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="mb-0"><strong>Transcript Processing Fee - (<?= $TranscriptInfo->international ? "International" : "National/Local" ?>)</strong></p>
                                        <p class="text-50 mt-3 mb-1 ml-2">Application Number: <strong>#<?= $TranscriptInfo->id ?></strong></p>
                                        <p class="text-50 my-2 ml-2">Matriculation Number: <strong><?= $TranscriptInfo->matricnumber ?></strong></p>

                                        <?php if ((int)strlen($TranscriptInfo->faculty)) : ?>
                                            <p class="text-50 my-2 ml-2">Faculty: <strong><?= $TranscriptInfo->faculty ?></strong></p>
                                        <?php endif; ?>
                                        <?php if ((int)strlen($TranscriptInfo->faculty)) : ?>
                                            <p class="text-50 my-2 ml-2">Department: <strong><?= $TranscriptInfo->department ?></strong></p>
                                        <?php endif; ?>

                                    </td>
                                    <td class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Logistics</strong></td>
                                    <td class="text-right"><strong>+inclusive</strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-flush">
                            <tfoot>
                                <tr>
                                    <td class="text-right text-70"><strong>Subtotal</strong></td>
                                    <td style="width: 60px;" class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="text-right text-70"><strong>Total</strong></td>
                                    <td style="width: 60px;" class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="px-16pt">

                        <?php if ($InvoiceInfo->tranx_status == "pending") : ?>
                            <p class="text-70 mb-8pt text-danger"><strong>This invoice is pending payment</strong></p>
                            <div class="media">
                                <div class="media-body text-50">
                                    Payment for this invoice in easy and online, we also provided several payment options to ensure you find the method that best suites your convienience.
                                </div>
                            </div>
                        <?php else : ?>
                            <p class="text-70 mb-8pt text-success"><strong>Invoice is paid</strong></p>
                            <div class="media">
                                <div class="media-body text-50">
                                    You don’t need to take further action. You just sit back and waiit while our team processes your transcript. You will be updated on the progress through email and SMS.
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
            <div class="col-lg-3 page-nav">
                <div class="page-section pt-lg-112pt">
                    <nav class="nav page-nav__menu">
                        <a class="nav-link" href="./my">Dashboard</a>
                        <a class="nav-link" href="./my/apps/edit-profile">Profile &amp; Details</a>
                        <a class="nav-link" href="./my/apps/applications">Application</a>
                        <a class="nav-link active" href="./my/apps/payments">Payments</a>
                    </nav>
                </div>
            </div>
        </div>
    </form>
</div>