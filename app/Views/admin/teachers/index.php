<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h3 class="fw-bold mb-0">
            <i class="bi bi-person-badge me-2 text-success"></i>Teacher List
        </h3>
        <p class="text-muted small mb-0">Faculty Directory and Contact Information</p>
    </div>
    <div class="d-flex gap-2">
        <div class="input-group input-group-sm" style="width: 250px;">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
            <input type="text" id="teacherSearch" class="form-control border-start-0 ps-0" placeholder="Search teachers...">
        </div>
    </div>
</div>

<div class="row g-4" id="teacherGrid">
    <?php if (empty($teachers)): ?>
        <div class="col-12 text-center py-5">
            <div class="text-muted mb-3"><i class="bi bi-person-x" style="font-size: 3rem;"></i></div>
            <p>No faculty members found.</p>
        </div>
    <?php else: ?>
        <?php foreach ($teachers as $teacher): ?>
            <div class="col-md-6 col-lg-4 teacher-card">
                <div class="card border-0 shadow-sm h-100 teacher-item">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <?php if (! empty($teacher['profile_image'])): ?>
                                <img src="<?= base_url('uploads/profiles/' . esc($teacher['profile_image'])) ?>" 
                                     class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <?php else: ?>
                                <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center me-3" 
                                     style="width: 60px; height: 60px;">
                                    <i class="bi bi-person text-success fs-3"></i>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h6 class="fw-bold mb-0 teacher-name"><?= esc($teacher['name']) ?></h6>
                                <span class="badge bg-success bg-opacity-10 text-success small">Faculty Member</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="text-muted small mb-1"><i class="bi bi-envelope me-1"></i>Email</div>
                            <div class="fw-medium small teacher-email"><?= esc($teacher['email']) ?></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2 mt-auto border-top">
                            <span class="text-muted extra-small">Joined: <?= date('M Y', strtotime($teacher['created_at'])) ?></span>
                            <div class="d-flex gap-1">
                                <a href="<?= base_url('/admin/teachers/show/' . $teacher['id']) ?>" class="btn btn-outline-primary btn-sm px-2" title="View Profile">
                                    <i class="bi bi-eye"></i>
                                </a>




                                <?php if ((session()->get('user')['role_name'] ?? '') === 'admin'): ?>


                                    <a href="<?= base_url('/admin/teachers/edit/' . $teacher['id']) ?>" class="btn btn-outline-success btn-sm px-2" title="Edit Teacher">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                <?php endif; ?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
    document.getElementById('teacherSearch').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const cards = document.querySelectorAll('.teacher-card');
        
        cards.forEach(card => {
            const name = card.querySelector('.teacher-name').textContent.toLowerCase();
            const email = card.querySelector('.teacher-email').textContent.toLowerCase();
            
            if (name.includes(searchText) || email.includes(searchText)) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        });
    });
</script>

<style>
    .extra-small { font-size: 0.75rem; }
    .teacher-item:hover { transform: translateY(-5px); transition: transform 0.2s; }
</style>
<?= $this->endSection() ?>
