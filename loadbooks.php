<?php


include("./functions.php");

	function strip_tags_with_whitespace($string, $allowable_tags = null)
{
  

    return $string;
}

 // JSON string
  $someJSON  = file_get_contents('./esther.json');


  // Convert JSON string to Array
  $bibledata = json_decode($someJSON, true);
  
  echo "<pre>";
  //print_r($someArray);  
 echo "</pre>";  
  
  
  $count=12650; //just put last keyid here increment will auto below
  
  foreach($bibledata as $part) {
	  $wordcount=0;
	  
	   $count++;
	  
	    //echo "<h4>".$part['id']."</h4>";
		
		$id=$part['id'];
		
		$book = substr($id, 0, 2);	
		
		$book=intval($book);
		
		$chapter = substr($id, 2, 3);	
		
		$chapter=intval($chapter);
		
		$verse = substr($id, 5, 3);	
		
		$verseno=intval($verse);
		

		
		  //echo "<h4>".$verse."</h4>";
	  
	 
	  
	    foreach($part as $verse) {
			
			

			
			    foreach($verse as $word) {
			$wordcount++;
			
	/*			   
     echo $word['word']."------";
	 echo $word['text']."------";
	 echo $word['number']."------";
     echo "</br></br>";
			
	*/

	$text=$word['word'];
	$english=$word['text'];
	$strongs=$word['number'];
	
	

	
		$english=strip_tags($english);

$english = str_replace(";", "", $english);
$english = str_replace("'", "", $english);
$english = str_replace(".", "", $english);
$english = str_replace(":", "", $english);
	
	echo "<h4>verse ".$count."</h4>";
		echo "<h4>wordcount ".$wordcount."</h4>";
	echo "book: ".$book."</br>";
	echo "chapter: ".$chapter."</br>";
	echo "verse: ".$verseno."</br>";
	echo "text: ".$text."</br>";
	echo "english: ".$english."</br>";
	echo "strongs: ".$strongs."</br>";
	
	echo "</br></br>";
	
	


				$sql="INSERT INTO `theholybibletranslated` (`id`, `keyid`, `book`, `chapter`, `verse`, `word`, `translated`, `wordorder`, `strongs`,  `gematriaword`) VALUES (NULL, '{$count}', '{$book}', '{$chapter}', '{$verseno}', '{$text}', '{$english}', '{$wordcount}', '{$strongs}', '000');";

if (mysqli_query($conn, $sql)) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


			
		}
				
			
		}
		
	
	/*	
		    foreach($verse as $word) {
			
			
				   echo "<pre>";
     print_r($word);
 echo "</pre>";
			
			
			
			
		}
		
*/
	  
/*	  
	   echo "<pre>";
  print_r($verse);  
 echo "</pre>"; 
	  
*/

	if($count>1000000) {break;}  
	  
  }
  
  //echo "<h4>First One</h4>";
  //print_r ($someArray[0]->); // Access Array data
  

  
?>