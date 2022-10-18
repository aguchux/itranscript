<?php
 
$Invoices = $Core->Invoices($UserInfo->accid);

?>
<div class="container page__container">

    <h2 class="mt-5">My Payments & Invoices</h2>

    <?php while ($invoice = mysqli_fetch_object($Invoices)) : ?>

        <?php if($invoice->tranx_status_int): ?>
        <div class="card card-sm border-left-3 border-left-accent">
            <div class="card-body d-flex flex-column flex-sm-row align-items-center pl-16pt">
                <div class="flex mr-sm-16pt mb-16pt mb-sm-0">
                    You have already paid for this transcrip application <strong class="text-accent">#<?= $invoice->transcriptid ?></strong> and invoice amount of <strong class="text-accent"><?= $Core->Money($invoice->amount) ?></strong> for invoice <a href="./my/apps/<?= $invoice->id ?>/invoice" class="text-underline text-accent">#<?= $invoice->id ?></a>
                </div>
                <a href="./my/apps/<?= $invoice->id ?>/print" class="btn btn-accent">Print Payment Slip</a>
            </div>
        </div>
        <?php else: ?>
            <div class="card card-sm border-left-3 border-left-accent">
            <div class="card-body d-flex flex-column flex-sm-row align-items-center pl-16pt">
                <div class="flex mr-sm-16pt mb-16pt mb-sm-0">
                    You have a pending transcript application <strong class="text-accent">#<?= $invoice->transcriptid ?></strong>. Please pay your amount due of
                    <strong class="text-accent"><?= $Core->Money($invoice->amount) ?></strong> for invoice <a href="./my/apps/<?= $invoice->id ?>/invoice" class="text-underline text-accent">#<?= $invoice->id ?></a>
                </div>
                <a href="./my/apps/<?= $invoice->id ?>/invoice" class="btn btn-accent">Pay Now</a>
            </div>
        </div>
        <?php endif; ?>

    <?php endwhile; ?>

</div>