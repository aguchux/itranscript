<div class="container page__container">

    <?php if ($Core->ProfileScore($UserInfo->accid) < 110) : ?>
        <div class="card border-left-4 mt-5 mb-0 border-left-accent card-sm">
            <div class="card-body pl-16pt">
                <div class="media flex-wrap align-items-center">
                    <div class="media-left">
                        <i class="material-icons text-50">access_time</i>
                    </div>
                    <div class="media-body" style="min-width: 180px">
                        Your profile is not updated, you need to update your personal data</strong>
                    </div>
                    <div class="media-right mt-2 mt-sm-0">
                        <a class="btn btn-link text-secondary" href="./my/apps/edit-profile">Update Profile</a>
                    </div>
                </div>
            </div>
        </div>

    <?php else : ?>

        <?php if ($Core->HasApplication($UserInfo->accid)) : ?>

            <?php if ($Core->HasInvoice($UserInfo->accid)) :
                $Invoices = $Core->Invoices($UserInfo->accid); ?>

                <h4 class="mt-5">Pending Transcript Payment...</h4>

                <?php while ($invoice = mysqli_fetch_object($Invoices)) : ?>
                    <div class="card card-sm border-left-3 border-left-accent">
                        <div class="card-body d-flex flex-column flex-sm-row align-items-center pl-16pt">
                            <div class="flex mr-sm-16pt mb-16pt mb-sm-0">
                                You have a pending transcript application <strong class="text-accent">#<?= $invoice->transcriptid ?></strong>. Please pay your amount due of
                                <strong class="text-accent"><?= $Core->Money($invoice->amount) ?></strong> for invoice <a href="./my/apps/<?= $invoice->id ?>/invoice" class="text-underline text-accent">#<?= $invoice->id ?></a>
                            </div>
                            <a href="./my/apps/<?= $invoice->id ?>/invoice" class="btn btn-accent">Pay Now</a>
                        </div>
                    </div>
                <?php endwhile; ?>

            <?php endif; ?>

        <?php else : ?>
            <div class="card border-left-4 mt-5 mb-0 border-left-accent card-sm">
                <div class="card-body pl-16pt">
                    <div class="media flex-wrap align-items-center">
                        <div class="media-left">
                            <i class="material-icons text-50">access_time</i>
                        </div>
                        <div class="media-body" style="min-width: 180px">
                            Your profile is up to date. Now you can start a new transcript application</strong>
                        </div>
                        <div class="media-right mt-2 mt-sm-0">
                            <a class="btn btn-primary" href="./my/apps/apply">New Application</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <form action="./forms/my/edit-profile" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-7">

                <div class="page-section">
                    <h4>WHY USE ETRANSCRIPT</h4>
                    <p class="text-70">Apply from the comfort of your home or office anywhere you are ONLINE and get feed back from application through to delivery without having to trave.</p>
                    <h4>HOW IT WORKS</h4>
                    <p class="text-70">To begin, you will need to provide basic details like your academic, personal and contact information to obtain your permanent PORTAL Login details in other to have access the platform features.</p>

                </div>

            </div>
            <div class="col-lg-5 page-nav">
                <div class="page-section pt-lg-112pt">

                    <nav class="nav page-nav__menu">
                        <a class="nav-link active" href="./my">Dashboard</a>
                        <a class="nav-link" href="./my/apps/edit-profile">Profile &amp; Details</a>
                        <a class="nav-link" href="./my/apps/applications">Application</a>
                        <a class="nav-link" href="./my/apps/payments">Payments</a>
                    </nav>

                    <div class="page-nav__content">
                        <h4>iTranscript Support</h4>
                        <p class="text-70">Our iTranscript team will be available Mondays - Fridays (8AM to 4PM) to attend to your questions and issues.</p>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>