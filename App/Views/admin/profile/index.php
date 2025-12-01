<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3" src="/<?= $user->picture_path ?>" width="80" height="80" alt="">
                        <div class="media-body">
                            <h3 class="mb-0"><?= $user->full_name ?></h3>
                            <p class="text-muted mb-0"><?= $user->job_title ?></p>
                        </div>
                    </div>
                    
                    <h4>About Me</h4>
                    <p class="text-muted"><?= $user->bio ?></p>
                    <ul class="card-profile__info">
                        <li class="mb-1"><strong class="text-dark mr-4">Username</strong> <span><?= $user->username ?></span></li>
                        <li><strong class="text-dark mr-4">Email</strong> <span><?= $user->email ?></span></li>
                    </ul>
                </div>
            </div>  
        </div>
    </div>
</div>
<!-- #/ container -->

<?php include_once ROOT . '/App/Views/admin/_footer.php'; ?>