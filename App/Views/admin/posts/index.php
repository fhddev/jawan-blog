<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            
            <div class="card-body">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Posts</h4>
                    <a href="http://127.0.0.1:8000/admin/posts/create" class="btn btn-primary">New +</a>
                </div>
                <!-- <h4 class="card-title">Posts</h4> -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration" id="mytable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $row): ?>
                            <tr>
                                <td>
                                    <a href="http://127.0.0.1:8000/admin/posts/details/<?= $row->post_id; ?>" class="text-dark"><?= htmlspecialchars($row->title) ?></a>
                                </td>
                                <td><?= htmlspecialchars($row->category) ?></td>
                                <td><?= array_to_badges($row->decodeTags()) ?></td>
                                <td class="actions">
                                    <a href="http://127.0.0.1:8000/admin/posts/details/<?= $row->post_id; ?>" class="text-dark">View</a>
                                    <a href="http://127.0.0.1:8000/admin/posts/edit/<?= $row->post_id; ?>" class="text-dark">Edit</a>
                                    <a href="http://127.0.0.1:8000/admin/posts/delete_confirmation/<?= $row->post_id; ?>" class="text-dark">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT . '/App/Views/admin/_footer.php'; ?>