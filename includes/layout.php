<?php
/**
 * Main Layout Template
 * Alumpro.Az Management System
 */

// Include session management
require_once __DIR__ . '/includes/session.php';

// Get page title and specific data
$page_title = $page_title ?? 'Alumpro.Az - Aluminium Profile Systems';
$page_description = $page_description ?? 'Professional aluminum profile systems for doors and windows in Azerbaijan';
$body_class = $body_class ?? '';
$page_specific_css = $page_specific_css ?? [];
$page_specific_js = $page_specific_js ?? [];

// Get flash message
$flash = getFlashMessage();
?>
<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
    <meta name="csrf-token" content="<?= generateCSRFToken() ?>">
    
    <title><?= htmlspecialchars($page_title) ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/logo/favicon.ico">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="/assets/css/main.css" as="style">
    <link rel="preload" href="/assets/js/main.js" as="script">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Main CSS -->
    <link href="/assets/css/main.css" rel="stylesheet">
    
    <!-- Page-specific CSS -->
    <?php foreach ($page_specific_css as $css): ?>
        <link href="<?= htmlspecialchars($css) ?>" rel="stylesheet">
    <?php endforeach; ?>
    
    <!-- Custom CSS for current user role -->
    <?php if (isLoggedIn()): ?>
        <?php if (hasRole('admin')): ?>
            <link href="/assets/css/admin.css" rel="stylesheet">
        <?php elseif (hasRole('sales')): ?>
            <link href="/assets/css/sales.css" rel="stylesheet">
        <?php elseif (hasRole('customer')): ?>
            <link href="/assets/css/customer.css" rel="stylesheet">
        <?php endif; ?>
    <?php endif; ?>
</head>

<body class="<?= htmlspecialchars($body_class) ?>">
    <div class="main-wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="/">
                    <img src="/assets/images/logo/logo.png" alt="Alumpro.Az" height="40" class="d-none">
                    <i class="bi bi-building"></i>
                    Alumpro.Az
                </a>

                <!-- Mobile toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation items -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/"><i class="bi bi-house"></i> Ana Səhifə</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about"><i class="bi bi-info-circle"></i> Haqqımızda</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/products" data-bs-toggle="dropdown">
                                <i class="bi bi-grid"></i> Məhsullar
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/products/profiles">Alüminium Profillər</a></li>
                                <li><a class="dropdown-item" href="/products/glass">Şüşə Sistemləri</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/products">Bütün Məhsullar</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/gallery"><i class="bi bi-images"></i> Qalereya</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/calculator"><i class="bi bi-calculator"></i> Kalkulyator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact"><i class="bi bi-telephone"></i> Əlaqə</a>
                        </li>
                    </ul>

                    <!-- User menu -->
                    <ul class="navbar-nav">
                        <?php if (isLoggedIn()): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i>
                                    <?= htmlspecialchars($_SESSION['user_name']) ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <?php if (hasRole('admin')): ?>
                                        <li><a class="dropdown-item" href="/admin"><i class="bi bi-speedometer2"></i> Admin Panel</a></li>
                                    <?php elseif (hasRole('sales')): ?>
                                        <li><a class="dropdown-item" href="/sales"><i class="bi bi-graph-up"></i> Satış Paneli</a></li>
                                    <?php elseif (hasRole('customer')): ?>
                                        <li><a class="dropdown-item" href="/customer"><i class="bi bi-person"></i> Şəxsi Kabinet</a></li>
                                    <?php endif; ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#" data-action="logout"><i class="bi bi-box-arrow-right"></i> Çıxış</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/auth/login"><i class="bi bi-box-arrow-in-right"></i> Giriş</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/auth/register"><i class="bi bi-person-plus"></i> Qeydiyyat</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        <?php if ($flash): ?>
            <div class="flash-messages">
                <div class="container mt-3">
                    <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : $flash['type'] ?> alert-dismissible">
                        <?= htmlspecialchars($flash['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <main class="content-wrapper">
            <?= $content ?? '' ?>
        </main>

        <!-- Footer -->
        <footer class="mt-5 py-4 glass-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-white mb-3">Alumpro.Az</h5>
                        <p class="text-white-50">
                            Azərbaycanda alüminium profil sistemləri sahəsində peşəkar xidmətlər.
                            Keyfiyyətli qapı və pəncərə həlləri.
                        </p>
                        <div class="social-links">
                            <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-white me-3"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-telephone"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-white mb-3">Sürətli Keçidlər</h6>
                        <ul class="list-unstyled">
                            <li><a href="/about" class="text-white-50">Haqqımızda</a></li>
                            <li><a href="/products" class="text-white-50">Məhsullar</a></li>
                            <li><a href="/gallery" class="text-white-50">Qalereya</a></li>
                            <li><a href="/contact" class="text-white-50">Əlaqə</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-white mb-3">Əlaqə</h6>
                        <ul class="list-unstyled text-white-50">
                            <li><i class="bi bi-geo-alt"></i> Bakı, Azərbaycan</li>
                            <li><i class="bi bi-telephone"></i> +994 XX XXX XX XX</li>
                            <li><i class="bi bi-envelope"></i> info@alumpro.az</li>
                            <li><i class="bi bi-whatsapp"></i> +994 XX XXX XX XX</li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <small class="text-white-50">
                            &copy; <?= date('Y') ?> Alumpro.Az. Bütün hüquqlar qorunur.
                        </small>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <small class="text-white-50">
                            Versiya <?= APP_VERSION ?>
                        </small>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>
    
    <!-- Page-specific JS -->
    <?php foreach ($page_specific_js as $js): ?>
        <script src="<?= htmlspecialchars($js) ?>"></script>
    <?php endforeach; ?>

    <!-- WhatsApp Float Button -->
    <div class="whatsapp-float" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        <a href="https://wa.me/<?= str_replace(['+', ' ', '-'], '', COMPANY_WHATSAPP) ?>" 
           target="_blank" 
           class="btn btn-success btn-lg rounded-circle"
           title="WhatsApp ilə əlaqə">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    <!-- Scroll to Top Button -->
    <button class="btn btn-primary btn-sm rounded-circle" 
            id="scrollToTop" 
            style="position: fixed; bottom: 20px; left: 20px; z-index: 1000; display: none;"
            title="Yuxarı qayıt">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script>
        // Scroll to top functionality
        window.addEventListener('scroll', function() {
            const scrollButton = document.getElementById('scrollToTop');
            if (window.pageYOffset > 300) {
                scrollButton.style.display = 'block';
            } else {
                scrollButton.style.display = 'none';
            }
        });

        document.getElementById('scrollToTop').addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Update last activity
        document.addEventListener('click', function() {
            localStorage.setItem('lastActivity', Date.now().toString());
        });
    </script>
</body>
</html>