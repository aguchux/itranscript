<?php
$Payments = $Core->adminListUserPayments($AccidInfo->accid);

?>
<div class="container page__container">
    <form action="./forms/my/transcript/apply" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-section">

                    <h2>Transactions & Payments</h2>

                    <table id="MyDatatable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>REFERENCE</th>
                                <th>INVOICE DATE</th>
                                <th>APPLICANT</th>
                                <th>APPLICATION</th>
                                <th>DATE PAID</th>
                                <th> - </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($payment = mysqli_fetch_object($Payments)) : $User = $Core->UserInfo($payment->accid); ?>
                                <tr class="<?= $payment->tranx_status_int ? 'text-success' : 'text-danger' ?>">
                                    <td><span><?= $payment->id ?></span></td>
                                    <td><span><a href="/admin/payments/edit/<?= $payment->id ?>/reference"><?= $payment->reference ?></a></span></td>
                                    <td><?= $payment->created ?></td>
                                    <td><?= "<strong>{$User->surname}</strong>, {$User->firstname} {$User->middlename}" ?><br/><?= $User->email ?></td>
                                    <td><?= $payment->transcriptid ?></td>
                                    <td><?= $payment->tranx_paid_at ?></td>
                                    <td>
                                        <a href="/my/admin/payments/<?= $payment->id ?>/view" class="btn-link">View</a> | <a href="/admin/payments/<?= $payment->id ?>/reciept">Reciept</a>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>REFERENCE</th>
                                <th>INVOICE DATE</th>
                                <th>APPLICANT</th>
                                <th>APPLICATION</th>
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