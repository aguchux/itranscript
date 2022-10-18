<?php
$Payments = $Core->updaterListSuccessfulPayments();
?>
<div class="container page__container">
    <form action="./forms/my/transcript/apply" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">

            <div class="col-lg-12">
                <div class="page-section mt-3 pt-0">

                    <h2>Transactions & Payments</h2>

                    <table id="MyDatatable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DATE</th>
                                <th>APPLICANT</th>
                                <th>APPLICATION</th>
                                <th>AMOUNT</th>
                                <th> - </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($payment = mysqli_fetch_object($Payments)) :
                                $User = $Core->UserInfo($payment->accid);
                                $applid = 0;
                                if (isset($User->accid)) { ?>
                                    <tr>
                                        <td><span><?= $payment->id ?></span></td>
                                        <td>
                                            <?= date("jS M, Y", strtotime($payment->created)) ?><br />
                                            <span class="text-muted"><?= $Core->Cycle(strtotime($payment->created)) ?></span>

                                        </td>
                                        <td><?= "<strong>{$User->surname}</strong>, {$User->firstname} {$User->middlename}<br/><span class=\"text-primary\">{$User->mobile}</span>" ?></td>
                                        <?php if ($payment->product == "transcript") : $applid = $payment->transcriptid; ?>
                                            <td><?= "{$payment->product}(<strong class=\"text-success\">{$payment->transcriptid}</strong>)" ?></td>
                                        <?php elseif ($payment->product == "verification") : $applid = $payment->verificationid; ?>
                                            <td><?= "{$payment->product}(<strong class=\"text-success\">{$payment->verificationid}</strong>)" ?></td>
                                        <?php endif; ?>

                                        <td><?= $Core->Monify($payment->amount) ?></td>
                                        <td>
                                            <?php if ($payment->product == "transcript") : $applid = $payment->transcriptid; ?>
                                                <a class="btn btn-primary btn-xs" href="/updater/transcripts/<?= $applid ?>/update">Update</a>
                                            <?php elseif ($payment->product == "verification") : $applid = $payment->verificationid; ?>
                                                <a class="btn btn-primary btn-xs" href="/updater/verifications/<?= $applid ?>/update">Update</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            endwhile; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>INVOICE DATE</th>
                                <th>APPLICANT</th>
                                <th>APPLICATION</th>
                                <th>AMOUNT</th>
                                <th>DATE PAID</th>
                                <th> - </th>
                            </tr>
                        </tfoot>
                    </table>



                </div>
            </div>
        </div>
    </form>
</div>