<div class="container page__container">
    <form action="./forms/my/edit-profile" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-7">

                <div class="page-section">
                    <h4>Update Profile &amp; Basic Details</h4>
                    <div class="list-group list-group-form">


                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <p class="text-success my-1">Please ensure that the Details are complete and correct as your application could be voided.</p>
                                <p class="text-danger my-1">* fields are required</p>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Surname </label>
                                <div class="col-sm-9">
                                    <input type="text" name="surname" required class="form-control" value="<?= $UserInfo->surname ?>" placeholder="Surname ...">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Firstname</label>
                                <div class="col-sm-9">
                                    <input type="text" name="firstname" required class="form-control" value="<?= $UserInfo->firstname ?>" placeholder="Firstname ...">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Middlename</label>
                                <div class="col-sm-9">
                                    <input type="text" name="middlename" placeholder="Middlename ...">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Telephone</label>
                                <div class="col-sm-9" style="width: 100%;">
                                    <input type="tel" id="phone" style="width: 100%;" name="mobile" required class="form-control" value="<?= $UserInfo->mobile ?>" placeholder="Telephone ...">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Sex</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="sex" id="sex" required>
                                        <option value="" <?= $UserInfo->sex == '' ? 'selected' : '' ?>> - </option>
                                        <option value="Male" <?= $UserInfo->sex == 'Male' ? 'selected' : '' ?>>Male</option>
                                        <option value="Female" <?= $UserInfo->sex == 'Female' ? 'selected' : '' ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Contact Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" id="address" cols="30" rows="2" required class="form-control" placeholder="Contact Address ..." style="height: auto;"><?= $UserInfo->address ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Nationality</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="country" class="countries" id="countryId">
                                        <option value="">Select Country</option>
                                        <?= $Core->LoadCountries($UserInfo->nationality) ?>
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
                                                <?= $Core->LoadDobDay($UserInfo->dob_day) ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="dob_month" required>
                                                <option value="">Month</option>
                                                <?= $Core->LoadDobMonth($UserInfo->dob_month) ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="dob_year" required>
                                                <option value="">Year</option>
                                                <?= $Core->LoadDobYear($UserInfo->dob_year) ?>
                                            </select>
                                        </div>
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
                        <a class="nav-link active" href="./my/apps/edit-profile">Profile &amp; Details</a>
                        <a class="nav-link" href="./my/apps/applications">Application</a>
                        <a class="nav-link" href="./my/apps/payments">Payments</a>
                    </nav>
                    <div class="page-nav__content">
                        <button type="submit" class="btn btn-accent">Update Profile Changes</button>
                    </div>
                    <div class="page-nav__content mt-4">
                        <p class="text-danger">All fields will be locked after first edit entry, to change any field, kindly request update changes and the admin will approve accordingly.</p>
                        <a type="submit" class="btn btn-accent" href="/my/apps/edit-profile-request">Request Profile Update</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>