<?php

require 'simple_html_dom.php';

include("./functions.php");

//$var=777;


	$bhrequiredquery = mysqli_query($conn, "SELECT * FROM `strongs` WHERE `strongdata` IS NULL");
			
		
	
	
	

	  
	   $bhrequiredquery=mysqli_num_rows($bhrequiredquery);
	  
	  
	
	  
	  echo "<h1>". $bhrequiredquery . " verses need Definitions and Strongs numbers</h1>";
	  



function strip_tags_with_whitespace($string, $allowable_tags = null)
{
  

    return $string;
}

$maincounter=0;
 $query = mysqli_query($conn, "SELECT * FROM `strongs` WHERE `strongdata` IS NULL LIMIT 1000");


//$query = mysqli_query($conn, "SELECT * FROM `hebrew` WHERE `book` > 39 LIMIT 1000");

while ($row = mysqli_fetch_array($query)) {
	
	$maincounter++;
	
	echo "<h3>***************************".$maincounter."****************************************</h3>";

$bnum=$row['book'];
$cnum=$row['chapter'];
$vnum=$row['verse'];
$id=$row['id'];

echo "</br></br>";

echo "booknumber ".$bnum."</br>";
echo "chapternumber ".$cnum."</br>";
echo "versenumber ".$vnum."</br>";

//$html = file_get_html('https://www.biblewheel.com/GR/GR_Database.php?Gem_Number='.$var.'&SearchByNum=Go');

$html = file_get_html('https://www.biblewheel.com/GR/GR_Database.php?bnum='.$bnum.'&cnum='.$cnum.'&vnum='.$vnum.'&getverse=Go');
$verse=NULL;

$counter=0;
$fourcount=0;
$td = $html->find("table#Strongs_table tr td");
foreach($td as $tds)

{

$counter++;
	  //echo "<h3>".$counter."</h3>";
	  
	  if ($counter>=7) {
		  
		    if ($counter==7) {
		  
	
		  
		  //save tds
		  
		  echo $tds;
		  
		 
		  
		  //$tds=preg_replace('#<[^>]+>#', ' ',$tds);
		  
		  //$tds=strip_tags_with_whitespace($tds);
		  
		  //$tds = preg_replace('/[^A-Za-z0-9\-]/', '', $tds);
		  
		  $tds=strip_tags($tds);

$tds = str_replace(";", "", $tds);
$tds = str_replace("'", "", $tds);
$tds = str_replace(".", "", $tds);
$tds = str_replace(":", "", $tds);
		  
		  $needed=$tds."*";
		  
echo "</br>";
		  
			} //$counter==7
		  
		  
	  }
	  
	   if ($fourcount==3) {
		   
	

//save tds	

echo $tds;	

	$tds=strip_tags($tds);

$tds = str_replace(";", "", $tds);
$tds = str_replace("'", "", $tds);
$tds = str_replace(".", "", $tds);
$tds = str_replace(":", "", $tds);

$needed=$needed.$tds."*";

echo "</br>";  
		$fourcount=0;   
		   
	   }
	   
	   else if($counter>7) {
		   
		   
		   $fourcount++;
	   }
	  
  //echo $tds;
 
}


echo "</br>";


$needed=$needed."###";
foreach($html->find('td.lightlink') as $e) {
//echo $e->plaintext;

$value=$e->plaintext;




	//echo $value."</br>";   
	
	$value= explode(" ", $value);
	
	//print_r($value);
$strongs=$value[1];

$needed=$needed.$strongs."*";
echo $strongs."</br>";   
	   

}

echo "</br>";

//echo $needed;


//$needed=strip_tags($needed);

 //$needed = preg_replace('/[^A-Za-z0-9\-]/', '', $needed);

	$writequery = "UPDATE `strongs` SET `strongdata` = '{$needed}' WHERE `strongs`.`id` = '{$id}'";
	
	
if (mysqli_query($conn, $writequery)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}

echo "<h3>*******************************************************************</h3>";

}
	   
	   
	   
	   //foreach($html->find('td.tdcb') as $e)
    //echo $e->outertext . '<br>';
	   
	   
	   
	   
	   
	
	   
	  