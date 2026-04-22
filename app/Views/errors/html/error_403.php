<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class='row justify-content-center mt-5'>
    <div class='p-5 bg-white shadow-sm rounded'>
        <h1 class='display-1 fw-bold text-danger'> 403 </h1>
        <h2 class='text-muted'>Forbidden</h2>
        <p class='lead mb-1'>You do not have permission to access this page.</p>
        <p class="text-muted small mb-4">
            <i class="bi bi-shield-lock me-1"></i> Restricted Path: <code>/<?= uri_string() ?></code>
        </p>




        <a href="/dashboard" class="btn btn-primary mt-3">Back to Dashboard</a>


        <?php 
            $role = session()->get('user')['role_name'] ?? '';

            if($role === 'teacher'){
                $back_url = base_url('teacher-info');
                $label = 'Teacher Hub';
            }
            elseif ($role ==='student'){
                $back_url = base_url('student-info');
                $label = 'Student Hub';
            }
            else{
                $back_url = base_url('login');
                $label = 'Login';
            }

            ?>

        <a href="<?= $back_url ?>" class="btn btn-primary mt-3">
            <i class='bi bi-arrow-left'></i> Back to <?= $label ?>
        </a>


    </div>
</div>
<?= $this->endSection() ?>