<?php
/**
 * Calculator API Endpoint
 * Alumpro.Az Management System
 */

// Include required files
require_once __DIR__ . '/../../includes/session.php';

// Get request method and action
$method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];
$path_parts = explode('/', trim($request_uri, '/'));
$action = end($path_parts);

// CORS headers for API
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-CSRF-Token');

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Rate limiting
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!checkRateLimit('calculator_' . $client_ip, 100, 3600)) { // 100 requests per hour
    sendJsonResponse([
        'success' => false,
        'message' => 'Çox sayda sorğu göndərdiniz. Zəhmət olmasa bir az gözləyin.'
    ], 429);
}

try {
    switch ($action) {
        case 'calculate':
            handleCalculation();
            break;
        case 'save':
            handleSaveCalculation();
            break;
        case 'materials':
            handleGetMaterials();
            break;
        default:
            sendJsonResponse([
                'success' => false,
                'message' => 'Invalid endpoint'
            ], 404);
    }
} catch (Exception $e) {
    error_log('Calculator API Error: ' . $e->getMessage());
    sendJsonResponse([
        'success' => false,
        'message' => 'Server error occurred'
    ], 500);
}

function handleCalculation() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    // Get calculation data
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        sendJsonResponse(['success' => false, 'message' => 'Invalid input data'], 400);
    }

    // Validate input
    $required_fields = ['productType', 'width', 'height', 'profileType', 'glassType', 'quantity'];
    foreach ($required_fields as $field) {
        if (!isset($input[$field])) {
            sendJsonResponse(['success' => false, 'message' => "Missing field: {$field}"], 400);
        }
    }

    // Price data (should match JavaScript calculator)
    $prices = [
        'profiles' => [
            '50mm' => 22.50,
            '60mm' => 25.50,
            '70mm' => 28.50
        ],
        'glass' => [
            'single' => 15.00,
            'double' => 45.00,
            'triple' => 75.00
        ],
        'accessories' => [
            'euro_handle' => 85.00,
            'mosquito_net' => 25.00,
            'window_sill' => 35.00 // per meter
        ],
        'installation' => [
            'window' => 25.00, // per m²
            'door' => 35.00    // per m²
        ]
    ];

    // Calculate
    $width = $input['width'] / 100; // Convert to meters
    $height = $input['height'] / 100; // Convert to meters
    $area = $width * $height;
    $perimeter = 2 * ($width + $height);
    
    // Profile cost
    $profilePrice = $prices['profiles'][$input['profileType']] ?? 0;
    $profileCost = $profilePrice * $perimeter * $input['quantity'];
    
    // Glass cost
    $glassPrice = $prices['glass'][$input['glassType']] ?? 0;
    $glassCost = $glassPrice * $area * $input['quantity'];
    
    // Accessories cost
    $accessoriesCost = 0;
    if (isset($input['accessories']) && is_array($input['accessories'])) {
        foreach ($input['accessories'] as $accessory) {
            if ($accessory === 'window_sill') {
                $accessoriesCost += $prices['accessories'][$accessory] * $width * $input['quantity'];
            } else {
                $accessoriesCost += ($prices['accessories'][$accessory] ?? 0) * $input['quantity'];
            }
        }
    }
    
    // Installation cost
    $installationPrice = $prices['installation'][$input['productType']] ?? 25.00;
    $installationCost = $installationPrice * $area * $input['quantity'];
    
    // Total cost
    $totalCost = $profileCost + $glassCost + $accessoriesCost + $installationCost;
    
    $result = [
        'success' => true,
        'calculation' => [
            'profileCost' => round($profileCost, 2),
            'glassCost' => round($glassCost, 2),
            'accessoriesCost' => round($accessoriesCost, 2),
            'installationCost' => round($installationCost, 2),
            'totalCost' => round($totalCost, 2),
            'area' => round($area, 2),
            'perimeter' => round($perimeter, 2)
        ],
        'input' => $input
    ];

    sendJsonResponse($result);
}

function handleSaveCalculation() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        sendJsonResponse(['success' => false, 'message' => 'Invalid input data'], 400);
    }

    try {
        $db = Database::getInstance();
        
        // Save calculation to database (simplified version)
        $sql = "INSERT INTO saved_calculations (user_id, calculation_data, ip_address, created_at) VALUES (?, ?, ?, NOW())";
        $user_id = isLoggedIn() ? $_SESSION['user_id'] : null;
        $calculation_data = json_encode($input);
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        
        $db->execute($sql, [$user_id, $calculation_data, $ip_address]);
        $calculation_id = $db->lastInsertId();

        // Log activity
        logActivity($user_id, 'calculation_saved', 'Price calculation saved', $ip_address);

        sendJsonResponse([
            'success' => true,
            'message' => 'Hesablama yadda saxlandı',
            'calculation_id' => $calculation_id
        ]);

    } catch (Exception $e) {
        error_log('Failed to save calculation: ' . $e->getMessage());
        sendJsonResponse([
            'success' => false,
            'message' => 'Hesablama yadda saxlanmadı'
        ], 500);
    }
}

function handleGetMaterials() {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        sendJsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
    }

    // Return available materials and their prices
    $materials = [
        'profiles' => [
            [
                'id' => '50mm',
                'name' => '50mm Profil',
                'description' => 'Standart pəncərələr üçün',
                'price' => 22.50,
                'unit' => 'm'
            ],
            [
                'id' => '60mm',
                'name' => '60mm Profil',
                'description' => 'Yaxşılaşdırılmış izolyasiya',
                'price' => 25.50,
                'unit' => 'm'
            ],
            [
                'id' => '70mm',
                'name' => '70mm Profil',
                'description' => 'Premium keyfiyyət',
                'price' => 28.50,
                'unit' => 'm'
            ]
        ],
        'glass' => [
            [
                'id' => 'single',
                'name' => 'Tək Şüşə',
                'description' => '4mm şüşə',
                'price' => 15.00,
                'unit' => 'm²'
            ],
            [
                'id' => 'double',
                'name' => 'İkili Şüşə',
                'description' => '4+12+4mm (enerji qənaət edici)',
                'price' => 45.00,
                'unit' => 'm²'
            ],
            [
                'id' => 'triple',
                'name' => 'Üçlü Şüşə',
                'description' => '4+12+4+12+4mm (maksimum izolyasiya)',
                'price' => 75.00,
                'unit' => 'm²'
            ]
        ],
        'accessories' => [
            [
                'id' => 'euro_handle',
                'name' => 'Avropa Dəstəyi',
                'description' => 'Mikro açılma sistemli',
                'price' => 85.00,
                'unit' => 'ədəd'
            ],
            [
                'id' => 'mosquito_net',
                'name' => 'Ağcaqanad Şəbəkəsi',
                'description' => 'Fiberglass material',
                'price' => 25.00,
                'unit' => 'ədəd'
            ],
            [
                'id' => 'window_sill',
                'name' => 'Pəncərə Altlığı',
                'description' => 'PVC material, ağ rəng',
                'price' => 35.00,
                'unit' => 'm'
            ]
        ]
    ];

    sendJsonResponse([
        'success' => true,
        'materials' => $materials
    ]);
}
?>