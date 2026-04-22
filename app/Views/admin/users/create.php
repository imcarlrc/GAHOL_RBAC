<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0">
                <i class="bi bi-person-plus-fill me-2 text-danger"></i>Add New User
            </h3>
            <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Back to Users
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="<?= base_url('/admin/users/store') ?>" method="POST" novalidate>
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Juan De La Cruz" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="e.g. juan@school.edu" required>
                    </div>

                 <div class="mb-3">
    <label class="form-label fw-semibold">Assign Role</label>
    <select name="role_id" class="form-select" required>
        <?php foreach ($roles as $role): ?>
            
            <!-- SKIP Student and Admin: That's it! -->
            <?php if ($role['name'] === 'student' || $role['name'] === 'admin') continue; ?>
            <option value="<?= $role['id'] ?>">
                <?= $role['label'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

                    <div id="student_fields" class="mb-3">
                        <label for="student_id" class="form-label fw-semibold">ID No.</label>
                        <input type="text" name="student_id" id="student_id" class="form-control" placeholder="e.g. 2024-0001">
                        <div class="form-text">Required only for student accounts.</div>
                    </div>

                    <div class="alert alert-info border-0 shadow-sm small">
                        <i class="bi bi-info-circle me-1"></i>
                        The default password for new accounts is <strong>Password1</strong>.
                    </div>

                    <div class="d-grid gap-2 pt-2">
                        <button type="submit" class="btn btn-danger py-2">
                            <i class="bi bi-save me-2"></i>Save User Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
