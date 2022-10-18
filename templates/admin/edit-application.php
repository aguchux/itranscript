<div class="container page__container">
    <form action="./forms/admin/transcript/<?= $Transcript->id ?>/apply-update-admin" method="POST" class="p-0 mx-auto" enctype="multipart/form-data">
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
                            <div class="col-lg-7">
                                <h4 class="card-title">Upload Documents</h4>
                                <p class="text-70">Any relevant documents from requesting institution.</p>
                            </div>
                            <div class="col-lg-5 d-flex align-items-center">
                                <div class="flex">
                                    <label class="form-label" for="documents">Upload document (*PDF)</label><br>
                                    <input type="file" class="form-control" name="documents">
                                </div>
                            </div>
                            <div class="col-lg-12 p-2">
                                <hr class="my-2 p-0" />
                                <div class="text-muted text-70">
                                    If you have any relevant documents from the institution to support this Transcript process, kindly attach above.
                                </div>
                            </div>

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
                                    <input type="text" name="sendemail" class="form-control" required aria-required="true" placeholder="email@schoolToReceive....com" value="<?= $Transcript->sendemail ?>">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Telephone of Receiver</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sendmobile" class="form-control" placeholder="e.g. +2348022334455" value="<?= $Transcript->sendmobile ?>">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Addressed(of Receiver) to</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sendname" class="form-control" required aria-required="true" placeholder="e.g. The Registrar" value="<?= $Transcript->sendname ?>">
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Name of Organisation<br />Institution*</label>
                                <div class="col-sm-8">
                                    <textarea name="sendorg" class="form-control" required aria-required="true" placeholder="e.g, Enugu State University of ..."><?= $Transcript->sendname ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Physical Address:*</label>
                                <div class="col-sm-8">
                                    <textarea type="text" name="sendaddress" required aria-required="true" placeholder="e.g: Plot 56A University Road, Esut, Agbani.." class="form-control"><?= $Transcript->sendaddress ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Destination Country*</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="sendcountry" required aria-required="true">
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
                                    <input type="text" required aria-required="true" name="matricnumber" class="form-control" readonly aria-readonly="true" placeholder="MATRIC NUMBER" value="<?= $Transcript->matricnumber ?>">
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-3">Date of Birth</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select class="form-control" name="dob_day" readonly aria-readonly="true" required aria-required="true">
                                                <option value="">Day</option>
                                                <option selected value="<?= $UserInfo->dob_day ?>"><?= $UserInfo->dob_day ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="dob_month" readonly aria-readonly="true" required aria-required="true">
                                                <option value="">Month</option>
                                                <option selected value="<?= $UserInfo->dob_month ?>"><?= $UserInfo->dob_month ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="dob_year" readonly aria-readonly="true" required aria-required="true">
                                                <option value="">Year</option>
                                                <option selected value="<?= $UserInfo->dob_year ?>"><?= $UserInfo->dob_year ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <label class="col-form-label col-sm-4">Session Admitted*</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="sessionadmitted" required aria-required="true">
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
                                    <select class="form-control" name="sessiongraduated" required aria-required="true">
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
                                    <select class="form-control" name="entrymode" required aria-required="true">
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
                                    <select class="form-control" name="faculty" required aria-required="true">
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
                                    <input type="text" id="department" value="<?= $Transcript->department ?>" name="department" required aria-required="true" class="form-control" placeholder="Department ...">
                                </div>
                            </div>
                        </div>


                        <div class="list-group-item">
                            <div class="page-nav__content">
                                <button type="submit" class="btn btn-accent btn-span">Update Application</button>
                            </div>
                        </div>
                        <!--  -->
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
                        <button type="submit" class="btn btn-accent btn-span">Update Application</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>