<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Coordinator Hub</h1>
        </div>

        <!-- Content Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 text-center">
                <i class="bi bi-briefcase text-info" style="font-size: 3rem;"></i>
                <h2 class="mt-3">Welcome, <?= esc($user['name']) ?>!</h2>
                <p class="text-muted">Role: <strong><?= esc($user['role_name']) ?></strong></p>
                <hr>
                <div class="alert alert-info border-0 shadow-sm">
                    <i class="bi bi-info-circle me-1"></i>
                    This Hub is specifically for **Coordinators**. You can manage schedules and school-wide events from here.
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
