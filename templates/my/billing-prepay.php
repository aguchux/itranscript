<div class="container page__container  mt-5">
    <form action="#">
        <div class="row">

            <div class="col-lg-9">
                <label class="h2">Secure Payment</label>
                <div class="card card-sm border-left-3 border-left-primary">
                    <div class="card-body d-flex flex-column flex-sm-row align-items-center pl-16pt">
                        <div class="flex mr-sm-16pt mb-16pt mb-sm-0 row">

                            <div class="col-md-12 col-sm-12 row">
                                <div class="col-md-12 col-sm-12 my-1">Your funding details</div>
                                <div class="col-md-12 col-sm-12 my-1 pl-4">Reference:<br /><strong class="text-accent"><?= $PaymentInfo->reference ?></strong></div>
                                <div class="col-md-12 col-sm-12 mt-1 mb-4 pl-4">Amount:<br /><strong class="text-accent"><?= $Core->ToMoney($PaymentInfo->amount / 100) ?></strong></div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-2">
                                You will now be redirected to <strong class="text-primary"> PayStack Secure payment gateway.</strong>
                            </div>

                        </div>
                        <a href="<?= $PaymentInfo->authorization_url ?>" class="btn btn-success">Pay Now</a>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 page-nav">
                <div class="page-section pt-lg-112pt">
                    <nav class="nav page-nav__menu">
                        <a class="nav-link <?= isset($submenukey) ? '' : 'active' ?>" href="/my/billing">Subscription</a>
                        <a class="nav-link <?= $submenukey == 'upgrade' ? 'active' : '' ?>" href="/my/billing/upgrade">Upgrade
                            Account</a>
                        <a class="nav-link <?= $submenukey == 'payment' ? 'active' : '' ?>" href="/my/billing/payment">Payment
                            Information</a>
                        <a class="nav-link <?= $submenukey == 'invoices' ? 'active' : '' ?>" href="/my/billing/invoices">Payments & Invoices</a>
                        <a class="nav-link <?= $submenukey == 'wallet' ? 'active' : '' ?>" href="/my/billing/wallet">My
                            Wallet</a>
                    </nav>

                </div>
            </div>

        </div>
    </form>
</div>
