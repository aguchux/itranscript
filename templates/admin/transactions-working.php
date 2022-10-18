<div class="container page__container">
    <form action="./forms/my/transcript/apply" method="POST" class="p-0 mx-auto">
        <div class="row">

            <?php if (isset($_REQUEST['verified'])) :
                $verified = $_REQUEST['verified'];  ?>
                <div class="col-lg-12 text-center mt-5 p-0">
                    <?php if ($verified == 'true') : ?>
                        <div class="alert alert-success m-0 p-0">
                            <h2 class="m-0 p-0">Payment has been verified.</h2>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-danger m-0 p-0">
                            <h2 class="m-0 p-0">Payment verification failed.</h2>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>


            <div class="col-lg-12">
                <div class="page-section">
                    <form action="/forms/my/admin/searchtransactions" method="POST" class="p-0 mx-auto">
                        <h4>Search Transactions</h4>
                        <?= $Self->Toast() ?>
                        <div class="list-group-item">
                            <div class="form-group row mb-0">
                                <div class="col-sm-6 col-md-6"><label class="col-form-label col-sm-4">Begining Date</label></div>
                                <div class="col-sm-6 col-md-6"><label class="col-form-label col-sm-4">Ending Date</label></div>

                                <div class="col-sm-6 col-md-6">
                                    <input type="date" name="DateFrom" required class="form-control" placeholder="Date From ...">
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <input type="date" name="DateTo" required class="form-control" placeholder="Date To ...">
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="page-nav__content mt-2">
                                <button type="submit" class="btn btn-accent" id="QuickSearchTrasactions">Quick Transactions Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </form>
</div>