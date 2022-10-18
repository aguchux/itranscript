<?php
$Users = $Core->adminListAdmins();

?>
<div class="container page__container">
    <form action="./forms/my/transcript/apply" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-section">

                    <h2>Registered Accounts</h2>

                    <table id="MyDatatable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>REGISTERED</th>
                                <th> - </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($user = mysqli_fetch_object($Users)) : ?>
                                <tr>
                                    <td><span class="<?= $user->verified ? 'text-success' : 'text-danger' ?>"><?= $user->accid ?></span></td>
                                    <td>
                                        <?=
                                            "
                                        Surname: <strong>{$user->surname}</strong> ({$user->sex})<br/>
                                        Other Names: <strong>{$user->firstname} {$user->middlename}</strong><br/>
                                        Mobile: <strong>{$user->mobile}</strong><br/>
                                        ";
                                        ?>
                                    </td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->created ?></td>
                                    <td>
                                        <a href="/my/admin/accounts/<?= $user->accid ?>/view" class="btn-link">View</a> | 
                                        <a href="/my/admin/accounts/<?= $user->accid ?>/applications">Applications (<?= $Core->userCountApplications($user->accid) ?>)</a> | 
                                        <a href="/my/admin/accounts/<?= $user->accid ?>/transactions">Payments (<?= $Core->userCountPayments($user->accid) ?>)</a>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>REGISTERED</th>
                                <th> - </th>
                            </tr>
                        </tfoot>
                    </table>



                </div>
            </div>
        </div>
    </form>
</div>