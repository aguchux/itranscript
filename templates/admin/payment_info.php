<div class="container page__container">
    <?= $Self->tokenize() ?>
    <div class="row">
        <div class="col-lg-7">

            <div class="page-section">
                <h2 class="mb-0">ACCID: <?= $AccidInfo->accid ?></h2>
                <h1 class="mt-0"><?= "{$AccidInfo->surname}, {$AccidInfo->firstname} {$AccidInfo->middlename}," ?></h1>
                <div class="list-group list-group-form">

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Email </label>
                            <div class="col-sm-9">
                                <input type="text" name="email" required class="form-control" value="<?= $AccidInfo->email ?>" placeholder="Email ...">
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Surname </label>
                            <div class="col-sm-9">
                                <input type="text" name="surname" required class="form-control" value="<?= $AccidInfo->surname ?>" placeholder="Surname ...">
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Firstname</label>
                            <div class="col-sm-9">
                                <input type="text" name="firstname" required class="form-control" value="<?= $AccidInfo->firstname ?>" placeholder="Firstname ...">
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Middlename</label>
                            <div class="col-sm-9">
                                <input type="text" name="middlename" required class="form-control" value="<?= $AccidInfo->middlename ?>" placeholder="Middlename ...">
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Telephone</label>
                            <div class="col-sm-9" style="width: 100%;">
                                <input type="tel" id="phone" style="width: 100%;" name="mobile" required class="form-control" value="<?= $AccidInfo->mobile ?>" placeholder="Telephone ...">
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Sex</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="sex" id="sex" required>
                                    <option value="" <?= $AccidInfo->sex == '' ? 'selected' : '' ?>> - </option>
                                    <option value="Male" <?= $AccidInfo->sex == 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= $AccidInfo->sex == 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Contact Address</label>
                            <div class="col-sm-9">
                                <textarea name="address" id="address" cols="30" rows="2" required class="form-control" placeholder="Contact Address ..." style="height: auto;"><?= $AccidInfo->address ?></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Nationality</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="country" class="countries" id="countryId">
                                    <option value="">Select Country</option>
                                    <?= $Core->LoadCountries($AccidInfo->nationality) ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Date of birth</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control" name="dob_day" required>
                                            <option value="">Day</option>
                                            <?= $Core->LoadDobDay($AccidInfo->dob_day) ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="dob_month" required>
                                            <option value="">Month</option>
                                            <?= $Core->LoadDobMonth($AccidInfo->dob_month) ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="dob_year" required>
                                            <option value="">Year</option>
                                            <?= $Core->LoadDobYear($AccidInfo->dob_year) ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="list-group-item">

                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-5 page-nav">
            <div class="page-section pt-lg-112pt">
                <nav class="nav page-nav__menu">
                    <a class="nav-link" href="/my/admin/accounts/<?= $AccidInfo->accid ?>/view">User's Registration Info</a>
                    <a class="nav-link" href="#">User's Application (<?= $Core->userCountApplications($AccidInfo->accid) ?>)</a>
                    <a class="nav-link active" href="#">User's Payment (<?= $Core->userCountPayments($AccidInfo->accid) ?>)</a>
                </nav>
            </div>
        </div>
    </div>
</div>