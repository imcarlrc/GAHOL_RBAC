<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0 text-info">
                <i class="bi bi-person-plus-fill me-2"></i>New Student Enrollment
            </h3>
            <a href="<?= base_url('/management/students') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                <p class="mb-0 text-info small fw-bold">STUDENT INFORMATION</p>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('/management/students/store') ?>" method="POST" novalidate>
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <!-- Full Name -->
                        <div class="col-md-7">
                            <label for="name" class="form-label fw-semibold">Student Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   placeholder="e.g. John Doe" value="<?= old('name') ?>" required>
                        </div>

                        <!-- Student ID -->
                        <div class="col-md-5">
                            <label for="student_id" class="form-label fw-semibold">ID Number</label>
                            <input type="text" name="student_id" id="student_id" class="form-control" 
                                   placeholder="e.g. 2024-00123" value="<?= old('student_id') ?>" required>
                        </div>

                        <!-- Email Address -->
                        <div class="col-12">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="student@example.com" value="<?= old('email') ?>" required>
                        </div>

                        <hr class="my-4 text-muted opacity-25">
                        <p class="text-info small fw-bold mt-0">ACADEMIC DETAILS</p>

                        <!-- Course -->
                        <div class="col-md-6">
                            <label for="course" class="form-label fw-semibold">Course / Degree</label>
                            <input type="text" name="course" id="course" class="form-control" 
                                   placeholder="e.g. BS Information Technology" value="<?= old('course') ?>" required>
                        </div>

                        <!-- Year Level -->
                        <div class="col-md-3">
                            <label for="year_level" class="form-label fw-semibold">Year Level</label>
                            <select name="year_level" id="year_level" class="form-select" required>
                                <option value="" disabled selected>-- Select --</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>

                        <!-- Section -->
                        <div class="col-md-3">
                            <label for="section" class="form-label fw-semibold">Section</label>
                            <input type="text" name="section" id="section" class="form-control" 
                                   placeholder="e.g. A" value="<?= old('section') ?>" required>
                        </div>
                    </div>

                    <div class="mt-5 d-grid">
                        <button type="submit" class="btn btn-info text-white fw-bold py-2 shadow-sm">
                            <i class="bi bi-save2 me-2"></i> Enroll Student
                        </button>
                    </div>

                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Default password for new students is: <strong>Student123</strong>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
