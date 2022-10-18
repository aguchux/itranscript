<div class="bg-primary py-32pt">
    <div class="container d-flex flex-column flex-sm-row align-items-sm-center">
        <div class="flex">
            <h1 class="text-white flex mb-0">Reset Password</h1>
            <p class="lead text-white-50">Reset iTranscript Password</p>
        </div>
        <p class="d-sm-none"></p>
        <a href="./info/support" class="btn btn-outline-white flex-column">
            Can't Reset or Need Help?
            <span class="btn__secondary-text">Contact support team</span>
        </a>
    </div>
</div>

<div class="page-section bg-white">
    <div class="container page__container">
        <div class="col-sm-6 mx-auto">

            <div class="alert alert-light border-1 border-left-3 border-left-accent d-none mb-24pt" role="alert">
                <i class="material-icons text-accent mr-3">check_circle</i>
                <div class="text-body">An email with password reset instructions has been sent to your email address, if it exists on our system.</div>
            </div>
           
            <?= $Self->Toast() ?>

            <form action="./forms/my/reset" method="POST" class="p-0 mx-auto">
                <?= $Self->tokenize() ?>
                <div class="form-group">
                    <label>iTranscript Account Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Your email address ..." required aria-required="true">
                    <small class="form-text text-muted">We will email you with info on how to reset your password.</small>
                </div>
                <div class="text-center">
                    <button class="btn btn-accent btn-lg">Reset Account</button>
                </div>

            </form>
        </div>
    </div>
</div>