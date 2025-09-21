
<?php

/*
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


// config.php - Store database connection parameters
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

// Connect to the database
$conn = mysqli_connect(
    $current_db['host'],
    $current_db['username'],
    $current_db['password'],
    $current_db['database']
);

// Set UTF-8 encoding
header('Content-Type: text/html; charset=utf-8');
mysqli_query($conn, "SET NAMES 'utf8'");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
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
?>
 


