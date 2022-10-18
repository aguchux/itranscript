<div class="container page__container">
    <div class="row">
        <dic class="col-12 mt-5">
            <div class="alert alert-info media">
                <div class="media-left">
                    <strong><i class="material-icons text-50">info</i> READ ME: </strong>
                </div>
                <p>VERIFICATION is for thoes who already has applied and paid for TRANSCRIPT or wishing to VERIFY their CERTIFICATES. If you are looking to apply for a fresh transcript from ESUT, then visit "<strong><a href="/my/apps/applications/"> My Applications </a></strong>" menu, and click the Apply button there.</p>
            </div>
        </dic>
    </div>
    <div class="card border-left-4 mt-0 mb-5 border-left-accent card-sm">
        <div class="card-body pl-16pt">
            <div class="media flex-wrap align-items-center">
                <div class="media-left">
                    <i class="material-icons text-50">access_time</i>
                </div>
                <div class="media-body" style="min-width: 180px">
                    Want to verify Transcript OR Certificate?</strong>
                </div>
                <div class="media-right mt-2 mt-sm-0">
                    <a class="btn btn-primary" href="./my/apps/transcript-verification">Verify Transcript</a>
                </div>
                <div class="media-right mt-2 mt-sm-0">
                    <a class="btn btn-primary" href="./my/apps/certificate-verification">Verify Certificate</a>
                </div>
            </div>
        </div>
    </div>

    <h4 class="my-5">Manage all your Verifications.</h4>

    <?php
    $Verifications = $Core->Verifications($UserInfo->accid);
    while ($verification = mysqli_fetch_object($Verifications)) :
        $invoice = $Core->invoiceInfo($verification->paymentid);
    ?>

        <div class="card card-sm border-left-3 border-left-accent">
            <div class="media card-body d-flex flex-column flex-sm-row align-items-center pl-16pt">
                <div class="flex mr-sm-16pt mb-16pt mb-sm-0 h3">
                    <?= date("jS M Y", strtotime($invoice->created)) ?> |
                    <?= ucfirst($verification->verify) ?> Verification: <strong class="text-accent">#<?= $invoice->verificationid ?></strong> |
                    Invoice: <a href="./my/apps/<?= $invoice->id ?>/invoice" class="text-underline text-accent">#<?= $invoice->id ?></a> (<strong class="text-accent"><?= $Core->Money($invoice->amount) ?></strong>)
                </div>
                <?php if ($invoice->tranx_status == "pending") : ?>
                    <button disabled class="btn btn-danger disabled"> -- Awaiting Payment --</button>
                    <div class="media-right text-danger">
                        <a href="./my/apps/<?= $verification->id ?>/verification/delete"><i class="material-icons text-100">close</i></a>
                    </div>
                <?php else : ?>
                    <?php if ($verification->progress == "1") : ?>

                        <?php if ($verification->verify == "transcript") : ?>
                            <a href="./my/apps/verify/transcript/<?= $verification->id ?>/apply" class="btn btn-success">Continue Transcript Verification</a>
                        <?php elseif ($verification->verify == "certificate") : ?>
                            <a href="./my/apps/verify/certificate/<?= $verification->id ?>/apply" class="btn btn-success">Continue Certificate Verification</a>
                        <?php endif; ?>


                    <?php elseif ($verification->progress == "2") : ?>
                        <a href="#" class="btn btn-accent">Check Status</a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>

    <?php endwhile; ?>



</div>