<?php
$Transcripts = $Core->adminListUserTranscripts($AccidInfo->accid);

?>
<div class="container page__container">
    <form action="./forms/my/transcript/apply" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-section">

                    <h2>Transcript Applications</h2>

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
                            <?php while ($transcript = mysqli_fetch_object($Transcripts)) : $User = $Core->UserInfo($transcript->accid); ?>
                                
                                <tr>
                                    <td><span class="<?= $transcript->progress >= 2 ? 'text-success' : 'text-danger' ?>"><?= $transcript->id ?></span></td>
                                    <td><?= $transcript->created ?></td>
                                    <td><?= "<strong>{$User->surname}</strong>, {$User->firstname} {$User->middlename}" ?><br/><?= $User->email ?></td>
                                    <td><?= $transcript->international ? 'INTERNATIONAL' : 'LOCAL' ?></td>
                                    <td>
                                    <a href="/my/admin/accounts/<?= $transcript->accid ?>/view" class="btn-link">Profile</a> | 
                                    <a href="/my/admin/transcripts/<?= $transcript->id ?>/view" class="btn-link">View</a> | 
                                        <a href="/my/admin/accounts/<?= $User->accid ?>/applications">Applications (<?= $Core->userCountApplications($User->accid) ?>)</a> | 
                                        <a href="/my/admin/accounts/<?= $User->accid ?>/transactions">Payments (<?= $Core->userCountPayments($User->accid) ?>)</a>
                                    </td>

                                </tr>
                                
                            <?php endwhile; ?>
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