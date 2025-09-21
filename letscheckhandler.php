<?php
include("./functions.php");

$missingwords=0;
$nonmatches=0;



$book=$_POST['book'];

 $record_per_page = 1000;  
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
 
 
  $page_query = "SELECT * FROM `theholybible` WHERE `book` = '{$book}' ORDER BY keyid ASC";  
 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  


$translationquery = mysqli_query($conn, "SELECT * FROM `theholybibletranslated` WHERE `book` = '{$book}' ORDER BY keyid ASC ");
$translationrowcount=mysqli_num_rows($translationquery);

$holybiblequery = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `book` = '{$book}' ORDER BY keyid ASC LIMIT $start_from, $record_per_page ");
$holybiblerowcount=mysqli_num_rows($holybiblequery);
  
  if($translationrowcount==0){echo "<h3>Book not loaded yet, please enter a lower book number</h3>";} else {
	
echo "<h3>Book ".$book."</h3>";	
	?>

<table  class="table table-striped" style="
    width: 100%;
"> 
<thead> 
<tr>
  <td>Verse#</td>
  <td>Book</td>
  <td>Chapter</td>
  <td>Verse</td>
    <td>Wordorder</td>
  <td>THBText</td>
  <td>THBValue</td>
  <td>TranslatedValue</td>
    <td>TranslatedText</td>
	<td>Strongs</td>
	 <td>Translate</td>
	 <td>Copy</td>
	 <td>Mark</td>
	 <td>Status</td>
	
  


 
</tr>
</thead>
<tbody>

<?php

while ($thbrow = mysqli_fetch_array($holybiblequery)) { 

$thbid=$thbrow['id'];
$thbkey=$thbrow['keyid'];
$thbbook=$thbrow['book'];
$thbchapter=$thbrow['chapter']; 
$thbverse=$thbrow['verse'];
$thbworder=$thbrow['wordorder'];
$thbword=$thbrow['word']; 
$thbgematriaword=$thbrow['gematriaword']; 
$thbstatus=$thbrow['marker']; 

$translationquery = mysqli_query($conn, "SELECT * FROM `theholybibletranslated` WHERE `book` = '{$thbbook}' AND `chapter` = '{$thbchapter}' AND `verse` = '{$thbverse}' AND `wordorder` = '{$thbworder}'  ");
$translationrowcount=mysqli_num_rows($translationquery);

if($translationrowcount==0){
	
	$missingwords++;
	
	?>
	
	<tr style="
    background-color: #efc0c0;">
	
	 <td><?php echo $thbkey; ?></td>
       <td><?php echo $thbbook; ?></td>
      <td><?php echo $thbchapter; ?></td>
	   <td><?php echo $thbverse; ?></td>
	     <td><?php echo $thbworder; ?></td>
	   <td><?php echo $thbword; ?></td>
      <td><?php echo $thbgematriaword; ?></td>
	  <td>Word missing</td>
    <td>Word missing</td>
	<td>Word missing</td>
	<td><a class="btn btn-primary"  href="./letscheckfull.php?keyid=<?php echo $thbkey; ?>" target="_blank" >Translate</a></td>
		<td><a class="btn btn-primary"  href="./copy.php?book=<?php echo $thbbook; ?>&chapter=<?php echo $thbchapter; ?>&verse=<?php echo $thbverse; ?>&wordorder=<?php echo $thbworder; ?>" target="_blank" >Copy</a></td>
	<td><a class="btn btn-primary"  href="./mark.php?keyid=<?php echo $thbkey; ?>" target="_blank" >Mark</a></td>
    <td><?php echo $thbstatus; ?></td>


</tr>

<?php
	
	
}

else {
	
	$thbtrow = mysqli_fetch_array($translationquery);
	$thbtstrongs=$thbtrow['strongs']; 
	
	$thbtgematriaword=$thbtrow['gematriaword']; 
	$thbtword=$thbtrow['word']; 
	$thbttranslated=$thbtrow['translated']; 
	
	if($thbtgematriaword<>$thbgematriaword) {
		
		
		$nonmatches++;
		
		?>
		
			<tr style="
    background-color: #788de7;">
	
 <td><?php echo $thbkey; ?></td>
       <td><?php echo $thbbook; ?></td>
      <td><?php echo $thbchapter; ?></td>
	   <td><?php echo $thbverse; ?></td>
	     <td><?php echo $thbworder; ?></td>
	   <td><?php echo $thbword; ?></td>
      <td><?php echo $thbgematriaword; ?></td>
	  <td><?php echo $thbtgematriaword; ?></td>
    <td><?php echo $thbtword; ?></td>
	 <td><?php echo 	$thbtstrongs; ?></td>

	<td><a class="btn btn-primary"  href="./letscheckfull.php?keyid=<?php echo $thbkey; ?>" target="_blank" >Translate</a></td>
		<td><a class="btn btn-primary"  href="./copy.php?book=<?php echo $thbbook; ?>&chapter=<?php echo $thbchapter; ?>&verse=<?php echo $thbverse; ?>&wordorder=<?php echo $thbworder; ?>" target="_blank" >Copy</a></td>
	<td><a class="btn btn-primary"  href="./mark.php?keyid=<?php echo $thbkey; ?>" target="_blank" >Mark</a></td>
    <td><?php echo $thbstatus; ?></td>


</tr>

<?php
		
		
		
		
	} //non match
	
	else {


?>

<tr>
 <td><?php echo $thbkey; ?></td>
       <td><?php echo $thbbook; ?></td>
      <td><?php echo $thbchapter; ?></td>
	   <td><?php echo $thbverse; ?></td>
	     <td><?php echo $thbworder; ?></td>
	   <td><?php echo $thbword; ?></td>
      <td><?php echo $thbgematriaword; ?></td>
	  <td><?php echo $thbtgematriaword; ?></td>
    <td><?php echo $thbtword; ?></td>
	 <td><?php echo 	$thbtstrongs; ?></td>
	<td><a class="btn btn-primary"  href="./letscheckfull.php?keyid=<?php echo $thbkey; ?>" target="_blank" >Translate</a></td>
		<td><a class="btn btn-primary"  href="./copy.php?book=<?php echo $thbbook; ?>&chapter=<?php echo $thbchapter; ?>&verse=<?php echo $thbverse; ?>&wordorder=<?php echo $thbworder; ?>" target="_blank" >Copy</a></td>
	<td><a class="btn btn-primary"  href="./mark.php?keyid=<?php echo $thbkey; ?>" target="_blank" >Mark</a></td>
 <td><?php echo $thbstatus; ?></td>

</tr>
<?php
}//while query



}// else to confirm word exists in both tables
	  
  }//else for books
  
  } //closing else for match confirmed ie passed non match check
  
//form submit
?>

<tbody>
</table>

<?php

 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; color:#000000; border:1px solid #b11717;' id='".$i."'>".$i."</span>";  
 }  
 echo $output;
 
 ?>

<h3>Missing Words: <?php echo $missingwords;?></h3>
<h3>Non Matches: <?php echo $nonmatches;?></h3>

</div> <!--md-12-->