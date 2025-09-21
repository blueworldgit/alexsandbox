<?php
// Test script for remote database connections
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Testing Remote Database Connections to Hostinger</h2>";
echo "<p>Server: srv1015.hstgr.io (194.5.156.145)</p>";
echo "<hr>";

// Database configurations
$databases = [
    'english' => [
        'host' => 'srv1015.hstgr.io',
        'username' => 'u826402471_u826402471_blu',
        'password' => 'Neris@9112512',
        'database' => 'u826402471_gem_kjv',
        'table_prefix' => 'kjv_'
    ],
    'hebrew_greek' => [
        'host' => 'srv1015.hstgr.io',
        'username' => 'u826402471_blue',
        'password' => 'letmein123',
        'database' => 'u826402471_gem',
        'table_prefix' => ''
    ]
];

// Test each database connection
foreach ($databases as $db_name => $config) {
    echo "<h3>Testing {$db_name} database connection:</h3>";
    echo "<p>Database: {$config['database']}</p>";
    echo "<p>Username: {$config['username']}</p>";
    
    // Test connection
    $start_time = microtime(true);
    $conn = @mysqli_connect(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database']
    );
    $end_time = microtime(true);
    $connection_time = round(($end_time - $start_time) * 1000, 2);
    
    if ($conn) {
        echo "<p style='color: green;'>✓ Connection successful! (Time: {$connection_time}ms)</p>";
        
        // Set UTF-8 encoding
        mysqli_query($conn, "SET NAMES 'utf8'");
        
        // Test a simple query to verify database access
        $test_query = "SHOW TABLES";
        $result = mysqli_query($conn, $test_query);
        
        if ($result) {
            echo "<p style='color: green;'>✓ Database query successful!</p>";
            echo "<p><strong>Tables found in database:</strong></p>";
            echo "<ul>";
            $table_count = 0;
            while ($row = mysqli_fetch_array($result) && $table_count < 10) {
                echo "<li>" . $row[0] . "</li>";
                $table_count++;
            }
            if (mysqli_num_rows($result) > 10) {
                echo "<li>... and " . (mysqli_num_rows($result) - 10) . " more tables</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠ Connected but query failed: " . mysqli_error($conn) . "</p>";
        }
        
        // Test connection info
        echo "<p><strong>Server Info:</strong> " . mysqli_get_server_info($conn) . "</p>";
        echo "<p><strong>Host Info:</strong> " . mysqli_get_host_info($conn) . "</p>";
        
        mysqli_close($conn);
    } else {
        echo "<p style='color: red;'>✗ Connection failed!</p>";
        echo "<p><strong>Error:</strong> " . mysqli_connect_error() . "</p>";
        echo "<p><strong>Error Number:</strong> " . mysqli_connect_errno() . "</p>";
    }
    
    echo "<hr>";
}

// Test using IP address instead of hostname
echo "<h3>Testing with IP address (194.5.156.145):</h3>";
$ip_config = [
    'host' => '194.5.156.145',
    'username' => 'u826402471_blue',
    'password' => 'letmein123',
    'database' => 'u826402471_gem'
];

$start_time = microtime(true);
$conn = @mysqli_connect(
    $ip_config['host'],
    $ip_config['username'],
    $ip_config['password'],
    $ip_config['database']
);
$end_time = microtime(true);
$connection_time = round(($end_time - $start_time) * 1000, 2);

if ($conn) {
    echo "<p style='color: green;'>✓ IP connection successful! (Time: {$connection_time}ms)</p>";
    mysqli_close($conn);
} else {
    echo "<p style='color: red;'>✗ IP connection failed: " . mysqli_connect_error() . "</p>";
}

echo "<hr>";
echo "<h3>Connection Tips:</h3>";
echo "<ul>";
echo "<li>Make sure your current IP address is added to the Remote MySQL whitelist in Hostinger</li>";
echo "<li>Verify that the usernames have remote access permissions (% wildcard)</li>";
echo "<li>Check if your firewall/ISP blocks outgoing MySQL connections on port 3306</li>";
echo "<li>Try using the IP address (194.5.156.145) if hostname doesn't work</li>";
echo "</ul>";

echo "<p><strong>Your current server IP (for whitelist):</strong> " . $_SERVER['SERVER_ADDR'] . "</p>";
echo "<p><strong>Your current client IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>";
?>