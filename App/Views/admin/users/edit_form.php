<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
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

                    <form class="form-valide" action="http://127.0.0.1:8000/admin/users/edit_submit/<?= $model->user_id ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="username">Username <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="username" name="username" value="<?= htmlspecialchars($model->username ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="full_name">Full Name <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="full_name" name="full_name" value="<?= htmlspecialchars($model->full_name ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="email" class="form-control input-default" id="email" name="email" value="<?= htmlspecialchars($model->email ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="role">Role <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control input-default" id="role" name="role">
                                    <option value="" <?= $model->role === '' ? 'selected' : '' ?>>Please select</option>
                                    <option value="admin" <?= $model->role === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="editor" <?= $model->role === 'editor' ? 'selected' : '' ?>>Editor</option>
                                    <option value="user" <?= $model->role === 'user' ? 'selected' : '' ?>>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="job_title">Job Title</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="job_title" name="job_title" value="<?= htmlspecialchars($model->job_title ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="bio">Bio</label>
                            <div class="col-lg-6">
                                <textarea class="form-control input-default summernote" id="bio" name="bio"><?= htmlspecialchars($model->bio ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="picture_path">Profile Picture</label>
                            <div class="col-lg-6">
                                <img src="<?= '/'.$model->picture_path ?? '#' ?>" class="img-thumbnail" alt="Profile picture">
                                <input type="file" class="form-control input-default" id="picture_path" name="picture_path">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Social Links</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default mb-2" name="facebook_link" placeholder="Facebook" value="<?= htmlspecialchars($model->facebook_link ?? '') ?>">
                                <input type="text" class="form-control input-default mb-2" name="x_link" placeholder="X (Twitter)" value="<?= htmlspecialchars($model->x_link ?? '') ?>">
                                <input type="text" class="form-control input-default mb-2" name="github_link" placeholder="GitHub" value="<?= htmlspecialchars($model->github_link ?? '') ?>">
                                <input type="text" class="form-control input-default mb-2" name="website_link" placeholder="Website" value="<?= htmlspecialchars($model->website_link ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="http://127.0.0.1:8000/admin/users" class="btn btn-secondary">Back to list</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT . '/App/Views/admin/_footer.php'; ?>