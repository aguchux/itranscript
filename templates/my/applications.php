<div class="container page__container">



    <h4 class="my-5">Manage all your applications.</h4>

    <?php
    $Applications = $Core->Applications($UserInfo->accid);
    while ($application = mysqli_fetch_object($Applications)) :
        $invoice = $Core->invoiceInfo($application->paymentid);
    ?>



        <div class="card card-sm border-left-3 border-left-accent">
            <div class="media card-body d-flex flex-column flex-sm-row align-items-center pl-16pt">
                <div class="flex mr-sm-16pt mb-16pt mb-sm-0 h3">
                    <?= date("jS M Y", strtotime($invoice->created)) ?> |
                    Application: <strong class="text-accent">#<?= $invoice->transcriptid ?></strong> |
                    Invoice: <a href="./my/apps/<?= $invoice->id ?>/invoice" class="text-underline text-accent">#<?= $invoice->id ?></a> (<strong class="text-accent"><?= $Core->Money($invoice->amount) ?></strong>)
                </div>
                <?php if ($invoice->tranx_status == "pending") : ?>
                    <button disabled class="btn btn-warning disabled"> -- Awaiting Payment --</button>
                    <div class="media-right text-danger">
                        <a href="./my/apps/<?= $application->id ?>/transcript/delete"><i class="material-icons text-100">close</i></a>
                    </div>
                <?php else : ?>
                    <?php if ($application->progress == "1") : ?>
                        <a href="./my/apps/<?= $application->id ?>/apply" class="btn btn-success">Continue Application</a>
                    <?php elseif ($application->progress == "2") : ?>
                        <a href="./my/apps/transcripts/<?= $application->id ?>/edit" class="btn btn-success mx-1">Update</a>
                        <a href="./my/apps/transcripts/<?= $application->id ?>/status" class="btn btn-accent mx-1">Status</a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>


    <?php endwhile; ?>




    <div class="row">
        <dic class="col-12 mt-5">
            <div class="alert alert-info media">
                <div class="media-left">
                    <strong><i class="material-icons text-50">info</i> READ ME: </strong>
                </div>
                <p>If you are looking to apply for a fresh transcript from ESUT use the apply button below. But if you have already paid for your transcript and only needs verification or verification of your school certificate, then visit "<strong><a href="/my/apps/verifications/"> My Verifications </a></strong>" menu, and click the Apply button there.</p>
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
                    Manage and Monitor all applications</strong>
                </div>
                <div class="media-right mt-2 mt-sm-0">
                    <a class="btn btn-primary" href="./my/apps/apply">Apply New</a>
                </div>
            </div>
        </div>
    </div>



</div>