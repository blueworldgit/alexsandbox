<?php



include("./functions.php");


$book=$_POST['book'];

 //$query = mysqli_query($conn, "SELECT *  FROM `differences` WHERE `book`=19   && `gemdifference` != 6 && `gemdifference` != 12 && `gemdifference` != 18 && `gemdifference` != 24 && `gemdifference` != 30 && `gemdifference` != 36");
 
 
 $query = mysqli_query($conn, "SELECT * FROM `differences` WHERE `book`='{$book}'");

$counter=0;

while ($row = mysqli_fetch_array($query)) {
	

 

 
 
    $id=$row['id'];
	$keyid=$row['keyid'];
	$old=$row['gemtext'];
	$new=$row['gemnewtext'];
	$pdforigins=$row['pdforigins'];
		$book=$row['book'];
			$chapter=$row['chapter'];
				$verse=$row['verse'];
					$difference=$row['gemdifference'];
					$alternategem=$row['alternategem'];
					$alternatetext=$row['alternatetext'];
	
	
	
	

	
	$counter++;
	
$oldtext=$row['text'];
$newtext=$row['newtext'];


echo	"<div class='row'>";

echo "<div class='col-md-12'>";
	
	    echo "no: ".$counter."</br>";
	   echo "book: ".$book."</br>";
	    echo "chapter: ".$chapter."</br>";
		 echo "verse: ".$verse."</br>";
	
	   echo "NEW: ".$newtext."</br>";
	     echo "OLD: ".$oldtext."</br>";
		  
	
 echo "</div>";
		   echo "</div>"; 
		  

	//writedifference($conn,$difference,$keyid);
	
echo	"<div class='row'>";

echo "<div class='col-md-12'>";
	
	echo "<div class='copy btn btn-success' id='$id'>correct</div>";
	
	echo "<div class='delete btn btn-danger' id='$id'>delete</div>";
	
	 echo "</div>";
		   echo "</div>";
		   
		   
		   echo	"<div class='row'>";

echo "<div class='col-md-12'>";
	
	echo " <input type='text' class='text-$id' name='verse' id='verse' placeholder='This is an input box to correct the text for this verse. Enter correct text and hit correct or use delete if this verse is not an error and the original should remain'  style='width:100%'> ";
	

		  
		 echo "</div>";
		   echo "</div>"; 
	
}






	
?>