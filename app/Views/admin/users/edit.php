<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0">
                <i class="bi bi-pencil-square me-2 text-danger"></i>Edit User Account
            </h3>
            <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <?php 
                    $roleSlug = strtolower(trim($user['role_name'] ?? ''));
                    $isTeacher = ($roleSlug === 'teacher');
                    $formAction = $isTeacher ? '/admin/teachers/update/' : '/admin/users/update/';
                ?>
                <form action="<?= base_url($formAction . $user['id']) ?>" method="POST" novalidate>
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="<?= esc($user['name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="<?= esc($user['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label fw-semibold">Role</label>
                        <select name="role_id" id="role_id" class="form-select" required>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id'] ?>" <?= $user['role_id'] == $role['id'] ? 'selected' : '' ?>>
                                    <?= esc($role['label']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2 pt-2">
                        <button type="submit" class="btn btn-danger py-2">
                            <i class="bi bi-save me-2"></i>Update User Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
