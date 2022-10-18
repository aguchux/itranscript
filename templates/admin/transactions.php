<div class="container page__container">
    <form action="./forms/my/transcript/apply" method="POST" class="p-0 mx-auto">
        <div class="row">

            <?php if (isset($_REQUEST['verified'])) :
                $verified = $_REQUEST['verified'];  ?>
                <div class="col-lg-12 text-center mt-5 p-0">
                    <?php if ($verified == 'true') : ?>
                        <div class="alert alert-success m-0 p-0">
                            <h2 class="m-0 p-0">Payment has been verified.</h2>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-danger m-0 p-0">
                            <h2 class="m-0 p-0">Payment verification failed.</h2>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>


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
                                <th>AMOUNT</th>
                                <th>DATE PAID</th>
                                <th> - </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($payment = mysqli_fetch_object($MyPayments)) :
                                $User = $Core->UserInfo($payment->accid);
                                if (isset($User->accid)) { ?>
                                    <tr class="<?= $payment->tranx_status_int ? 'text-success' : 'text-danger' ?>">
                                        <td><span><?= $payment->id ?></span></td>

                                        <?php if ($UserInfo->is_owner) : ?>
                                            <td><span><a href="/admin/payments/edit/<?= $payment->id ?>/reference"><?= $payment->reference ?></a></span></td>
                                        <?php else : ?>
                                            <td><span><a href="/admin/payments/<?= $payment->reference ?>/verify"><?= $payment->reference ?></a></span></td>
                                        <?php endif; ?>

                                        <td><?= date("d-m-y", strtotime($payment->created)) ?></td>
                                        <td><?= "<strong>{$User->surname}</strong>, {$User->firstname} {$User->middlename}" ?><br/><?= $User->email ?></td>
                                        <td><?= $payment->transcriptid ?></td>
                                        <td><?= $Core->Monify($payment->amount) ?></td>
                                        <td><?= date("d-m-y", strtotime($payment->tranx_paid_at)) ?></td>
                                        <td>
                                            <a href="/my/admin/payments/<?= $payment->id ?>/reciept">Reciept</a> |
                                            <a class="text-primary" href="/admin/payments/<?= $payment->reference ?>/verify">Verifiy</a>
                                            <?php if ($UserInfo->is_owner) : endif; ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            endwhile; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>REFERENCE</th>
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