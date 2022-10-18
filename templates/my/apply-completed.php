<div class="bg-primary py-32pt">
    <div class="container d-flex flex-column flex-sm-row align-items-sm-center">
        <div class="flex">
            <h1 class="text-white flex mb-0 text-success">Application was successful</h1>
            <p class="lead text-white-50">You don't need to do anything, just sit back and wait while we process your transcript</p>
        </div>
        <p class="d-sm-none"></p>
        <a href="./my/apps/transcript/<?= $Transcript->id ?>/status" class="text-success btn btn-outline-white flex-column">
           Check Status
            <span class="btn__secondary-text">Click here for status</span>
        </a>
    </div>
</div>

<div class="page-section bg-white">
    <div class="container page__container">
        <div class="col-sm-12 col-md-12 mx-auto">

            <div class="alert alert-light border-1 border-left-3 border-left-success d-flex mb-24pt" role="alert">
                <i class="material-icons text-success mr-3">check_circle</i>
                <div class="text-body">
                    <h3>Application is now submitted.</h3>
                    <p>You don't need to do anything, just sit back and wait while we process your transcript</p>
                    <p><a href="./my/apps/transcript/<?= $Transcript->id ?>/status" class="text-success">CLICK HERE</a> to complete check status of your application.</p>
                </div>
            </div>

        </div>
    </div>
</div>