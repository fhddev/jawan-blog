<?php include_once ROOT . '/App/Views/admin/_header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            
            <div class="card-body">
                <?php if($app->session->exists('alert')): ?>
                    <div class="alert alert-<?= $app->session->fetch('alert')['type'] ?> alert-dismissible fade show" role="alert">
                        <?= $app->session->fetch('alert')['alert-message'] ?>
                    </div>

                    <?php $app->session->drop('alert'); ?>
                <?php endif; ?>

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Users</h4>
                    <a href="http://127.0.0.1:8000/admin/users/create" class="btn btn-primary">New +</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration" id="mytable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $row): ?>
                            <tr>
                                <td>
                                    <a href="http://127.0.0.1:8000/admin/users/details/<?= $row->user_id; ?>" class="text-dark">
                                        <?= htmlspecialchars($row->username) ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($row->full_name) ?></td>
                                <td><?= htmlspecialchars($row->email) ?></td>
                                <td><?= htmlspecialchars($row->role) ?></td>
                                <td class="actions">
                                    <a href="http://127.0.0.1:8000/admin/users/details/<?= $row->user_id; ?>" class="text-dark">View</a>
                                    <a href="http://127.0.0.1:8000/admin/users/edit/<?= $row->user_id; ?>" class="text-dark">Edit</a>
                                    <a href="http://127.0.0.1:8000/admin/users/delete_confirmation/<?= $row->user_id; ?>" class="text-dark">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
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