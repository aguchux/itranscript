<div class="bg-primary py-32pt">
    <div class="container d-flex flex-column flex-sm-row align-items-sm-center">
        <div class="flex">
            <h1 class="text-white flex mb-0 text-success">Payment was successful</h1>
            <p class="lead text-white-50">You can now complete your application</p>
        </div>
        <p class="d-sm-none"></p>
        <a href="./my/payments/<?= $PaymentInfo->id ?>/print/receipt" class="btn btn-outline-white flex-column">
            Print Payment Receipt
            <span class="btn__secondary-text">Click here print receipt</span>
        </a>
    </div>
</div>

<div class="page-section bg-white">
    <div class="container page__container">
        <div class="col-sm-12 col-md-12 mx-auto">

            <div class="alert alert-light border-1 border-left-3 border-left-success d-flex mb-24pt" role="alert">
                <i class="material-icons text-success mr-3">check_circle</i>
                <div class="text-body">
                    <h4>Thank you, payment was successfull.</h4>
                    <p>A success email will be sent to your inbox shortly. Your transcript application has also been opened for application.</p>
                    <p><a href="./my/apps/<?= $TranscriptInfo->id ?>/apply" class="text-success">CLICK HERE</a> to complete your application.</p>
                </div>
            </div>

        </div>
    </div>
</div>