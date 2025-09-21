<?php

/*
// Legacy connection - kept for reference
// Enter your Host, username, password, database below.
// I left password empty because i do not set password on localhost.
header('Content-Type: text/html; charset=utf-8');
 $conn = mysqli_connect("localhost","u826402471_u826402471_blu","Neris@9112512","u826402471_gem_kjv");
 mysqli_query($conn,"SET NAMES 'utf8'");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
*/

// Auto-detect environment: local development vs online production
function detectEnvironment() {
    // Check common local development indicators
    $local_hosts = ['localhost', '127.0.0.1', '::1'];
    $local_ips = ['127.0.0.1', '::1'];
    
    // Check server name/host
    $server_name = $_SERVER['SERVER_NAME'] ?? $_SERVER['HTTP_HOST'] ?? 'unknown';
    $server_addr = $_SERVER['SERVER_ADDR'] ?? 'unknown';
    
    // Local development indicators
    if (in_array($server_name, $local_hosts) || 
        in_array($server_addr, $local_ips) || 
        strpos($server_name, 'localhost') !== false ||
        strpos($server_name, '127.0.0.1') !== false ||
        strpos($server_name, 'wamp') !== false ||
        strpos($server_name, 'xampp') !== false) {
        return 'local';
    }
    
    // Production environment (online server)
    return 'online';
}

// Get current environment
$environment = detectEnvironment();

// Database configurations based on environment
if ($environment === 'local') {
    // LOCAL DEVELOPMENT SERVER (WAMP/XAMPP with remote database connection)
    $databases = [
        'english' => [
            'host' => 'srv1015.hstgr.io', // Remote Hostinger server
            'username' => 'u826402471_u826402471_blu',
            'password' => 'Neris@9112512',
            'database' => 'u826402471_gem_kjv',
            'table_prefix' => 'kjv_'
        ],
        'hebrew_greek' => [
            'host' => 'srv1015.hstgr.io', // Remote Hostinger server
            'username' => 'u826402471_blue',
            'password' => 'letmein123',
            'database' => 'u826402471_gem',
            'table_prefix' => ''
        ]
    ];
} else {
    // ONLINE PRODUCTION SERVER (local database connection)
    $databases = [
        'english' => [
            'host' => 'localhost', // Local database on production server
            'username' => 'u826402471_u826402471_blu',
            'password' => 'Neris@9112512',
            'database' => 'u826402471_gem_kjv',
            'table_prefix' => 'kjv_'
        ],
        'hebrew_greek' => [
            'host' => 'localhost', // Local database on production server
            'username' => 'u826402471_blue',
            'password' => 'letmein123',
            'database' => 'u826402471_gem',
            'table_prefix' => ''
        ]
    ];
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set default database type if not set
if (!isset($_SESSION['db_type'])) {
    $_SESSION['db_type'] = 'hebrew_greek'; // Default to Hebrew/Greek
}

// Toggle database type if requested
if (isset($_GET['toggle_db'])) {
    $_SESSION['db_type'] = ($_SESSION['db_type'] == 'english') ? 'hebrew_greek' : 'english';
    
    // Redirect to remove the toggle parameter from URL
    $redirect_url = strtok($_SERVER['REQUEST_URI'], '?');
    header("Location: $redirect_url");
    exit();
}

// Get current database configuration
$current_db = $databases[$_SESSION['db_type']];

// Connect to the database with retry logic
$max_retries = 3;
$retry_count = 0;
$conn = false;

while (!$conn && $retry_count < $max_retries) {
    $conn = @mysqli_connect(
        $current_db['host'],
        $current_db['username'],
        $current_db['password'],
        $current_db['database']
    );
    
    if (!$conn) {
        $retry_count++;
        if ($retry_count < $max_retries) {
            sleep(1); // Wait 1 second before retry
        }
    }
}

// Set UTF-8 encoding
header('Content-Type: text/html; charset=utf-8');
if ($conn) {
    mysqli_query($conn, "SET NAMES 'utf8'");
}

// Check connection and provide detailed error info
if (!$conn) {
    $error_details = [
        'Environment' => $environment,
        'Host' => $current_db['host'],
        'Database' => $current_db['database'],
        'Username' => $current_db['username'],
        'Error' => mysqli_connect_error(),
        'Error Number' => mysqli_connect_errno()
    ];
    
    echo "<div style='background: #ffebee; border: 1px solid #f44336; padding: 20px; margin: 20px; border-radius: 5px;'>";
    echo "<h3 style='color: #d32f2f;'>Database Connection Failed</h3>";
    echo "<table style='border-collapse: collapse; width: 100%;'>";
    foreach ($error_details as $key => $value) {
        echo "<tr><td style='border: 1px solid #ddd; padding: 8px; font-weight: bold;'>{$key}:</td>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>{$value}</td></tr>";
    }
    echo "</table>";
    echo "<p><strong>Troubleshooting Tips:</strong></p>";
    echo "<ul>";
    if ($environment === 'local') {
        echo "<li>Ensure your IP is whitelisted in Hostinger Remote MySQL</li>";
        echo "<li>Check your internet connection</li>";
        echo "<li>Verify WAMP/XAMPP is running</li>";
    } else {
        echo "<li>Check if database service is running on the server</li>";
        echo "<li>Verify database credentials</li>";
        echo "<li>Check database permissions</li>";
    }
    echo "</ul>";
    echo "</div>";
    exit();
}

// Function to get the correct table name with prefix
function get_table_name($base_table_name) {
    global $current_db;
    return $current_db['table_prefix'] . $base_table_name;
}

// Helper function to get current database type name for display
function get_db_display_name() {
    global $_SESSION;
    return ($_SESSION['db_type'] == 'english') ? 'English (KJV)' : 'Hebrew/Greek';
}

// Helper function to get current environment for display
function get_environment_info() {
    global $environment, $current_db;
    return [
        'environment' => $environment,
        'host' => $current_db['host'],
        'database' => $current_db['database'],
        'connection_type' => ($environment === 'local') ? 'Remote (Hostinger)' : 'Local (Production)'
    ];
}

// Optional: Add debug info (remove in production)
if (isset($_GET['debug']) && $_GET['debug'] === 'db') {
    $env_info = get_environment_info();
    echo "<div style='background: #e3f2fd; border: 1px solid #2196F3; padding: 15px; margin: 15px; border-radius: 5px; font-family: monospace;'>";
    echo "<h4 style='color: #1976D2; margin-top: 0;'>Database Debug Info</h4>";
    echo "<strong>Environment:</strong> {$env_info['environment']}<br>";
    echo "<strong>Connection Type:</strong> {$env_info['connection_type']}<br>";
    echo "<strong>Host:</strong> {$env_info['host']}<br>";
    echo "<strong>Database:</strong> {$env_info['database']}<br>";
    echo "<strong>Current DB Type:</strong> " . get_db_display_name() . "<br>";
    echo "<strong>Server Name:</strong> " . ($_SERVER['SERVER_NAME'] ?? 'N/A') . "<br>";
    echo "<strong>Server Address:</strong> " . ($_SERVER['SERVER_ADDR'] ?? 'N/A') . "<br>";
    echo "</div>";
}
?>