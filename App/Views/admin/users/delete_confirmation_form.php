<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Delete User</h4>
                <hr>
                <div class="form-validation">

                    <?php if( ENV === 1 ) renderList(get_defined_vars()); ?>

                    <form class="form-valide" action="http://127.0.0.1:8000/admin/users/destroy/<?= $model->user_id ?>" method="post">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <p class="text-center h3">
                                    Are you sure you want to delete this user?
                                </p>
                                <p class="text-center">
                                    <strong><?= htmlspecialchars($model->full_name) ?></strong> 
                                    (<?= htmlspecialchars($model->username) ?>)
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 ml-auto">
                                <center>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <a href="http://127.0.0.1:8000/admin/users" class="btn btn-primary">Back to list</a>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT . '/App/Views/admin/_footer.php'; ?>