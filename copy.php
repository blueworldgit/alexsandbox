
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



$book=$_GET['book'];
$verse=$_GET['verse'];
$chapter=$_GET['chapter'];
$wordorder=$_GET['wordorder'];




 $query = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}' AND `wordorder` = '{$wordorder}' ");


while ($row = mysqli_fetch_array($query)) {
	
	
	$newword=$row['word'];
	$gematria=$row['gematriaword'];
	
}


 $query = mysqli_query($conn, "SELECT * FROM `theholybibletranslated` WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}' AND `wordorder` = '{$wordorder}' ");


while ($row = mysqli_fetch_array($query)) {
	
	
	$id=$row['id'];
	
	
}


echo "New word is: ". $newword."</br>";
echo "New gematria value is: ". $gematria."</br>";


echo "book".  $book."</br>";
echo "chapter ".  $chapter."</br>";
echo "verse".  $verse."</br>";

echo "wordorder ". $wordorder."</br>";


$writequery = "UPDATE `theholybibletranslated` SET `word` = '{$newword}', `gematriaword` = '{$gematria}' WHERE `theholybibletranslated`.`id` = '{$id}'";



	//$writequery = "UPDATE `theholybibletranslated` SET `gematriaword` = '{$gematria}' AND `word` = '{$newword}' WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}' AND `wordorder` = '{$wordorder}' ";
	
	
	
if (mysqli_query($conn, $writequery)) {
    echo "<h2>Word updated!!!</h2>";
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}


?>



