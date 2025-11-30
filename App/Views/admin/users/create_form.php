<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create User</h4>
                <hr>
                <div class="form-validation">

                    <?php if( ENV === 1 ) renderList(get_defined_vars()); ?>

                    <?php if ( ! empty($errors) ): ?>
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">Validation errors:</h5>
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form class="form-valide" action="http://127.0.0.1:8000/admin/users/create_submit" method="post" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="role">Role <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control input-default" id="role" name="role">
                                    <option value="" <?= htmlspecialchars($model->role !== null && $model->role === '' ? 'selected' : '') ?>>Please select</option>
                                    <option value="admin" <?= htmlspecialchars($model->role !== null && $model->role === 'admin' ? 'selected' : '') ?>>Admin</option>
                                    <option value="author" <?= htmlspecialchars($model->role !== null && $model->role === 'author' ? 'selected' : '') ?>>Author</option>
                                    <option value="guest" <?= htmlspecialchars($model->role !== null && $model->role === 'guest' ? 'selected' : '') ?>>Guest</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="username">Username <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="username" name="username" value="<?= htmlspecialchars($model->username ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">Email <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="email" name="email" value="<?= htmlspecialchars($model->email ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="password_hash">Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="password_hash" name="password_hash" value="<?= htmlspecialchars($model->password_hash ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="full_name">Full Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="full_name" name="full_name" value="<?= htmlspecialchars($model->full_name ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="picture_path">Picture <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="file" class="form-control input-default" id="picture_path" name="picture_path" value="<?= htmlspecialchars($model->picture_path ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="job_title">Job Title <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="job_title" name="job_title" value="<?= htmlspecialchars($model->job_title ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="bio">Bio <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control input-default summernote" id="bio" name="bio"><?= htmlspecialchars($model->bio ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="facebook_link">Facebook Link <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="facebook_link" name="facebook_link" value="<?= htmlspecialchars($model->facebook_link ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="x_link">X Link <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="x_link" name="x_link" value="<?= htmlspecialchars($model->x_link ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="github_link">Github Link <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="github_link" name="github_link" value="<?= htmlspecialchars($model->github_link ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="website_link">Website Link <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="website_link" name="website_link" value="<?= htmlspecialchars($model->website_link ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT . '/App/Views/admin/_footer.php'; ?>