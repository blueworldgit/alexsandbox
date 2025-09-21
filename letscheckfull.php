<?php
$missingwords=0;
$nonmatches=0;
?>

<html>
<head>
<title>lets check</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0/dist/js.cookie.min.js" integrity="sha256-pUYbeWfQ0TisH2PabhAZLCzI8qGOJop0mEWjbJBcZLQ=" crossorigin="anonymous"></script>
</head>
<body>

<div class="col-md-12">







<?php

//http://localhost/alexlatest/interlinear/letscheckfull.php?keyid=2

include("./functions.php");



$keyid=$_GET['keyid'];

$holybiblequery = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `keyid` = '{$keyid}' ");
$thbrow = mysqli_fetch_array($holybiblequery);

$thbbook=$thbrow['book'];
$thbchapter=$thbrow['chapter']; 
$thbverse=$thbrow['verse'];



$translationquery = mysqli_query($conn, "SELECT * FROM `theholybibletranslated` WHERE `book` = '{$thbbook}' AND `chapter` = '{$thbchapter}' AND `verse` = '{$thbverse}' ");
$translationrowcount=mysqli_num_rows($translationquery);

$holybiblequery = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `keyid` = '{$keyid}' ");
$holybiblerowcount=mysqli_num_rows($holybiblequery);


  
  if($translationrowcount==0){echo "<h3>Book not loaded yet, please enter a lower book number</h3>";} else {
	
echo "<h3>Verse ".$keyid."</h3>";	
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
    <td>Translation</td>


 
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


</tr>

<?php
	
	
}

else {
	
	$thbtrow = mysqli_fetch_array($translationquery);
	
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
    <td><?php echo $thbttranslated; ?></td>



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
    <td style="font-size:10px;"><?php echo $thbttranslated; ?></td>


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

<h3>Missing Words: <?php echo $missingwords;?></h3>
<h3>Non Matches: <?php echo $nonmatches;?></h3>

</div> <!--md-12-->
</body>
</html>