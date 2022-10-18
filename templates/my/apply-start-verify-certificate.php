<div class="container page__container">
    <form action="./forms/my/transcript/<?= $Transcript->id ?>/apply-start-verify-certificate" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-7">

                <div class="page-section">

                    <h1>Verification: #<?= $Transcript->id ?> </h1>

                    <div class="card card-body mb-32pt">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="card-title">Application for Certificate Verification</h4>
                            </div>
                            <div class="col-lg-12 p-2">
                                <div class="alert alert-primary">
                                    APPLICATION TYPE : <strong>CERTIFICATE VERIFICATION</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <p class="my-1"><strong>RECIEVING ADDRESS FOR DISPATCH</strong></p>
                        </div>
                    </div>

                    <div class="list-group list-group-form">


                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Email Addressed of Receiver</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sendemail" class="form-control" required placeholder="email@schoolToReceive....com" value="<?= $Transcript->sendemail ?>">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Telephone of Receiver</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sendmobile" class="form-control" placeholder="e.g. The Registrar" value="<?= $Transcript->sendmobile ?>">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Addressed(of Receiver) to</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sendname" class="form-control" required placeholder="e.g. The Registrar" value="<?= $Transcript->sendname ?>">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Name of Organisation<br />Institution*</label>
                                <div class="col-sm-8">
                                    <textarea name="sendorg" class="form-control" required placeholder="e.g, Enugu State University of ..."><?= $Transcript->sendname ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Physical Address:*</label>
                                <div class="col-sm-8">
                                    <textarea type="text" name="sendaddress" placeholder="e.g: Plot 56A University Road, Esut, Agbani.." class="form-control"><?= $Transcript->sendaddress ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Destination Country*</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="sendcountry" required>
                                        <option value="">Select Country</option>
                                        <?= $Core->LoadCountries($Transcript->sendcountry) ?>
                                    </select>
                                </div>
                            </div>
                        </div>



                    </div>


                    <div class="list-group list-group-form">

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <p class="text-danger my-1">* fields are required</p>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Matriculation Number*</label>
                                <div class="col-sm-8">
                                    <input type="text" name="matricnumber" class="form-control" disabled placeholder="MATRIC NUMBER" value="<?= $Transcript->matricnumber ?>">
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
                                                <?= $Core->LoadDobDay($Transcript->dob_day) ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="dob_month" required>
                                                <option value="">Month</option>
                                                <?= $Core->LoadDobMonth($Transcript->dob_month) ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="dob_year" required>
                                                <option value="">Year</option>
                                                <?= $Core->LoadDobYear($Transcript->dob_year) ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>
                        
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Session Admitted*</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="sessionadmitted" required>
                                        <option value="">Select Session</option>
                                        <?= $Core->LoadSessionAdmitted($Transcript->sessionadmitted) ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Session Graduated*</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="sessiongraduated" required>
                                        <option value="">Select Session</option>
                                        <?= $Core->LoadSessionAdmitted($Transcript->sessiongraduated) ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Entry Status*</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="entrymode" required>
                                        <option value="">Mode of Entry</option>
                                        <option value="JAMB" <?= $Transcript->entrymode == "JAMB" ? "selected" : "" ?>>JAMB</option>
                                        <option value="DIRECT ENTRY" <?= $Transcript->entrymode == "DIRECT ENTRY" ? "selected" : "" ?>>DIRECT ENTRY</option>
                                        <option value="TRANSFER" <?= $Transcript->entrymode == "TRANSFER" ? "selected" : "" ?>>TRANSFER</option>
                                        <option value="OTHERS" <?= $Transcript->entrymode == "OTHERS" ? "selected" : "" ?>>OTHERS</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Faculty*</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="faculty" required>
                                        <option <?= $Transcript->faculty == "" ? "selected" : "" ?> value="">Select Faculty</option>
                                        <option <?= $Transcript->faculty == "Agriculture and Natural Resources" ? "selected" : "" ?> value="Agriculture and Natural Resources">Agriculture and Natural Resources</option>
                                        <option <?= $Transcript->faculty == "Applied Natural Science" ? "selected" : "" ?> value="Applied Natural Science">Applied Natural Science</option>
                                        <option <?= $Transcript->faculty == "Education" ? "selected" : "" ?> value="Education">Education</option>
                                        <option <?= $Transcript->faculty == "Engineering" ? "selected" : "" ?> value="Engineering">Engineering</option>
                                        <option <?= $Transcript->faculty == "Environmental Science" ? "selected" : "" ?> value="Environmental Science">Environmental Science</option>
                                        <option <?= $Transcript->faculty == "Law" ? "selected" : "" ?> value="Law">Law</option>
                                        <option <?= $Transcript->faculty == "Management Science" ? "selected" : "" ?> value="Management Science">Management Science</option>
                                        <option <?= $Transcript->faculty == "Clinical Medicine" ? "selected" : "" ?> value="Clinical Medicine">Clinical Medicine</option>
                                        <option <?= $Transcript->faculty == "Basic Medicine" ? "selected" : "" ?> value="Basic Medicine">Basic Medicine</option>
                                        <option <?= $Transcript->faculty == "Pharmacy" ? "selected" : "" ?> value="Pharmacy">Pharmacy</option>
                                        <option <?= $Transcript->faculty == "Social science" ? "selected" : "" ?> value="Social science">Social science</option>
                                        <option <?= $Transcript->faculty == "Others not listed" ? "selected" : "" ?> value="Others not listed">Others not listed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Department*</label>
                                <div class="col-sm-8">
                                    <input type="text" id="department" value="<?= $Transcript->department ?>" name="department" required class="form-control" placeholder="Department ...">
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">

                            <?php if ($Transcript->progress == "0") : ?>
                                <button type="submit" disabled class="btn btn-accent"> - Awaiting payment -</button>
                            <?php elseif ($Transcript->progress == "1") : ?>
                                <button type="submit" class="btn btn-accent">Submit Application</button>
                            <?php elseif ($Transcript->progress == "2") : ?>
                                <button type="submit" class="btn btn-accent" disabled> - Processing -</button>
                            <?php endif; ?>

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
                        
                        <?php if ($Transcript->progress == "0") : ?>
                            <button type="submit" disabled class="btn btn-accent"> - Awaiting payment -</button>
                        <?php elseif ($Transcript->progress == "1") : ?>
                            <button type="submit" class="btn btn-accent">Submit Application</button>
                        <?php elseif ($Transcript->progress == "2") : ?>
                            <button type="submit" class="btn btn-accent" disabled> - Processing -</button>
                        <?php endif; ?> 
                    
                    </div>



                </div>
            </div>
        </div>
    </form>
</div>