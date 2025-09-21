<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("./functions.php");

$newchapter=1;
$setchapter=1;

$query = mysqli_query($conn,"SELECT * FROM `theholybible` WHERE `gematriaword` = 401 ");

$booksum=0;
$chaptersum=0;
$versesum=0;
$counter=0;


echo "<h1>DUMP RESULTS FOR 401 TOTAL</h1>";

while( $row = mysqli_fetch_array( $query)){

$counter++;

echo "<h1>".$counter."</h1>";


$book=$row['book'];
$verse=$row['keyid'];
$chapter=gettruechapter($conn,$verse);


echo "*************************************************************************************";
echo "<h3>Data for verse $counter out of 7728</h3>";
echo "<p><i>book--".$book."</p></i>";
echo "<p><i>chapter--".$chapter."</p></i>";
echo "<p><i>verse--".$verse."</p></i>";
echo "*************************************************************************************";


$booksum=($booksum+$book)*1;
$chaptersum=($chaptersum+$chapter)*1;
$versesum=($versesum+$verse)*1;

echo "<p>booksum--".$booksum."</p>";
echo "<p>chaptersum--".$chaptersum."</p>";
echo "<p>versesum--".$versesum."</p>";


}


echo "<h1>FINAL TOTALS</h1>";


echo "<p>booksum--".$booksum."</p>";
echo "<p>chaptersum--".$chaptersum."</p>";
echo "<p>versesum--".$versesum."</p>";







 //$value = array_sum(array_column($arr,'f_count'));

?>
