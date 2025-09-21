<?php
// Database Comparison Analysis: Hebrew/Greek vs English KJV
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(300);

echo "<!DOCTYPE html><html><head>";
echo "<title>Database Comparison: Hebrew/Greek vs English KJV</title>";
echo "<style>
body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
.container { max-width: 1400px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
h1, h2, h3 { color: #333; border-bottom: 2px solid #007cba; padding-bottom: 5px; }
.comparison-section { margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 5px; background: #fafafa; }
.db-column { width: 48%; display: inline-block; vertical-align: top; margin: 1%; }
.hebrew-db { background: #e8f5e8; border-left: 4px solid #4CAF50; }
.english-db { background: #e8f0ff; border-left: 4px solid #2196F3; }
table { width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 12px; }
th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
th { background: #007cba; color: white; }
tr:nth-child(even) { background: #f2f2f2; }
.present { color: #008000; font-weight: bold; }
.absent { color: #ff0000; font-weight: bold; }
.difference { background: #fff3cd; padding: 10px; border-radius: 3px; margin: 10px 0; }
.stats { background: #f0f8ff; padding: 15px; border-radius: 5px; margin: 10px 0; }
.gematria-systems { background: #f9f9f9; padding: 15px; border-radius: 5px; }
.unique-feature { background: #d4edda; color: #155724; padding: 8px; border-radius: 3px; margin: 5px 0; }
.missing-feature { background: #f8d7da; color: #721c24; padding: 8px; border-radius: 3px; margin: 5px 0; }
</style>";
echo "</head><body>";

echo "<div class='container'>";
echo "<h1>🔍 Database Comparison Analysis</h1>";
echo "<h2>Hebrew/Greek Database vs English KJV Database</h2>";
echo "<p><strong>Analysis Date:</strong> " . date('Y-m-d H:i:s') . "</p>";

// Database configurations
$databases = [
    'hebrew_greek' => [
        'host' => 'srv1015.hstgr.io',
        'username' => 'u826402471_blue',
        'password' => 'letmein123',
        'database' => 'u826402471_gem',
        'description' => 'Hebrew/Greek Original Language Database',
        'color_class' => 'hebrew-db'
    ],
    'english' => [
        'host' => 'srv1015.hstgr.io',
        'username' => 'u826402471_u826402471_blu',
        'password' => 'Neris@9112512',
        'database' => 'u826402471_gem_kjv',
        'description' => 'English KJV Bible Database',
        'color_class' => 'english-db'
    ]
];

$db_data = [];

// Connect to both databases and gather data
foreach ($databases as $db_key => $config) {
    $conn = @mysqli_connect(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database']
    );
    
    if (!$conn) {
        echo "<p style='color: red;'>❌ Failed to connect to {$config['description']}: " . mysqli_connect_error() . "</p>";
        continue;
    }
    
    mysqli_query($conn, "SET NAMES 'utf8'");
    
    // Get all tables
    $tables_result = mysqli_query($conn, "SHOW TABLES");
    $tables = [];
    while ($row = mysqli_fetch_array($tables_result)) {
        $tables[] = $row[0];
    }
    
    // Get database size
    $size_query = "SELECT 
        SUM(DATA_LENGTH + INDEX_LENGTH) as total_size,
        COUNT(*) as table_count
        FROM information_schema.TABLES 
        WHERE TABLE_SCHEMA = '{$config['database']}'";
    
    $size_result = mysqli_query($conn, $size_query);
    $size_data = mysqli_fetch_assoc($size_result);
    
    $db_data[$db_key] = [
        'config' => $config,
        'tables' => $tables,
        'table_count' => $size_data['table_count'],
        'total_size' => $size_data['total_size'],
        'connection' => $conn
    ];
}

// Display side-by-side comparison
echo "<div class='comparison-section'>";
echo "<h2>📊 Database Overview Comparison</h2>";

foreach ($db_data as $db_key => $data) {
    echo "<div class='db-column {$data['config']['color_class']}'>";
    echo "<h3>🗄️ {$data['config']['description']}</h3>";
    echo "<div class='stats'>";
    echo "<strong>Database:</strong> {$data['config']['database']}<br>";
    echo "<strong>Tables:</strong> {$data['table_count']}<br>";
    echo "<strong>Total Size:</strong> " . formatBytes($data['total_size']) . "<br>";
    echo "</div>";
    echo "</div>";
}

echo "</div>";

// Analyze gematria calculation tables
echo "<div class='comparison-section'>";
echo "<h2>🔢 Gematria Calculation Systems Comparison</h2>";

$gematria_patterns = [
    'theholybible' => 'Standard Gematria',
    'theholybibleordinal' => 'Ordinal Gematria', 
    'theholybiblereduced' => 'Reduced Gematria',
    'theholybiblefullstandard' => 'Full Standard Gematria',
    'theholybiblefullordinal' => 'Full Ordinal Gematria',
    'theholybiblefullreduced' => 'Full Reduced Gematria',
    'theholybiblereversedstandard' => 'Reverse Standard Gematria',
    'theholybiblereversedordinal' => 'Reverse Ordinal Gematria',
    'theholybiblereversedreduced' => 'Reverse Reduced Gematria',
    'theholybibleone' => 'Combined Method One (Ord + Std)',
    'theholybibletwo' => 'Combined Method Two (Red + Ord + Std)',
    'theholybiblethree' => 'Combined Method Three (Full Ord + Full Std)',
    'theholybiblefour' => 'Combined Method Four (Full Red + Full Ord + Full Std)',
    'theholybiblefive' => 'Combined Method Five (Rev Ord + Rev Std)',
    'theholybiblesix' => 'Combined Method Six (Rev Red + Rev Ord + Rev Std)',
    'theholybibleordinalstandard' => 'Ordinal + Standard Combined',
    'theholybiblereducedordinalstandard' => 'Reduced + Ordinal + Standard Combined'
];

echo "<table>";
echo "<tr><th>Gematria System</th><th>Hebrew/Greek DB</th><th>English KJV DB</th><th>Notes</th></tr>";

foreach ($gematria_patterns as $table_pattern => $description) {
    $in_hebrew = in_array($table_pattern, $db_data['hebrew_greek']['tables']);
    $in_english = in_array($table_pattern, $db_data['english']['tables']);
    
    echo "<tr>";
    echo "<td><strong>{$description}</strong><br><code>{$table_pattern}</code></td>";
    echo "<td>" . ($in_hebrew ? "<span class='present'>✓ Present</span>" : "<span class='absent'>✗ Absent</span>") . "</td>";
    echo "<td>" . ($in_english ? "<span class='present'>✓ Present</span>" : "<span class='absent'>✗ Absent</span>") . "</td>";
    
    // Analysis notes
    if ($in_hebrew && !$in_english) {
        echo "<td class='unique-feature'>🔹 Hebrew/Greek Only - Advanced original language calculations</td>";
    } elseif (!$in_hebrew && $in_english) {
        echo "<td class='unique-feature'>🔹 English Only - KJV-specific calculations</td>";
    } elseif ($in_hebrew && $in_english) {
        echo "<td>✓ Available in both databases</td>";
    } else {
        echo "<td class='missing-feature'>Not implemented in either database</td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "</div>";

// Analyze methods tables
echo "<div class='comparison-section'>";
echo "<h2>🧮 Methods Tables Comparison</h2>";

$methods_patterns = [
    'methods_standard' => 'Standard Methods',
    'methods_ordinal' => 'Ordinal Methods',
    'methods_reduced' => 'Reduced Methods',
    'methods_fullstandard' => 'Full Standard Methods',
    'methods_fullordinal' => 'Full Ordinal Methods',
    'methods_fullreduced' => 'Full Reduced Methods',
    'methods_reversedstandard' => 'Reverse Standard Methods',
    'methods_reversedordinal' => 'Reverse Ordinal Methods',
    'methods_reversedreduced' => 'Reverse Reduced Methods',
    'methods_one' => 'Combined Methods One',
    'methods_two' => 'Combined Methods Two',
    'methods_three' => 'Combined Methods Three',
    'methods_four' => 'Combined Methods Four',
    'methods_five' => 'Combined Methods Five',
    'methods_six' => 'Combined Methods Six'
];

echo "<table>";
echo "<tr><th>Methods System</th><th>Hebrew/Greek DB</th><th>English KJV DB</th><th>Analysis</th></tr>";

foreach ($methods_patterns as $table_pattern => $description) {
    $in_hebrew = in_array($table_pattern, $db_data['hebrew_greek']['tables']);
    $in_english = in_array($table_pattern, $db_data['english']['tables']);
    
    echo "<tr>";
    echo "<td><strong>{$description}</strong><br><code>{$table_pattern}</code></td>";
    echo "<td>" . ($in_hebrew ? "<span class='present'>✓ Present</span>" : "<span class='absent'>✗ Absent</span>") . "</td>";
    echo "<td>" . ($in_english ? "<span class='present'>✓ Present</span>" : "<span class='absent'>✗ Absent</span>") . "</td>";
    
    if ($in_hebrew && !$in_english) {
        echo "<td class='unique-feature'>Hebrew/Greek exclusive - Original language method analysis</td>";
    } elseif (!$in_hebrew && $in_english) {
        echo "<td class='unique-feature'>English exclusive - KJV-specific method analysis</td>";
    } elseif ($in_hebrew && $in_english) {
        echo "<td>Available in both - Cross-language comparison possible</td>";
    } else {
        echo "<td class='missing-feature'>Not available</td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "</div>";

// Unique tables analysis
echo "<div class='comparison-section'>";
echo "<h2>🔍 Unique Tables Analysis</h2>";

$hebrew_only = array_diff($db_data['hebrew_greek']['tables'], $db_data['english']['tables']);
$english_only = array_diff($db_data['english']['tables'], $db_data['hebrew_greek']['tables']);
$common_tables = array_intersect($db_data['hebrew_greek']['tables'], $db_data['english']['tables']);

echo "<div class='db-column hebrew-db'>";
echo "<h3>📚 Hebrew/Greek Exclusive Tables (" . count($hebrew_only) . ")</h3>";
if (!empty($hebrew_only)) {
    echo "<ul>";
    foreach ($hebrew_only as $table) {
        echo "<li><code>{$table}</code></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No exclusive tables</p>";
}
echo "</div>";

echo "<div class='db-column english-db'>";
echo "<h3>📖 English KJV Exclusive Tables (" . count($english_only) . ")</h3>";
if (!empty($english_only)) {
    echo "<ul>";
    foreach ($english_only as $table) {
        echo "<li><code>{$table}</code></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No exclusive tables</p>";
}
echo "</div>";

echo "<div style='clear: both;'>";
echo "<h3>🤝 Common Tables (" . count($common_tables) . ")</h3>";
echo "<p>Tables present in both databases:</p>";
echo "<div style='columns: 3; column-gap: 20px;'>";
foreach ($common_tables as $table) {
    echo "<code>{$table}</code><br>";
}
echo "</div>";
echo "</div>";

echo "</div>";

// Key differences summary
echo "<div class='comparison-section'>";
echo "<h2>📋 Key Differences Summary</h2>";

echo "<div class='difference'>";
echo "<h3>🔹 Hebrew/Greek Database Features:</h3>";
echo "<ul>";
echo "<li><strong>Full Methods:</strong> Contains 'Full' variations of gematria calculations not present in English</li>";
echo "<li><strong>Extended Combinations:</strong> Methods Three and Four for complex original language analysis</li>";
echo "<li><strong>Original Language Focus:</strong> Optimized for Hebrew and Greek textual analysis</li>";
echo "</ul>";
echo "</div>";

echo "<div class='difference'>";
echo "<h3>🔹 English KJV Database Features:</h3>";
echo "<ul>";
echo "<li><strong>Standard Systems:</strong> Focus on core gematria calculation methods</li>";
echo "<li><strong>English Optimization:</strong> Tailored for English language biblical text analysis</li>";
echo "<li><strong>Streamlined Approach:</strong> Fewer method variations for cleaner English analysis</li>";
echo "</ul>";
echo "</div>";

echo "<div class='difference'>";
echo "<h3>🎯 Strategic Implementation:</h3>";
echo "<ul>";
echo "<li><strong>Language-Specific Optimization:</strong> Each database optimized for its target language</li>";
echo "<li><strong>Computational Efficiency:</strong> Avoids unnecessary calculations for language-inappropriate methods</li>";
echo "<li><strong>Research Flexibility:</strong> Allows comparative analysis between original and translated texts</li>";
echo "</ul>";
echo "</div>";

echo "</div>";

// Close database connections
foreach ($db_data as $data) {
    mysqli_close($data['connection']);
}

function formatBytes($size, $precision = 2) {
    $base = log($size, 1024);
    $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

echo "</div></body></html>";
?>