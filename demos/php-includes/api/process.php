<?php
/**
 * process.php - Server-side API endpoint
 * Handles AJAX requests and returns JSON responses
 */

// Enable error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display errors in response

// Set response header to JSON
header('Content-Type: application/json');

// Allow CORS for development (remove in production or configure properly)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'success' => false,
        'message' => 'Only POST requests are allowed'
    ]);
    exit;
}

try {
    // Read JSON input
    $jsonInput = file_get_contents('php://input');
    $data = json_decode($jsonInput, true);
    
    // Check if JSON is valid
    if ($data === null) {
        throw new Exception('Invalid JSON data');
    }
    
    // Validate required fields
    if (!isset($data['username']) || !isset($data['color'])) {
        throw new Exception('Missing required fields: username or color');
    }
    
    // Sanitize input
    $username = sanitizeInput($data['username']);
    $color = sanitizeInput($data['color']);
    
    // Validate username
    if (empty($username)) {
        throw new Exception('Username cannot be empty');
    }
    
    if (strlen($username) > 50) {
        throw new Exception('Username is too long (max 50 characters)');
    }
    
    // Validate color
    $validColors = ['blue', 'green', 'red', 'purple', 'orange'];
    if (!in_array($color, $validColors)) {
        throw new Exception('Invalid color selected');
    }
    
    // Process the data
    $response = processData($username, $color);
    
    // Send success response
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Data processed successfully',
        'data' => $response
    ]);
    
} catch (Exception $e) {
    // Send error response
    http_response_code(400); // Bad Request
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

/**
 * Processes the user data and generates response
 * 
 * @param string $username User's name
 * @param string $color Selected color
 * @return array Processed data
 */
function processData($username, $color) {
    // Color mapping
    $colorMap = [
        'blue' => ['name' => 'Син', 'hex' => '#3498db'],
        'green' => ['name' => 'Зелен', 'hex' => '#2ecc71'],
        'red' => ['name' => 'Червен', 'hex' => '#e74c3c'],
        'purple' => ['name' => 'Лилав', 'hex' => '#9b59b6'],
        'orange' => ['name' => 'Оранжев', 'hex' => '#e67e22']
    ];
    
    // Generate personalized greeting
    $greetings = [
        'Здравей, %s! Радвам се да те видя!',
        'Добре дошъл, %s!',
        'Хей, %s! Как си днес?',
        'Приветствам те, %s!',
        '%s, страхотно име!'
    ];
    
    $randomGreeting = $greetings[array_rand($greetings)];
    $greeting = sprintf($randomGreeting, $username);
    
    // Calculate some data
    $nameLength = mb_strlen($username, 'UTF-8');
    $timestamp = date('d.m.Y H:i:s');
    $clientIp = getClientIp();
    
    // Get color info
    $colorInfo = $colorMap[$color];
    
    // Return processed data
    return [
        'greeting' => $greeting,
        'username' => $username,
        'color' => $colorInfo['hex'],
        'colorName' => $colorInfo['name'],
        'nameLength' => $nameLength,
        'timestamp' => $timestamp,
        'clientIp' => $clientIp,
        'processingTime' => round(microtime(true) * 1000) . 'ms'
    ];
}

/**
 * Sanitizes input data to prevent XSS attacks
 * 
 * @param string $data Input data
 * @return string Sanitized data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Gets the client's IP address
 * 
 * @return string Client IP address
 */
function getClientIp() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
