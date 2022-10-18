<div class="container page__container">
    <form action="./forms/my/edit-settings" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-7">

                <div class="page-section">
                    <h4>Update Site &amp; Settings</h4>
                    <div class="list-group list-group-form">

                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex">
                                    <label class="form-label" for="international">Enable Split Routing?</label><br>
                                    <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1 disabled">
                                        <input type="checkbox" id="use_default_split" name="use_default_split" <?= $SiteSettings->use_default_split == 1 ? 'checked' : '' ?> value="1" class="custom-control-input">
                                        <label class="custom-control-label disabled" for="use_default_split"><?= $SiteSettings->use_default_split == 1 ? 'Yes' : 'No' ?></label>
                                    </div>
                                    <label class="form-label mb-0 text-success" for="use_default_split"><?= $SiteSettings->use_default_split == 1 ? 'Yes, Enable' : 'No, Disable' ?></label>
                                </div>
                            </div>
                        </div>


                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex row">
                                    <label class="form-label col-md-6" for="Monday">Split on Monday</label><br>
                                    <div class="col-md-6custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                        <input type="checkbox" id="Monday" name="Monday" <?= $SiteSettings->Monday == 1 ? 'checked' : '' ?> value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="Monday"><?= $SiteSettings->Monday == 1 ? 'Yes' : 'No' ?></label>
                                    </div>
                                    <label class="form-label mb-0 text-success" for="Monday"><?= $SiteSettings->Monday == 1 ? 'Yes' : 'No' ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex row">
                                    <label class="form-label col-md-6" for="Tuesday">Split on Tuesday</label><br>
                                    <div class="col-md-6custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                        <input type="checkbox" id="Tuesday" name="Tuesday" <?= $SiteSettings->Tuesday == 1 ? 'checked' : '' ?> value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="Tuesday"><?= $SiteSettings->Tuesday == 1 ? 'Yes' : 'No' ?></label>
                                    </div>
                                    <label class="form-label mb-0 text-success" for="Tuesday"><?= $SiteSettings->Tuesday == 1 ? 'Yes' : 'No' ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex row">
                                    <label class="form-label col-md-6" for="Wednesday">Split on Wednesday</label><br>
                                    <div class="col-md-6custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                        <input type="checkbox" id="Wednesday" name="Wednesday" <?= $SiteSettings->Wednesday == 1 ? 'checked' : '' ?> value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="Wednesday"><?= $SiteSettings->Wednesday == 1 ? 'Yes' : 'No' ?></label>
                                    </div>
                                    <label class="form-label mb-0 text-success" for="Wednesday"><?= $SiteSettings->Wednesday == 1 ? 'Yes' : 'No' ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex row">
                                    <label class="form-label col-md-6" for="Thursday">Split on Thursday</label><br>
                                    <div class="col-md-6custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                        <input type="checkbox" id="Thursday" name="Thursday" <?= $SiteSettings->Thursday == 1 ? 'checked' : '' ?> value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="Thursday"><?= $SiteSettings->Thursday == 1 ? 'Yes' : 'No' ?></label>
                                    </div>
                                    <label class="form-label mb-0 text-success" for="Thursday"><?= $SiteSettings->Thursday == 1 ? 'Yes' : 'No' ?></label>
                                </div>
                            </div>
                        </div>


                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex row">
                                    <label class="form-label col-md-6" for="Friday">Split on Friday</label><br>
                                    <div class="col-md-6custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                        <input type="checkbox" id="Friday" name="Friday" <?= $SiteSettings->Friday == 1 ? 'checked' : '' ?> value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="Friday"><?= $SiteSettings->Friday == 1 ? 'Yes' : 'No' ?></label>
                                    </div>
                                    <label class="form-label mb-0 text-success" for="Friday"><?= $SiteSettings->Friday == 1 ? 'Yes' : 'No' ?></label>
                                </div>
                            </div>
                        </div>


                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex row">
                                    <label class="form-label col-md-6" for="Saturday">Split on Saturday</label><br>
                                    <div class="col-md-6custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                        <input type="checkbox" id="Saturday" name="Saturday" <?= $SiteSettings->Saturday == 1 ? 'checked' : '' ?> value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="Saturday"><?= $SiteSettings->Saturday == 1 ? 'Yes' : 'No' ?></label>
                                    </div>
                                    <label class="form-label mb-0 text-success" for="Saturday"><?= $SiteSettings->Saturday == 1 ? 'Yes' : 'No' ?></label>
                                </div>
                            </div>
                        </div>


                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex row">
                                    <label class="form-label col-md-6" for="Sunday">Split on Sunday</label><br>
                                    <div class="col-md-6custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                        <input type="checkbox" id="Sunday" name="Sunday" <?= $SiteSettings->Sunday == 1 ? 'checked' : '' ?> value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="Sunday"><?= $SiteSettings->Sunday == 1 ? 'Yes' : 'No' ?></label>
                                    </div>
                                    <label class="form-label mb-0 text-success" for="Sunday"><?= $SiteSettings->Sunday == 1 ? 'Yes' : 'No' ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex row">
                                    <button type="submit" class="btn btn-accent">Update Site Settings</button>
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
                    </nav>
                    <div class="page-nav__content">
                        <button type="submit" class="btn btn-accent">Update Site Settings</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>