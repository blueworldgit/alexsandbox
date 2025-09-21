<?php

include("./functions.php");


$hebrewText="בְּרֵאשִׁ֗ית";

$hebrewText = preg_replace('/\p{Mn}/u', '', $hebrewText);

$hebrewText=str_replace("׃","",$hebrewText);
 $hebrewText= mb_strtolower($hebrewText, 'UTF-8');

  $page_query = "SELECT * FROM `theholybibledeaccentedwords` WHERE `text` = '{$hebrewText}' ORDER BY keyid ASC"; 



  $query = mysqli_query($conn, $page_query);
  
  
  
  
  while ($row = mysqli_fetch_array($query)) {
	



 
 $book=$row['book'];
   $chapter=$row['chapter'];

 $verse=$row['keyid'];
 
  $trueverse=$row['verse'];
  
  $text=$row['text'];
  
  
    $wordorder=$row['wordorder'];
 
 
 $bookname=getbookname($conn,$book);
 
 $translated=gettranslation($conn,$book,$chapter,$trueverse,$wordorder);
 
 
 
 echo "book--$book</br>";
 
 echo "chapter--$chapter</br>";
 
  echo "verse--$verse</br>";
  
  echo "wordorder--$wordorder</br>";
  
  echo "translated--$translated</br>";
  
  echo "------------------------------</br>";
 
 
 
  }
 
 
 
 //$translated=gettranslation($conn,24,26,1,1);
 
 
 echo $translated;

?>



 





