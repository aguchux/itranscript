<div class="container page__container" id="pagePDFcontainer">
    <?= $Self->tokenize() ?>
    <div class="row">
        <div class="col-lg-7">

            <div class="page-section">

                <h2 class="mb-3">Application Number: #<?= $TranscriptInfo->id ?></h2>



                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Name of Applicant: </label>
                            <div class="col-sm-6">
                                <p class="m-0 p-0"><strong><?= "{$AccidInfo->surname}, {$AccidInfo->firstname} {$AccidInfo->middlename}" ?></strong></p>
                                <p class="m-0 p-0"><strong><?= $AccidInfo->email ?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Date Of Birth: </label>
                            <div class="col-sm-6">
                                <p class="m-0 p-0"><strong><?= "{$AccidInfo->dob}" ?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Matriculation Number: </label>
                            <div class="col-sm-6">
                                <strong><?= $TranscriptInfo->matricnumber ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Application Type: </label>
                            <div class="col-sm-6">
                                <strong><?= $TranscriptInfo->international ? "International" : "Local Transcript" ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Faculty: </label>
                            <div class="col-sm-6">
                                <strong><?= $TranscriptInfo->faculty ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Department: </label>
                            <div class="col-sm-6">
                                <strong><?= $TranscriptInfo->department ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="list-group-item">
                    <a href="/my/admin/transcripts/<?= $TranscriptInfo->id ?>/print" class="btn btn-accent">Print Transcript Form</a>
                </div>

            </div>

        </div>
        <div class="col-lg-5 page-nav">


            <div class="page-section pt-lg-112pt">


                <?php if ($TranscriptInfo->progress >= 2) : ?>


                    <form action="/forms/my/admin/<?= $TranscriptInfo->id ?>/switch2verification" method="POST" class="p-0 mx-auto">
                        <?= $Self->tokenize() ?>
                        <div class="list-group list-group-form">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="card-title">Swich Product</h4>
                                        <p class="text-70">We noticed most student pays for Transcript while intending to pay for Verification. You can switch back their products to iTranscript.</p>
                                    </div>
                                    <div class="col-lg-12 alert alert-success">
                                        <strong>Product Applied:</strong> Transcript <?= $TranscriptInfo->international ? "International" : "Local" ?><br />
                                        <strong>Product Amount:</strong> <?= $Core->Monify($InvoiceInfo->amount) ?>
                                    </div>
                                    <div class="col-lg-12 d-flex align-items-center">
                                        <div class="flex">
                                            <label class="form-label" for="target">Select Target Product</label><br>
                                            <div class="form-group mr-1">
                                                <select class="form-control" name="target" id="target" required>
                                                    <option value=""> Select Product </option>
                                                    <option value="verification_certificate">Certificate Verification (20,000)</option>
                                                    <option value="verification_local">Transcript Verification (Local) Application (20,000)</option>
                                                    <option value="verification_international">Transcript Verification (Int'nl) Application (35,000)</option>
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


                    <form action="/forms/my/admin/<?= $TranscriptInfo->id ?>/searchreference" method="POST" class="p-0 mx-auto">
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
                    <a class="nav-link active" href="/my/admin/transcripts">Back to Transcripts</a>
                </nav>

            </div>


        </div>
    </div>
</div>