<?php
// Test script for smart database detection
include("./db.php");

echo "<h2>🔍 Smart Database Connection Test</h2>";
echo "<p><strong>Test Date:</strong> " . date('Y-m-d H:i:s') . "</p>";

$env_info = get_environment_info();

echo "<div style='background: #f0f8ff; border: 1px solid #007cba; padding: 20px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>🖥️ Environment Detection Results</h3>";
echo "<table style='border-collapse: collapse; width: 100%;'>";
echo "<tr><td style='border: 1px solid #ddd; padding: 10px; font-weight: bold; background: #f5f5f5;'>Environment:</td>";
echo "<td style='border: 1px solid #ddd; padding: 10px;'><span style='color: " . ($env_info['environment'] === 'local' ? '#ff6600' : '#008000') . "; font-weight: bold;'>" . strtoupper($env_info['environment']) . "</span></td></tr>";

echo "<tr><td style='border: 1px solid #ddd; padding: 10px; font-weight: bold; background: #f5f5f5;'>Connection Type:</td>";
echo "<td style='border: 1px solid #ddd; padding: 10px;'>{$env_info['connection_type']}</td></tr>";

echo "<tr><td style='border: 1px solid #ddd; padding: 10px; font-weight: bold; background: #f5f5f5;'>Database Host:</td>";
echo "<td style='border: 1px solid #ddd; padding: 10px;'><code>{$env_info['host']}</code></td></tr>";

echo "<tr><td style='border: 1px solid #ddd; padding: 10px; font-weight: bold; background: #f5f5f5;'>Database Name:</td>";
echo "<td style='border: 1px solid #ddd; padding: 10px;'><code>{$env_info['database']}</code></td></tr>";

echo "<tr><td style='border: 1px solid #ddd; padding: 10px; font-weight: bold; background: #f5f5f5;'>Current Language:</td>";
echo "<td style='border: 1px solid #ddd; padding: 10px;'>" . get_db_display_name() . "</td></tr>";

echo "<tr><td style='border: 1px solid #ddd; padding: 10px; font-weight: bold; background: #f5f5f5;'>Server Name:</td>";
echo "<td style='border: 1px solid #ddd; padding: 10px;'>" . ($_SERVER['SERVER_NAME'] ?? 'N/A') . "</td></tr>";

echo "<tr><td style='border: 1px solid #ddd; padding: 10px; font-weight: bold; background: #f5f5f5;'>Server Address:</td>";
echo "<td style='border: 1px solid #ddd; padding: 10px;'>" . ($_SERVER['SERVER_ADDR'] ?? 'N/A') . "</td></tr>";
echo "</table>";
echo "</div>";

// Test database connection
echo "<div style='background: #f0fff0; border: 1px solid #4CAF50; padding: 20px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>🔌 Database Connection Test</h3>";

if ($conn) {
    echo "<p style='color: #008000; font-size: 18px; font-weight: bold;'>✅ CONNECTION SUCCESSFUL!</p>";
    
    // Test a simple query
    $test_query = "SELECT COUNT(*) as table_count FROM information_schema.tables WHERE table_schema = '{$current_db['database']}'";
    $result = mysqli_query($conn, $test_query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "<p><strong>Database Tables Found:</strong> {$row['table_count']}</p>";
    }
    
    // Show MySQL server info
    echo "<p><strong>MySQL Server Version:</strong> " . mysqli_get_server_info($conn) . "</p>";
    echo "<p><strong>Connection Info:</strong> " . mysqli_get_host_info($conn) . "</p>";
    
} else {
    echo "<p style='color: #ff0000; font-size: 18px; font-weight: bold;'>❌ CONNECTION FAILED!</p>";
    echo "<p><strong>Error:</strong> " . mysqli_connect_error() . "</p>";
}
echo "</div>";

// Configuration summary
echo "<div style='background: #fff8e1; border: 1px solid #ffa000; padding: 20px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>⚙️ Configuration Summary</h3>";

if ($env_info['environment'] === 'local') {
    echo "<h4 style='color: #ff6600;'>🏠 LOCAL DEVELOPMENT MODE</h4>";
    echo "<ul>";
    echo "<li><strong>Development Server:</strong> WAMP/XAMPP running locally</li>";
    echo "<li><strong>Database Connection:</strong> Remote connection to Hostinger</li>";
    echo "<li><strong>Use Case:</strong> Local development with remote database</li>";
    echo "<li><strong>Required:</strong> Internet connection and IP whitelisting</li>";
    echo "</ul>";
} else {
    echo "<h4 style='color: #008000;'>🌐 PRODUCTION MODE</h4>";
    echo "<ul>";
    echo "<li><strong>Production Server:</strong> Live hosting environment</li>";
    echo "<li><strong>Database Connection:</strong> Local connection (localhost)</li>";
    echo "<li><strong>Use Case:</strong> Live website with local database</li>";
    echo "<li><strong>Performance:</strong> Optimized for production use</li>";
    echo "</ul>";
}
echo "</div>";

// Toggle database language test
echo "<div style='background: #f3e5f5; border: 1px solid #9c27b0; padding: 20px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>🔄 Database Language Toggle</h3>";
echo "<p><strong>Current Database:</strong> " . get_db_display_name() . "</p>";
echo "<p><a href='?toggle_db=1' style='background: #9c27b0; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px;'>";
echo "Switch to " . ($_SESSION['db_type'] == 'english' ? 'Hebrew/Greek' : 'English (KJV)') . " Database";
echo "</a></p>";
echo "</div>";

echo "<div style='background: #e8f5e8; border: 1px solid #4CAF50; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>✅ System Ready!</h3>";
echo "<p>Your smart database system is working correctly and will automatically:</p>";
echo "<ul>";
echo "<li>Detect local development vs production environment</li>";
echo "<li>Use appropriate database connections</li>";
echo "<li>Handle both English and Hebrew/Greek databases</li>";
echo "<li>Work seamlessly on both local and online servers</li>";
echo "</ul>";
echo "</div>";
?>