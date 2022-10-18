<?php
$Verifications = $Core->adminListVerifications();

?>
<div class="container page__container">
    <form action="./forms/my/transcript/apply" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-section">

                    <h2>Certificate Verifications</h2>

                    <table id="MyDatatable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DATE</th>
                                <th>APPLICANT</th>
                                <th>TYPE</th>
                                <th> - </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($verification = mysqli_fetch_object($Verifications)) :
                                $User = $Core->UserInfo($verification->accid);
                                if (isset($User->accid)) {
                            ?>
                                    <tr>
                                        <td><span class="<?= $verification->progress >= 2 ? 'text-success' : 'text-danger' ?>"><?= $verification->id ?></span></td>
                                        <td><?= $verification->created ?></td>
                                        <td><?= "<strong>{$User->surname}</strong>, {$User->firstname} {$User->middlename}" ?></td>
                                        <td><?= $verification->international ? 'INTERNATIONAL' : 'LOCAL' ?></td>
                                        <td>
                                            <a href="/my/admin/verifications/<?= $verification->id ?>/view" class="btn-link">View</a> | <a href="/my/admin/verifications/<?= $verification->id ?>/reciept">Invoice</a>
                                        </td>

                                    </tr>
                            <?php
                                }
                            endwhile; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>DATE</th>
                                <th>APPLICANT</th>
                                <th>TYPE</th>
                                <th> - </th>
                            </tr>
                        </tfoot>
                    </table>



                </div>
            </div>
        </div>
    </form>
</div>