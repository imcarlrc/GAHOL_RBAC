<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTC Portal - RBAC</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-dark: #0f172a;
            --accent-blue: #38bdf8;
        }

        body { 
            background-color: #f1f5f9; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
        }

        .navbar { 
            background: linear-gradient(90deg, #0f172a 0%, #1e293b 100%) !important;
            padding: 0.8rem 0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            transition: all 0.3s ease;
            font-weight: 500;
            border-radius: 8px;
            margin: 0 2px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--accent-blue) !important;
        }

        .nav-link.active {
            background-color: rgba(56, 189, 248, 0.2) !important;
            color: var(--accent-blue) !important;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .content-area { margin-top: 2rem; margin-bottom: 3rem; }
    </style>
</head>
<body>

    <?php
        $userSession = session()->get('user');
        $role = $userSession['role_name'] ?? '';

        switch ($role) {
            case 'admin': $brandName = 'Admin Portal'; $iconColor = 'bg-danger'; break;
            case 'teacher': $brandName = 'Teacher Portal'; $iconColor = 'bg-primary'; break;
            case 'student': $brandName = 'Student Portal'; $iconColor = 'bg-success'; break;
            case 'coordinator': $brandName = 'Coordinator Hub'; $iconColor = 'bg-info'; break;
            default: $brandName = 'NTC Portal'; $iconColor = 'bg-secondary';
        }
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="<?= base_url('dashboard') ?>">
                <div class="<?= $iconColor ?> p-2 rounded-3 me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <i class="bi bi-mortarboard-fill text-white small"></i>
                </div>
                <span><?= $brandName ?></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= url_is('dashboard*') ? 'active' : 'text-white-50' ?>" href="<?= base_url('dashboard') ?>">
                            <i class="bi bi-house-door me-1"></i> Home
                        </a>
                    </li>

                    <?php if ($role === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link <?= url_is('admin/roles*') ? 'active' : 'text-white-50' ?>" href="<?= base_url('/admin/roles') ?>"><i class="bi bi-gear me-1"></i> Roles</a></li>
                        <li class="nav-item"><a class="nav-link <?= url_is('admin/users*') ? 'active' : 'text-white-50' ?>" href="<?= base_url('/admin/users') ?>"><i class="bi bi-people me-1"></i> Users</a></li>
                    <?php endif; ?>

                    <?php if (in_array($role, ['teacher', 'admin'])): ?>
                        <li class="nav-item"><a class="nav-link <?= url_is('management/students*') ? 'active' : 'text-white-50' ?>" href="<?= base_url('/management/students') ?>"><i class="bi bi-mortarboard me-1"></i> Students</a></li>
                    <?php endif; ?>

                    <?php if (in_array($role, ['admin', 'coordinator'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= url_is('admin/teachers*') ? 'active' : 'text-white-50' ?>" href="<?= base_url('/admin/teachers') ?>">
                                <i class="bi bi-briefcase me-1"></i> Teacher List
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5 me-2"></i>
                            <span class="small"><?= esc($userSession['name'] ?? 'Account') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><a class="dropdown-item py-2" href="/logout"><i class="bi bi-box-arrow-right me-2 text-danger"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container content-area">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>