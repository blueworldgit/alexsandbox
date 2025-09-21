<?php
include("./db.php");


function utf8_strrev($str){
    preg_match_all('/./us', $str, $ar);
    return join('', array_reverse($ar[0]));
}




function testforcolon($string){
	$firstchar=mb_substr($string, 0, 1);
	
	if($firstchar===":") {
	
	$result=true;
}

else {
	
	$result=false;
	
}
	
	return $result;
  
}




function testifnumber($string){
	
	$secondchar=mb_substr($string, 1, 1);
	
	if(is_numeric($secondchar)) {
	
	$result=true;
}

else {
	
	$result=false;
	
}
	
	return $result;
  
}



function cleanverse($string){
$string=str_replace("׃","",$string);
$string=str_replace("'","",$string);
$string=str_replace("'","",$string);
$string=str_replace("~","",$string);
$string = preg_replace('/\p{Mn}/u', '', $string);
return $string;

}



function leaveonlyhebrew($line){
$line = preg_replace("/[a-zA-Z0-9]+/", '',$line);
$line = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $line);
$line = preg_replace("/\r|\n/", "", $line);
$line=str_replace("-", "", $line);
$line=str_replace(".", "", $line);
$line=str_replace("©", "", $line);
$line=str_replace("'", "", $line);
$line=str_replace("~","",$line);


 


return $line;

}



function getoriginaltext($conn,$book,$chapter,$verse){

$sql = "SELECT *  FROM `thenewstuff` WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}'";


$query=mysqli_query($conn, $sql);



 

	while ($row = mysqli_fetch_array($query)) {
	
	$versetext=$row['text'];
	
	
	
	}
	
	//return utf8_strrev($versetext);
	
	$versetext=cleanverse($versetext);
	
	return $versetext;
}



function getpdftext($conn,$book,$chapter,$verse){

$sql = "SELECT *  FROM `thenewstuff` WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}'";


$query=mysqli_query($conn, $sql);



 

	while ($row = mysqli_fetch_array($query)) {
	
	$versetext=$row['newtext'];
	
	
	
	}
	
	//return utf8_strrev($versetext);
	

	
	return $versetext;
}


function getkeyid($conn,$book,$chapter,$verse){
	
	$sql = "SELECT * FROM `thenewstuff` WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}' LIMIT 1";
		$query=mysqli_query($conn, $sql);
	 $row = mysqli_fetch_array( $query);

$keyid=$row['keyid'];


return $keyid;
	
	
	
	
}



function writepdforiginsverse($conn,$newtext,$keyid){
	
	
		$writequery = "UPDATE `thenewstuff` SET `pdforigins` = '{$newtext}' WHERE `thenewstuff`.`keyid` = {$keyid};";

if (mysqli_query($conn, $writequery)) {
	
	
    //echo "New record created successfully";
	
	
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}

	
}




function writepdfverse($conn,$newtext,$keyid){
	
	
		$writequery = "UPDATE `thenewstuff` SET `newtext` = '{$newtext}' WHERE `thenewstuff`.`keyid` = {$keyid};";

if (mysqli_query($conn, $writequery)) {
	
	
    //echo "New record created successfully";
	
	
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}

	
}



function removeeigthy($string) {
	
$char="פ";

$char=trim($char);

$char="".$char." ";


if (strpos($string, $char) !== false) {
		
$position = strpos($string, $char);
		
$length=mb_strlen($string, 'UTF-8');

$string = mb_substr($string, 1, $length, "UTF-8");
		   

	}

return $string;	
	
	
	
}



function removeninety($string) {
	
$char="ס";

$char=trim($char);

$char="".$char." ";


if (strpos($string, $char) !== false) {
		
$position = strpos($string, $char);
		
$length=mb_strlen($string, 'UTF-8');

$string = mb_substr($string, 1, $length, "UTF-8");
		   

	}

return $string;	
	
	
	
}




function writealternateverse($conn,$alternatetext,$keyid){
	
	
		$writequery = "UPDATE `thenewstuff` SET `alternateverse` = '{$alternatetext}' WHERE `thenewstuff`.`keyid` = {$keyid};";

if (mysqli_query($conn, $writequery)) {
	
	
    //echo "New record created successfully";
	
	
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}

	
}




function writedifference($conn,$difference,$keyid){
	
	
		$writequery = "UPDATE `thenewstuff` SET `gemdifference` = '{$difference}' WHERE `thenewstuff`.`keyid` = {$keyid};";

if (mysqli_query($conn, $writequery)) {
	
	
   "New record created successfully</br>";
	
	
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}

	
}





function deletedifference($conn,$id){
	
	
		$query = "DELETE FROM `differences` WHERE `id` ='{$id}'";

if (mysqli_query($conn, $query)) {
	
	
    //echo "New record created successfully";
	
	
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}

	
}



function copyalternateverse($conn,$providedtext,$id){
	
	
		$writequery = "UPDATE `differences` SET `newtext` = '{$providedtext}' WHERE `differences`.`id` = '{$id}';";

if (mysqli_query($conn, $writequery)) {
	
	
    //echo "New record created successfully";
	
	
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}

	
}



