<?php include_once __DIR__ . '/config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Hearts — Admin Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --pink: #ec4899;
            --pink-dark: #be185d;
            --pink-light: #fce7f3;
            --dark: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-font-smoothing: antialiased;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-brand .brand-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: var(--pink);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 16px;
        }

        .login-brand h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .login-brand p {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .login-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 36px 32px;
        }

        .login-card h2 {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .login-card .subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 28px;
        }

        .form-group { margin-bottom: 20px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 15px;
            font-weight: 500;
            font-family: inherit;
            background: var(--bg);
            color: var(--dark);
            transition: all 0.2s;
            outline: none;
        }

        .form-group input::placeholder {
            color: var(--text-muted);
            font-weight: 400;
        }

        .form-group input:focus {
            border-color: var(--pink);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
        }

        .btn-login {
            width: 100%;
            background: var(--pink);
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 4px;
        }

        .btn-login:hover {
            background: var(--pink-dark);
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
        }

        .login-footer a {
            color: var(--pink);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .login-footer a:hover { text-decoration: underline; }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Brand -->
        <div class="login-brand">
            <div class="brand-icon">🐾</div>
            <h1>Paws & Hearts</h1>
            <p>Admin Dashboard</p>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <h2>Welcome back</h2>
            <p class="subtitle">Sign in to your admin account</p>

            <form action="./actions/auth-actions.php" method="post">
                <input type="hidden" name="action" value="login">

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="you@example.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" name="submit" value="submit" class="btn-login">
                    Sign In
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="login-footer">
            <a href="<?= BASE_URL ?>">← Back to Homepage</a>
        </div>
    </div>
</body>

</html>