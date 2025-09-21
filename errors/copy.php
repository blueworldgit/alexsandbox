<?php


include("./functions.php");


$id=$_POST['id'];
$providedtext=$_POST['providedtext'];


copyalternateverse($conn,$providedtext,$id);



?>