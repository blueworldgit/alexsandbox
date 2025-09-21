<?php


include("./functions.php");

$id=$_POST['id'];
$book=$_POST['book'];
$chapter=$_POST['chapter'];
$verse=$_POST['verse'];
$value=$_POST['value'];





changestate($conn,$id,'3');


echo "<h2>Verse Marked</h2>";

?>