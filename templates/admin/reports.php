<div class="container page__container">
    <form action="/my/admin/report" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-7">

                <div class="page-section">
                    <h4>Search Applications</h4>

                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-4">Start Date</label>
                            <div class="col-sm-8">
                                <input type="date" name="startdate" required class="form-control" placeholder="Search ...">
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-4">End Date</label>
                            <div class="col-sm-8">
                                <input type="date" name="ensdate" required class="form-control" placeholder="Search ...">
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <div class="col-sm-12">
                                <div class="page-nav__content mt-2">
                                    <button type="submit" class="btn btn-accent">Search Application</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-5 page-nav">
                <div class="page-section pt-lg-112pt">

                    <div class="page-nav__content">
                        <h4>iTranscript Support</h4>
                        <p class="text-70">Our iTranscript team will be available Mondays - Fridays (8AM to 4PM) to attend to your questions and issues.</p>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>