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

            </div>

        </div>
        <div class="col-lg-5 page-nav">
            <div class="page-section pt-lg-112pt">
                <form action="/forms/my/admin/<?= $VerificatinInfo->id ?>/switch" method="POST" class="p-0 mx-auto">
                    <?= $Self->tokenize() ?>
                    <div class="list-group list-group-form">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="card-title">Swich Product</h4>
                                    <p class="text-70">We noticed most student pays for verification while intendng to pay for iTranscrip. You can switch back their products to iTranscript.</p>
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

                <nav class="nav page-nav__menu">
                    <a class="nav-link active" href="/my/admin/verifications">Back to Verifications</a>
                </nav>

            </div>
        </div>
    </div>
</div>