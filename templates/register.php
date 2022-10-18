<div class="py-64pt bg-primary">
    <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
        <img src="<?= $assets ?>admin\images\illustration\student\128\white.svg" class="mr-md-32pt mb-32pt mb-md-0" alt="student">
        <div class="flex mb-32pt mb-md-0">
            <h1 class="text-white mb-8pt">iTranscript: <span>Sign Up</span></h1>
            <p class="lead measure-lead text-white-50">Apply from the comfort of your home or office anywhere you are ONLINE and get feed back from application through to delivery without having to travel.</p>
        </div>
        <a href="/my/login" class="btn btn-outline-white flex-column">
            Already registered?
            <span class="btn__secondary-text">Sign in here!</span>
        </a>
    </div>
</div>


<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <a href="#" class="progression-bar__item progression-bar__item--active">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon">done</i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Account details</span>
                </span>
            </a>
            <a href="#" class="progression-bar__item">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Verification</span>
                </span>
            </a>
            <a href="#" class="progression-bar__item">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Create Profile</span>
                </span>
            </a>
        </div>
    </div>
</div>

<div class="bg-white py-32pt py-lg-64pt">
    <div class="container page__container">
        <div class="col-lg-10 p-0 mx-auto">
            <div class="row">
                <div class="col-md-6 mb-24pt mb-md-0">
                    <?= $Self->Toast() ?>

                    <form action="/forms/my/register" method="POST" autocomplete="off" aria-autocomplete="FALSE" class="p-0 mx-auto">
                        <?= $Self->tokenize() ?>

                        <h2>Account Information</h2>

                        <div class="form-group">
                            <label for="surname">Your Surname:</label>
                            <input id="surname" name="surname" type="text" autocomplete="off" class="form-control" placeholder="Your Surname ..." required aria-required="true">
                        </div>

                        <div class="form-group">
                            <label for="firstname">Your Firstname:</label>
                            <input id="firstname" name="firstname" type="text" autocomplete="off" class="form-control" placeholder="Your Firstname ..." required aria-required="true">
                        </div>

                        <div class="form-group">
                            <label for="email">Your email:</label>
                            <input id="email" name="email" type="email" autocomplete="off" class="form-control" placeholder="Your email address ..." required aria-required="true">
                        </div>

                        <div class="form-group mb-24pt">
                            <label for="password">Password:</label>
                            <input id="password" name="password" type="password" autocomplete="off" class="form-control" placeholder="Your password ..." required aria-required="true">
                        </div>
                        <div class="form-group mb-24pt">
                            <label for="password_repeat">Retype Password:</label>
                            <input id="password_repeat" name="password_repeat" autocomplete="off" type="password" class="form-control" placeholder="comfirm password ..." required aria-required="true">
                        </div>


                        <button class="btn btn-lg btn-accent">Create account</button>

                    </form>
                </div>
                <div class="col-md-6">
                    <div class="card mb-0">
                        <div class="card-body">

                            <h5>Quick Information</h5>
                            <div class="d-flex mb-8pt">
                                <div class="flex"><strong class="text-70">While creating your account, ensure you follow the following stated procedures.</strong></div>
                            </div>
                            <div class="d-flex mb-16pt pb-16pt border-bottom">
                                <span class="material-icons text-muted mr-8pt">check</span>
                                <span class="text-70">Make sure your email is valid and accessible.</span>
                            </div>

                            <div class="d-flex mb-16pt pb-16pt border-bottom">
                                <span class="material-icons text-muted mr-8pt">check</span>
                                <span class="text-70">Use strong password and ensure you can remember it at all time.</span>
                            </div>

                            <div class="d-flex mb-16pt pb-16pt border-bottom">
                                <span class="material-icons text-muted mr-8pt">check</span>
                                <span class="text-70">If you forget your password, kindly use <a href="./my/reset/" class="btn-link text-primary"><strong>the reset menu</strong></a>, no need to create another account..</span>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" checked="" id="topic-all">
                                <label class="custom-control-label">Terms and conditions</label>
                                <small class="form-text text-muted">By checking here and continuing, I agree to the ESUT's Terms of Use</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>