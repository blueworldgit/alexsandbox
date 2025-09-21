<?php
include("./functions.php");


$book=$_POST['book'];

 //$query = mysqli_query($conn, "SELECT *  FROM `differences` WHERE `book`=19   && `gemdifference` != 6 && `gemdifference` != 12 && `gemdifference` != 18 && `gemdifference` != 24 && `gemdifference` != 30 && `gemdifference` != 36");
 
 
 $query = mysqli_query($conn, "SELECT * FROM `differences` WHERE `book`='{$book}'");

$counter=0;


if (mysqli_num_rows($query)==0) { 


echo "<h3>No errors found in this book</h3>";


} else {

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
	
	    echo "no: ".$counter."</br>";
	   echo "book: ".$book."</br>";
	    echo "chapter: ".$chapter."</br>";
		 echo "verse: ".$verse."</br>";

	   echo "NEW: ".$newtext."</br>";
	     echo "OLD: ".$oldtext."</br>";
		  
	/*
		  

	//writedifference($conn,$difference,$keyid);
	
echo	"<div class='row'>";

echo "<div class='col-md-12'>";
	
	echo "<div class='copy btn btn-success' id='$id'>copy</div>";
	
	echo "<div class='delete btn btn-danger' id='$id'>delete</div>";
	
	 echo "</div>";
		   echo "</div>";
		   
		   
		   echo	"<div class='row'>";

echo "<div class='col-md-12'>";
	
	echo " <input type='text' class='text-$id' name='verse' id='verse' value='$alternatetext'  style='width:100%'> ";
	
		  echo "***********************************************************************************</br>";
		  
		 echo "</div>";
		   echo "</div>"; 
	
	*/
	
	
		  echo "***********************************************************************************</br>";
}


}



	
?>