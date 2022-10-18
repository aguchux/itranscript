<div class="container bg-white page__container">
    <form class="" style="margin: 10px 0; padding: 30px 0 10px 0;">

        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-black-100 mb-0"><strong>Prepared by</strong></p>
                <h4 class="text-black-100">ENUGU STATE UNIVERSITY OF SCIENCE AND TECHNOLOGY,<br />Enugu State, Nigeria</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="page-section">
                    <h3>Application ID: #<?= $TranscriptInfo->id ?></h3>

                    <div class="card table-responsive">
                        <table class="table table--elevated p-5">
                            <thead>
                                <tr>
                                    <th>Application Data</th>
                                    <th class="text-right">Details&nbsp;&nbsp;&nbsp;</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Date of Application</td>
                                    <td class="text-right"><strong><?= date("jS F, Y g:i:s A", strtotime($TranscriptInfo->created)) ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Applicant Type</td>
                                    <td class="text-right"><strong><?= $TranscriptInfo->international ? "International Transcript" : "Local Transcript" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Name of Applicant</td>
                                    <td class="text-right"><strong><?= "{$AccidInfo->surname}, {$AccidInfo->firstname} {$AccidInfo->middlename}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td class="text-right"><strong><?= "{$AccidInfo->dob}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Matriculation Number</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->matricnumber}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Academic Sessions</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->sessionadmitted}" ?> - <?= "{$TranscriptInfo->sessiongraduated}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Faculty</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->faculty}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Department</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->department}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Position (Receiver Position)</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->sendname}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Send To (Receiver)</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->sendorg}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Receiver Address</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->sendaddress}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Receivers Email</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->sendemail}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Receivers Mobile</td>
                                    <td class="text-right"><strong><?= "{$TranscriptInfo->sendmobile}" ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Receivers Country</td>
                                    <td class="text-right"><strong><?= $Core->CountryInfo($TranscriptInfo->sendcountry) ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Attached Documents</td>                                  
                                    <?php if($TranscriptInfo->document==NULL): ?>
                                        <td class="text-right"><strong> - &nbsp;&nbsp;&nbsp;</td>
                                    <?php else: ?>
                                        <td class="text-right"><a href="<?= "{$TranscriptInfo->document}" ?>"><?=  "{$TranscriptInfo->document}" ?></a> &nbsp;&nbsp;&nbsp;</td>
                                    <?php endif; ?>                           
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><strong>Logistics</strong></td>
                                    <td class="text-right"><strong>+inclusive</strong>&nbsp;&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>

,pl   
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td class="text-right text-70"><strong>Transcript Subtotal</strong></td>
                                    <td class="text-right"><strong><?= $Core->Money($InvoiceInfo->amount) ?></strong>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-70"><strong>Total Paid</strong></td>
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