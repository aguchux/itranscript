<div class="bg-primary py-32pt">
    <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
        <img src="<?= $assets ?>admin\images\illustration\student\128\white.svg" class="mr-md-32pt mb-32pt mb-md-0">
        <div class="flex mb-32pt mb-md-0">
            <h1 class="text-white mb-0">iTranscript: <span>Sign In</span></h1>
            <p class="lead measure-lead text-white-50">Manage Transcript Application</p>
        </div>
        <a href="/my/register" class="btn btn-outline-white flex-column">
            Don't have an account?
            <span class="btn__secondary-text">Sign up Today!</span>
        </a>
    </div>
</div>
<div class="bg-white pt-32pt pt-sm-64pt pb-32pt">
    <div class="container page__container">
        <?= $Self->Toast() ?>
        <form action="/forms/my/login" autocomplete="off" method="POST" class="col-md-5 p-0 mx-auto">
            <?= $Self->tokenize() ?>
            <div class="form-group">
                <label for="email">Account's Email:</label>
                <input id="email" autocomplete="off" required aria-required="true" name="email" type="text" class="form-control" placeholder="Your email address ...">
            </div>
            <div class="form-group">
                <label for="password">Account's Password:</label>
                <input id="password" autocomplete="off" required aria-required="true" name="password" type="password" class="form-control" placeholder="Your password ...">
                <p class="text-right"><a href="./my/reset" class="small">Forgot your password?</a></p>
            </div>
            <div class="text-center">
                <button class="btn btn-lg btn-accent">Login to iTranscript</button>
            </div>
        </form>
    </div>
</div>