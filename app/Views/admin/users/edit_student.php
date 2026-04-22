<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/admin/users') ?>">User Management</a></li>
        <li class="breadcrumb-item active">Edit Student: <?= esc($user['name']) ?></li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0">
                <i class="bi bi-mortarboard-fill me-2 text-danger"></i>Edit Student Profile
            </h3>
            <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <form action="<?= base_url('/admin/users/update/' . $user['id']) ?>" method="POST" novalidate>
                    <?= csrf_field() ?>

                    <div class="row g-4">
                        <!-- Account Section -->
                        <div class="col-12">
                            <h6 class="fw-bold border-bottom pb-2 mb-3">Account Information</h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   value="<?= esc($user['name']) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   value="<?= esc($user['email']) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="role_id" class="form-label fw-semibold text-muted small">Access Level</label>
                            <select name="role_id" id="role_id" class="form-select bg-light" required>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['id'] ?>" <?= $user['role_id'] == $role['id'] ? 'selected' : '' ?>>
                                        <?= esc($role['label']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text extra-small">Changing this to a non-student role will hide student fields.</div>
                        </div>

                        <!-- School Section -->
                        <div class="col-12 mt-5">
                            <h6 class="fw-bold border-bottom pb-2 mb-3">School Specific Details</h6>
                        </div>

                        <div class="col-md-6">
                            <label for="student_id" class="form-label fw-semibold">Student ID No.</label>
                            <input type="text" name="student_id" id="student_id" class="form-control" 
                                   value="<?= esc($user['student_id'] ?? '') ?>" placeholder="e.g. 2024-0001">
                        </div>

                        <div class="col-md-6">
                            <label for="course" class="form-label fw-semibold">Course / Program</label>
                            <input type="text" name="course" id="course" class="form-control" 
                                   value="<?= esc($user['course'] ?? '') ?>" placeholder="e.g. BS Information Technology">
                        </div>

                        <div class="col-md-6">
                            <label for="year_level" class="form-label fw-semibold">Year Level</label>
                            <select name="year_level" id="year_level" class="form-select">
                                <option value="">-- Select Year --</option>
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <option value="<?= $i ?>" <?= ($user['year_level'] == $i) ? 'selected' : '' ?>>Year <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="section" class="form-label fw-semibold">Section</label>
                            <input type="text" name="section" id="section" class="form-control" 
                                   value="<?= esc($user['section'] ?? '') ?>" placeholder="e.g. 3A">
                        </div>

                        <div class="col-12 pt-3">
                            <hr class="my-3">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= base_url('/admin/users') ?>" class="btn btn-light px-4">Cancel</a>
                                <button type="submit" class="btn btn-danger px-5">
                                    <i class="bi bi-save me-2"></i>Update Student Details
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
