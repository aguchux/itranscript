<?php
$Transcripts = $Core->adminListTranscripts();

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
                                <th>MOBILE</th>
                                <th>STATUS</th>
                                <th>TYPE</th>
                                <th> - </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($transcript = mysqli_fetch_object($Transcripts)) :
                                $User = $Core->UserInfo($transcript->accid);
                                if (isset($User->accid)) {
                            ?>
                                    <tr>
                                        <td><a href="/my/admin/transcripts/<?= $transcript->id ?>/update" class="<?= $transcript->progress >= 2 ? 'text-success' : 'text-danger' ?>"><?= $transcript->id ?></a></td>
                                        <td><?= $transcript->created ?></td>
                                        <td><?= "<strong>{$User->surname}</strong>, {$User->firstname} {$User->middlename}" ?></td>
                                        <td><?= $User->mobile ?></td>
                                        <td><?= $transcript->international ? 'INTERNATIONAL' : 'LOCAL' ?></td>
                                        <td>
                                            <?php
                                            if ($transcript->progress == 0) {
                                                echo "<span class='text-danger'>Not Paid</span>";
                                            } elseif ($transcript->progress == 1) {
                                                echo "<span class='text-success'>Invoice Paid</span>";
                                            } elseif ($transcript->progress == 2) {
                                                echo "<span class='text-success'>Completed</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="/my/admin/transcripts/<?= $transcript->id ?>/view" class="btn-link">View</a> |
                                            <a href="/my/admin/transcripts/<?= $transcript->id ?>/edit" class="btn-link">Edit</a> |
                                            <a href="/my/admin/transcripts/<?= $transcript->id ?>/reciept">Invoice</a>
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
                                <th>MOBILE</th>
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