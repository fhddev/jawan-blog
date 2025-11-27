<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Post</h4>
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

                    <form class="form-valide" action="http://127.0.0.1:8000/admin/posts/edit_submit/<?= $model->post_id ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="url_slug">URL Slug <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="url_slug" name="url_slug" value="<?= htmlspecialchars($model->url_slug ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="title">Title <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control input-default" id="title" name="title" value="<?= htmlspecialchars($model->title ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="category">Category <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control input-default" id="category" name="category">
                                    <option value="" <?= htmlspecialchars($model->category !== null && $model->category === '' ? 'selected' : '') ?>>Please select</option>
                                    <option value="Creativity" <?= htmlspecialchars($model->category !== null && $model->category === 'Creativity' ? 'selected' : '') ?>>Creativity</option>
                                    <option value="Demo" <?= htmlspecialchars($model->category !== null && $model->category === 'Demo' ? 'selected' : '') ?>>Demo</option>
                                    <option value="Elements" <?= htmlspecialchars($model->category !== null && $model->category === 'Elements' ? 'selected' : '') ?>>Elements</option>
                                    <option value="Food" <?= htmlspecialchars($model->category !== null && $model->category === 'Food' ? 'selected' : '') ?>>Food</option>
                                    <option value="Microwave" <?= htmlspecialchars($model->category !== null && $model->category === 'Microwave' ? 'selected' : '') ?>>Microwave</option>
                                    <option value="Natural" <?= htmlspecialchars($model->category !== null && $model->category === 'Natural' ? 'selected' : '') ?>>Natural</option>
                                    <option value="Newyork city" <?= htmlspecialchars($model->category !== null && $model->category === 'Newyork city' ? 'selected' : '') ?>>Newyork city</option>
                                    <option value="Nice" <?= htmlspecialchars($model->category !== null && $model->category === 'Nice' ? 'selected' : '') ?>>Nice</option>
                                    <option value="Tech" <?= htmlspecialchars($model->category !== null && $model->category === 'Tech' ? 'selected' : '') ?>>Tech</option>
                                    <option value="Videography" <?= htmlspecialchars($model->category !== null && $model->category === 'Videography' ? 'selected' : '') ?>>Videography</option>
                                    <option value="Vlog" <?= htmlspecialchars($model->category !== null && $model->category === 'Vlog' ? 'selected' : '') ?>>Vlog</option>
                                    <option value="Wondarland" <?= htmlspecialchars($model->category !== null && $model->category === 'Wondarland' ? 'selected' : '') ?>>Wondarland</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="tags">Tags <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control input-default" multiple id="tags" name="tags[]" data-choices="post-tags">
                                    <option value="City" <?= $model->tags !== null && in_array('City', $model->decodeTags()) ? "selected" : "" ?>>City</option>
                                    <option value="Color" <?= $model->tags !== null && in_array('Color', $model->decodeTags()) ? "selected" : "" ?>>Color</option>
                                    <option value="Creative" <?= $model->tags !== null && in_array('Creative', $model->decodeTags()) ? "selected" : "" ?>>Creative</option>
                                    <option value="Decorate" <?= $model->tags !== null && in_array('Decorate', $model->decodeTags()) ? "selected" : "" ?>>Decorate</option>
                                    <option value="Demo" <?= $model->tags !== null && in_array('Demo', $model->decodeTags()) ? "selected" : "" ?>>Demo</option>
                                    <option value="Elements" <?= $model->tags !== null && in_array('Elements', $model->decodeTags()) ? "selected" : "" ?>>Elements</option>
                                    <option value="Fish" <?= $model->tags !== null && in_array('Fish', $model->decodeTags()) ? "selected" : "" ?>>Fish</option>
                                    <option value="Food" <?= $model->tags !== null && in_array('Food', $model->decodeTags()) ? "selected" : "" ?>>Food</option>
                                    <option value="Nice" <?= $model->tags !== null && in_array('Nice', $model->decodeTags()) ? "selected" : "" ?>>Nice</option>
                                    <option value="Recipe" <?= $model->tags !== null && in_array('Recipe', $model->decodeTags()) ? "selected" : "" ?>>Recipe</option>
                                    <option value="Season" <?= $model->tags !== null && in_array('Season', $model->decodeTags()) ? "selected" : "" ?>>Season</option>
                                    <option value="Taste" <?= $model->tags !== null && in_array('Taste', $model->decodeTags()) ? "selected" : "" ?>>Taste</option>
                                    <option value="Tasty" <?= $model->tags !== null && in_array('Tasty', $model->decodeTags()) ? "selected" : "" ?>>Tasty</option>
                                    <option value="Vlog" <?= $model->tags !== null && in_array('Vlog', $model->decodeTags()) ? "selected" : "" ?>>Vlog</option>
                                    <option value="Wow" <?= $model->tags !== null && in_array('Wow', $model->decodeTags()) ? "selected" : "" ?>>Wow</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="content">Content <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <textarea  class="form-control input-default summernote" id="content" name="content"><?= html_entity_decode($model->content ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="cover_image">Cover Image <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <img src="<?= '/'.$model->cover_image ?? '#' ?>" class="img-thumbnail" alt="Cover image">
                                <input type="file" class="form-control input-default" id="cover_image" name="cover_image">
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