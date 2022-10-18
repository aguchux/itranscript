<div class="container page__container">
    <form action="/form/payments/edit/<?= $InvoiceInfo->id ?>/reference" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-7">

                <div class="page-section">
                    <h4>Change Payment Reference</h4>
                    <p class="text-70">All payment reference are verified through PayStack API</p>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 my-1">Your funding details</div>
                        <div class="col-md-12 col-sm-12 my-1 pl-4">Old Reference:<br /><strong class="text-accent"><?= $InvoiceInfo->reference ?></strong> | <a class="text-success" target="_blank" href="/admin/payments/<?= $InvoiceInfo->reference ?>/verify">Verify Reference</a></div>
                        <div class="col-md-12 col-sm-12 mt-1 mb-4 pl-4">Amount:<br /><strong class="text-accent"><?= $Core->ToMoney($InvoiceInfo->amount) ?></strong></div>

                        <div class="col-md-12 col-sm-12 mt-1 mb-4 pl-4">Applicant Details:<br /><strong class="text-accent"><?= "<strong>{$ThisUser->surname}</strong>, {$ThisUser->firstname} {$ThisUser->middlename} | {$ThisUser->email} | {$ThisUser->mobile}" ?></strong></div>
                    </div>
                    <h4>New Payment Reference</h4>

                    <div class="list-group list-group-form">

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-12">Payment Reference:</label>
                                <div class="col-12">
                                    <input type="text" name="reference" class="form-control" placeholder="Reference" value="<?= $InvoiceInfo->reference ?>">
                                </div>
                            </div>
                        </div>


                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <button type="submit" class="btn btn-accent">Update Reference</button>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
            <div class="col-lg-5 page-nav">
                <div class="page-section pt-lg-112pt">
                    <div class="page-nav__content">
                        <h4>Changing References</h4>
                        <p class="text-70">This area is only provisional under the Bursars authority and approval. After reference submission, Bursary will execute final approval.</p>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>