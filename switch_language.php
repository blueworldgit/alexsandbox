<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Toggle the database type
if(!isset($_SESSION['db_type']) || $_SESSION['db_type'] == 'english') {
    $_SESSION['db_type'] = 'hebrew_greek';
} else {
    $_SESSION['db_type'] = 'english';
}

// Get current verse and system data to maintain context
$keyid = isset($_POST['keyid']) ? $_POST['keyid'] : 1;
$system = isset($_POST['system']) ? $_POST['system'] : 'theholybible#standard';

// Handle system compatibility when switching to English
if ($_SESSION['db_type'] == 'english') {
    // Parse current system
    $systemvalues = explode("#", $system);
    $bibletable = $systemvalues[0];
    $methodtable = isset($systemvalues[1]) ? $systemvalues[1] : 'standard';
    
    // Check if this is a Hebrew/Greek only system (not available in English)
    // English database only has standard system, so default to that
    if ($bibletable != 'theholybible' || $methodtable != 'standard') {
        $system = 'theholybible#standard'; // Default to standard English system
    }
}

// Forward the request to systemswitch.php to reload current verse in new language
$_POST['keyid'] = $keyid;
$_POST['system'] = $system;
$_POST['db_type'] = $_SESSION['db_type'];

// Include systemswitch.php to display the verse in the new language
// (systemswitch.php will handle including functions.php)
include('./systemswitch.php');
?>