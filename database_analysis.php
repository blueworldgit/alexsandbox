<?php
// Comprehensive Database Structure Analysis Script
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(300); // 5 minutes for large databases

echo "<!DOCTYPE html><html><head>";
echo "<title>Bible Database Structure Analysis</title>";
echo "<style>
body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
.container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
h1, h2, h3 { color: #333; border-bottom: 2px solid #007cba; padding-bottom: 5px; }
.db-section { margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 5px; background: #fafafa; }
table { width: 100%; border-collapse: collapse; margin: 15px 0; }
th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
th { background: #007cba; color: white; }
tr:nth-child(even) { background: #f2f2f2; }
.success { color: #008000; font-weight: bold; }
.error { color: #ff0000; font-weight: bold; }
.info { color: #0066cc; }
.sample-data { background: #e8f4f8; padding: 10px; border-radius: 3px; margin: 10px 0; }
.stats { background: #f0f8ff; padding: 15px; border-radius: 5px; margin: 10px 0; }
.field-details { font-size: 12px; color: #666; }
.table-summary { background: #fff3cd; padding: 10px; border-radius: 3px; margin: 5px 0; }
</style>";
echo "</head><body>";

echo "<div class='container'>";
echo "<h1>📊 Bible Database Structure Analysis</h1>";
echo "<p><strong>Analysis Date:</strong> " . date('Y-m-d H:i:s') . "</p>";
echo "<p><strong>Remote Server:</strong> srv1015.hstgr.io (194.5.156.145)</p>";

// Database configurations
$databases = [
    'english' => [
        'host' => 'srv1015.hstgr.io',
        'username' => 'u826402471_u826402471_blu',
        'password' => 'Neris@9112512',
        'database' => 'u826402471_gem_kjv',
        'table_prefix' => 'kjv_',
        'description' => 'English KJV Bible Database'
    ],
    'hebrew_greek' => [
        'host' => 'srv1015.hstgr.io',
        'username' => 'u826402471_blue',
        'password' => 'letmein123',
        'database' => 'u826402471_gem',
        'table_prefix' => '',
        'description' => 'Hebrew/Greek Original Language Database'
    ]
];

function formatBytes($size, $precision = 2) {
    $base = log($size, 1024);
    $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

function analyzeTable($conn, $table_name, $database_name) {
    echo "<div class='table-summary'>";
    echo "<h4>📋 Table: <code>{$table_name}</code></h4>";
    
    // Get table info
    $info_query = "SELECT 
        TABLE_ROWS as row_count,
        DATA_LENGTH as data_length,
        INDEX_LENGTH as index_length,
        (DATA_LENGTH + INDEX_LENGTH) as total_size,
        ENGINE,
        TABLE_COLLATION
        FROM information_schema.TABLES 
        WHERE TABLE_SCHEMA = '{$database_name}' AND TABLE_NAME = '{$table_name}'";
    
    $info_result = mysqli_query($conn, $info_query);
    if ($info_result && $info_row = mysqli_fetch_assoc($info_result)) {
        echo "<div class='stats'>";
        echo "<strong>📊 Table Statistics:</strong><br>";
        echo "• Rows: " . number_format($info_row['row_count']) . "<br>";
        echo "• Data Size: " . formatBytes($info_row['data_length']) . "<br>";
        echo "• Index Size: " . formatBytes($info_row['index_length']) . "<br>";
        echo "• Total Size: " . formatBytes($info_row['total_size']) . "<br>";
        echo "• Engine: {$info_row['ENGINE']}<br>";
        echo "• Collation: {$info_row['TABLE_COLLATION']}<br>";
        echo "</div>";
    }
    
    // Get column structure
    $columns_query = "DESCRIBE `{$table_name}`";
    $columns_result = mysqli_query($conn, $columns_query);
    
    if ($columns_result) {
        echo "<table>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th><th>Sample Data</th></tr>";
        
        $sample_query = "SELECT * FROM `{$table_name}` LIMIT 3";
        $sample_result = mysqli_query($conn, $sample_query);
        $sample_data = [];
        while ($sample_result && $row = mysqli_fetch_assoc($sample_result)) {
            $sample_data[] = $row;
        }
        
        while ($col = mysqli_fetch_assoc($columns_result)) {
            echo "<tr>";
            echo "<td><strong>{$col['Field']}</strong></td>";
            echo "<td><span class='field-details'>{$col['Type']}</span></td>";
            echo "<td>{$col['Null']}</td>";
            echo "<td>" . ($col['Key'] ? "<span class='info'>{$col['Key']}</span>" : '') . "</td>";
            echo "<td>{$col['Default']}</td>";
            echo "<td>{$col['Extra']}</td>";
            
            // Show sample data for this field
            echo "<td>";
            if (!empty($sample_data)) {
                $samples = [];
                foreach ($sample_data as $sample) {
                    if (isset($sample[$col['Field']])) {
                        $value = $sample[$col['Field']];
                        if (strlen($value) > 30) {
                            $value = substr($value, 0, 30) . "...";
                        }
                        $samples[] = htmlspecialchars($value);
                    }
                }
                echo implode('<br>', array_slice($samples, 0, 2));
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    // Look for interesting patterns in table name
    if (strpos($table_name, 'holy') !== false || strpos($table_name, 'bible') !== false) {
        echo "<p class='info'>🔍 <strong>Gematria Table Detected:</strong> This appears to be a main gematria calculation table.</p>";
    }
    if (strpos($table_name, 'method') !== false) {
        echo "<p class='info'>🧮 <strong>Methods Table Detected:</strong> This likely contains calculation method data.</p>";
    }
    if (strpos($table_name, 'strong') !== false) {
        echo "<p class='info'>📖 <strong>Strong's Table Detected:</strong> This contains Hebrew/Greek Strong's reference data.</p>";
    }
    if (strpos($table_name, 'ultra') !== false) {
        echo "<p class='info'>⚡ <strong>Ultra Calculation Table:</strong> Advanced gematria calculations stored here.</p>";
    }
    
    echo "</div>";
}

// Analyze each database
foreach ($databases as $db_key => $config) {
    echo "<div class='db-section'>";
    echo "<h2>🗄️ Database: {$config['description']}</h2>";
    echo "<p><strong>Database Name:</strong> {$config['database']}</p>";
    echo "<p><strong>Table Prefix:</strong> " . ($config['table_prefix'] ?: 'None') . "</p>";
    
    // Connect to database
    $conn = @mysqli_connect(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database']
    );
    
    if (!$conn) {
        echo "<p class='error'>❌ Connection failed: " . mysqli_connect_error() . "</p>";
        echo "</div>";
        continue;
    }
    
    echo "<p class='success'>✅ Connected successfully!</p>";
    mysqli_query($conn, "SET NAMES 'utf8'");
    
    // Get database size
    $size_query = "SELECT 
        SUM(DATA_LENGTH + INDEX_LENGTH) as total_size,
        COUNT(*) as table_count
        FROM information_schema.TABLES 
        WHERE TABLE_SCHEMA = '{$config['database']}'";
    
    $size_result = mysqli_query($conn, $size_query);
    if ($size_result && $size_row = mysqli_fetch_assoc($size_result)) {
        echo "<div class='stats'>";
        echo "<strong>📈 Database Overview:</strong><br>";
        echo "• Total Tables: {$size_row['table_count']}<br>";
        echo "• Total Size: " . formatBytes($size_row['total_size']) . "<br>";
        echo "</div>";
    }
    
    // Get all tables
    $tables_query = "SHOW TABLES";
    $tables_result = mysqli_query($conn, $tables_query);
    
    if (!$tables_result) {
        echo "<p class='error'>❌ Could not retrieve tables: " . mysqli_error($conn) . "</p>";
        mysqli_close($conn);
        echo "</div>";
        continue;
    }
    
    $tables = [];
    while ($table_row = mysqli_fetch_array($tables_result)) {
        $tables[] = $table_row[0];
    }
    
    echo "<h3>📊 Tables Found: " . count($tables) . "</h3>";
    
    // Categorize tables
    $gematria_tables = [];
    $methods_tables = [];
    $reference_tables = [];
    $other_tables = [];
    
    foreach ($tables as $table) {
        $lower_table = strtolower($table);
        if (strpos($lower_table, 'holy') !== false || strpos($lower_table, 'bible') !== false) {
            $gematria_tables[] = $table;
        } elseif (strpos($lower_table, 'method') !== false) {
            $methods_tables[] = $table;
        } elseif (strpos($lower_table, 'strong') !== false || strpos($lower_table, 'concord') !== false) {
            $reference_tables[] = $table;
        } else {
            $other_tables[] = $table;
        }
    }
    
    // Display categorized tables
    $categories = [
        '🔢 Gematria Tables' => $gematria_tables,
        '🧮 Methods Tables' => $methods_tables,
        '📚 Reference Tables' => $reference_tables,
        '📋 Other Tables' => $other_tables
    ];
    
    foreach ($categories as $category_name => $category_tables) {
        if (!empty($category_tables)) {
            echo "<h3>{$category_name}</h3>";
            foreach ($category_tables as $table) {
                analyzeTable($conn, $table, $config['database']);
            }
        }
    }
    
    mysqli_close($conn);
    echo "</div>";
}

echo "<div class='db-section'>";
echo "<h2>🔍 Analysis Summary</h2>";
echo "<h3>🎯 Key Insights for Your Gematria System:</h3>";
echo "<ul>";
echo "<li><strong>Dual Database Architecture:</strong> Separate English and Hebrew/Greek databases for comparative analysis</li>";
echo "<li><strong>Multiple Calculation Methods:</strong> Tables for different gematria calculation systems (standard, ordinal, reduced, etc.)</li>";
echo "<li><strong>Strong's Integration:</strong> Hebrew/Greek reference system linked to original language words</li>";
echo "<li><strong>Verse-Level Analysis:</strong> Word-by-word gematria calculations stored for each biblical verse</li>";
echo "<li><strong>Advanced Features:</strong> Ultra calculations and method combinations for complex numerological analysis</li>";
echo "</ul>";

echo "<h3>💡 Recommendations:</h3>";
echo "<ul>";
echo "<li>Consider adding indexes on frequently searched fields (gematria values, verse numbers)</li>";
echo "<li>Monitor database size growth as you add more calculation methods</li>";
echo "<li>Regular backups recommended due to the complex data relationships</li>";
echo "<li>Connection pooling could improve performance for heavy usage</li>";
echo "</ul>";
echo "</div>";

echo "</div></body></html>";
?>