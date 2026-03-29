<?php


include("./functions.php");

$id=$_POST['id'];
$book=$_POST['book'];
$chapter=$_POST['chapter'];
$verse=$_POST['verse'];
$value=$_POST['value'];
$word=$_POST['word'];


update($conn,$book,$chapter,$verse,$word,$value,$id);
changestate($conn,$id,'9');

echo "<h2>Values Updated</h2>";

?>