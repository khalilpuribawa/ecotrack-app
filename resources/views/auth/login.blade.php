@extends('layouts.app')

@section('title', 'Login - EcoTrack.ID')

@section('content')
<style>
/* Remove ALL margins and padding from body and html */
html,
body {
    margin: 0 !important;
    padding: 0 !important;
    height: 100% !important;
    overflow-x: hidden;
}

/* Override layout container */
.main-content {
    padding: 0 !important;
    margin: 0 !important;
    width: 100vw !important;
    position: relative;
}

.login-container {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 30%, #d1fae5 70%, #a7f3d0 100%);
    overflow: hidden;
    z-index: 999;
}

/* Ensure navbar stays on top */
.navbar-modern {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000 !important;
    width: 100vw;
}

/* Make login card wider and more compact */
.login-card {
    margin-top: 60px;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 20px;
    box-shadow:
        0 25px 50px -12px rgba(0, 0, 0, 0.15),
        0 0 0 1px rgba(16, 185, 129, 0.05);
    overflow: hidden;
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 600px;
    /* Increased from 420px */
    margin-left: 1rem;
    margin-right: 1rem;
    max-height: calc(100vh - 120px);
    /* Ensure it fits in viewport */
}

.login-container::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2310b981' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    animation: float 25s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0px) rotate(0deg);
    }

    50% {
        transform: translateY(-30px) rotate(180deg);
    }
}

/* More compact header */
.login-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 1.5rem 2rem;
    /* Reduced from 2.5rem */
    text-align: center;
    position: relative;
    overflow: hidden;
}

.login-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M20 20c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10zm10 0c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10z'/%3E%3C/g%3E%3C/svg%3E") repeat;
    animation: slide 20s linear infinite;
}

@keyframes slide {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-40px);
    }
}

.eco-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.15);
    color: rgba(255, 255, 255, 0.95);
    padding: 0.4rem 0.8rem;
    /* Slightly smaller */
    border-radius: 50px;
    font-size: 0.8rem;
    /* Smaller font */
    font-weight: 500;
    margin-bottom: 0.8rem;
    /* Reduced margin */
    position: relative;
    z-index: 1;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.login-title {
    font-size: 1.6rem;
    /* Reduced from 1.875rem */
    font-weight: 700;
    margin-bottom: 0.3rem;
    /* Reduced margin */
    position: relative;
    z-index: 1;
}

.login-subtitle {
    font-size: 0.9rem;
    /* Slightly smaller */
    opacity: 0.9;
    margin: 0;
    position: relative;
    z-index: 1;
}

/* Two-column layout for form */
.login-body {
    padding: 1.5rem 2rem;
    /* Reduced padding */
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group-modern {
    margin-bottom: 1rem;
    /* Reduced from 1.5rem */
}

.form-group-full {
    grid-column: 1 / -1;
    /* Full width */
}

.form-label-modern {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.4rem;
    /* Reduced margin */
    font-size: 0.85rem;
    /* Smaller font */
    display: block;
}

.input-wrapper {
    position: relative;
}

.form-control-modern {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    /* Slightly smaller radius */
    padding: 0.75rem 0.8rem 0.75rem 2.5rem;
    /* Reduced padding */
    font-size: 0.9rem;
    /* Smaller font */
    transition: all 0.3s ease;
    width: 100%;
    height: 42px;
    /* Reduced height */
}

.form-control-modern:focus {
    background: #ffffff;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    outline: none;
}

.form-control-modern.is-invalid {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.input-icon {
    position: absolute;
    left: 0.8rem;
    /* Adjusted position */
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 0.9rem;
    /* Smaller icon */
    z-index: 2;
    transition: color 0.3s ease;
}

.form-control-modern:focus+.input-icon {
    color: #10b981;
}

.password-toggle {
    position: absolute;
    right: 0.8rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #64748b;
    cursor: pointer;
    font-size: 0.9rem;
    z-index: 2;
    transition: color 0.3s ease;
    padding: 0.2rem;
}

.password-toggle:hover {
    color: #10b981;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    /* Reduced margin */
    font-size: 0.85rem;
    /* Smaller font */
}

.form-check {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.form-check-input {
    margin: 0;
}

.forgot-link {
    color: #10b981;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: #059669;
    text-decoration: underline;
}

/* Compact login button */
.btn-login {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    /* Reduced padding */
    font-weight: 600;
    font-size: 0.95rem;
    /* Slightly smaller */
    color: white;
    width: 100%;
    height: 44px;
    /* Reduced height */
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
}

.btn-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-login:hover::before {
    left: 100%;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.btn-login:active {
    transform: translateY(0);
}

.divider {
    display: flex;
    align-items: center;
    margin: 1rem 0;
    /* Reduced margin */
    color: #64748b;
    font-size: 0.85rem;
    /* Smaller font */
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e2e8f0;
}

.divider span {
    padding: 0 1rem;
    background: rgba(255, 255, 255, 0.98);
}

/* Compact social buttons */
.social-buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.6rem;
    /* Reduced gap */
    margin-bottom: 1rem;
    /* Reduced margin */
}

.btn-social {
    background: #ffffff;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.6rem 0.8rem;
    /* Reduced padding */
    font-weight: 500;
    font-size: 0.85rem;
    /* Smaller font */
    color: #374151;
    height: 38px;
    /* Reduced height */
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    text-decoration: none;
}

.btn-social:hover {
    border-color: #10b981;
    background: #f0fdf4;
    color: #059669;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-social.google:hover {
    border-color: #ea4335;
    background: #fef2f2;
    color: #dc2626;
}

.btn-social.facebook:hover {
    border-color: #1877f2;
    background: #eff6ff;
    color: #2563eb;
}

/* Compact register link */
.register-link {
    text-align: center;
    margin-top: 1rem;
    /* Reduced margin */
    padding: 1rem;
    /* Reduced padding */
    background: rgba(16, 185, 129, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(16, 185, 129, 0.1);
    font-size: 0.85rem;
    /* Smaller font */
}

.register-link a {
    color: #10b981;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.register-link a:hover {
    color: #059669;
    text-decoration: underline;
}

.invalid-feedback {
    display: block;
    font-size: 0.8rem;
    /* Smaller font */
    color: #ef4444;
    margin-top: 0.3rem;
    /* Reduced margin */
    font-weight: 500;
}

.loading-spinner {
    display: none;
    width: 16px;
    /* Smaller spinner */
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.btn-login.loading .loading-spinner {
    display: inline-block;
}

.btn-login.loading .btn-text {
    opacity: 0.7;
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-card {
        margin-top: 60px;
        margin-left: 0.5rem;
        margin-right: 0.5rem;
        max-width: calc(100vw - 1rem);
    }

    .login-body {
        padding: 1.25rem;
    }

    .login-header {
        padding: 1.25rem;
    }

    .login-title {
        font-size: 1.4rem;
    }

    /* Stack form fields on mobile */
    .form-row {
        grid-template-columns: 1fr;
        gap: 0.8rem;
    }

    .social-buttons {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .login-card {
        margin: 0.5rem;
        border-radius: 16px;
    }

    .login-body {
        padding: 1rem;
    }
}

/* Override any container restrictions */
.container,
.container-fluid {
    max-width: none !important;
    padding: 0 !important;
    margin: 0 !important;
}
</style>

<div class="login-container">
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <div class="eco-badge">
                🌱 Selamat Datang Kembali
            </div>
            <h1 class="login-title">Masuk ke EcoTrack.ID</h1>
            <p class="login-subtitle">Lanjutkan perjalanan hijau Anda</p>
        </div>

        <!-- Body -->
        <div class="login-body">
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Form Fields in Two Columns -->
                <div class="form-row">
                    <!-- Email Field -->
                    <div class="form-group-modern">
                        <label for="email" class="form-label-modern">Alamat Email</label>
                        <div class="input-wrapper">
                            <input id="email" type="email"
                                class="form-control-modern @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group-modern">
                        <label for="password" class="form-label-modern">Password</label>
                        <div class="input-wrapper">
                            <input id="password" type="password"
                                class="form-control-modern @error('password') is-invalid @enderror" name="password"
                                required placeholder="Masukkan password Anda">
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>
                    <a href="#" class="forgot-link">
                        Lupa password?
                    </a>
                </div>

                <!-- Login Button -->
                <div class="form-group-modern form-group-full">
                    <button type="submit" class="btn-login" id="loginBtn">
                        <div class="loading-spinner"></div>
                        <span class="btn-text">
                            <i class="fas fa-sign-in-alt"></i>
                            Masuk ke Dashboard
                        </span>
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span>atau</span>
            </div>

            <!-- Social Login -->
            <div class="social-buttons">
                <a href="#" class="btn-social google">
                    <i class="fab fa-google"></i>
                    Google
                </a>
                <a href="#" class="btn-social facebook">
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </a>
            </div>

            <!-- Register Link -->
            <div class="register-link">
                <p class="mb-0">
                    <i class="fas fa-user-plus me-2" style="color: #10b981;"></i>
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar sekarang dan mulai berkontribusi!</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Password Toggle
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}

// Form Loading State
document.getElementById('loginForm').addEventListener('submit', function() {
    const loginBtn = document.getElementById('loginBtn');
    loginBtn.classList.add('loading');
    loginBtn.disabled = true;

    // Re-enable button after 5 seconds (fallback)
    setTimeout(() => {
        loginBtn.classList.remove('loading');
        loginBtn.disabled = false;
    }, 5000);
});

// Input Focus Effects
document.querySelectorAll('.form-control-modern').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });

    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});

// Auto-hide alerts after 5 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('.invalid-feedback');
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
    });
}, 5000);
</script>
@endsection