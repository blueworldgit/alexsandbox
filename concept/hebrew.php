<?php 

include("./functions.php");



$hebrewText=$_POST["text"];




$hebrewText = preg_replace('/\p{Mn}/u', '', $hebrewText);

$hebrewText=str_replace("׃","",$hebrewText);
 $hebrewText= mb_strtolower($hebrewText, 'UTF-8');
 
 
 
  $query = mysqli_query($conn, "SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%{$hebrewText}%' ");
 
 //$query = mysqli_query($conn, " SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%הארץ%' ");
 



  //$querytwo = mysqli_query($conn, "SELECT * FROM `{$method}` WHERE `id` = '{$key}'");
 
 
 //$rowtwo = mysqli_fetch_array($querytwo);
 
 
 	//$twofll=$rowtwo['2_F.L.L']; 


while ($row = mysqli_fetch_array($query)) {
	

 
 

 $verse=$row['keyid'];
 
 
 echo "Verse no: ". $verse."</br>";
 
}

?>
 
 












