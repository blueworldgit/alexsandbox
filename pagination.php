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

 $record_per_page = 50;  
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
		  <h3 style="color: #a70d0d;"><?php echo $total_records. " Results Found" ?></h3>
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
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
		while( $row = mysqli_fetch_array( $result)){
 		$verseno=$row['keyid'];
	    $line=$row['orderid'];
        $text=$row['words']; //added
 
 echo "<tr>";
 ?>
 
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
 
 ?>
 
   <div class="row">
		  <div class="col-md-12">
		      
		      	<p style="
    text-align: center;
    font-size: 12px;
    color: #ffa500;
	
	
"> YOU CAN CLICK THE VERSE NUMBERS BELOW AND THEY WILL OPEN IN A NEW TAB </p>
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
 <td>Reference</td>
  <td>Verse #</td>
   <td>Link to Verse</td>


 
</tr>
</thead>
<tbody>


<?php
 
 

  $query = mysqli_query($conn, "SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%{$hebrewText}%'  ");
 
 

 //$query = mysqli_query($conn, " SELECT * FROM `theholybibledeaccented` WHERE `text` LIKE '%הארץ%' ");
 



  //$querytwo = mysqli_query($conn, "SELECT * FROM `{$method}` WHERE `id` = '{$key}'");
 
 
 //$rowtwo = mysqli_fetch_array($querytwo);
 
 
 	//$twofll=$rowtwo['2_F.L.L']; 


while ($row = mysqli_fetch_array($query)) {
	

 
 
 $book=$row['book'];
   $chapter=$row['chapter'];

 $verse=$row['keyid'];
 
  $trueverse=$row['verse'];
  
  $text=$row['text'];
 
 
 $bookname=getbookname($conn,$book);
 
 //echo "Verse no: ". $verse."</br>";
 


$search=$hebrewText;
$search=" ".$search." ";

if ((strpos($text, $search) !== false)  || ($wordpattern!=="pattern"))  {
   


 
  echo "<tr>";
 
 ?>


  <td style="color:#ffffff;"> <?php echo $bookname. " ".$chapter.":".$trueverse;?></td>
    <td style="color:#ffffff;"><?php echo $verse;?></td>
	 <td style="color:#ffffff;"><a href="./interface.php?verse=<?php echo $verse; ?>"target="_blank"><?php echo $verse; ?></a></td>
	  
	  <?php
 
} //while loop

} //strpos




	} //if loop
 
 
 else {
	 
	echo "wrong language";
	 
	 
 }
 ?>
 
 </div><!--container-->
</body>
</html>