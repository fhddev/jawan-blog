<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Details</h4>
                <hr>
                <div class="form-validation">

                    <?php if( ENV === 1 ) renderList(get_defined_vars()); ?>

                    <form>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="url_slug">URL Slug <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->url_slug ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="title">Title <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->title ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="category">Category <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <p><?= htmlspecialchars($model->category ?? '') ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="tags">Tags <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <p><?= $model->tags === null ? '' : array_to_badges($model->decodeTags()) ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="content">Content <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <?= html_entity_decode($model->content ?? '') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="cover_image">Cover Image <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <img src="<?= '/'.$model->cover_image ?? '#' ?>" 
                                    class="img-thumbnail" 
                                    alt="Cover image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <a href="http://127.0.0.1:8000/admin/posts" class="btn btn-primary">Back to list</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT . '/App/Views/admin/_footer.php'; ?>