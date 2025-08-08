<?php
/**
 * Login Page - Alumpro.Az Management System
 */

$page_title = 'Giriş - Alumpro.Az';
$page_description = 'Hesabınıza daxil olun və sifarişlərinizi idarə edin.';
$body_class = 'auth-page login-page';
$page_specific_css = ['/assets/css/auth.css'];

// Redirect if already logged in
if (isLoggedIn()) {
    $role = $_SESSION['user_role'];
    switch ($role) {
        case 'admin':
            redirect('/admin');
            break;
        case 'sales':
            redirect('/sales');
            break;
        case 'customer':
            redirect('/customer');
            break;
        default:
            redirect('/');
    }
}

ob_start();
?>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card glass-container">
                    <div class="auth-header text-center mb-4">
                        <h1 class="h2 text-white mb-2">
                            <i class="bi bi-person-circle text-warning"></i>
                            Hesaba Giriş
                        </h1>
                        <p class="text-white-50">Hesabınıza daxil olun</p>
                    </div>

                    <form action="/api/auth/login" method="POST" data-ajax="true" data-validate="true" class="auth-form">
                        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">

                        <div class="form-group mb-3">
                            <label class="form-label text-white">E-poçt ünvanı</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" 
                                       class="form-control" 
                                       name="email" 
                                       placeholder="email@example.com"
                                       required 
                                       autocomplete="email">
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-white">Şifrə</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" 
                                       class="form-control" 
                                       name="password" 
                                       placeholder="Şifrənizi daxil edin"
                                       required 
                                       autocomplete="current-password">
                                <button type="button" class="btn btn-outline-secondary toggle-password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="remember_me" 
                                       id="remember_me">
                                <label class="form-check-label text-white-50" for="remember_me">
                                    Məni xatırla
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning btn-lg w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Giriş
                        </button>

                        <div class="text-center">
                            <a href="/auth/forgot-password" class="text-white-50 text-decoration-none">
                                Şifrəni unutmusunuz?
                            </a>
                        </div>
                    </form>

                    <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">

                    <div class="text-center">
                        <p class="text-white-50 mb-2">Hesabınız yoxdur?</p>
                        <a href="/auth/register" class="btn btn-outline-light">
                            <i class="bi bi-person-plus"></i>
                            Qeydiyyatdan keç
                        </a>
                    </div>
                </div>

                <!-- Quick Login Demo -->
                <div class="demo-logins mt-4 glass-container p-3">
                    <h6 class="text-white mb-3">Demo Hesablar:</h6>
                    <div class="row g-2">
                        <div class="col-12">
                            <button type="button" 
                                    class="btn btn-outline-light btn-sm w-100 demo-login" 
                                    data-email="admin@alumpro.az" 
                                    data-password="admin123">
                                <i class="bi bi-speedometer2"></i> Admin Panel
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" 
                                    class="btn btn-outline-light btn-sm w-100 demo-login" 
                                    data-email="sales@alumpro.az" 
                                    data-password="sales123">
                                <i class="bi bi-graph-up"></i> Satış
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" 
                                    class="btn btn-outline-light btn-sm w-100 demo-login" 
                                    data-email="customer@alumpro.az" 
                                    data-password="customer123">
                                <i class="bi bi-person"></i> Müştəri
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 2rem 0;
}

.auth-card {
    padding: 2rem;
    max-width: 100%;
}

.input-group-text {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.7);
}

.form-control {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: var(--warning-color);
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.form-check-input:checked {
    background-color: var(--warning-color);
    border-color: var(--warning-color);
}

.toggle-password {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.7);
}

.demo-logins {
    backdrop-filter: blur(5px);
}

@media (max-width: 768px) {
    .auth-card {
        padding: 1.5rem;
        margin: 1rem;
    }
    
    .auth-container {
        padding: 1rem 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelector('.toggle-password').addEventListener('click', function() {
        const passwordInput = document.querySelector('input[name="password"]');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            passwordInput.type = 'password';
            icon.className = 'bi bi-eye';
        }
    });

    // Demo login functionality
    document.querySelectorAll('.demo-login').forEach(button => {
        button.addEventListener('click', function() {
            const email = this.getAttribute('data-email');
            const password = this.getAttribute('data-password');
            
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="password"]').value = password;
            
            // Highlight the form briefly
            const form = document.querySelector('.auth-form');
            form.style.background = 'rgba(255, 193, 7, 0.1)';
            setTimeout(() => {
                form.style.background = '';
            }, 1000);
        });
    });

    // Enhanced form validation for login
    const form = document.querySelector('.auth-form');
    form.addEventListener('submit', function(e) {
        const email = document.querySelector('input[name="email"]').value;
        const password = document.querySelector('input[name="password"]').value;
        
        if (!email || !password) {
            e.preventDefault();
            app.showNotification('E-poçt və şifrə sahələri doldurulmalıdır.', 'error');
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../includes/layout.php';
?>