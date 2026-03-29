<?php
header('Content-Type: text/html; charset=utf-8');

$remote_host = 'srv1015.hstgr.io';

$databases = [
    'English (KJV)' => [
        'host'     => $remote_host,
        'username' => 'u826402471_u826402471_blu',
        'password' => 'Neris@9112512',
        'database' => 'u826402471_gem_kjv',
    ],
    'Hebrew/Greek' => [
        'host'     => $remote_host,
        'username' => 'u826402471_blue',
        'password' => 'letmein123',
        'database' => 'u826402471_gem',
    ],
];

echo "<h2>Remote Database Connection Test</h2>";
echo "<p><strong>Remote host:</strong> {$remote_host}</p>";
echo "<hr>";

foreach ($databases as $label => $cfg) {
    echo "<h3>{$label}</h3>";
    echo "<ul>";
    echo "<li><strong>Host:</strong> {$cfg['host']}</li>";
    echo "<li><strong>User:</strong> {$cfg['username']}</li>";
    echo "<li><strong>Database:</strong> {$cfg['database']}</li>";
    echo "</ul>";

    $conn = @mysqli_connect($cfg['host'], $cfg['username'], $cfg['password'], $cfg['database']);

    if (!$conn || mysqli_connect_errno()) {
        $err = mysqli_connect_error();
        $code = mysqli_connect_errno();
        echo "<p style='color:red;'>&#10008; Connection FAILED (error {$code}): {$err}</p>";
    } else {
        mysqli_query($conn, "SET NAMES 'utf8'");
        $server_info = mysqli_get_server_info($conn);
        echo "<p style='color:green;'>&#10004; Connection SUCCESSFUL &mdash; MySQL server version: {$server_info}</p>";

        // Quick sanity query: list tables
        $result = mysqli_query($conn, "SHOW TABLES");
        if ($result) {
            $tables = [];
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
            echo "<p>Tables found (" . count($tables) . "): " . implode(', ', array_slice($tables, 0, 10));
            if (count($tables) > 10) {
                echo " ... and " . (count($tables) - 10) . " more";
            }
            echo "</p>";
            mysqli_free_result($result);
        }

        mysqli_close($conn);
    }

    echo "<hr>";
}
?>
