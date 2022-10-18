<div class="container page__container">
    <form action="./forms/my/transcript/certificate-verification" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-7">

                <div class="page-section">

                    <h1>Verify Certificate</h1>

                    <div class="list-group list-group-form">

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <p class="text-danger my-1">* fields are required</p>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Matriculation Number*</label>
                                <div class="col-sm-8">
                                    <input type="text" name="matricnumber" required class="form-control" placeholder="MATRIC NUMBER">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">

                            <div class="row">
                                <div class="col-lg-7">
                                    <h4 class="card-title">Verification Fee</h4>
                                </div>
                                <div class="col-lg-5 d-flex align-items-center">
                                    <div class="flex">
                                    <h4><?= $Core->Monify(certificate_verification_fee) ?></h4>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="card-title">Select Payment Mode</h4>
                                    <p class="text-70">How would you prefer to make payment?</p>
                                </div>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" required name="payment_mode" value="online" class="custom-control-input" id="payment_mode1">
                                <label class="custom-control-label" for="payment_mode1">Online (Credit/Debit) Card Payment</label>
                                <small class="form-text text-muted">This method is instant and will charge your card. It is fast and secure.</small>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" disabled aria-disabled="true" required name="payment_mode" value="offline" class="custom-control-input" id="payment_mode2">
                                <label class="custom-control-label" for="payment_mode2">Local Bank/Deposit Payment</label>
                                <small class="form-text text-muted">You need to print the invoice and visit any bank nearest to you for payment.</small>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <button type="submit" class="btn btn-accent">Start Verification</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-5 page-nav">
                <div class="page-section pt-lg-112pt">
                    
                    <nav class="nav page-nav__menu">
                        <a class="nav-link" href="./my">Dashboard</a>
                        <a class="nav-link" href="./my/apps/edit-profile">Profile &amp; Details</a>
                        <a class="nav-link active" href="./my/apps/applications">Application</a>
                        <a class="nav-link" href="./my/apps/payments">Payments</a>
                    </nav>

                    <div class="page-nav__content">
                        <button type="submit" class="btn btn-accent">Start Verification</button>
                    </div>



                </div>
            </div>
        </div>
    </form>
</div>