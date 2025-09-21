<?php
include("./functions.php");

echo "<h3>Database Session Diagnostic</h3>";
echo "<p><strong>Current SESSION db_type:</strong> " . (isset($_SESSION['db_type']) ? $_SESSION['db_type'] : 'NOT SET') . "</p>";
echo "<p><strong>Database Name:</strong> " . get_db_display_name() . "</p>";
echo "<p><strong>Connection Info:</strong> " . get_db_connection_info() . "</p>";

echo "<h4>Test Toggle Links:</h4>";
echo "<a href='?toggle_db=1'>Toggle Database</a><br>";
echo "<a href='interface.php'>Back to Interface</a>";

if (isset($_GET['toggle_db'])) {
    echo "<p style='color: green;'><strong>Toggle requested!</strong></p>";
}
?>