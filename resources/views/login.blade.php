<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - CREC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .login-card { border: none; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .brand-text { color: #0f172a; font-weight: 700; letter-spacing: -1px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="card login-card p-5" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h1 class="brand-text">CREC</h1>
            <p class="text-muted small">Campus Resource & Equipment Centre</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 small rounded-3">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small text-uppercase fw-bold text-muted">Email Address</label>
                <input type="email" name="email" class="form-control form-control-lg bg-light border-0" placeholder="student@school.edu" required>
            </div>
            <div class="mb-4">
                <label class="form-label small text-uppercase fw-bold text-muted">Password</label>
                <input type="password" name="password" class="form-control form-control-lg bg-light border-0" placeholder="••••••••" required>
            </div>
            <button class="btn btn-primary w-100 btn-lg fs-6 fw-bold">Sign In</button>
        </form>
    </div>

</body>
</html>