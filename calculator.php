<?php
/**
 * Price Calculator Page - Alumpro.Az Management System
 */

$page_title = 'Qiymət Kalkulyatoru - Alumpro.Az';
$page_description = 'Alüminium qapı və pəncərələrin qiymətini hesablayın. İnteraktiv kalkulyator ilə dərhal nəticə alın.';
$body_class = 'calculator-page';
$page_specific_css = ['/assets/css/calculator.css'];
$page_specific_js = ['/assets/js/calculator.js'];

ob_start();
?>

<!-- Calculator Hero Section -->
<section class="calculator-hero py-5 mb-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="display-4 fw-bold text-white mb-4 fade-in">
                    <i class="bi bi-calculator text-warning"></i>
                    Qiymət <span class="text-warning">Kalkulyatoru</span>
                </h1>
                <p class="lead text-white-50 mb-4 fade-in">
                    Alüminium qapı və pəncərələrinizin qiymətini dərhal hesablayın. 
                    Material və ölçü seçərək təxmini dəyəri öyrənin.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Calculator Form -->
<section class="calculator-form py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="calculator-container glass-container fade-in">
                    <h3 class="text-white mb-4">
                        <i class="bi bi-gear text-warning me-2"></i>
                        Layihənizi konfiqurasiya edin
                    </h3>
                    
                    <form id="calculatorForm" data-validate="true">
                        <!-- Product Type Selection -->
                        <div class="form-section mb-4">
                            <h5 class="section-title text-white mb-3">1. Məhsul Növü</h5>
                            <div class="product-types row g-3">
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="product_type" id="window" value="window" checked>
                                    <label class="btn btn-outline-light w-100 p-3" for="window">
                                        <i class="bi bi-window fs-3 d-block mb-2"></i>
                                        <strong>Pəncərə</strong>
                                        <br><small>Alüminium pəncərə sistemi</small>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="product_type" id="door" value="door">
                                    <label class="btn btn-outline-light w-100 p-3" for="door">
                                        <i class="bi bi-door-open fs-3 d-block mb-2"></i>
                                        <strong>Qapı</strong>
                                        <br><small>Alüminium qapı sistemi</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dimensions -->
                        <div class="form-section mb-4">
                            <h5 class="section-title text-white mb-3">2. Ölçülər</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-white">En (sm)</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               name="width" 
                                               id="width"
                                               placeholder="120"
                                               min="50" 
                                               max="300"
                                               value="120"
                                               required>
                                        <span class="input-group-text">sm</span>
                                    </div>
                                    <small class="text-white-50">Minimum: 50sm, Maksimum: 300sm</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white">Hündürlük (sm)</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               name="height" 
                                               id="height"
                                               placeholder="140"
                                               min="50" 
                                               max="250"
                                               value="140"
                                               required>
                                        <span class="input-group-text">sm</span>
                                    </div>
                                    <small class="text-white-50">Minimum: 50sm, Maksimum: 250sm</small>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-info">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Ölçü: <span id="dimensionDisplay">120 x 140 sm (1.68 m²)</span>
                                </small>
                            </div>
                        </div>
                        
                        <!-- Profile Type -->
                        <div class="form-section mb-4">
                            <h5 class="section-title text-white mb-3">3. Profil Sistemi</h5>
                            <div class="profile-types">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="profile_type" id="profile_50" value="50mm" checked>
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="profile_50">
                                        <span>
                                            <strong>50mm Profil</strong>
                                            <br><small class="text-white-50">Standart pəncərələr üçün</small>
                                        </span>
                                        <span class="text-warning">22.50 AZN/m</span>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="profile_type" id="profile_60" value="60mm">
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="profile_60">
                                        <span>
                                            <strong>60mm Profil</strong>
                                            <br><small class="text-white-50">Yaxşılaşdırılmış izolyasiya</small>
                                        </span>
                                        <span class="text-warning">25.50 AZN/m</span>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="profile_type" id="profile_70" value="70mm">
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="profile_70">
                                        <span>
                                            <strong>70mm Profil</strong>
                                            <br><small class="text-white-50">Premium keyfiyyət</small>
                                        </span>
                                        <span class="text-warning">28.50 AZN/m</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Glass Type -->
                        <div class="form-section mb-4">
                            <h5 class="section-title text-white mb-3">4. Şüşə Növü</h5>
                            <div class="glass-types">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="glass_type" id="single_glass" value="single">
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="single_glass">
                                        <span>
                                            <strong>Tək Şüşə</strong>
                                            <br><small class="text-white-50">4mm şüşə</small>
                                        </span>
                                        <span class="text-warning">15.00 AZN/m²</span>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="glass_type" id="double_glass" value="double" checked>
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="double_glass">
                                        <span>
                                            <strong>İkili Şüşə</strong>
                                            <br><small class="text-white-50">4+12+4mm (enerji qənaət edici)</small>
                                        </span>
                                        <span class="text-warning">45.00 AZN/m²</span>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="glass_type" id="triple_glass" value="triple">
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="triple_glass">
                                        <span>
                                            <strong>Üçlü Şüşə</strong>
                                            <br><small class="text-white-50">4+12+4+12+4mm (maksimum izolyasiya)</small>
                                        </span>
                                        <span class="text-warning">75.00 AZN/m²</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Accessories -->
                        <div class="form-section mb-4">
                            <h5 class="section-title text-white mb-3">5. Aksesuarlar</h5>
                            <div class="accessories">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="accessories[]" id="euro_handle" value="euro_handle" checked>
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="euro_handle">
                                        <span>
                                            <strong>Avropa Dəstəyi</strong>
                                            <br><small class="text-white-50">Mikro açılma sistemli</small>
                                        </span>
                                        <span class="text-warning">85.00 AZN</span>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="accessories[]" id="mosquito_net" value="mosquito_net">
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="mosquito_net">
                                        <span>
                                            <strong>Ağcaqanad Şəbəkəsi</strong>
                                            <br><small class="text-white-50">Fiberglass material</small>
                                        </span>
                                        <span class="text-warning">25.00 AZN</span>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="accessories[]" id="window_sill" value="window_sill">
                                    <label class="form-check-label text-white d-flex justify-content-between w-100" for="window_sill">
                                        <span>
                                            <strong>Pəncərə Altlığı</strong>
                                            <br><small class="text-white-50">PVC material, ağ rəng</small>
                                        </span>
                                        <span class="text-warning">35.00 AZN/m</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quantity -->
                        <div class="form-section mb-4">
                            <h5 class="section-title text-white mb-3">6. Miqdar</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-white">Ədəd sayı</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-light" id="quantityMinus">-</button>
                                        <input type="number" 
                                               class="form-control text-center" 
                                               name="quantity" 
                                               id="quantity"
                                               min="1" 
                                               max="50"
                                               value="1"
                                               required>
                                        <button type="button" class="btn btn-outline-light" id="quantityPlus">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Calculate Button -->
                        <div class="form-section">
                            <button type="button" class="btn btn-warning btn-lg w-100" id="calculateBtn">
                                <i class="bi bi-calculator"></i>
                                Qiyməti Hesabla
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Results Panel -->
            <div class="col-lg-4">
                <div class="results-panel glass-container fade-in sticky-top">
                    <h4 class="text-white mb-4">
                        <i class="bi bi-receipt text-warning me-2"></i>
                        Qiymət Hesabı
                    </h4>
                    
                    <div class="calculation-breakdown">
                        <div class="breakdown-item d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Məhsul növü:</span>
                            <span class="text-white" id="resultProductType">Pəncərə</span>
                        </div>
                        <div class="breakdown-item d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Ölçü:</span>
                            <span class="text-white" id="resultDimensions">120 x 140 sm</span>
                        </div>
                        <div class="breakdown-item d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Sahə:</span>
                            <span class="text-white" id="resultArea">1.68 m²</span>
                        </div>
                        <div class="breakdown-item d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Profil:</span>
                            <span class="text-white" id="resultProfile">50mm Profil</span>
                        </div>
                        <div class="breakdown-item d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Şüşə:</span>
                            <span class="text-white" id="resultGlass">İkili Şüşə</span>
                        </div>
                        <div class="breakdown-item d-flex justify-content-between py-2 border-bottom border-secondary">
                            <span class="text-white-50">Miqdar:</span>
                            <span class="text-white" id="resultQuantity">1 ədəd</span>
                        </div>
                    </div>
                    
                    <div class="cost-breakdown mt-4">
                        <h6 class="text-warning mb-3">Qiymət Tərkibi:</h6>
                        <div class="cost-item d-flex justify-content-between py-1">
                            <span class="text-white-50">Profil:</span>
                            <span class="text-white" id="costProfile">0.00 AZN</span>
                        </div>
                        <div class="cost-item d-flex justify-content-between py-1">
                            <span class="text-white-50">Şüşə:</span>
                            <span class="text-white" id="costGlass">0.00 AZN</span>
                        </div>
                        <div class="cost-item d-flex justify-content-between py-1">
                            <span class="text-white-50">Aksesuarlar:</span>
                            <span class="text-white" id="costAccessories">0.00 AZN</span>
                        </div>
                        <div class="cost-item d-flex justify-content-between py-1">
                            <span class="text-white-50">Quraşdırma:</span>
                            <span class="text-white" id="costInstallation">0.00 AZN</span>
                        </div>
                        <hr style="border-color: rgba(255,255,255,0.2);">
                        <div class="total-cost d-flex justify-content-between py-2">
                            <span class="text-warning fw-bold">CƏMİ:</span>
                            <span class="text-warning fw-bold fs-4" id="totalCost">0.00 AZN</span>
                        </div>
                    </div>
                    
                    <div class="result-actions mt-4">
                        <button class="btn btn-success w-100 mb-2" id="saveCalculationBtn">
                            <i class="bi bi-save"></i> Hesabı Yadda Saxla
                        </button>
                        <button class="btn btn-outline-light w-100 mb-2" id="generatePDFBtn">
                            <i class="bi bi-file-pdf"></i> PDF Yüklə
                        </button>
                        <a href="/contact" class="btn btn-warning w-100">
                            <i class="bi bi-telephone"></i> Sifariş Ver
                        </a>
                    </div>
                    
                    <div class="calculation-note mt-4 p-3" style="background: rgba(255,193,7,0.1); border-radius: var(--border-radius-md);">
                        <small class="text-white-50">
                            <i class="bi bi-info-circle text-warning me-1"></i>
                            Bu qiymət təxminidir. Dəqiq qiymət üçün bizə müraciət edin.
                            Quraşdırma və çatdırılma daxildir.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calculator Features -->
<section class="calculator-features py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="h3 text-white text-center mb-5">Kalkulyator Xüsusiyyətləri</h2>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card glass-container text-center fade-in">
                    <i class="bi bi-lightning-charge fs-1 text-warning mb-3"></i>
                    <h5 class="text-white mb-2">Sürətli Hesablama</h5>
                    <p class="text-white-50 small">Dərhal nəticə alın və qiymətləri müqayisə edin</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="feature-card glass-container text-center fade-in">
                    <i class="bi bi-accuracy fs-1 text-warning mb-3"></i>
                    <h5 class="text-white mb-2">Dəqiq Qiymətlər</h5>
                    <p class="text-white-50 small">Güncel bazar qiymətləri əsasında hesablama</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="feature-card glass-container text-center fade-in">
                    <i class="bi bi-file-pdf fs-1 text-warning mb-3"></i>
                    <h5 class="text-white mb-2">PDF Eksport</h5>
                    <p class="text-white-50 small">Hesabınızı PDF formatında yükləyin</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="feature-card glass-container text-center fade-in">
                    <i class="bi bi-bookmark-check fs-1 text-warning mb-3"></i>
                    <h5 class="text-white mb-2">Yadda Saxlama</h5>
                    <p class="text-white-50 small">Hesablarınızı yadda saxlayın və müqayisə edin</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.calculator-hero {
    min-height: 40vh;
    display: flex;
    align-items: center;
}

.calculator-container {
    padding: 2rem;
    border-radius: var(--border-radius-xl);
}

.results-panel {
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    position: sticky;
    top: 2rem;
}

.form-section {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding-bottom: 1.5rem;
}

.form-section:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.section-title {
    font-weight: 600;
    margin-bottom: 1rem;
}

.btn-check:checked + .btn {
    background-color: var(--warning-color);
    border-color: var(--warning-color);
    color: var(--dark-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.product-types .btn {
    min-height: 120px;
    transition: all var(--transition-fast);
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

.input-group-text {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.8);
}

.form-check-input:checked {
    background-color: var(--warning-color);
    border-color: var(--warning-color);
}

.breakdown-item,
.cost-item {
    font-size: 0.9rem;
}

.border-secondary {
    border-color: rgba(255, 255, 255, 0.2) !important;
}

.feature-card {
    padding: 2rem 1.5rem;
    border-radius: var(--border-radius-lg);
    transition: transform var(--transition-normal);
    height: 100%;
}

.feature-card:hover {
    transform: translateY(-3px);
}

#quantityMinus,
#quantityPlus {
    min-width: 45px;
}

@media (max-width: 992px) {
    .results-panel {
        position: static;
        margin-top: 2rem;
    }
}

@media (max-width: 768px) {
    .calculator-container,
    .results-panel {
        padding: 1.5rem;
    }
    
    .product-types .btn {
        min-height: 100px;
        font-size: 0.9rem;
    }
    
    .feature-card {
        padding: 1.5rem 1rem;
        margin-bottom: 1rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/includes/layout.php';
?>