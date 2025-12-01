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
                    <h4 class="card-title">Subscribed Emails</h4>
                </div>
                <!-- <h4 class="card-title">Posts</h4> -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration" id="mytable">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Subscribed Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row->email) ?></td>
                                <td><?= htmlspecialchars($row->subscribed_at) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Email</th>
                                <th>Subscribed Date</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT . '/App/Views/admin/_footer.php'; ?>