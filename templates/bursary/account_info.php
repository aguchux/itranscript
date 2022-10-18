<div class="container page__container">
    <?= $Self->tokenize() ?>
    <div class="row">
        <div class="col-lg-7">

            <div class="page-section">
                <h2 class="mb-0">ACCID: <?= $AccidInfo->accid ?></h2>
                <h1 class="mt-0">
                    <?= "{$AccidInfo->surname}, {$AccidInfo->firstname} {$AccidInfo->middlename}," ?></h1>

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

                <form action="/forms/my/user/<?= $AccidInfo->accid ?>/setadmin" method="POST" class="p-0 mx-auto">
                    <?= $Self->tokenize() ?>
                    <div class="list-group list-group-form">
                        <div class="list-group-item">

                            <div class="row">

                                <div class="col-lg-12">
                                    <h4 class="card-title">Make Student</h4>
                                    <p class="text-70">make this user an student.</p>
                                </div>
                                <div class="col-lg-12 d-flex align-items-center">
                                    <div class="flex">
                                        <label class="form-label" for="is_student">Student?</label><br>
                                        <div class="custom-control custom-radio-toggle custom-control-inline mr-1">
                                            <input type="radio" <?= $AccidInfo->is_admin == 0 ? 'checked' : '' ?> id="is_student" name="is_admin" value="0" class="custom-control-input">
                                            <label class="custom-control-label" for="is_student"><?= $AccidInfo->is_admin == 0 ? 'Yes' : 'No' ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <hr class="border-success border-1" />
                                </div>

                                <div class="col-lg-12">
                                    <h4 class="card-title">Make Admin</h4>
                                    <p class="text-70">make this user an administrator.</p>
                                </div>
                                <div class="col-lg-12 d-flex align-items-center">
                                    <div class="flex">
                                        <label class="form-label" for="is_admin">Administrator</label><br>
                                        <div class="custom-control custom-radio-toggle custom-control-inline mr-1">
                                            <input type="radio" <?= $AccidInfo->is_admin == 1 ? 'checked' : '' ?> id="is_admin" name="is_admin" value="1" class="custom-control-input">
                                            <label class="custom-control-label" for="is_admin"><?= $AccidInfo->is_admin == 1 ? 'Yes' : 'No' ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <hr class="border-success border-1" />
                                </div>

                                <div class="col-lg-12">
                                    <h4 class="card-title">Make Bursary</h4>
                                    <p class="text-70">make this user a payment processor.</p>
                                </div>
                                <div class="col-lg-12 d-flex align-items-center">
                                    <div class="flex">
                                        <label class="form-label" for="is_bursary">Bursary & Payments</label><br>
                                        <div class="custom-control custom-radio-toggle custom-control-inline mr-1">
                                            <input type="radio" <?= $AccidInfo->is_admin == 2 ? 'checked' : '' ?> id="is_bursary" name="is_admin" value="2" class="custom-control-input">
                                            <label class="custom-control-label" for="is_bursary"><?= $AccidInfo->is_admin == 2 ? 'Yes' : 'No' ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="list-group-item">

                            <button type="submit" class="btn btn-accent">Upgrade Account Role</button>

                        </div>

                    </div>
                </form>

                <nav class="nav page-nav__menu">
                    <a class="nav-link active" href="/my/admin/accounts/<?= $AccidInfo->accid ?>/view">User's Registration Info</a>
                    <a class="nav-link" href="#">User's Application (<?= $Core->userCountApplications($AccidInfo->accid) ?>)</a>
                    <a class="nav-link" href="#">User's Payment (<?= $Core->userCountPayments($AccidInfo->accid) ?>)</a>
                </nav>

                <form action="/forms/my/user/quicklogin" method="POST" class="p-0 mx-auto">
                    <?= $Self->tokenize() ?>
                    <input type="hidden" name="password" id="password" value="<?= $AccidInfo->password ?>">
                    <div class="list-group list-group-form">
                        <div class="list-group-item">

                            <div class="row">

                                <div class="col-lg-12">
                                    <h4 class="card-title">Login as User</h4>
                                    <p class="text-70">see what this user is seeing.</p>
                                </div>

                                <div class="col-lg-12 d-flex align-items-center">
                                    <div class="flex">
                                        <label class="form-label" for="email">Email</label><br>
                                        <div class="form-group mr-1">
                                            <input type="text" id="email" name="email" class="form-control" value="<?= $AccidInfo->email ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="list-group-item">

                                <button type="submit" class="btn btn-accent">Login to User</button>

                            </div>

                        </div>
                </form>

            </div>
        </div>
    </div>
</div>