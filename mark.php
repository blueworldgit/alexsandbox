
<html>
<head>
<title>lets check</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0/dist/js.cookie.min.js" integrity="sha256-pUYbeWfQ0TisH2PabhAZLCzI8qGOJop0mEWjbJBcZLQ=" crossorigin="anonymous"></script>
</head>
<body>

<div class="col-md-12">


<?php

//http://localhost/alexlatest/interlinear/copy.php?book=1&chapter=2&verse=3&wordorder=4

//UPDATE `theholybibletranslated` SET `word` = 'את', `gematriaword` = '401' WHERE `theholybibletranslated`.`id` = 4;

include("./functions.php");


$keyid=$_GET['keyid'];





echo "Verse : ". $keyid."  has been marked as error</br>";



$writequery = "UPDATE `theholybible` SET `marker` = 'error'  WHERE `theholybible`.`keyid` = '{$keyid}'";



	//$writequery = "UPDATE `theholybibletranslated` SET `gematriaword` = '{$gematria}' AND `word` = '{$newword}' WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}' AND `wordorder` = '{$wordorder}' ";
	
	
	
if (mysqli_query($conn, $writequery)) {
    echo "<h2>Verse updated!!!</h2>";
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}


?>



