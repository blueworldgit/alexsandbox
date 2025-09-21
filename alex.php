<?php
include("./db.php");
error_reporting(E_ERROR | E_WARNING | E_PARSE);


 



$tablename="methods_six";

$queryone = mysqli_query($conn, "SELECT * FROM `{$tablename}` WHERE `no_words` = '0'");


//$queryone = mysqli_query($conn, "SELECT * FROM `theholybibleordinal` WHERE `wordorder` = 1");


	while ($row = mysqli_fetch_array($queryone)) {
		
		
		$verseno=$row['verseno'];
	
		$querytwo = mysqli_query($conn, "SELECT * FROM `count` WHERE `verseno` = '{$verseno}'");

	$rowtwo = mysqli_fetch_array($querytwo);
	$no_words=$rowtwo['no_words'];
	
	

/*
echo $book."</br>";
echo $chapter."</br>";
echo $verse."</br>";
echo $text."</br></br></br>";
*/

//***************here***************************

$writequery = "UPDATE `{$tablename}` SET `no_words` = '{$no_words}' WHERE `verseno` = '{$verseno}';";

if (mysqli_query($conn, $writequery)) {
	
	/*
    echo "New record created successfully";
	*/
	
} else {
    echo "Error: " . $writequery . "<br>" . mysqli_error($conn);
}



	}

//mysqli_query($conn, $writequery);

//} //for loop



	?>
	
	






