
<?php
 
 header("Content-Type: text/html;charset=UTF-8");
 include("./functions.php");
 












$greektext=$_POST["text"];




$greektext=str_replace(".","","$greektext");
$greektext=str_replace(",","","$greektext");
 $greektext= mb_strtolower($greektext, 'UTF-8');
$greektext=removeAccents($greektext);
 
 
 
 
  $query = mysqli_query($conn, "SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%{$greektext}%' ");
 
 //$query = mysqli_query($conn, " SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%הארץ%' ");
 



  //$querytwo = mysqli_query($conn, "SELECT * FROM `{$method}` WHERE `id` = '{$key}'");
 
 
 //$rowtwo = mysqli_fetch_array($querytwo);
 
 
 	//$twofll=$rowtwo['2_F.L.L']; 


while ($row = mysqli_fetch_array($query)) {
	

 
 

 $verse=$row['keyid'];
 
 
 echo "Verse no: ". $verse."</br>";
 
}

?>
 