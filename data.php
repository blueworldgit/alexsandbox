<?php

include("./db.php");



$versetext=NULL;



for ($x = 1; $x <= 50; $x++) {

$chapter=$x;
$verse=0;
$maybe=TRUE;

while ($maybe) {
$verse++;
echo $chapter. "</br>";
echo $verse. "</br>";

$query = mysqli_query($conn, "SELECT * FROM `bible_original` WHERE `chapter` = '$chapter' 
AND `verse` = '$verse'   ");


if (mysqli_num_rows($query) == 0) { 
$maybe=FALSE;
echo "<h1>NO MORE VERSES</h1>";
} 



else   {
    
  $count=0; 

while ($row = mysqli_fetch_array($query)) {
	
	$count++;


  
  //$versetext=$versetext.$row['word'];	
  
  $versetext=$versetext.$row['orig_order']."--";	
	
}
echo "<h1>**************************************************************</h1>";
echo $versetext. "</br>";

   
}
   
  
  //echo $row['chapter']. "</br>";
  
  
 
 
} //maybe



}

 //while loop array fetch

//echo $versetext;

//$verse++;

// for loop


?>
