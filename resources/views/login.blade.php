<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #6c757d;
        }
        .login-wrapper {
            display: flex;
            width: 900px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .login-left {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-right {
            width: 50%;
            background: linear-gradient(45deg, #8441ff, #592bff);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header img {
            width: 100px;
            margin-bottom: 20px;
        }
        .login-header h1 {
            font-size: 24px;
            margin: 0;
            font-weight: 700;
        }
        .btn-primary {
            background: linear-gradient(45deg, #8441ff, #592bff);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #4e41ff, #5624e0);
        }
        .forgot-password, .create-account {
            text-align: center;
            margin-top: 15px;
        }
        .create-account a {
            color: #592bff;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- Left Side (Form) -->
    <div class="login-left">
        <div class="login-header">
            <img src="{{ asset('images/LPA.jpeg') }}" alt="Logo">
            <h1>Teruslah Berkembang</h1>
        </div>
        <!-- Error Notification -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="mb-3 position-relative">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <i class="toggle-password bi bi-eye-slash" id="togglePassword"></i>
            </div>

            <button type="submit" class="btn btn-primary w-100">Log in</button>
        </form>

        <div class="forgot-password">
            <a href="#">Forgot password?</a>
        </div>

        <div class="create-account">
            <p>Don?t have an account? <a href="#">CREATE NEW</a></p>
        </div>
    </div>

    <!-- Right Side (Info) -->
    <div class="login-right">
        <h2>We are more than just a company</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
    </div>
</div>

<!-- Bootstrap Icons CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">

<!-- Bootstrap JS & Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for toggling password visibility -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        const passwordInput = document.querySelector('[name="password"]');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
</script>

</body>
</html>
