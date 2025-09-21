<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>


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

$keyvalue=$_GET['verse'];
//SELECT * FROM strong_words, strong_numbers WHERE strong_words.keyid = strong_numbers.keyid AND strong_numbers.keyid=2 AND strong_words.orderid=strong_numbers.orderid ORDER BY strong_numbers.orderid


//SELECT * FROM strong_words, strong_numbers, strongsconcord WHERE strong_words.keyid = strong_numbers.keyid AND strong_numbers.keyid=1 AND strong_words.orderid=strong_numbers.orderid AND strong_numbers.numbers=strongsconcord.number ORDER BY strong_numbers.orderid





//SELECT * FROM verses ORDER BY `book_number` ASC, `chapter` ASC,`verse` ASC




	$query = mysqli_query($conn, "SELECT * FROM strong_words, strong_numbers WHERE strong_numbers.keyid = '{$keyvalue}' AND strong_words.keyid = strong_numbers.keyid  AND strong_words.orderid=strong_numbers.orderid ORDER BY strong_numbers.orderid");


	//mysqli_query($conn, $query);
	


		







?>

        <div class="row">
		  <div class="col-md-8">
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
  <td>KJV</td>
  <td>Scripture</td>
  <td>Strongs #</td>
  <td>Gematria</td>

 
</tr>
</thead>
<tbody>
<tr>  <td style="color:#ffffff;"><center>Data from Strongs Concordance<center></td></tr>

<?php
	
	
	



		while( $row = mysqli_fetch_array( $query)){
 
$number=$row['numbers'];

		$query2 = mysqli_query($conn, "SELECT * FROM `strongsconcord` WHERE `number`='{$number}'");
		$concordrow = mysqli_fetch_array($query2);

	
	echo "<tr>";
		
	
	
	?>

	

   
     <td style="color:#ffffff;"><?php echo $row['words']; ?></td>
     <td style="color:#00ff00;"><?php echo $concordrow['lemma']." (".$concordrow['xlit'].")"; ?></td>
     <td style="color:#00ccff;"><?php echo $row['numbers']; ?></td>
	  <td style="color:#ffff00;"><?php echo $concordrow['gematria']; ?></td>

	
	


   </tr>
   

<?php }


?>
</tbody>
</table>
</div><!--md-6-->
        <div class="row">
		  <div class="col-md-4">
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
 
  <td>Scripture</td>
 
  <td>Gematria</td>

 
</tr>
</thead>
<tbody>
<tr>  <td style="color:#ffffff;"><center>Bible Text<center></td></tr>

<?php
	
	
	
$query = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `keyid` = '{$keyvalue}' ORDER BY `wordorder` ASC");


		while( $row = mysqli_fetch_array( $query)){
 
$total=$row['gematriastandardverse'];

	
	echo "<tr>";
		
	
	
	?>

	

   

     <td style="color:#00ff00;"><?php echo $row['word']; ?></td>

	  <td style="color:#ffff00;"><?php echo $row['gematriastandardword']; ?></td>

	
	


   </tr>
   

<?php }


?>
<tr>
<td style="color:#fd1f0e">Standard Gematria Total <?php echo $total; ?></td>
</tr>
</tbody>
</table>
</div><!--md-4-->

</div><!--container-->
</body>
</html>