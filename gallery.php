<?php
/**
 * Gallery Page - Alumpro.Az Management System
 */

$page_title = 'Qalereya - Alumpro.Az';
$page_description = 'Tamamladığımız layihələr və işlərimizin qalereya. Alüminium qapı və pəncərə həllərinin nümunələri.';
$body_class = 'gallery-page';

ob_start();
?>

<!-- Gallery Hero Section -->
<section class="gallery-hero py-5 mb-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="display-4 fw-bold text-white mb-4 fade-in">
                    <i class="bi bi-images text-warning"></i>
                    Bizim <span class="text-warning">İşlərimiz</span>
                </h1>
                <p class="lead text-white-50 mb-4 fade-in">
                    Reallaşdırdığımız layihələr və məmnun müştərilərimizin işləri. 
                    Keyfiyyət və peşəkarlığımızın nümunələri.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Filters -->
<section class="gallery-filters py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="filter-buttons text-center fade-in">
                    <button class="btn btn-warning active me-2 mb-2" data-filter="all">
                        <i class="bi bi-grid"></i> Hamısı
                    </button>
                    <button class="btn btn-outline-light me-2 mb-2" data-filter="residential">
                        <i class="bi bi-house"></i> Yaşayış
                    </button>
                    <button class="btn btn-outline-light me-2 mb-2" data-filter="commercial">
                        <i class="bi bi-building"></i> Ticarət
                    </button>
                    <button class="btn btn-outline-light me-2 mb-2" data-filter="industrial">
                        <i class="bi bi-buildings"></i> Sənaye
                    </button>
                    <button class="btn btn-outline-light me-2 mb-2" data-filter="facade">
                        <i class="bi bi-layout-wtf"></i> Fasad
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="gallery-grid py-5">
    <div class="container">
        <div class="row g-4" id="galleryContainer">
            
            <!-- Project 1 - Residential -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="residential">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/residential-1.jpg" 
                             alt="Villa Layihəsi" 
                             class="img-fluid"
                             data-bs-toggle="modal" 
                             data-bs-target="#galleryModal"
                             data-src="/assets/images/gallery/residential-1-full.jpg"
                             data-title="Villa Layihəsi - Nərimanov"
                             data-description="250m² villa üçün alüminium pəncərə sistemi">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Villa Layihəsi</h5>
                                <p class="text-white-50 mb-3">Nərimanov rayonu</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#galleryModal"
                                            data-src="/assets/images/gallery/residential-1-full.jpg"
                                            data-title="Villa Layihəsi - Nərimanov"
                                            data-description="250m² villa üçün alüminium pəncərə sistemi. 15 ədəd pəncərə və 3 ədəd balkon qapısı.">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Villa Layihəsi</h6>
                        <small class="text-white-50">Nərimanov • 250m² • 2023</small>
                    </div>
                </div>
            </div>
            
            <!-- Project 2 - Commercial -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="commercial">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/commercial-1.jpg" 
                             alt="Ofis Binası" 
                             class="img-fluid"
                             data-bs-toggle="modal" 
                             data-bs-target="#galleryModal"
                             data-src="/assets/images/gallery/commercial-1-full.jpg"
                             data-title="Ofis Binası - Şəhər Mərkəzi"
                             data-description="5 mərtəbəli ofis binası üçün fasad sistemi">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Ofis Binası</h5>
                                <p class="text-white-50 mb-3">Şəhər mərkəzi</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#galleryModal">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Ofis Binası</h6>
                        <small class="text-white-50">Mərkəz • 1200m² • 2023</small>
                    </div>
                </div>
            </div>
            
            <!-- Project 3 - Residential -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="residential">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/residential-2.jpg" 
                             alt="Yaşayış Kompleksi" 
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Yaşayış Kompleksi</h5>
                                <p class="text-white-50 mb-3">Yasamal rayonu</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Yaşayış Kompleksi</h6>
                        <small class="text-white-50">Yasamal • 120 mənzil • 2023</small>
                    </div>
                </div>
            </div>
            
            <!-- Project 4 - Industrial -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="industrial">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/industrial-1.jpg" 
                             alt="Sənaye Obyekti" 
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Sənaye Obyekti</h5>
                                <p class="text-white-50 mb-3">Səngəçal</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Sənaye Obyekti</h6>
                        <small class="text-white-50">Səngəçal • 5000m² • 2022</small>
                    </div>
                </div>
            </div>
            
            <!-- Project 5 - Facade -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="facade">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/facade-1.jpg" 
                             alt="Fasad Sistemi" 
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Fasad Sistemi</h5>
                                <p class="text-white-50 mb-3">Port Baku</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Fasad Sistemi</h6>
                        <small class="text-white-50">Port Baku • 2500m² • 2023</small>
                    </div>
                </div>
            </div>
            
            <!-- Project 6 - Commercial -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="commercial">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/commercial-2.jpg" 
                             alt="Ticarət Mərkəzi" 
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Ticarət Mərkəzi</h5>
                                <p class="text-white-50 mb-3">28 May</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Ticarət Mərkəzi</h6>
                        <small class="text-white-50">28 May • 3500m² • 2022</small>
                    </div>
                </div>
            </div>
            
            <!-- Project 7 - Residential -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="residential">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/residential-3.jpg" 
                             alt="Balkon Şüşələnməsi" 
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Balkon Şüşələnməsi</h5>
                                <p class="text-white-50 mb-3">Nəsimi rayonu</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Balkon Şüşələnməsi</h6>
                        <small class="text-white-50">Nəsimi • 45m² • 2023</small>
                    </div>
                </div>
            </div>
            
            <!-- Project 8 - Facade -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="facade">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/facade-2.jpg" 
                             alt="Müasir Fasad" 
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Müasir Fasad</h5>
                                <p class="text-white-50 mb-3">Sahil bulvarı</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Müasir Fasad</h6>
                        <small class="text-white-50">Sahil • 1800m² • 2023</small>
                    </div>
                </div>
            </div>
            
            <!-- Project 9 - Industrial -->
            <div class="col-md-6 col-lg-4 gallery-item" data-category="industrial">
                <div class="gallery-card glass-container fade-in">
                    <div class="gallery-image">
                        <img src="/assets/images/gallery/industrial-2.jpg" 
                             alt="Zavod Binası" 
                             class="img-fluid">
                        <div class="gallery-overlay">
                            <div class="gallery-content text-center">
                                <h5 class="text-white mb-2">Zavod Binası</h5>
                                <p class="text-white-50 mb-3">Sumqayıt</p>
                                <div class="gallery-actions">
                                    <button class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-eye"></i> Bax
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-info-circle"></i> Ətraflı
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info p-3">
                        <h6 class="text-white mb-1">Zavod Binası</h6>
                        <small class="text-white-50">Sumqayıt • 8000m² • 2022</small>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- Load More Button -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <button class="btn btn-outline-light btn-lg" id="loadMoreBtn">
                    <i class="bi bi-arrow-down"></i> Daha Çox Göstər
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="gallery-stats py-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="stat-card glass-container fade-in">
                    <h3 class="h1 fw-bold text-warning mb-2" data-count="1000">0+</h3>
                    <p class="text-white-50 mb-0">Tamamlanmış Layihə</p>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="stat-card glass-container fade-in">
                    <h3 class="h1 fw-bold text-warning mb-2" data-count="500">0+</h3>
                    <p class="text-white-50 mb-0">Məmnun Müştəri</p>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="stat-card glass-container fade-in">
                    <h3 class="h1 fw-bold text-warning mb-2" data-count="50000">0+</h3>
                    <p class="text-white-50 mb-0">m² Şüşələnmə</p>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="stat-card glass-container fade-in">
                    <h3 class="h1 fw-bold text-warning mb-2" data-count="25">0+</h3>
                    <p class="text-white-50 mb-0">Şəhər</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="modalTitle">Layihə Detalları</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-lg-8">
                        <img id="modalImage" src="" alt="" class="img-fluid w-100">
                    </div>
                    <div class="col-lg-4 p-4">
                        <div class="project-details">
                            <h4 class="text-white mb-3" id="modalProjectTitle">Layihə Adı</h4>
                            <p class="text-white-50 mb-4" id="modalDescription">Layihə təsviri</p>
                            
                            <div class="project-specs mb-4">
                                <h6 class="text-warning mb-3">Layihə Məlumatları:</h6>
                                <div class="spec-item d-flex justify-content-between mb-2">
                                    <span class="text-white-50">Sahə:</span>
                                    <span class="text-white">250m²</span>
                                </div>
                                <div class="spec-item d-flex justify-content-between mb-2">
                                    <span class="text-white-50">Pəncərə sayı:</span>
                                    <span class="text-white">15 ədəd</span>
                                </div>
                                <div class="spec-item d-flex justify-content-between mb-2">
                                    <span class="text-white-50">Qapı sayı:</span>
                                    <span class="text-white">3 ədəd</span>
                                </div>
                                <div class="spec-item d-flex justify-content-between mb-2">
                                    <span class="text-white-50">Tamamlanma:</span>
                                    <span class="text-white">2023</span>
                                </div>
                            </div>
                            
                            <div class="project-features mb-4">
                                <h6 class="text-warning mb-3">İstifadə olunan məhsullar:</h6>
                                <ul class="list-unstyled">
                                    <li class="text-white-50 mb-1">
                                        <i class="bi bi-check text-success me-2"></i>
                                        60mm Alüminium Profil
                                    </li>
                                    <li class="text-white-50 mb-1">
                                        <i class="bi bi-check text-success me-2"></i>
                                        İkili Şüşə Sistemi
                                    </li>
                                    <li class="text-white-50 mb-1">
                                        <i class="bi bi-check text-success me-2"></i>
                                        Avropa Dəstəkləri
                                    </li>
                                    <li class="text-white-50">
                                        <i class="bi bi-check text-success me-2"></i>
                                        Avtomat Qıfıl Sistemi
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="project-actions">
                                <a href="/contact" class="btn btn-warning w-100 mb-2">
                                    <i class="bi bi-telephone"></i> Məsləhət Al
                                </a>
                                <a href="/calculator" class="btn btn-outline-light w-100">
                                    <i class="bi bi-calculator"></i> Qiymət Hesabla
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.gallery-hero {
    min-height: 40vh;
    display: flex;
    align-items: center;
}

.filter-buttons .btn {
    border-radius: var(--border-radius-lg);
    font-weight: 500;
    transition: all var(--transition-fast);
}

.filter-buttons .btn.active {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.gallery-card {
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    transition: transform var(--transition-normal);
}

.gallery-card:hover {
    transform: translateY(-5px);
}

.gallery-image {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
    cursor: pointer;
}

.gallery-card:hover .gallery-image img {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity var(--transition-normal);
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-content {
    padding: 1rem;
}

.gallery-actions .btn {
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
}

.gallery-info {
    background: rgba(255, 255, 255, 0.05);
}

.stat-card {
    padding: 2rem 1rem;
    border-radius: var(--border-radius-lg);
    transition: transform var(--transition-normal);
}

.stat-card:hover {
    transform: translateY(-3px);
}

.stat-card [data-count] {
    opacity: 0;
    transition: opacity 0.5s ease;
}

.gallery-stats.animated [data-count] {
    opacity: 1;
}

.modal-content {
    border-radius: var(--border-radius-lg);
    overflow: hidden;
}

.project-details .spec-item {
    font-size: 0.9rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding-bottom: 0.5rem;
}

.project-details .spec-item:last-child {
    border-bottom: none;
}

/* Gallery filtering */
.gallery-item {
    transition: all 0.3s ease;
}

.gallery-item.filtered-out {
    opacity: 0;
    transform: scale(0.8);
    pointer-events: none;
}

/* Loading animation */
.loading-more {
    opacity: 0.5;
    pointer-events: none;
}

@media (max-width: 768px) {
    .gallery-image {
        height: 200px;
    }
    
    .gallery-overlay {
        opacity: 1;
        background: rgba(0, 0, 0, 0.5);
    }
    
    .gallery-content {
        padding: 0.5rem;
    }
    
    .gallery-actions .btn {
        font-size: 0.7rem;
        padding: 0.3rem 0.6rem;
    }
    
    .stat-card {
        padding: 1.5rem 0.5rem;
    }
    
    .filter-buttons .btn {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
        margin-right: 0.25rem !important;
        margin-bottom: 0.5rem !important;
    }
    
    .modal-dialog {
        margin: 1rem;
    }
    
    .project-details {
        padding: 1rem !important;
    }
}

@media (max-width: 576px) {
    .gallery-image {
        height: 180px;
    }
    
    .gallery-info {
        padding: 0.75rem !important;
    }
    
    .gallery-info h6 {
        font-size: 0.9rem;
    }
    
    .gallery-info small {
        font-size: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gallery filtering
    const filterButtons = document.querySelectorAll('[data-filter]');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            filterButtons.forEach(btn => btn.classList.add('btn-outline-light'));
            filterButtons.forEach(btn => btn.classList.remove('btn-warning'));
            
            this.classList.add('active');
            this.classList.remove('btn-outline-light');
            this.classList.add('btn-warning');
            
            // Filter items
            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.classList.remove('filtered-out');
                } else {
                    item.classList.add('filtered-out');
                }
            });
        });
    });
    
    // Gallery modal
    const galleryModal = document.getElementById('galleryModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalProjectTitle = document.getElementById('modalProjectTitle');
    const modalDescription = document.getElementById('modalDescription');
    
    document.addEventListener('click', function(e) {
        if (e.target.matches('[data-bs-target="#galleryModal"]') || e.target.closest('[data-bs-target="#galleryModal"]')) {
            const trigger = e.target.matches('[data-bs-target="#galleryModal"]') ? e.target : e.target.closest('[data-bs-target="#galleryModal"]');
            const src = trigger.getAttribute('data-src');
            const title = trigger.getAttribute('data-title');
            const description = trigger.getAttribute('data-description');
            
            if (src) modalImage.src = src;
            if (title) {
                modalTitle.textContent = title;
                modalProjectTitle.textContent = title;
            }
            if (description) modalDescription.textContent = description;
        }
    });
    
    // Load more functionality
    let loadMoreCount = 0;
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    
    loadMoreBtn.addEventListener('click', function() {
        loadMoreCount++;
        
        // Simulate loading
        this.classList.add('loading-more');
        this.innerHTML = '<span class="loading"></span> Yüklənir...';
        
        setTimeout(() => {
            // Add more gallery items here (you can load from API)
            this.classList.remove('loading-more');
            this.innerHTML = '<i class="bi bi-arrow-down"></i> Daha Çox Göstər';
            
            // After 3 loads, hide the button
            if (loadMoreCount >= 3) {
                this.style.display = 'none';
            }
        }, 1500);
    });
    
    // Statistics animation
    const statisticsSection = document.querySelector('.gallery-stats');
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
                    counter.textContent = target + '+';
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