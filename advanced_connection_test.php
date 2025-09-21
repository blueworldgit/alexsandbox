<?php
// Enhanced connection diagnostics
echo "<h2>Enhanced Database Connection Diagnostics</h2>";
echo "<hr>";

// Check if we can reach the server at all
echo "<h3>1. Basic Connectivity Test</h3>";
$host = 'srv1015.hstgr.io';
$port = 3306;

echo "<p>Testing if we can reach {$host}:{$port}...</p>";

$connection = @fsockopen($host, $port, $errno, $errstr, 10);
if ($connection) {
    echo "<p style='color: green;'>✓ Can reach MySQL server on port 3306</p>";
    fclose($connection);
} else {
    echo "<p style='color: red;'>✗ Cannot reach MySQL server</p>";
    echo "<p><strong>Error:</strong> {$errstr} (Code: {$errno})</p>";
    echo "<p><strong>This suggests:</strong> Port 3306 is blocked or server is unreachable</p>";
}

echo "<hr>";

// Get real public IP
echo "<h3>2. IP Address Information</h3>";
echo "<p><strong>Server sees your IP as:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>";

// Try to get public IP
$public_ip = @file_get_contents('http://checkip.amazonaws.com/');
if ($public_ip) {
    echo "<p><strong>Your public IP is:</strong> " . trim($public_ip) . "</p>";
    echo "<p style='color: orange;'>⚠ Make sure this IP is whitelisted in Hostinger Remote MySQL!</p>";
} else {
    echo "<p>Could not determine public IP automatically</p>";
}

echo "<hr>";

// Test with different connection parameters
echo "<h3>3. Connection Parameter Testing</h3>";

$test_configs = [
    [
        'name' => 'Standard Connection',
        'host' => 'srv1015.hstgr.io',
        'port' => 3306
    ],
    [
        'name' => 'IP Address Connection', 
        'host' => '194.5.156.145',
        'port' => 3306
    ],
    [
        'name' => 'Alternative Port (if available)',
        'host' => 'srv1015.hstgr.io',
        'port' => 3307
    ]
];

foreach ($test_configs as $config) {
    echo "<h4>{$config['name']}:</h4>";
    
    $connection = @fsockopen($config['host'], $config['port'], $errno, $errstr, 5);
    if ($connection) {
        echo "<p style='color: green;'>✓ Port {$config['port']} is reachable on {$config['host']}</p>";
        fclose($connection);
        
        // Try actual MySQL connection
        $conn = @mysqli_connect(
            $config['host'],
            'u826402471_blue',
            'letmein123',
            'u826402471_gem',
            $config['port']
        );
        
        if ($conn) {
            echo "<p style='color: green;'>✓ MySQL authentication successful!</p>";
            mysqli_close($conn);
        } else {
            echo "<p style='color: red;'>✗ MySQL connection failed: " . mysqli_connect_error() . "</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Cannot reach {$config['host']}:{$config['port']}</p>";
        echo "<p>Error: {$errstr} (Code: {$errno})</p>";
    }
    echo "<br>";
}

echo "<hr>";
echo "<h3>4. Troubleshooting Steps</h3>";
echo "<ol>";
echo "<li><strong>Check Hostinger Remote MySQL:</strong><br>";
echo "   - Log into Hostinger control panel<br>";
echo "   - Go to Databases → Remote MySQL<br>";
echo "   - Add your public IP address to whitelist<br>";
echo "   - Make sure databases are selected</li><br>";

echo "<li><strong>Check Firewall/ISP:</strong><br>";
echo "   - Contact your ISP if port 3306 is blocked<br>";
echo "   - Check Windows Firewall settings<br>";
echo "   - Try from a different network (mobile hotspot)</li><br>";

echo "<li><strong>Alternative Solutions:</strong><br>";
echo "   - Use SSH tunnel through Hostinger<br>";
echo "   - Consider using Hostinger's phpMyAdmin for testing<br>";
echo "   - Check if Hostinger offers alternative ports</li>";
echo "</ol>";

echo "<hr>";
echo "<p><strong>Current PHP MySQL Extensions:</strong></p>";
echo "<ul>";
if (extension_loaded('mysqli')) {
    echo "<li style='color: green;'>✓ MySQLi extension loaded</li>";
} else {
    echo "<li style='color: red;'>✗ MySQLi extension not available</li>";
}

if (extension_loaded('pdo_mysql')) {
    echo "<li style='color: green;'>✓ PDO MySQL extension loaded</li>";
} else {
    echo "<li style='color: red;'>✗ PDO MySQL extension not available</li>";
}
echo "</ul>";
?>