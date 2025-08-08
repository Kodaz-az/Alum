<?php
/**
 * Homepage - Alumpro.Az Management System
 */

$page_title = 'Alumpro.Az - Alüminium Profil Sistemləri';
$page_description = 'Azərbaycanda keyfiyyətli alüminium profil sistemləri. Qapı və pəncərə həlləri, peşəkar quraşdırma xidməti.';
$body_class = 'homepage';

ob_start();
?>

<!-- Hero Section -->
<section class="hero-section py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content fade-in">
                    <h1 class="display-4 fw-bold text-white mb-4">
                        Keyfiyyətli Alüminium 
                        <span class="text-warning">Profil Sistemləri</span>
                    </h1>
                    <p class="lead text-white-50 mb-4">
                        Azərbaycanda ən yaxşı alüminium qapı və pəncərə həlləri. 
                        Peşəkar komanda, sürətli çatdırılma və keyfiyyət zəmanəti.
                    </p>
                    <div class="hero-buttons">
                        <a href="/products" class="btn btn-primary btn-lg me-3">
                            <i class="bi bi-grid"></i> Məhsulları Gör
                        </a>
                        <a href="/calculator" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-calculator"></i> Qiymət Hesabla
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image slide-in-right">
                    <div class="glass-container p-4">
                        <img src="/assets/images/hero-window.jpg" 
                             alt="Alüminium Pəncərə" 
                             class="img-fluid rounded"
                             style="max-height: 400px; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="h1 fw-bold text-white mb-3">Niyə Bizi Seçməlisiniz?</h2>
                <p class="lead text-white-50">Bizim üstünlüklərimiz və keyfiyyət standartlarımız</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card card-glass h-100 text-center fade-in">
                    <div class="card-body">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-award fs-1 text-warning"></i>
                        </div>
                        <h5 class="card-title text-white">Keyfiyyət Zəmanəti</h5>
                        <p class="card-text text-white-50">
                            Bütün məhsullarımız beynəlxalq standartlara uyğundur və uzunmüddətli zəmanətlə təmin edilir.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card card-glass h-100 text-center fade-in">
                    <div class="card-body">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-people fs-1 text-warning"></i>
                        </div>
                        <h5 class="card-title text-white">Peşəkar Komanda</h5>
                        <p class="card-text text-white-50">
                            Təcrübəli ustalarımız və texniki personalımız sizə ən yaxşı xidməti təqdim edir.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card card-glass h-100 text-center fade-in">
                    <div class="card-body">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-lightning fs-1 text-warning"></i>
                        </div>
                        <h5 class="card-title text-white">Sürətli Xidmət</h5>
                        <p class="card-text text-white-50">
                            Sifarişlərinizi minimum vaxtda hazırlayır və çatdırırıq. 24/7 dəstək xidməti.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card card-glass h-100 text-center fade-in">
                    <div class="card-body">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-shield-check fs-1 text-warning"></i>
                        </div>
                        <h5 class="card-title text-white">Etibarlı Həllər</h5>
                        <p class="card-text text-white-50">
                            Hər proyekt üçün fərdi yanaşma və optimal həllərin təklifi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Preview Section -->
<section class="products-preview py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="h1 fw-bold text-white mb-3">Məhsul Kateqoriyaları</h2>
                <p class="lead text-white-50">Geniş məhsul çeşidimiz və həllərimiz</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 fade-in">
                    <img src="/assets/images/products/aluminum-profiles.jpg" 
                         class="card-img-top" 
                         alt="Alüminium Profillər"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Alüminium Profillər</h5>
                        <p class="card-text">
                            Müxtəlif ölçü və dizaynlarda alüminium profillər. 
                            Qapı və pəncərə çərçivələri üçün ideal həllər.
                        </p>
                        <a href="/products/profiles" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Ətraflı
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 fade-in">
                    <img src="/assets/images/products/glass-systems.jpg" 
                         class="card-img-top" 
                         alt="Şüşə Sistemləri"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Şüşə Sistemləri</h5>
                        <p class="card-text">
                            Enerji səmərəli, təhlükəsiz və estetik şüşə həlləri. 
                            Müxtəlif qalınlıq və tiplərdə.
                        </p>
                        <a href="/products/glass" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Ətraflı
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 fade-in">
                    <img src="/assets/images/products/accessories.jpg" 
                         class="card-img-top" 
                         alt="Aksesuarlar"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Aksesuarlar</h5>
                        <p class="card-text">
                            Keyfiyyətli quraşdırma aksesuarları və tamamlayıcı elementlər. 
                            Hər növ layihə üçün.
                        </p>
                        <a href="/products" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Ətraflı
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calculator CTA Section -->
<section class="calculator-cta py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-container text-center p-5 fade-in">
                    <h2 class="h1 fw-bold text-white mb-4">
                        <i class="bi bi-calculator text-warning"></i>
                        Qiymət Kalkulyatoru
                    </h2>
                    <p class="lead text-white-50 mb-4">
                        Qapı və pəncərələrinizin qiymətini dərhal hesablayın. 
                        Ölçü və material seçərək təxmini dəyəri öyrənin.
                    </p>
                    <a href="/calculator" class="btn btn-warning btn-lg">
                        <i class="bi bi-calculator"></i> Kalkulyatoru Aç
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Projects Section -->
<section class="recent-projects py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="h1 fw-bold text-white mb-3">Son Layihələrimiz</h2>
                <p class="lead text-white-50">Reallaşdırdığımız bəzi işlərdən nümunələr</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 fade-in">
                    <img src="/assets/images/gallery/project1.jpg" 
                         class="card-img-top" 
                         alt="Layihə 1"
                         style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="card-title">Yaşayış Kompleksi</h6>
                        <p class="card-text text-muted">
                            Modern alüminium pəncərə sistemləri və balkon şüşələnməsi.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 fade-in">
                    <img src="/assets/images/gallery/project2.jpg" 
                         class="card-img-top" 
                         alt="Layihə 2"
                         style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="card-title">Ofis Binası</h6>
                        <p class="card-text text-muted">
                            Böyük ölçülü pəncərə sistemləri və giriş qapıları.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 fade-in">
                    <img src="/assets/images/gallery/project3.jpg" 
                         class="card-img-top" 
                         alt="Layihə 3"
                         style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="card-title">Villa Layihəsi</h6>
                        <p class="card-text text-muted">
                            Fərdi dizayn və premium keyfiyyət standartları.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="/gallery" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-images"></i> Bütün Layihələri Gör
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="contact-cta py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="glass-container p-4 h-100 fade-in">
                    <h3 class="text-white mb-3">
                        <i class="bi bi-telephone text-warning"></i>
                        Bizimlə Əlaqə
                    </h3>
                    <p class="text-white-50 mb-4">
                        Suallarınız və ya layihəniz barədə məlumat almaq üçün 
                        bizimlə əlaqə saxlayın.
                    </p>
                    <div class="contact-info">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-telephone text-warning me-3"></i>
                            <span class="text-white"><?= COMPANY_PHONE ?></span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-whatsapp text-warning me-3"></i>
                            <span class="text-white"><?= COMPANY_WHATSAPP ?></span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-envelope text-warning me-3"></i>
                            <span class="text-white"><?= COMPANY_EMAIL ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt text-warning me-3"></i>
                            <span class="text-white"><?= COMPANY_ADDRESS ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="glass-container p-4 h-100 fade-in">
                    <h3 class="text-white mb-3">
                        <i class="bi bi-chat-dots text-warning"></i>
                        Sürətli Müraciət
                    </h3>
                    <form action="/api/contact" method="POST" data-ajax="true" data-validate="true">
                        <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                        
                        <div class="mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   name="name" 
                                   placeholder="Ad və Soyad" 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <input type="tel" 
                                   class="form-control" 
                                   name="phone" 
                                   placeholder="Telefon nömrəsi" 
                                   data-validate-phone 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <textarea class="form-control" 
                                      name="message" 
                                      rows="3" 
                                      placeholder="Mesajınız" 
                                      required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-warning btn-lg w-100">
                            <i class="bi bi-send"></i> Göndər
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="statistics py-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="glass-container p-4 fade-in">
                    <h3 class="h1 fw-bold text-warning mb-2" data-count="500">0+</h3>
                    <p class="text-white-50 mb-0">Məmnun Müştəri</p>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="glass-container p-4 fade-in">
                    <h3 class="h1 fw-bold text-warning mb-2" data-count="1000">0+</h3>
                    <p class="text-white-50 mb-0">Tamamlanmış Layihə</p>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="glass-container p-4 fade-in">
                    <h3 class="h1 fw-bold text-warning mb-2" data-count="10">0+</h3>
                    <p class="text-white-50 mb-0">İl Təcrübə</p>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="glass-container p-4 fade-in">
                    <h3 class="h1 fw-bold text-warning mb-2">24/7</h3>
                    <p class="text-white-50 mb-0">Dəstək Xidməti</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    min-height: 70vh;
    display: flex;
    align-items: center;
}

.feature-icon {
    transition: transform 0.3s ease;
}

.card:hover .feature-icon {
    transform: scale(1.1);
}

.statistics [data-count] {
    opacity: 0;
    transition: opacity 0.5s ease;
}

.statistics.animated [data-count] {
    opacity: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate statistics on scroll
    const statisticsSection = document.querySelector('.statistics');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                animateCounters(entry.target);
            }
        });
    });

    if (statisticsSection) {
        observer.observe(statisticsSection);
    }

    function animateCounters(section) {
        const counters = section.querySelectorAll('[data-count]');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current) + '+';
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target + (counter.textContent.includes('24/7') ? '' : '+');
                }
            };

            updateCounter();
        });
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/includes/layout.php';
?>