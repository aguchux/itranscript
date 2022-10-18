<div class="container page__container  mt-5">
    <form action="./forms/my/transcript/completepurchase" method="POST" class="mx-auto" enctype="multipart/form-data">
        <?= $Me->tokenize() ?>
        <input type="hidden" name="transcript" value="<?= $TranscriptInfo->id ?>" />
        <div class="row">
            <div class="col-lg-9">
                <label class="h2">Secure Payment</label>
                <div class="card card-sm border-left-3 border-left-primary">
                    <div class="card-body d-flex flex-column flex-sm-row align-items-center pl-16pt">
                        <div class="flex mr-sm-16pt mb-16pt mb-sm-0 row">
                            <div class="col-md-12 col-sm-12 row mt-3">
                                <div class="col-md-12 col-sm-12 my-1">Your Purchase details</div>
                                <div class="col-md-12 col-sm-12 my-1 pl-4">Reference:<br /><strong class="text-accent"><?= $PaymentInfo->reference ?></strong></div>
                                <div class="col-md-12 col-sm-12 my-1 pl-4">Invoice Number:<br /><strong class="text-accent"><?= $PaymentInfo->id ?></strong></div>
                                <div class="col-md-12 col-sm-12 mt-1 mb-4 pl-4">Amount:<br /><strong class="text-accent"><?= $Core->Money($PaymentInfo->amount) ?></strong></div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                You will now be redirected to <strong class="text-primary"> PayStack Secure payment gateway.</strong>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-4 mt-2">
                                <a href="<?= $PaymentInfo->authorization_url ?>" class="btn btn-success">Complete Payment</a>
                            </div>
                        </div>
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