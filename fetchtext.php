<?php

include("./functions.php");

$verse=$_POST['verse'];




$string="";

$queryone = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `keyid` = '{$verse}'");


	while ($row = mysqli_fetch_array($queryone)) {
		
		
		$string=$string." ".$row['word'];
		
	}


if($id>23145) {

$string=str_replace(".","","$string");
$string=str_replace(",","","$string");
 $string= mb_strtolower($string, 'UTF-8');
$string=removeAccents($string);

}

else {
		$string=str_replace("׃","",$string);
	$string=str_replace(".","","$string");
$string=str_replace(",","","$string");

$string = preg_replace('/\p{Mn}/u', '', $string);

}
echo $string

?>