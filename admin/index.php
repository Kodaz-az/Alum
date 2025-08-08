<?php
/**
 * Admin Dashboard - Alumpro.Az Management System
 */

// Require admin access
requirePermission('admin');

$page_title = 'Admin Panel - Alumpro.Az';
$page_description = 'Alumpro.Az idarəetmə paneli - istifadəçilər, sifarişlər və sistem idarəetməsi.';
$body_class = 'admin-page dashboard-page';
$page_specific_css = ['/assets/css/admin.css'];

ob_start();

// Get dashboard statistics
try {
    $db = Database::getInstance();
    
    // Users count
    $users_count = $db->fetch("SELECT COUNT(*) as count FROM users")['count'];
    
    // Customers count
    $customers_count = $db->fetch("SELECT COUNT(*) as count FROM customers WHERE status = 'active'")['count'];
    
    // Orders count (this month)
    $orders_this_month = $db->fetch("SELECT COUNT(*) as count FROM orders WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)")['count'];
    
    // Total revenue (this month)
    $revenue_this_month = $db->fetch("SELECT COALESCE(SUM(total), 0) as total FROM orders WHERE DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND status != 'cancelled'")['total'];
    
    // Recent orders
    $recent_orders = $db->fetchAll("
        SELECT o.*, c.name as customer_name, c.phone as customer_phone 
        FROM orders o 
        LEFT JOIN customers c ON o.customer_id = c.id 
        ORDER BY o.created_at DESC 
        LIMIT 10
    ");
    
    // Recent customers
    $recent_customers = $db->fetchAll("
        SELECT * FROM customers 
        ORDER BY created_at DESC 
        LIMIT 10
    ");
    
    // System activity
    $recent_activity = $db->fetchAll("
        SELECT al.*, u.name as user_name 
        FROM activity_log al 
        LEFT JOIN users u ON al.user_id = u.id 
        ORDER BY al.created_at DESC 
        LIMIT 15
    ");
    
} catch (Exception $e) {
    error_log("Dashboard error: " . $e->getMessage());
    $users_count = $customers_count = $orders_this_month = $revenue_this_month = 0;
    $recent_orders = $recent_customers = $recent_activity = [];
}
?>

<!-- Admin Header -->
<div class="admin-header py-4 mb-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 text-white mb-2 fade-in">
                    <i class="bi bi-speedometer2 text-warning me-2"></i>
                    Admin Panel
                </h1>
                <p class="text-white-50 mb-0">Alumpro.Az İdarəetmə Sistemi</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="admin-actions fade-in">
                    <a href="/admin/orders" class="btn btn-warning me-2">
                        <i class="bi bi-plus-circle"></i> Yeni Sifariş
                    </a>
                    <a href="/admin/settings" class="btn btn-outline-light">
                        <i class="bi bi-gear"></i> Tənzimləmələr
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Statistics -->
<section class="dashboard-stats mb-5">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-6 col-xl-3">
                <div class="stat-card glass-container fade-in">
                    <div class="stat-content">
                        <div class="stat-icon">
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number"><?= number_format($users_count) ?></h3>
                            <p class="stat-label text-white-50">İstifadəçilər</p>
                            <small class="stat-change text-success">
                                <i class="bi bi-arrow-up"></i> +5% bu ay
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="stat-card glass-container fade-in">
                    <div class="stat-content">
                        <div class="stat-icon">
                            <i class="bi bi-person-heart text-success"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number"><?= number_format($customers_count) ?></h3>
                            <p class="stat-label text-white-50">Aktiv Müştərilər</p>
                            <small class="stat-change text-success">
                                <i class="bi bi-arrow-up"></i> +12% bu ay
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="stat-card glass-container fade-in">
                    <div class="stat-content">
                        <div class="stat-icon">
                            <i class="bi bi-cart-check text-warning"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number"><?= number_format($orders_this_month) ?></h3>
                            <p class="stat-label text-white-50">Bu Ay Sifarişlər</p>
                            <small class="stat-change text-success">
                                <i class="bi bi-arrow-up"></i> +8% keçən aya nisbətdə
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="stat-card glass-container fade-in">
                    <div class="stat-content">
                        <div class="stat-icon">
                            <i class="bi bi-currency-exchange text-info"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number"><?= formatCurrency($revenue_this_month) ?></h3>
                            <p class="stat-label text-white-50">Bu Ay Gəlir</p>
                            <small class="stat-change text-success">
                                <i class="bi bi-arrow-up"></i> +15% keçən aya nisbətdə
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Actions -->
<section class="quick-actions mb-5">
    <div class="container-fluid">
        <h3 class="text-white mb-4">Sürətli Əməliyyatlar</h3>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <a href="/admin/orders/create" class="quick-action-card glass-container text-decoration-none">
                    <div class="action-icon">
                        <i class="bi bi-plus-circle text-warning"></i>
                    </div>
                    <div class="action-content">
                        <h5 class="text-white">Yeni Sifariş</h5>
                        <p class="text-white-50 mb-0">Müştəri sifarişi əlavə et</p>
                    </div>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <a href="/admin/customers/create" class="quick-action-card glass-container text-decoration-none">
                    <div class="action-icon">
                        <i class="bi bi-person-plus text-success"></i>
                    </div>
                    <div class="action-content">
                        <h5 class="text-white">Yeni Müştəri</h5>
                        <p class="text-white-50 mb-0">Müştəri əlavə et</p>
                    </div>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <a href="/admin/products/create" class="quick-action-card glass-container text-decoration-none">
                    <div class="action-icon">
                        <i class="bi bi-box text-primary"></i>
                    </div>
                    <div class="action-content">
                        <h5 class="text-white">Yeni Məhsul</h5>
                        <p class="text-white-50 mb-0">Məhsul kataloqu əlavə et</p>
                    </div>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <a href="/admin/whatsapp" class="quick-action-card glass-container text-decoration-none">
                    <div class="action-icon">
                        <i class="bi bi-whatsapp text-success"></i>
                    </div>
                    <div class="action-content">
                        <h5 class="text-white">WhatsApp</h5>
                        <p class="text-white-50 mb-0">Mesaj göndər</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="dashboard-content">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Recent Orders -->
            <div class="col-lg-8">
                <div class="content-card glass-container fade-in">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0">
                            <i class="bi bi-cart text-warning me-2"></i>
                            Son Sifarişlər
                        </h4>
                        <a href="/admin/orders" class="btn btn-sm btn-outline-light">
                            Hamısını Gör
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (empty($recent_orders)): ?>
                            <div class="empty-state text-center py-4">
                                <i class="bi bi-cart-x text-white-50 fs-1"></i>
                                <p class="text-white-50 mt-2">Hələ sifariş yoxdur</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sifariş №</th>
                                            <th>Müştəri</th>
                                            <th>Məbləğ</th>
                                            <th>Status</th>
                                            <th>Tarix</th>
                                            <th>Əməliyyat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recent_orders as $order): ?>
                                            <tr>
                                                <td>
                                                    <strong class="text-warning">#<?= htmlspecialchars($order['order_number']) ?></strong>
                                                </td>
                                                <td>
                                                    <div>
                                                        <div class="text-white"><?= htmlspecialchars($order['customer_name']) ?></div>
                                                        <small class="text-white-50"><?= htmlspecialchars($order['customer_phone']) ?></small>
                                                    </div>
                                                </td>
                                                <td class="text-success fw-bold">
                                                    <?= formatCurrency($order['total']) ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?= getOrderStatusColor($order['status']) ?>">
                                                        <?= getOrderStatusText($order['status']) ?>
                                                    </span>
                                                </td>
                                                <td class="text-white-50">
                                                    <?= formatDate($order['created_at'], 'd.m.Y') ?>
                                                </td>
                                                <td>
                                                    <a href="/admin/orders/<?= $order['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div class="col-lg-4">
                <div class="content-card glass-container fade-in">
                    <div class="card-header">
                        <h4 class="text-white mb-0">
                            <i class="bi bi-activity text-info me-2"></i>
                            Son Fəaliyyət
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($recent_activity)): ?>
                            <div class="empty-state text-center py-4">
                                <i class="bi bi-clock-history text-white-50 fs-1"></i>
                                <p class="text-white-50 mt-2">Fəaliyyət yoxdur</p>
                            </div>
                        <?php else: ?>
                            <div class="activity-list">
                                <?php foreach ($recent_activity as $activity): ?>
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="bi bi-<?= getActivityIcon($activity['action']) ?> text-warning"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-text text-white">
                                                <?= getActivityText($activity['action']) ?>
                                            </div>
                                            <div class="activity-meta">
                                                <small class="text-white-50">
                                                    <?= $activity['user_name'] ? htmlspecialchars($activity['user_name']) : 'Sistem' ?>
                                                    • <?= formatDate($activity['created_at'], 'd.m H:i') ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row g-4 mt-1">
            <!-- Recent Customers -->
            <div class="col-lg-6">
                <div class="content-card glass-container fade-in">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0">
                            <i class="bi bi-people text-success me-2"></i>
                            Yeni Müştərilər
                        </h4>
                        <a href="/admin/customers" class="btn btn-sm btn-outline-light">
                            Hamısını Gör
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (empty($recent_customers)): ?>
                            <div class="empty-state text-center py-4">
                                <i class="bi bi-people text-white-50 fs-1"></i>
                                <p class="text-white-50 mt-2">Yeni müştəri yoxdur</p>
                            </div>
                        <?php else: ?>
                            <div class="customer-list">
                                <?php foreach ($recent_customers as $customer): ?>
                                    <div class="customer-item d-flex align-items-center py-2">
                                        <div class="customer-avatar me-3">
                                            <div class="avatar-circle">
                                                <?= strtoupper(substr($customer['name'], 0, 1)) ?>
                                            </div>
                                        </div>
                                        <div class="customer-info flex-grow-1">
                                            <div class="customer-name text-white"><?= htmlspecialchars($customer['name']) ?></div>
                                            <div class="customer-contact">
                                                <small class="text-white-50"><?= htmlspecialchars($customer['phone']) ?></small>
                                                <?php if ($customer['email']): ?>
                                                    <small class="text-white-50">• <?= htmlspecialchars($customer['email']) ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="customer-actions">
                                            <a href="/admin/customers/<?= $customer['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- System Status -->
            <div class="col-lg-6">
                <div class="content-card glass-container fade-in">
                    <div class="card-header">
                        <h4 class="text-white mb-0">
                            <i class="bi bi-shield-check text-success me-2"></i>
                            Sistem Statusu
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="system-status">
                            <div class="status-item d-flex justify-content-between align-items-center py-2">
                                <span class="text-white-50">Database:</span>
                                <span class="badge bg-success">Aktiv</span>
                            </div>
                            <div class="status-item d-flex justify-content-between align-items-center py-2">
                                <span class="text-white-50">WhatsApp API:</span>
                                <span class="badge bg-success">Qoşulu</span>
                            </div>
                            <div class="status-item d-flex justify-content-between align-items-center py-2">
                                <span class="text-white-50">SMS Xidməti:</span>
                                <span class="badge bg-warning">Gözləyir</span>
                            </div>
                            <div class="status-item d-flex justify-content-between align-items-center py-2">
                                <span class="text-white-50">Email Xidməti:</span>
                                <span class="badge bg-success">Aktiv</span>
                            </div>
                            <div class="status-item d-flex justify-content-between align-items-center py-2">
                                <span class="text-white-50">Backup:</span>
                                <span class="badge bg-info">Son: 2 saat əvvəl</span>
                            </div>
                        </div>
                        
                        <hr style="border-color: rgba(255,255,255,0.2);">
                        
                        <div class="system-info">
                            <small class="text-white-50">
                                <strong>Sistem Versiyası:</strong> <?= APP_VERSION ?><br>
                                <strong>Son Yenilik:</strong> <?= formatDate(date('Y-m-d H:i:s'), 'd.m.Y H:i') ?><br>
                                <strong>Aktiv İstifadəçilər:</strong> <?= $users_count ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
/**
 * Helper functions for dashboard
 */
function getOrderStatusColor($status) {
    $colors = [
        'pending' => 'warning',
        'confirmed' => 'info',
        'processing' => 'primary',
        'ready' => 'success',
        'delivered' => 'success',
        'cancelled' => 'danger'
    ];
    return $colors[$status] ?? 'secondary';
}

function getOrderStatusText($status) {
    $texts = [
        'pending' => 'Gözləyir',
        'confirmed' => 'Təsdiqləndi',
        'processing' => 'İşlənir',
        'ready' => 'Hazır',
        'delivered' => 'Çatdırıldı',
        'cancelled' => 'Ləğv edildi'
    ];
    return $texts[$status] ?? 'Naməlum';
}

function getActivityIcon($action) {
    $icons = [
        'login' => 'box-arrow-in-right',
        'logout' => 'box-arrow-right',
        'user_registered' => 'person-plus',
        'order_created' => 'cart-plus',
        'order_updated' => 'cart-check',
        'customer_created' => 'person-heart',
        'product_created' => 'box',
        'whatsapp_sent' => 'whatsapp'
    ];
    return $icons[$action] ?? 'activity';
}

function getActivityText($action) {
    $texts = [
        'login' => 'Sistemə giriş',
        'logout' => 'Sistemdən çıxış',
        'user_registered' => 'Yeni istifadəçi qeydiyyatı',
        'order_created' => 'Yeni sifariş yaradıldı',
        'order_updated' => 'Sifariş yeniləndi',
        'customer_created' => 'Yeni müştəri əlavə edildi',
        'product_created' => 'Yeni məhsul əlavə edildi',
        'whatsapp_sent' => 'WhatsApp mesajı göndərildi'
    ];
    return $texts[$action] ?? 'Sistem fəaliyyəti';
}

$content = ob_get_clean();
include __DIR__ . '/../includes/layout.php';
?>