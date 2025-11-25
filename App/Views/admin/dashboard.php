<?php include_once '_header.php' ?>

<div class="mt-3">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Posts</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white"><?= $posts_count ?? 'N/A' ?></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="icon-note menu-icon"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Users</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white"><?= $users_count ?? 'N/A' ?></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
    </div>

    
</div>
<!-- #/ container -->

<?php include_once '_footer.php' ?>