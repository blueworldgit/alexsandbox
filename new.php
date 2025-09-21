<?php

include("./db.php");

$results=0;
$count=0;
$versecounter=0;
$text=NULL;
$fullverse=NULL;


$query = mysqli_query($conn, "SELECT * FROM `bible_original` WHERE `book` > 20 AND `book` < 40 ");

$rowcount=mysqli_num_rows($query);


while ($row = mysqli_fetch_array($query)) {
	
	echo $rowcount;
	
	echo "<h1>table sequence start</h1>";
	
	
	echo $row['orig_order'];
	
		echo "<h1>table sequence end</h1>";
	$count++;
	$results++;
	
	  $versetext=$row['orig_order'];
	    $word=$row['word'];
		
		
		
	if	($rowcount == $results) {
		
			echo "<h1>*********************FINAL***********************************</h1>";
	$count=0;
	$versecounter++;
	
	
	   $book=$row['book'];
					    $chapter=$row['chapter'];
							    $verseid=$row['verseID'];
								 $verseno=$row['verse'];
	
	echo "<h2>*".$versecounter."*</h2>";
	
		  echo "BOOK ". $book. "</br>";
		  	  echo "CHAPTER ". $chapter. "</br>";
			  	  echo "VERSEID ". $verseid. "</br>";
				  
				  
				    $text=$text.$versetext;
	  
	   $fullverse=$fullverse." ".$word;
	
	  echo $text. "</br>";
	  
	  
	  
	  	  echo $fullverse. "</br>";
		  
		  
		  
		  		
		$sql="INSERT INTO `hebrew` (`id`, `verseID`, `book`, `chapter`, `verse`, `word`) 
VALUES (NULL, '{$verseid}', '{$book}', '{$chapter}', '{$verseno}', '{$fullverse}')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
	
	
		$text=$versetext;
		$fullverse=" ".$word;
		
			echo "<h1>*************************FINAL**************************</h1>";
		
		
		
		
		
		
	}
	  
                    
	
	if ( $versetext >= $count)                   { 
	
	
		    $book=$row['book'];
					    $chapter=$row['chapter'];
							    $verseid=$row['verseID'];
								
								 $verseno=$row['verse'];
	
	echo "<h1>if loop start</h1>";
	
	echo "verseno is valid so it is". $versetext. "</br>";

	  $text=$text.$versetext;
	  
	$fullverse=$fullverse." ".$word;
	  
	  echo $text. "</br>";
	
	 echo $fullverse. "</br>";
		echo "<h1>if loop end</h1>";
} 



else   {
	
	 
	
	echo "<h1>********************************************************</h1>";
	$count=0;
	$versecounter++;
	
	echo "<h2>*".$versecounter."*</h2>";
	
		  echo "BOOK ". $book. "</br>";
		  	  echo "CHAPTER ". $chapter. "</br>";
			  	  echo "VERSEID ". $verseid. "</br>";
	
	  echo $text. "</br>";
	  
	  
	  
	  	  echo $fullverse. "</br>";
	
	
	
		
		
		$sql="INSERT INTO `hebrew` (`id`, `verseID`, `book`, `chapter`, `verse`, `word`) 
VALUES (NULL, '{$verseid}', '{$book}', '{$chapter}', '{$verseno}', '{$fullverse}')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

	$text=$versetext;
		$fullverse=$word;
		

		
			echo "<h1>***************************************************</h1>";
	
	
}




}




?>
