<?php
/**
 * Products Index Page - Alumpro.Az Management System
 */

$page_title = 'Məhsullar - Alumpro.Az';
$page_description = 'Alüminium profillər, şüşə sistemləri və aksesuarlar. Keyfiyyətli qapı və pəncərə həlləri.';
$body_class = 'products-page';

ob_start();
?>

<!-- Products Hero Section -->
<section class="products-hero py-5 mb-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="display-4 fw-bold text-white mb-4 fade-in">
                    <i class="bi bi-grid-3x3-gap-fill text-warning"></i>
                    Bizim <span class="text-warning">Məhsullar</span>
                </h1>
                <p class="lead text-white-50 mb-4 fade-in">
                    Geniş çeşiddə alüminium profillər, şüşə sistemləri və aksesuarlar. 
                    Hər növ qapı və pəncərə layihəsi üçün keyfiyyətli həllər.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Product Categories -->
<section class="product-categories py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Aluminum Profiles -->
            <div class="col-md-6 col-lg-4">
                <div class="product-category-card glass-container text-center fade-in">
                    <div class="category-image mb-4">
                        <img src="/assets/images/products/aluminum-profiles-main.jpg" 
                             alt="Alüminium Profillər" 
                             class="img-fluid rounded"
                             style="height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="category-content">
                        <h3 class="h4 text-white mb-3">
                            <i class="bi bi-window text-warning me-2"></i>
                            Alüminium Profillər
                        </h3>
                        <p class="text-white-50 mb-4">
                            Müxtəlif dizayn və ölçülərdə alüminium profillər. 
                            Qapı və pəncərə çərçivələri üçün mükəmməl həllər.
                        </p>
                        <div class="category-features mb-4">
                            <div class="feature-item mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">50+ müxtəlif profil növü</span>
                            </div>
                            <div class="feature-item mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">Avropa keyfiyyəti</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">5 il zəmanət</span>
                            </div>
                        </div>
                        <a href="/products/profiles" class="btn btn-warning">
                            <i class="bi bi-arrow-right"></i> Ətraflı Bax
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Glass Systems -->
            <div class="col-md-6 col-lg-4">
                <div class="product-category-card glass-container text-center fade-in">
                    <div class="category-image mb-4">
                        <img src="/assets/images/products/glass-systems-main.jpg" 
                             alt="Şüşə Sistemləri" 
                             class="img-fluid rounded"
                             style="height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="category-content">
                        <h3 class="h4 text-white mb-3">
                            <i class="bi bi-square text-warning me-2"></i>
                            Şüşə Sistemləri
                        </h3>
                        <p class="text-white-50 mb-4">
                            Enerji səmərəli, təhlükəsiz və estetik şüşə həlləri. 
                            Müxtəlif qalınlıq və növlərdə.
                        </p>
                        <div class="category-features mb-4">
                            <div class="feature-item mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">4-24mm qalınlıq</span>
                            </div>
                            <div class="feature-item mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">Enerji qənaət edici</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">Təhlükəsizlik şüşəsi</span>
                            </div>
                        </div>
                        <a href="/products/glass" class="btn btn-warning">
                            <i class="bi bi-arrow-right"></i> Ətraflı Bax
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Accessories -->
            <div class="col-md-6 col-lg-4">
                <div class="product-category-card glass-container text-center fade-in">
                    <div class="category-image mb-4">
                        <img src="/assets/images/products/accessories-main.jpg" 
                             alt="Aksesuarlar" 
                             class="img-fluid rounded"
                             style="height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="category-content">
                        <h3 class="h4 text-white mb-3">
                            <i class="bi bi-gear text-warning me-2"></i>
                            Aksesuarlar
                        </h3>
                        <p class="text-white-50 mb-4">
                            Keyfiyyətli quraşdırma aksesuarları və tamamlayıcı elementlər. 
                            Hər növ layihə üçün.
                        </p>
                        <div class="category-features mb-4">
                            <div class="feature-item mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">Menteşə və kilidlər</span>
                            </div>
                            <div class="feature-item mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">Conta və fitinqlər</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <span class="text-white-50">Dekortiv elementlər</span>
                            </div>
                        </div>
                        <a href="/products/accessories" class="btn btn-warning">
                            <i class="bi bi-arrow-right"></i> Ətraflı Bax
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="featured-products py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="h1 fw-bold text-white text-center mb-5">Populyar Məhsullar</h2>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Featured Product 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="product-card card h-100 fade-in">
                    <div class="product-image">
                        <img src="/assets/images/products/profile-60mm.jpg" 
                             class="card-img-top" 
                             alt="60mm Profil"
                             style="height: 250px; object-fit: cover;">
                        <div class="product-badge">
                            <span class="badge bg-warning">ƏN POPULYAR</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">60mm Alüminium Profil</h5>
                        <p class="card-text text-muted">
                            Standart pəncərələr üçün ideal olan 60mm profil sistemi. 
                            Yüksək davamlılıq və estetik görünüş.
                        </p>
                        <div class="product-specs mb-3">
                            <small class="text-muted">
                                <i class="bi bi-rulers me-1"></i> Ölçü: 60mm<br>
                                <i class="bi bi-palette me-1"></i> Rəng: Ağ, Qəhvəyi, Antrasit<br>
                                <i class="bi bi-award me-1"></i> Sertifikat: CE, ISO
                            </small>
                        </div>
                        <div class="product-price d-flex justify-content-between align-items-center">
                            <span class="price-text fw-bold text-primary">25.50 AZN/m</span>
                            <a href="/products/profiles?id=1" class="btn btn-sm btn-outline-primary">Ətraflı</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Featured Product 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="product-card card h-100 fade-in">
                    <div class="product-image">
                        <img src="/assets/images/products/double-glass.jpg" 
                             class="card-img-top" 
                             alt="İkili Şüşə"
                             style="height: 250px; object-fit: cover;">
                        <div class="product-badge">
                            <span class="badge bg-success">ENERJİ QƏNAƏT</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">İkili Şüşə Sistemi</h5>
                        <p class="card-text text-muted">
                            Enerji səmərəliliyi və ses izolyasiyası təmin edən 
                            ikili şüşə sistemi.
                        </p>
                        <div class="product-specs mb-3">
                            <small class="text-muted">
                                <i class="bi bi-rulers me-1"></i> Qalınlıq: 4+12+4mm<br>
                                <i class="bi bi-thermometer me-1"></i> U-dəyər: 1.1 W/m²K<br>
                                <i class="bi bi-volume-down me-1"></i> Səs izolyasiyası: 32dB
                            </small>
                        </div>
                        <div class="product-price d-flex justify-content-between align-items-center">
                            <span class="price-text fw-bold text-primary">45.00 AZN/m²</span>
                            <a href="/products/glass?id=1" class="btn btn-sm btn-outline-primary">Ətraflı</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Featured Product 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="product-card card h-100 fade-in">
                    <div class="product-image">
                        <img src="/assets/images/products/euro-handle.jpg" 
                             class="card-img-top" 
                             alt="Avropa Dəstəyi"
                             style="height: 250px; object-fit: cover;">
                        <div class="product-badge">
                            <span class="badge bg-info">PREMİUM</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Avropa Dəstəyi</h5>
                        <p class="card-text text-muted">
                            Yüksək keyfiyyətli Avropa istehsalı dəstək və qıfıl sistemi. 
                            Uzunmüddətli istifadə zəmanəti.
                        </p>
                        <div class="product-specs mb-3">
                            <small class="text-muted">
                                <i class="bi bi-shield-check me-1"></i> Material: Paslanmaz polad<br>
                                <i class="bi bi-palette me-1"></i> Rəng: Ağ, Qızılı, Gümüşü<br>
                                <i class="bi bi-gear me-1"></i> Mexanizm: Mikro açılma
                            </small>
                        </div>
                        <div class="product-price d-flex justify-content-between align-items-center">
                            <span class="price-text fw-bold text-primary">85.00 AZN</span>
                            <a href="/products/accessories?id=1" class="btn btn-sm btn-outline-primary">Ətraflı</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="/gallery" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-images"></i> Bütün Layihələri Gör
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Product Advantages -->
<section class="product-advantages py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="h1 fw-bold text-white text-center mb-5">Məhsullarımızın Üstünlükləri</h2>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="advantage-card glass-container text-center fade-in">
                    <div class="advantage-icon mb-3">
                        <i class="bi bi-award-fill fs-1 text-warning"></i>
                    </div>
                    <h5 class="text-white mb-3">Keyfiyyət Sertifikatları</h5>
                    <p class="text-white-50">
                        ISO 9001:2015 və CE sertifikatlarına sahib məhsullar. 
                        Beynəlxalq standartlara uyğunluq.
                    </p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="advantage-card glass-container text-center fade-in">
                    <div class="advantage-icon mb-3">
                        <i class="bi bi-shield-check fs-1 text-warning"></i>
                    </div>
                    <h5 class="text-white mb-3">Uzun Zəmanət</h5>
                    <p class="text-white-50">
                        Profillər üçün 5 il, şüşə üçün 3 il zəmanət. 
                        Zəmanət müddətində pulsuz xidmət.
                    </p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="advantage-card glass-container text-center fade-in">
                    <div class="advantage-icon mb-3">
                        <i class="bi bi-thermometer-sun fs-1 text-warning"></i>
                    </div>
                    <h5 class="text-white mb-3">Enerji Səmərəliliyi</h5>
                    <p class="text-white-50">
                        Yüksək istilik izolyasiyası təmin edən məhsullar. 
                        İstilik itkilərini minimuma endirir.
                    </p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="advantage-card glass-container text-center fade-in">
                    <div class="advantage-icon mb-3">
                        <i class="bi bi-recycle fs-1 text-warning"></i>
                    </div>
                    <h5 class="text-white mb-3">Ekoloji Təmizlik</h5>
                    <p class="text-white-50">
                        100% təkrar emal edilə bilən materiallar. 
                        Ətraf mühitə zərərsiz istehsal.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Calculator CTA -->
<section class="product-calculator-cta py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-container text-center p-5 fade-in">
                    <h2 class="h1 fw-bold text-white mb-4">
                        <i class="bi bi-calculator text-warning"></i>
                        Layihənizin Qiymətini Hesablayın
                    </h2>
                    <p class="lead text-white-50 mb-4">
                        Məhsul seçimi və ölçülər əsasında dərhal qiymət hesablayın. 
                        Kalkulyatorumuz sizə təxmini məbləği göstərəcək.
                    </p>
                    <div class="cta-buttons">
                        <a href="/calculator" class="btn btn-warning btn-lg me-3">
                            <i class="bi bi-calculator"></i> Qiymət Hesabla
                        </a>
                        <a href="/contact" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-telephone"></i> Məsləhət Al
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technical Specifications -->
<section class="technical-specs py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="h1 fw-bold text-white text-center mb-5">Texniki Xüsusiyyətlər</h2>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="specs-card glass-container fade-in">
                    <h4 class="text-white mb-4">
                        <i class="bi bi-window text-warning me-2"></i>
                        Alüminium Profillər
                    </h4>
                    <div class="specs-table">
                        <div class="spec-row d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Profil eni:</span>
                            <span class="text-white">50mm - 80mm</span>
                        </div>
                        <div class="spec-row d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Divar qalınlığı:</span>
                            <span class="text-white">1.4mm - 2.0mm</span>
                        </div>
                        <div class="spec-row d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">İstilik izolyasiyası:</span>
                            <span class="text-white">Uf = 1.0-1.6 W/m²K</span>
                        </div>
                        <div class="spec-row d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Su keçirməzliyi:</span>
                            <span class="text-white">600 Pa</span>
                        </div>
                        <div class="spec-row d-flex justify-content-between py-2">
                            <span class="text-white-50">Külək yükü:</span>
                            <span class="text-white">1200 Pa</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="specs-card glass-container fade-in">
                    <h4 class="text-white mb-4">
                        <i class="bi bi-square text-warning me-2"></i>
                        Şüşə Sistemləri
                    </h4>
                    <div class="specs-table">
                        <div class="spec-row d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Qalınlıq diapazonu:</span>
                            <span class="text-white">4mm - 24mm</span>
                        </div>
                        <div class="spec-row d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">İkili şüşə:</span>
                            <span class="text-white">4+12+4mm - 6+16+6mm</span>
                        </div>
                        <div class="spec-row d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">U-dəyər:</span>
                            <span class="text-white">1.0 - 1.2 W/m²K</span>
                        </div>
                        <div class="spec-row d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Səs izolyasiyası:</span>
                            <span class="text-white">28dB - 35dB</span>
                        </div>
                        <div class="spec-row d-flex justify-content-between py-2">
                            <span class="text-white-50">Günəş faktoru:</span>
                            <span class="text-white">g = 0.58 - 0.63</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.products-hero {
    min-height: 40vh;
    display: flex;
    align-items: center;
}

.product-category-card {
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    transition: transform var(--transition-normal);
    height: 100%;
}

.product-category-card:hover {
    transform: translateY(-5px);
}

.category-image img {
    border-radius: var(--border-radius-md);
}

.feature-item {
    font-size: 0.9rem;
}

.product-card {
    transition: transform var(--transition-normal);
    border: none;
    box-shadow: var(--shadow-md);
}

.product-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.product-image {
    position: relative;
    overflow: hidden;
}

.product-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    z-index: 2;
}

.product-badge .badge {
    font-size: 0.7rem;
    padding: 0.4rem 0.8rem;
}

.product-specs {
    background: var(--gray-100);
    padding: 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.85rem;
}

.price-text {
    font-size: 1.1rem;
}

.advantage-card {
    padding: 2rem 1.5rem;
    border-radius: var(--border-radius-lg);
    transition: transform var(--transition-normal);
    height: 100%;
}

.advantage-card:hover {
    transform: translateY(-3px);
}

.advantage-icon {
    transition: transform var(--transition-normal);
}

.advantage-card:hover .advantage-icon {
    transform: scale(1.1);
}

.specs-card {
    padding: 2rem;
    border-radius: var(--border-radius-lg);
    height: 100%;
}

.spec-row {
    font-size: 0.9rem;
}

.border-secondary {
    border-color: rgba(255, 255, 255, 0.2) !important;
}

@media (max-width: 768px) {
    .product-category-card {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .advantage-card,
    .specs-card {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .cta-buttons .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .cta-buttons .btn:last-child {
        margin-bottom: 0;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/includes/layout.php';
?>