<?php
/**
 * Contact Page - Alumpro.Az Management System
 */

$page_title = 'Əlaqə - Alumpro.Az';
$page_description = 'Bizimlə əlaqə saxlayın. Telefon, e-poçt, WhatsApp və ünvan məlumatları. Sürətli və peşəkar cavab zəmanəti.';
$body_class = 'contact-page';

ob_start();
?>

<!-- Contact Hero Section -->
<section class="contact-hero py-5 mb-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="display-4 fw-bold text-white mb-4 fade-in">
                    <i class="bi bi-telephone-fill text-warning"></i>
                    Bizimlə <span class="text-warning">Əlaqə</span>
                </h1>
                <p class="lead text-white-50 mb-4 fade-in">
                    Suallarınız, təklifləriniz və ya layihə tələbləriniz üçün bizimlə əlaqə saxlayın. 
                    Komandamız sizə ən qısa müddətdə cavab verəcək.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information & Form -->
<section class="contact-main py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="contact-info fade-in">
                    <h2 class="h3 text-white mb-4">Əlaqə Məlumatları</h2>
                    
                    <!-- Phone -->
                    <div class="contact-item glass-container mb-4">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill text-warning fs-3"></i>
                            </div>
                            <div class="contact-details ms-3">
                                <h5 class="text-white mb-1">Telefon</h5>
                                <p class="text-white-50 mb-0"><?= COMPANY_PHONE ?></p>
                                <small class="text-white-50">Hər gün 09:00 - 18:00</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- WhatsApp -->
                    <div class="contact-item glass-container mb-4">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon">
                                <i class="bi bi-whatsapp text-warning fs-3"></i>
                            </div>
                            <div class="contact-details ms-3">
                                <h5 class="text-white mb-1">WhatsApp</h5>
                                <p class="text-white-50 mb-0"><?= COMPANY_WHATSAPP ?></p>
                                <small class="text-white-50">24/7 Online</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="contact-item glass-container mb-4">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill text-warning fs-3"></i>
                            </div>
                            <div class="contact-details ms-3">
                                <h5 class="text-white mb-1">E-poçt</h5>
                                <p class="text-white-50 mb-0"><?= COMPANY_EMAIL ?></p>
                                <small class="text-white-50">24 saat ərzində cavab</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Address -->
                    <div class="contact-item glass-container mb-4">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt-fill text-warning fs-3"></i>
                            </div>
                            <div class="contact-details ms-3">
                                <h5 class="text-white mb-1">Ünvan</h5>
                                <p class="text-white-50 mb-0"><?= COMPANY_ADDRESS ?></p>
                                <small class="text-white-50">Əsas ofis və anbar</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Business Hours -->
                    <div class="business-hours glass-container p-4">
                        <h5 class="text-white mb-3">İş Saatları</h5>
                        <div class="hours-list">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-white-50">Bazar ertəsi - Cümə</span>
                                <span class="text-warning">09:00 - 18:00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-white-50">Şənbə</span>
                                <span class="text-warning">10:00 - 16:00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-white-50">Bazar</span>
                                <span class="text-danger">Bağlı</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form-container glass-container fade-in">
                    <h2 class="h3 text-white mb-4">Mesaj Göndərin</h2>
                    
                    <form action="/api/contact" method="POST" data-ajax="true" data-validate="true" class="contact-form">
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
                                               placeholder="Adınızı və soyadınızı daxil edin"
                                               required>
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
                                               required>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label text-white">E-poçt *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" 
                                               class="form-control" 
                                               name="email" 
                                               placeholder="email@example.com"
                                               required>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label text-white">Şirkət (İxtiyari)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-building"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control" 
                                               name="company" 
                                               placeholder="Şirkət adı">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label text-white">Mövzu *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-chat-dots"></i>
                                </span>
                                <select class="form-control" name="subject" required>
                                    <option value="">Mövzu seçin</option>
                                    <option value="general">Ümumi məlumat</option>
                                    <option value="quote">Qiymət sorğusu</option>
                                    <option value="technical">Texniki məsləhət</option>
                                    <option value="complaint">Şikayət</option>
                                    <option value="support">Dəstək</option>
                                    <option value="partnership">Əməkdaşlıq</option>
                                </select>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label text-white">Mesajınız *</label>
                            <div class="input-group">
                                <span class="input-group-text align-items-start pt-3">
                                    <i class="bi bi-chat-text"></i>
                                </span>
                                <textarea class="form-control" 
                                          name="message" 
                                          rows="5"
                                          placeholder="Mesajınızı ətraflı yazın..."
                                          required></textarea>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <!-- Preferred Contact Method -->
                        <div class="form-group mb-4">
                            <label class="form-label text-white">Əlaqə üsulu (İxtiyari)</label>
                            <div class="contact-preferences">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="contact_method[]" value="phone" id="contact_phone">
                                    <label class="form-check-label text-white-50" for="contact_phone">
                                        <i class="bi bi-telephone"></i> Telefon
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="contact_method[]" value="email" id="contact_email">
                                    <label class="form-check-label text-white-50" for="contact_email">
                                        <i class="bi bi-envelope"></i> E-poçt
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="contact_method[]" value="whatsapp" id="contact_whatsapp">
                                    <label class="form-check-label text-white-50" for="contact_whatsapp">
                                        <i class="bi bi-whatsapp"></i> WhatsApp
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="newsletter" 
                                       id="newsletter">
                                <label class="form-check-label text-white-50" for="newsletter">
                                    Yeni məhsul və kampanyalar barədə məlumat almaq istəyirəm
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-warning btn-lg">
                            <i class="bi bi-send"></i>
                            Mesajı Göndər
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="h3 text-white text-center mb-4">Bizim Yerləşmə</h2>
                <div class="map-container glass-container">
                    <div class="map-placeholder">
                        <div class="map-overlay">
                            <div class="text-center p-4">
                                <i class="bi bi-geo-alt-fill text-warning fs-1 mb-3"></i>
                                <h4 class="text-white mb-2">Alumpro.Az Ofisi</h4>
                                <p class="text-white-50 mb-3"><?= COMPANY_ADDRESS ?></p>
                                <div class="map-buttons">
                                    <a href="https://maps.google.com/?q=Alumpro.Az+Baku" 
                                       target="_blank" 
                                       class="btn btn-warning me-2">
                                        <i class="bi bi-map"></i> Google Maps
                                    </a>
                                    <a href="https://yandex.az/maps" 
                                       target="_blank" 
                                       class="btn btn-outline-light">
                                        <i class="bi bi-compass"></i> Yandex
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="h3 text-white text-center mb-5">Tez-tez Verilən Suallar</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item glass-container mb-3">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <i class="bi bi-question-circle text-warning me-2"></i>
                                Sifariş vermək üçün nə etməliyəm?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-white-50">
                                Sifariş vermək üçün bizimlə telefon və ya WhatsApp vasitəsilə əlaqə saxlayın. 
                                Ustalarımız sizin evinizə gəlib ölçü alacaq və layihə hazırlayacaq. 
                                Qiymət təsdiqlədikdən sonra istehsal prosesi başlayacaq.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item glass-container mb-3">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <i class="bi bi-question-circle text-warning me-2"></i>
                                Sifarişin hazırlanma müddəti neçə gündür?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-white-50">
                                Standart pəncərə və qapılar 5-7 iş günü ərzində hazırlanır. 
                                Böyük layihələr və xüsusi sifarişlər üçün müddət fərqli ola bilər. 
                                Dəqiq müddət sifariş zamanı bildirilir.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item glass-container mb-3">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <i class="bi bi-question-circle text-warning me-2"></i>
                                Zəmanət müddəti neçə ildir?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-white-50">
                                Alüminium profillər üçün 5 il, şüşə üçün 3 il, 
                                aksesuarlar üçün 2 il zəmanət veririk. 
                                Zəmanət müddətində bütün nasazlıqlar pulsuz aradan qaldırılır.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item glass-container mb-3">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <i class="bi bi-question-circle text-warning me-2"></i>
                                Ödəniş şərtləri necədir?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-white-50">
                                Sifariş zamanı 50% depozit, quraşdırma tamamlandıqdan sonra qalan 50% ödənilir. 
                                Nağd, bank kartı və bank köçürməsi ilə ödəniş mümkündür. 
                                Böyük sifarişlər üçün hissə-hissə ödəniş sistemi mövcuddur.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Contact CTAs -->
<section class="quick-contact py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <a href="tel:<?= str_replace(['+', ' ', '-'], '', COMPANY_PHONE) ?>" 
                   class="quick-contact-item glass-container text-center text-decoration-none d-block">
                    <i class="bi bi-telephone-fill text-warning fs-1 mb-3"></i>
                    <h5 class="text-white">Zəng Edin</h5>
                    <p class="text-white-50 small mb-0">Dərhal cavab alın</p>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <a href="https://wa.me/<?= str_replace(['+', ' ', '-'], '', COMPANY_WHATSAPP) ?>" 
                   target="_blank"
                   class="quick-contact-item glass-container text-center text-decoration-none d-block">
                    <i class="bi bi-whatsapp text-warning fs-1 mb-3"></i>
                    <h5 class="text-white">WhatsApp</h5>
                    <p class="text-white-50 small mb-0">24/7 Online</p>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <a href="mailto:<?= COMPANY_EMAIL ?>" 
                   class="quick-contact-item glass-container text-center text-decoration-none d-block">
                    <i class="bi bi-envelope-fill text-warning fs-1 mb-3"></i>
                    <h5 class="text-white">E-poçt</h5>
                    <p class="text-white-50 small mb-0">Ətraflı məlumat</p>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <a href="/calculator" 
                   class="quick-contact-item glass-container text-center text-decoration-none d-block">
                    <i class="bi bi-calculator-fill text-warning fs-1 mb-3"></i>
                    <h5 class="text-white">Kalkulyator</h5>
                    <p class="text-white-50 small mb-0">Qiymət hesablayın</p>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.contact-hero {
    min-height: 40vh;
    display: flex;
    align-items: center;
}

.contact-item {
    padding: 1.5rem;
    border-radius: var(--border-radius-lg);
    transition: transform var(--transition-normal);
}

.contact-item:hover {
    transform: translateY(-3px);
}

.contact-icon {
    min-width: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-form-container {
    padding: 2rem;
    border-radius: var(--border-radius-xl);
}

.contact-form .input-group-text {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.8);
}

.contact-form .form-control,
.contact-form .form-control:focus {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.contact-form .form-control:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: var(--warning-color);
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.contact-form .form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.contact-form select.form-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
}

.contact-preferences .form-check {
    margin-right: 1.5rem;
    margin-bottom: 0.5rem;
}

.contact-preferences .form-check-input:checked {
    background-color: var(--warning-color);
    border-color: var(--warning-color);
}

.map-container {
    height: 400px;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    position: relative;
}

.map-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    position: relative;
}

.map-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
}

.accordion-item {
    background: transparent;
    border: none;
    border-radius: var(--border-radius-lg) !important;
    margin-bottom: 1rem;
}

.accordion-button {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: white;
    font-weight: 500;
    padding: 1.25rem 1.5rem;
    border-radius: var(--border-radius-lg) !important;
}

.accordion-button:not(.collapsed) {
    background: rgba(255, 193, 7, 0.2);
    color: white;
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffc107'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

.accordion-body {
    padding: 1.25rem 1.5rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 0 0 var(--border-radius-lg) var(--border-radius-lg);
}

.quick-contact-item {
    padding: 2rem 1.5rem;
    border-radius: var(--border-radius-lg);
    transition: all var(--transition-normal);
}

.quick-contact-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 193, 7, 0.1);
    text-decoration: none;
    color: inherit;
}

.business-hours {
    border-radius: var(--border-radius-lg);
}

@media (max-width: 768px) {
    .contact-form-container {
        padding: 1.5rem;
    }
    
    .contact-item {
        padding: 1rem;
    }
    
    .map-container {
        height: 300px;
    }
    
    .quick-contact-item {
        padding: 1.5rem 1rem;
        margin-bottom: 1rem;
    }
    
    .contact-preferences .form-check {
        margin-right: 1rem;
        display: block;
        margin-bottom: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Phone number formatting for contact form
    const phoneInput = document.querySelector('input[name="phone"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            
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
                
                this.value = value.substring(0, 17);
            }
        });
    }

    // Auto-select email preference if email field is filled
    const emailInput = document.querySelector('input[name="email"]');
    const emailPreference = document.getElementById('contact_email');
    
    if (emailInput && emailPreference) {
        emailInput.addEventListener('blur', function() {
            if (this.value && this.value.includes('@')) {
                emailPreference.checked = true;
            }
        });
    }

    // Auto-select phone preference if phone field is filled
    const phonePreference = document.getElementById('contact_phone');
    
    if (phoneInput && phonePreference) {
        phoneInput.addEventListener('blur', function() {
            if (this.value && this.value.length > 10) {
                phonePreference.checked = true;
            }
        });
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/includes/layout.php';
?>