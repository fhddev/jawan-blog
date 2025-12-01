<?php include_once ROOT . '\App\Views\shared\_header.php' ?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Email Subscription Feedback</h4>
                <hr>
                <div>

                    <div class="container mt-5">
                      <div class="alert alert-<?= $status === 'failed' ? 'danger' : 'success' ?> text-center" role="alert">
                        <?= $message ?>
                      </div>

                      <div class="d-flex justify-content-center">
                        <a href="/" class="btn btn-primary">
                          Go Back to Home
                        </a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT . '\App\Views\shared\_footer.php' ?>