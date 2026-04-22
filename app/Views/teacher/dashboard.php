<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Teacher Dashboard</h1>
        </div>

        <!-- Content Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 text-center">
                <i class="bi bi-person-badge text-primary" style="font-size: 3rem;"></i>
                <h2 class="mt-3">Welcome, <?= esc($user['name']) ?>!</h2>
                <p class="text-muted">You are logged in as a <strong><?= esc($user['role_name']) ?></strong>.</p>
                <hr>
                <a href="<?= base_url('management/students') ?>" class="btn btn-primary">
                    <i class="bi bi-people me-2"></i>Manage Students
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
