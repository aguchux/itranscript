<div class="container bg-white page__container">
    <form class="" style="margin: 10px 0; padding: 10px 0;">

        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-black-100 mb-0"><strong>Prepared by</strong></p>
                        <h4 class="text-black-100">ENUGU STATE UNIVERSITY OF SCIENCE AND TECHNOLOGY,<br/>Enugu State, Nigeria</h4>
                    </div>
                    <div class="col-md-6 mb-24pt mb-lg-0">
                        <p class="text-black-100 mb-0"><strong>Prepared for</strong></p>
                        <h2><?= "<strong>{$AccidInfo->surname}</strong>, {$AccidInfo->firstname} {$AccidInfo->middlename} " ?></h2>
                        <p class="text-black-100"><?= $AccidInfo->address ?><br><?= $Core->CountryInfo($AccidInfo->nationality) ?></p>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 text-lg-right d-flex flex-lg-column mb-24pt mb-lg-0 border-bottom border-lg-0 pb-16pt pb-lg-0">
                <div class="flex">
                    <p class="text-black-70 my-0"><strong>Invoice Number</strong></p>
                    <h2 class="my-1"><?= $InvoiceInfo->id ?></h2>
                    <p class="text-black-50">
                        <?= date("F jS, Y", strtotime($InvoiceInfo->created)) ?><br>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="page-section">
                    <h4>Transcript Payment Information (#<?= $TranscriptInfo->id ?>)</h4>

                    <div class="card table-responsive">
                        <table class="table table--elevated p-5">
                            <thead>
                                <tr>
                                    <th>Description of Payment</th>
                                    <th class="text-right">Amount(&#8358;)&nbsp;&nbsp;&nbsp;</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="mb-0"><strong>Transcript Processing Fee - (<?= $TranscriptInfo->international ? "International" : "National/Local" ?>)</strong>&nbsp;&nbsp;&nbsp;</p>
                                        <p class="text-50 mt-3 mb-1 ml-2">Application Number: <strong>#<?= $TranscriptInfo->id ?></strong>&nbsp;&nbsp;&nbsp;</p>
                                        <p class="text-50 my-2 ml-2">Matriculation Number: <strong><?= $TranscriptInfo->matricnumber ?></strong>&nbsp;&nbsp;&nbsp;</p>

                                        <?php if ((int)strlen($TranscriptInfo->faculty)) : ?>
                                            <p class="text-50 my-2 ml-2">Faculty: <strong><?= $TranscriptInfo->faculty ?></strong>&nbsp;&nbsp;&nbsp;</p>
                                        <?php endif; ?>
                                        <?php if ((int)strlen($TranscriptInfo->faculty)) : ?>
                                            <p class="text-50 my-2 ml-2">Department: <strong><?= $TranscriptInfo->department ?></strong>&nbsp;&nbsp;&nbsp;</p>
                                        <?php endif; ?>

                                    </td>
                                    <td class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>Logistics</strong></td>
                                    <td class="text-right"><strong>+inclusive</strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td class="text-right text-70"><strong>Subtotal</strong></td>
                                    <td class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-70"><strong>Total</strong></td>
                                    <td class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>

                    <div class="px-16pt">

                        <?php if ($InvoiceInfo->tranx_status == "pending") : ?>
                            <p class="text-70 mb-8pt text-danger"><strong>This invoice is pending payment</strong></p>
                            <div class="media">
                                <div class="media-body text-50">
                                    Payment for this invoice in easy and online, we also provided several payment options to ensure you find the method that best suites your convienience.
                                </div>
                            </div>
                        <?php else : ?>
                            <p class="text-70 mb-8pt text-success"><strong>Invoice is paid</strong></p>
                            <div class="media">
                                <div class="media-body text-50">
                                    You don’t need to take further action. You just sit back and waiit while our team processes your transcript. You will be updated on the progress through email and SMS.
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </form>

</div>