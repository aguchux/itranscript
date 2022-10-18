<div class="container page__container">
    <?= $Self->tokenize() ?>
    <div class="row">
        <div class="col-lg-7">

            <div class="page-section">

                <h2 class="mb-3">Verification Number: #<?= $VerificatinInfo->id ?></h2>


                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Email </label>
                            <div class="col-sm-6">
                                <strong><?= $AccidInfo->email ?></strong>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Matriculation Number: </label>
                            <div class="col-sm-6">
                                <strong><?= $VerificatinInfo->matricnumber ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Verification Type: </label>
                            <div class="col-sm-6">
                                <strong><?= ucfirst($VerificatinInfo->verify) ?></strong>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Faculty: </label>
                            <div class="col-sm-6">
                                <strong><?= $VerificatinInfo->faculty ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Department: </label>
                            <div class="col-sm-6">
                                <strong><?= $VerificatinInfo->department ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="list-group-item">
                    <a href="/my/admin/verifications/<?= $VerificatinInfo->id ?>/print" class="btn btn-accent">Print Verification Form</a>
                </div>



            </div>

        </div>
        <div class="col-lg-5 page-nav">
            <div class="page-section pt-lg-112pt">


                <?php if ($VerificatinInfo->progress >= 2) : ?>


                    <form action="/forms/my/admin/<?= $VerificatinInfo->id ?>/switch2transcript" method="POST" class="p-0 mx-auto">
                        <?= $Self->tokenize() ?>
                        <div class="list-group list-group-form">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="card-title">Swich Product</h4>
                                        <p class="text-70">We noticed most student pays for verification while intending to pay for iTranscrip. You can switch back their products to iTranscript.</p>
                                    </div>
                                    <div class="col-lg-12 alert alert-success">
                                        <strong>Product Applied:</strong> <?= ucfirst($VerificatinInfo->verify) ?> Verification<br />
                                        <strong>Product Amount:</strong> <?= $Core->Monify($InvoiceInfo->amount) ?>
                                    </div>
                                    <div class="col-lg-12 d-flex align-items-center">
                                        <div class="flex">
                                            <label class="form-label" for="target">Select Target Product</label><br>
                                            <div class="form-group mr-1">
                                                <select class="form-control" name="target" id="target" required>
                                                    <option value=""> Select Product </option>
                                                    <option value="transcript_local">iTranscript (Local) Application (15,000)</option>
                                                    <option value="transcript_international">iTranscript (Int'nl) Application (35,000)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <button type="submit" class="btn btn-accent">Switch Product</button>
                            </div>
                        </div>
                    </form>

                <?php else : ?>


                    <form action="/forms/my/admin/<?= $VerificatinInfo->id ?>/searchreference" method="POST" class="p-0 mx-auto">
                        <?= $Self->tokenize() ?>
                        <div class="list-group list-group-form">
                            <div class="list-group-item">
                                <div class="row">
                                    <?= $Self->Toast() ?>
                                    <div class="col-lg-12">
                                        <h4 class="card-title">Search Payment</h4>
                                        <p class="text-70">Payment not registered to application?</p>
                                    </div>
                                    <div class="col-lg-12 d-flex align-items-center">
                                        <div class="flex">
                                            <label class="form-label" for="target">Payment Reference</label><br>
                                            <div class="form-group mr-1">
                                                <input type="text" id="reference" required aria-required="true" name="reference" class="form-control" placeholder="Payment reference...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <button type="submit" class="btn btn-accent">Search Reference</button>
                            </div>
                        </div>
                    </form>


                <?php endif; ?>





                <nav class="nav page-nav__menu">
                    <a class="nav-link active" href="/my/admin/verifications">Back to Verifications</a>
                </nav>

            </div>
        </div>
    </div>
</div>