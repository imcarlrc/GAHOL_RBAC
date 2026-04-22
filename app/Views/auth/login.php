<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | NTC Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .btn-login {
            background: #0f172a;
            color: white;
            padding: 0.8rem;
            border-radius: 12px;
            font-weight: 600;
        }
        .btn-login:hover { background: #1e293b; color: white; }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="login-card">
            <div class="text-center mb-4">
                <h3 class="fw-bold">Welcome Back</h3>
                <p class="text-muted small">Please enter your details to sign in.</p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger small"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control p-3" placeholder="name@school.edu" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control p-3" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-login w-100 mb-3">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>