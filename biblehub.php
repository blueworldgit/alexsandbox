<?php

require 'simple_html_dom.php';

include("./db.php");

//$var=777;


 $query = mysqli_query($conn, "SELECT * FROM `hebrew` WHERE `biblehub_value` = 0 LIMIT 1000");


//$query = mysqli_query($conn, "SELECT * FROM `hebrew` WHERE `book` > 39 LIMIT 1000");

while ($row = mysqli_fetch_array($query)) {

$bnum=$row['book'];
$cnum=$row['chapter'];
$vnum=$row['verse'];
$id=$row['id'];



//$html = file_get_html('https://www.biblewheel.com/GR/GR_Database.php?Gem_Number='.$var.'&SearchByNum=Go');

$html = file_get_html('https://www.biblewheel.com/GR/GR_Database.php?bnum='.$bnum.'&cnum='.$cnum.'&vnum='.$vnum.'&SourceTxt=SCR&getverse=Go');

foreach($html->find('td#gemtotal') as $e)
//echo $e->plaintext;

$value=$e->plaintext;


echo $value."</br>";


	$writequery = "UPDATE `hebrew` SET `biblehub_value` = '{$value}' WHERE `hebrew`.`id` = '{$id}'";
	
	
if (mysqli_query($conn, $writequery)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}


}
	   
	   
	   
	   //foreach($html->find('td.tdcb') as $e)
    //echo $e->outertext . '<br>';
	   
	   
	   
	   
	   
	
	   
	  
?>