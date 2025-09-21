<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<style>
body {
  background-color: black;
  padding-top: 25px;
}

.table-striped>tbody>tr:nth-child(odd)>td, 
.table-striped>tbody>tr:nth-child(odd)>th {
   background-color: #000000; // Choose your own color here
 }
 
 
 .table-striped>tbody>tr:nth-child(even)>td, 
.table-striped>tbody>tr:nth-child(even)>th {
   background-color: #000000; // Choose your own color here
 }
 

</style>
</head>
<body>
<div class="container">


<?php 
include("./functions.php"); 
 $word=$_POST['word'];
$language=$_POST['language'];
$wordpattern=$_POST['wordpattern'];

 $record_per_page = 10000;  
 $page = '';  
 $output = '';  
 if(isset($_POST["page"]))  
 {  
      $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }  
 $start_from = ($page - 1)*$record_per_page;  
 
 
 //echo "<h1>".$wordpattern."</h1>";
 
 if($language=="english") { 
 
 
  $page_query = "SELECT * FROM `strong_words` WHERE `words` LIKE '%{$word}%' ORDER BY keyid ASC";  
 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  

 
 
 $query = "SELECT * FROM `strong_words` WHERE `words` LIKE '%{$word}%' ORDER BY keyid ASC LIMIT $start_from, $record_per_page";  
 
 ?>
 
 
         <div class="row">
		  <div class="col-md-12">
		      
		      	<p style="
    text-align: center;
    font-size: 12px;
    color: #ffa500;
	
	
"> YOU CAN CLICK THE VERSE NUMBERS BELOW AND THEY WILL OPEN IN A NEW TAB </p>

		  <div class="col-md-12">
		 <h4 style="color: ffff00;"><?php echo $total_records. " Results" ?></h4>
		  
	
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
<td>No</td>
 <td>Text</td>
  <td>Verse #</td>
   <td>Occurence</td>


 
</tr>
</thead>
<tbody>




<?php

//while loop and vars here

/*
 $result = mysqli_query($conn, $query);  
 
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
           <tr>  
                <td>'.$row["words"].'</td>  
                <td>'.$row["keyid"].'</td>  
				 <td>'.$row["orderid"].'</td>  

           </tr>  
      ';  
 }  
 $output .= '</table><br /><div align="center">';  
 
 */
 
    $result = mysqli_query($conn, $query); 
	$counter=0;
	$newcounter=0;
		while( $row = mysqli_fetch_array( $result)){
 		$verseno=$row['keyid'];
	    $line=$row['orderid'];
        $text=$row['words']; //added
		$counter++;
		$newcounter++;
		
		if($page>1) {$counter=($newcounter+($record_per_page*$page))-50;
		//$counter=$newcounter;
		
		}
 
 echo "<tr>";
 ?>
 
       <td style="color:#ffffff;"><?php echo $counter;?></td>
       <td style="color:#ffffff;"><?php echo $text;?></td>
   	
     <td style="color:#ffffff;"><a href="./interface.php?verse=<?php echo $verseno; ?>"target="_blank"><?php echo $verseno; ?></a></td>

     <td style="color:#ffffff;">Word <?php echo $line;?></td>
	
	


   </tr>
 

  <?php
  
		}
		
		?>
		
		</tbody>
</table>

<?php
  


 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link_queryword' style='cursor:pointer; padding:6px; color:#fff; border:1px solid #b11717;' id='".$i."'>".$i."</span>";  
 }  
 echo $output;


 }
 
else if($language=="hebrew") {


$hebrewText=$word;




$hebrewText = preg_replace('/\p{Mn}/u', '', $hebrewText);

$hebrewText=str_replace("׃","",$hebrewText);
 $hebrewText= mb_strtolower($hebrewText, 'UTF-8');
 
  if ($wordpattern=="fullword") {
	  
	  $tabletocheck="theholybibledeaccentedwords";
      $page_query = "SELECT * FROM `theholybibledeaccentedwords` WHERE `text` = '{$hebrewText}' ORDER BY keyid ASC"; 
      $wordquery="SELECT * FROM `theholybibledeaccentedwords` WHERE `text` = '{$hebrewText}' ORDER BY keyid ASC LIMIT $start_from, $record_per_page";
  
  }
  
 if ($wordpattern=="pattern") {
	 
$tabletocheck="theholybibledeaccented";
$page_query = "SELECT * FROM `{$tabletocheck}` WHERE `text` LIKE '%{$hebrewText}%' ORDER BY keyid ASC"; 
$wordquery="SELECT * FROM `{$tabletocheck}` WHERE `text` LIKE '%{$hebrewText}%' ORDER BY keyid ASC LIMIT $start_from, $record_per_page";
 
 }
 
 

 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result); 


$total_pages = ceil($total_records/$record_per_page); 

/*
 
  echo "<h1>".$wordpattern."</h1>";
 echo "<h1>".$tabletocheck."</h1>";
  echo "<h1>".$page_query."</h1>";
  echo "<h1>".$wordquery."</h1>";
  
  */
 
 
 ?>
 
   <div class="row">
		  <div class="col-md-12">
		      
		      	<p style="
    text-align: center;
    font-size: 12px;
    color: #ffa500;
	
	
"> YOU CAN CLICK THE VERSE NUMBERS BELOW AND THEY WILL OPEN IN A NEW TAB </p>

		 <h4 style="color: ffff00;"><?php echo $total_records. " Results" ?></h4>
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
 <td>No</td>
  <td>Translation</td>
 <td>Reference</td>

   <td>Link to Verse</td>


 
</tr>
</thead>
<tbody>


<?php




 
 

  $query = mysqli_query($conn, $wordquery);
 
 

 //$query = mysqli_query($conn, " SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%הארץ%' ");
 



  //$querytwo = mysqli_query($conn, "SELECT * FROM `{$method}` WHERE `id` = '{$key}'");
 
 
 //$rowtwo = mysqli_fetch_array($querytwo);
 
 
 	//$twofll=$rowtwo['2_F.L.L']; 
	
		$counter=0;
	$newcounter=0;
	
	
		
	

while ($row = mysqli_fetch_array($query)) {
	



 
 $book=$row['book'];
   $chapter=$row['chapter'];

 $verse=$row['keyid'];
 
  $trueverse=$row['verse'];
  
  $text=$row['text'];
  
  
    $wordorder=$row['wordorder'];
 
 
 $bookname=getbookname($conn,$book);
 
 $translated=gettranslation($conn,$book,$chapter,$trueverse,$wordorder);
 
 //echo "Verse no: ". $verse."</br>";
 




 	$counter++;
		$newcounter++;
		
			if($page>1) {$counter=($newcounter+($record_per_page*$page))-500;}
		//$counter=$newcounter;
		
		

 
  echo "<tr>";
 
 ?>
 
 
 

    <td style="color:#ffffff;"><?php echo $counter;?></td>
	<td style="color:#ffffff;"><?php echo $translated;?></td>
  <td style="color:#ffffff;"> <?php echo $bookname. " ".$chapter.":".$trueverse;?></td>
   
	 <td style="color:#ffffff;"><a href="./interface.php?verse=<?php echo $verse; ?>"target="_blank"><?php echo $verse; ?></a></td>
	  </tr>
	  <?php
 
} //while loop

 //strpos

?>
		</tbody>
</table>




<?php	


 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link_queryword' style='cursor:pointer; padding:6px; color:#fff; border:1px solid #b11717;' id='".$i."'>".$i."</span>";  
 }  
 echo $output;



} //if loop
	
	
	
	
	
	
	
	
 
 

else if($language=="greek") {
	
$greektext=$word;




$greektext=str_replace(".","","$greektext");
$greektext=str_replace(",","","$greektext");
 $greektext= mb_strtolower($greektext, 'UTF-8');
$greektext=removeAccents($greektext);


 if ($wordpattern=="fullword") {
	  
	  $tabletocheck="theholybibledeaccentedwords";
      $page_query = "SELECT * FROM `theholybibledeaccentedwords` WHERE `text` = '{$greektext}' ORDER BY keyid ASC"; 
      $wordquery="SELECT * FROM `theholybibledeaccentedwords` WHERE `text` = '{$greektext}' ORDER BY keyid ASC LIMIT $start_from, $record_per_page";
  
  }
  
 if ($wordpattern=="pattern") {
	 
$tabletocheck="theholybibledeaccented";
$page_query = "SELECT * FROM `{$tabletocheck}` WHERE `text` LIKE '%{$greektext}%' ORDER BY keyid ASC"; 
$wordquery="SELECT * FROM `{$tabletocheck}` WHERE `text` LIKE '%{$greektext}%' ORDER BY keyid ASC LIMIT $start_from, $record_per_page";
 
 }
 
 

 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result); 


$total_pages = ceil($total_records/$record_per_page); 

/*
 
  echo "<h1>".$wordpattern."</h1>";
 echo "<h1>".$tabletocheck."</h1>";
  echo "<h1>".$page_query."</h1>";
  echo "<h1>".$wordquery."</h1>";
  
  
  */


   //$page_query = "SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%{$greektext}%' ORDER BY keyid ASC";  
 //$page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page); 

?>


 <div class="row">
		  <div class="col-md-12">
		      
		      	<p style="
    text-align: center;
    font-size: 12px;
    color: #ffa500;
	
	
"> YOU CAN CLICK THE VERSE NUMBERS BELOW AND THEY WILL OPEN IN A NEW TAB </p>

		 <h4 style="color: ffff00;"><?php echo $total_records. " Results" ?></h4>
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
<td>No</td>
 <td>Translation</td>
 <td>Reference</td>

   <td>Link to Verse</td>


 
</tr>
</thead>
<tbody>


<?php



 $query = mysqli_query($conn, $wordquery);
 
 //$query = mysqli_query($conn, " SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%הארץ%' ");
 



  //$querytwo = mysqli_query($conn, "SELECT * FROM `{$method}` WHERE `id` = '{$key}'");
 
 
 //$rowtwo = mysqli_fetch_array($querytwo);
 
 
 	//$twofll=$rowtwo['2_F.L.L']; 
	$counter=0;
	$newcounter=0;

while ($row = mysqli_fetch_array($query)) {
	

 
 
  $book=$row['book'];
   $chapter=$row['chapter'];

 $verse=$row['keyid'];
 
  $trueverse=$row['verse'];
  
  $text=$row['text'];
  
    $wordorder=$row['wordorder'];
 
 
 $bookname=getbookname($conn,$book);
 
 
  
 $translated=gettranslation($conn,$book,$chapter,$trueverse,$wordorder);
 
 //echo "Verse no: ". $verse."</br>";
 


$search=$greektext;
$search=" ".$search." ";


   
	$counter++;
		$newcounter++;
		
			if($page>1) {$counter=($newcounter+($record_per_page*$page))-500;
		//$counter=$newcounter;
		
		}

 
  echo "<tr>";
  
  ?>

        <td style="color:#ffffff;"><?php echo $counter;?></td>
	<td style="color:#ffffff;"><?php echo $translated;?></td>
  <td style="color:#ffffff;"> <?php echo $bookname. " ".$chapter.":".$trueverse;?></td>
   
	 <td style="color:#ffffff;"><a href="./interface.php?verse=<?php echo $verse; ?>"target="_blank"><?php echo $verse; ?></a></td>
	  
	  <?php
 
}

//strpos


?>

		</tbody>
</table>

<?php

 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link_queryword' style='cursor:pointer; padding:6px; color:#fff; border:1px solid #b11717;' id='".$i."'>".$i."</span>";  
 }  
 echo $output;

	}
?>
</div><!--container-->
</body>
</html>