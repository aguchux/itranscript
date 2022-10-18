<?php $StatusUpdates = $Core->StatusUpdatesList($TranscriptInfo->id) ?>
<div class="container page__container" id="pagePDFcontainer">
    <?= $Self->tokenize() ?>
    <div class="row">
        <div class="col-lg-7">

            <div class="page-section">

                <h2 class="mb-3">Application Number: #<?= $TranscriptInfo->id ?></h2>

                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-6">Name of Applicant: </label>
                            <div class="col-sm-6">
                                <p class="m-0 p-0"><strong><?= "{$AccidInfo->surname}, {$AccidInfo->firstname} {$AccidInfo->middlename}" ?></strong></p>
                                <p class="m-0 p-0"><strong><?= $AccidInfo->email ?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php while ($update = mysqli_fetch_object($StatusUpdates)) : ?>

                    <?php if ($update->reply) : ?>

                        <div class="list-group list-group-form">
                            <div class="list-group-item">
                                <a href="/forms/my/admin/<?= $update->id ?>/transcript/statusupdate/delete" class="close float-right text-danger">&times;</a>
                                <div class="form-group row mb-0">
                                    <label class="col-form-label col-sm-12">
                                        <strong class="<?= $update->reply ? 'text-success' : 'text-info' ?>"> <i class="fa fa-info-circle"></i> <strong><?= date("jS M Y, g:i A", strtotime($update->created)) ?></strong></strong>
                                        <hr class="my-2" />
                                        <?= $update->message ?>
                                    </label>
                                </div>
                            </div>
                        </div>


                    <?php else : ?>

                        <div class="list-group list-group-form">
                            <div class="list-group-item">
                                <a href="/forms/my/admin/<?= $update->id ?>/transcript/statusupdate/delete" class="close float-right text-danger">&times;</a>
                                <div class="form-group row mb-0">
                                    <label class="col-form-label col-sm-9">
                                        <strong class="<?= $update->reply ? 'text-success' : 'text-info' ?>"> <i class="fa fa-info-circle"></i> <?= $update->status ?></strong>
                                        <hr class="my-2" />
                                        <?= $update->message ?>
                                    </label>
                                    <div class="col-sm-3">
                                        <strong><?= date("jS M Y, g:i A", strtotime($update->created)) ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endif; ?>


                <?php endwhile; ?>
            </div>

        </div>
        <div class="col-lg-5 page-nav">
            <div class="page-section pt-lg-112pt">
                <form action="/forms/my/admin/<?= $TranscriptInfo->id ?>/transcript/statusupdate" method="POST" class="p-0 mx-auto">
                    <?= $Self->tokenize() ?>
                    <div class="list-group list-group-form">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="card-title">Add Status Update</h4>
                                    <p class="text-70">Use this part to update the user on the status and progresses of their applications.</p>
                                </div>
                                <div class="col-lg-12 d-flex align-items-center">
                                    <div class="flex">
                                        <label class="form-label" for="status">Select Instant Status</label><br>
                                        <div class="form-group mr-1">
                                            <select class="form-control" name="status" id="status" required>
                                                <option value=""> Select Status </option>
                                                <option value="Bursary Payment Verification">Bursary Payment Verification</option>
                                                <option value="Collation is ongoing">Result Collation is ongoing</option>
                                                <option value="We require aditional information">We require aditional information</option>
                                                <option value="We are dispatching your transcript">We are dispatching your transcript</option>
                                                <option value="Received, thank you">Received, thank you</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="status_message" id="status_message" rows="1" class="form-control" placeholder="Additional messages"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <button type="submit" class="btn btn-accent">Add Update</button>
                        </div>
                    </div>
                </form>

                <nav class="nav page-nav__menu">
                    <a class="nav-link active" href="/my/admin/transcripts">Back to Transcripts</a>
                </nav>

            </div>
        </div>
    </div>
</div>