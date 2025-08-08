<?php
/**
 * Registration Page - Alumpro.Az Management System
 */

$page_title = 'Qeydiyyat - Alumpro.Az';
$page_description = 'Yeni hesab yaradın və xidmətlərimizdən istifadə edin.';
$body_class = 'auth-page register-page';
$page_specific_css = ['/assets/css/auth.css'];

// Redirect if already logged in
if (isLoggedIn()) {
    redirect('/');
}

ob_start();
?>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-card glass-container">
                    <div class="auth-header text-center mb-4">
                        <h1 class="h2 text-white mb-2">
                            <i class="bi bi-person-plus-fill text-warning"></i>
                            Qeydiyyat
                        </h1>
                        <p class="text-white-50">Yeni hesab yaradın</p>
                    </div>

                    <form action="/api/auth/register" method="POST" data-ajax="true" data-validate="true" class="auth-form">
                        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label text-white">Ad və Soyad *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control" 
                                               name="name" 
                                               placeholder="Ad və soyadınızı daxil edin"
                                               required 
                                               autocomplete="name">
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label text-white">Telefon *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-telephone"></i>
                                        </span>
                                        <input type="tel" 
                                               class="form-control" 
                                               name="phone" 
                                               placeholder="+994 XX XXX XX XX"
                                               data-validate-phone
                                               required 
                                               autocomplete="tel">
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-white">E-poçt ünvanı *</label>
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label text-white">Şifrə *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control" 
                                               name="password" 
                                               id="password"
                                               placeholder="Minimum 8 simvol"
                                               required 
                                               autocomplete="new-password">
                                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                    <small class="text-white-50">Şifrə ən azı 8 simvoldan ibarət olmalıdır</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label text-white">Şifrəni təsdiqləyin *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock-fill"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control" 
                                               name="password_confirm" 
                                               id="password_confirm"
                                               placeholder="Şifrəni təkrarlayın"
                                               data-confirm-password="#password"
                                               required 
                                               autocomplete="new-password">
                                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirm">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-white">Şirkət (İxtiyari)</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-building"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       name="company" 
                                       placeholder="Şirkət adı"
                                       autocomplete="organization">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-white">Ünvan (İxtiyari)</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                                <textarea class="form-control" 
                                          name="address" 
                                          rows="2"
                                          placeholder="Ünvanınızı daxil edin"
                                          autocomplete="street-address"></textarea>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="agree_terms" 
                                       id="agree_terms"
                                       required>
                                <label class="form-check-label text-white-50" for="agree_terms">
                                    <a href="/terms" class="text-warning text-decoration-none">İstifadə şərtləri</a> 
                                    və 
                                    <a href="/privacy" class="text-warning text-decoration-none">Məxfilik siyasəti</a> 
                                    ilə razıyam *
                                </label>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="newsletter" 
                                       id="newsletter">
                                <label class="form-check-label text-white-50" for="newsletter">
                                    Yeniliklər və təkliflər barədə məlumat almaq istəyirəm
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning btn-lg w-100 mb-3">
                            <i class="bi bi-person-plus"></i>
                            Qeydiyyatdan keç
                        </button>

                        <div class="text-center">
                            <small class="text-white-50">
                                Qeydiyyatdan sonra telefon nömrənizi SMS ilə təsdiqləməlisiniz.
                            </small>
                        </div>
                    </form>

                    <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">

                    <div class="text-center">
                        <p class="text-white-50 mb-2">Artıq hesabınız var?</p>
                        <a href="/auth/login" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Giriş edin
                        </a>
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

.form-control, .form-control:focus {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: var(--warning-color);
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

textarea.form-control {
    resize: vertical;
    min-height: 60px;
}

@media (max-width: 768px) {
    .auth-card {
        padding: 1.5rem;
        margin: 1rem;
    }
    
    .auth-container {
        padding: 1rem 0;
    }
    
    .row > .col-md-6 {
        margin-bottom: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });
    });

    // Phone number formatting
    const phoneInput = document.querySelector('input[name="phone"]');
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        
        // Format Azerbaijan phone number
        if (value.length > 0) {
            if (value.startsWith('994')) {
                value = '+' + value;
            } else if (value.startsWith('0')) {
                value = '+994' + value.substring(1);
            } else if (!value.startsWith('+994')) {
                value = '+994' + value;
            }
            
            // Format with spaces
            if (value.length > 4) {
                value = value.substring(0, 4) + ' ' + value.substring(4);
            }
            if (value.length > 7) {
                value = value.substring(0, 7) + ' ' + value.substring(7);
            }
            if (value.length > 11) {
                value = value.substring(0, 11) + ' ' + value.substring(11);
            }
            if (value.length > 14) {
                value = value.substring(0, 14) + ' ' + value.substring(14);
            }
            
            this.value = value.substring(0, 17); // Max length
        }
    });

    // Enhanced form validation
    const form = document.querySelector('.auth-form');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirm');

    // Real-time password matching
    function checkPasswordMatch() {
        if (confirmInput.value && passwordInput.value !== confirmInput.value) {
            confirmInput.setCustomValidity('Şifrələr uyğun gəlmir');
            confirmInput.classList.add('is-invalid');
        } else {
            confirmInput.setCustomValidity('');
            if (confirmInput.value) {
                confirmInput.classList.remove('is-invalid');
                confirmInput.classList.add('is-valid');
            }
        }
    }

    passwordInput.addEventListener('input', checkPasswordMatch);
    confirmInput.addEventListener('input', checkPasswordMatch);

    // Terms checkbox validation
    const termsCheckbox = document.getElementById('agree_terms');
    termsCheckbox.addEventListener('change', function() {
        if (this.checked) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.add('is-invalid');
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../includes/layout.php';
?>