<?php $StatusUpdates = $Core->StatusUpdatesList($TranscriptInfo->id) ?>
<div class="container page__container" id="pagePDFcontainer">
    <?= $Self->tokenize() ?>
    <div class="row">
        <div class="col-lg-7">
            <?php if(!$Core->CountStatusUpdateInfo($TranscriptInfo->id)): ?>
            <div class="row mt-5">
                <div class="col-12 alert alert-info"><i class="fa fa-info-circle"></i> Your application is being attended to, check back later.</div>
            </div>
            <?php endif; ?>
            <div class="page-section">
                <h2 class="mb-3">Application Number: #<?= $TranscriptInfo->id ?></h2>
                <?php while ($update = mysqli_fetch_object($StatusUpdates)) : ?>

                    <?php if ($update->reply) : ?>

                        <div class="list-group list-group-form">
                            <div class="list-group-item">
                                <a href="/forms/my/user/<?= $update->id ?>/transcript/statusupdate/delete" class="close float-right text-danger">&times;</a>
                                <div class="form-group row mb-0">
                                    <label class="col-form-label col-sm-12">
                                        <strong class="<?= $update->reply ? 'text-info' : 'text-success' ?>"> <i class="fa fa-info-circle"></i> <strong><?= date("jS M Y, g:i A", strtotime($update->created)) ?></strong></strong>
                                        <hr class="my-2" />
                                        <?= $update->message ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                    <?php else : ?>

                        <div class="list-group list-group-form">
                            <div class="list-group-item">
                                <div class="form-group row mb-0">
                                    <label class="col-form-label col-sm-9">
                                        <strong class="<?= $update->reply ? 'text-info' : 'text-success' ?>"> <i class="fa fa-info-circle"></i> <?= $update->status ?></strong>
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
                <form action="/forms/my/admin/<?= $TranscriptInfo->id ?>/transcript/userstatusupdate" method="POST" class="p-0 mx-auto">
                    <?= $Self->tokenize() ?>
                    <div class="list-group list-group-form">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="card-title">Have any request or questions?</h4>
                                    <p class="text-70">Use this part to communicate with us.</p>
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="status_message" id="status_message" rows="1" class="form-control" placeholder="Additional messages"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <button type="submit" class="btn btn-accent">Send Update</button>
                        </div>
                    </div>
                </form>

                <nav class="nav page-nav__menu">
                    <a class="nav-link active" href="/my/apps/transcripts">Back to Transcripts</a>
                </nav>

            </div>
        </div>
    </div>
</div>