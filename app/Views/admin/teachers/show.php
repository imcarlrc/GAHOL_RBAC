<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/admin/teachers') ?>">Teacher List</a></li>
        <li class="breadcrumb-item active"><?= esc($teacher['name']) ?></li>
    </ol>
</nav>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm text-center p-4">
            <div class="card-body">
                <?php if (! empty($teacher['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($teacher['profile_image'])) ?>" 
                         class="rounded-circle border border-4 border-success shadow-sm mb-3" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                <?php else: ?>
                    <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center border border-4 border-success shadow-sm mb-3" 
                         style="width: 150px; height: 150px;">
                        <i class="bi bi-person text-success" style="font-size: 5rem;"></i>
                    </div>
                <?php endif; ?>
                
                <h4 class="fw-bold mb-1"><?= esc($teacher['name']) ?></h4>
                <p class="text-muted mb-3">Faculty Member</p>
                <div class="badge bg-success bg-opacity-10 text-success p-2 px-3">
                    <i class="bi bi-check-circle-fill me-1"></i>Active Account
                </div>
            </div>
        </div>
    </div>

    <!-- Data Card -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0">Teacher Information</h6>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <label class="text-muted small mb-1">Full Name</label>
                        <p class="fw-bold mb-0 text-dark"><?= esc($teacher['name']) ?></p>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small mb-1">Email Address</label>
                        <p class="fw-bold mb-0 text-dark"><?= esc($teacher['email']) ?></p>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small mb-1">Role</label>
                        <p class="fw-bold mb-0 text-dark"><?= esc($teacher['role_label']) ?></p>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small mb-1">Joined Date</label>
                        <p class="fw-bold mb-0 text-dark"><?= date('F d, Y', strtotime($teacher['created_at'])) ?></p>
                    </div>
                </div>

                <hr class="my-4">
                
                <div class="bg-light p-3 rounded-3 border-start border-4 border-success">
                    <p class="mb-0 small text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Administrators can update this teacher's login credentials and account status via the User Management panel.
                    </p>
                </div>
            </div>
            <div class="card-footer bg-white py-3 d-flex justify-content-between">
                <a href="<?= base_url('/admin/teachers') ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Back to List
                </a>
                <a href="<?= base_url('/admin/users/edit/' . $teacher['id']) ?>" class="btn btn-success px-4">
                    <i class="bi bi-pencil-square me-1"></i>Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
