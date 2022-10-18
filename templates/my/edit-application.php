<div class="container page__container">
    <form action="./forms/my/transcript/<?= $Transcript->id ?>/apply-update" method="POST" class="p-0 mx-auto" enctype="multipart/form-data">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-7">

                <div class="page-section">

                    <h2>Edit Transcript: #<?= $Transcript->id ?></h2>

                    <div class="card card-body mb-32pt">
                        <div class="row">
                            <div class="col-lg-12 p-2">
                                <div class="alert alert-primary">
                                    APPLICATION TYPE : <?= $Transcript->international == 1 ? '<strong>INTERNATIONAL TRANSCRIPT</strong>' : '<strong>LOCAL TRANSCRIPT</strong>' ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card card-body mb-32pt">
                        <div class="row">

                            <div class="col-lg-12 p-2">
                                <hr class="my-2 p-0" />
                                <div class="form-group row mb-0">
                                    <label class="col-form-label col-sm-12">Additional (Use Case) Instruction</label>
                                    <div class="col-sm-12">
                                        <textarea name="instructions" id="instructions" rows="2" class="form-control" placeholder="Give additional instuction to ensure we meet your application use case."><?= $Transcript->instructions ?></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

            </div>
            <div class="col-lg-5 page-nav">
                <div class="page-section pt-lg-112pt">

                    <nav class="nav page-nav__menu">
                        <a class="nav-link" href="./my">Dashboard</a>
                        <a class="nav-link" href="./my/apps/edit-profile">Profile &amp; Details</a>
                        <a class="nav-link active" href="./my/apps/applications">Application</a>
                        <a class="nav-link" href="./my/apps/payments">Payments</a>
                    </nav>

                    <div class="page-nav__content">
                            <button type="submit" class="btn btn-accent disabled" disabled>Update Application</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>