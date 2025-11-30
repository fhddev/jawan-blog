<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Details</h4>
                <hr>
                <div class="form-validation">

                    <?php if( ENV === 1 ) renderList(get_defined_vars()); ?>

                    <form>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Username <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->username ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Full Name <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->full_name ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->email ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Role <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->role ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Job Title</label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->job_title ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Bio</label>
                            <div class="col-lg-6">
                                <p><?= nl2br(htmlspecialchars($model->bio ?? '')) ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Profile Picture</label>
                            <div class="col-lg-6">
                                <img src="<?= '/'.$model->picture_path ?? '#' ?>" 
                                    class="img-thumbnail" 
                                    alt="Profile picture">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Social Links</label>
                            <div class="col-lg-6">
                                <p>
                                    <?php if(!empty($model->facebook_link)): ?>
                                        <a href="<?= htmlspecialchars($model->facebook_link) ?>" target="_blank">Facebook</a><br>
                                    <?php endif; ?>
                                    <?php if(!empty($model->x_link)): ?>
                                        <a href="<?= htmlspecialchars($model->x_link) ?>" target="_blank">X (Twitter)</a><br>
                                    <?php endif; ?>
                                    <?php if(!empty($model->github_link)): ?>
                                        <a href="<?= htmlspecialchars($model->github_link) ?>" target="_blank">GitHub</a><br>
                                    <?php endif; ?>
                                    <?php if(!empty($model->website_link)): ?>
                                        <a href="<?= htmlspecialchars($model->website_link) ?>" target="_blank">Website</a>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Created At</label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->created_at ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <a href="http://127.0.0.1:8000/admin/users" class="btn btn-primary">Back to list</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT . '/App/Views/admin/_footer.php'; ?>