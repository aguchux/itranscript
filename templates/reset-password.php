<div class="bg-primary py-32pt">
    <div class="container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
        <div class="flex mb-32pt mb-md-0">
            <h1 class="text-white mb-0">Set new password</h1>
            <p class="lead measure-lead text-white-50">Manage Transcript Application</p>
        </div>
        <a href="./my/register" class="btn btn-outline-white flex-column">
            Don't have an account?
            <span class="btn__secondary-text">Sign up Today!</span>
        </a>
    </div>
</div>
<div class="bg-white pt-32pt pt-sm-64pt pb-32pt">
    <div class="container page__container">
        <?= $Self->Toast() ?>
        <form action="./forms/my/new-password" method="POST" class="col-md-5 p-0 mx-auto">
            <?= $Self->tokenize() ?>
            <h2>Set your new password</h2>
            <div class="form-group">
                <label for="password">New Password:</label>
                <input id="password" required aria-required="true" name="password" type="password" class="form-control" placeholder="Your new password ...">
            </div>
            <div class="form-group">
                <label for="password_repeat">Confirm Password:</label>
                <input id="password" required aria-required="true" name="password_repeat" type="password" class="form-control" placeholder="Confirm password ...">
            </div>
            <div class="text-center">
                <button class="btn btn-lg btn-accent">Change Password</button>
            </div>
        </form>
    </div>
</div>