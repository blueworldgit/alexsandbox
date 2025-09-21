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


$book=$_GET['book'];
$verse=$_GET['verse'];
$chapter=$_GET['chapter'];

	$queryid = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}' LIMIT 1");
	 $row = mysqli_fetch_array( $queryid);

$keyvalue=$row['keyid'];
//SELECT * FROM strong_words, strong_numbers WHERE strong_words.keyid = strong_numbers.keyid AND strong_numbers.keyid=2 AND strong_words.orderid=strong_numbers.orderid ORDER BY strong_numbers.orderid


//SELECT * FROM strong_words, strong_numbers, strongsconcord WHERE strong_words.keyid = strong_numbers.keyid AND strong_numbers.keyid=1 AND strong_words.orderid=strong_numbers.orderid AND strong_numbers.numbers=strongsconcord.number ORDER BY strong_numbers.orderid

	$querynum = mysqli_query($conn, "SELECT * FROM `count` WHERE `verseno` = {$keyvalue}");
	$row = mysqli_fetch_array( $querynum);
 
$no_letters=$row['no_letters'];
$no_words=$row['no_words'];


    	$scrapquery = mysqli_query($conn, "SELECT * FROM `cwstandard` WHERE `verseno` = '{$keyvalue}'");
		

      $row = mysqli_fetch_array( $scrapquery);
 
$fw=$row['F.W'];
$lw=$row['L.W'];
$fw_lw=$row['FLW'];
$cw=$row['CW'];
$fw_lw_cw=$row['FLCW'];
$f2lw=$row['2_FLW'];
$cw34=$row['3/4_CW'];
$f2lw_34=$row['2_FLW_+_3/4_CW'];
$surrcw=$row['W_surr_CW'];
$W_upto_CW=$row['W_upto_CW'];
$W_from_CW=$row['W_from_CW'];





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
  <td>Strongs Concordance</td>
  <td>Strongs #</td>
  <td>Gematria</td>

 
</tr>
</thead>
<tbody>


<?php
	
	
	



		while( $row = mysqli_fetch_array( $query)){
 
$number=$row['numbers'];

		$query2 = mysqli_query($conn, "SELECT * FROM `strongsconcord` WHERE `number`='{$number}'");
		$concordrow = mysqli_fetch_array($query2);

	
	echo "<tr>";
		
	
	
	?>

	

   
     <td style="color:#ffffff;"><?php echo $row['words']; ?></td>
     <td style="color:#00ff00;"><?php echo $concordrow['lemma']." (".$concordrow['xlit'].")"; ?></td>
  
	     <td style="color:#00ccff;"><span class="glyphicon glyphicon-zoom-in">&nbsp;</span><a href="./querystrongtable.php?strong=<?php echo $number; ?>"><?php echo $number; ?></a></td>
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
<td style="color:#ffffff">Standard Gematria Total </td>
<td style="color:#fd1f0e"><?php echo $total; ?></td>
</tr>
</tbody>
</table>
</div><!--md-4-->

<div class="row">
		  <div class="col-md-12">
	<p style="color:#ffffff;">Nr.W=<?php echo $no_words;?>---Nr.L=<?php echo $no_letters;?></p>	  
		  
		  </div>
		  </div>
		  
		  
		        <div class="row">
		  <div class="col-md-12">
		  
		  
		  <table  class="table table-striped" style="
    width: 100%;
"> 
<thead> 
<tr>

<td style="color:#ffffff;">F.W</td>
<td style="color:#ffffff;">L.W</td>
<td style="color:#ffffff;">FLW</td>
<td style="color:#ffffff;">CW</td>
<td style="color:#ffffff;">FLCW</td>
<td style="color:#ffffff;">2_FLW</td>
<td style="color:#ffffff;">3/4_CW</td>
<td style="color:#ffffff;">2_FLW_+_3/4_CW</td>
<td style="color:#ffffff;">W_surr_CW</td>
<td style="color:#ffffff;">W_upto_CW</td>
<td style="color:#ffffff;">W_from_CW</td>
 


 
</tr>
</thead>
<tbody>
<tr>


 


  <td style="color:#ffff00;"><?php echo $fw;?>
  <td style="color:#ffff00;"><?php echo $lw;?>
 <td style="color:#ffff00;"><?php echo $fw_lw;?>
   <td style="color:#ffff00;"><?php echo $cw;?>
 <td style="color:#ffff00;"><?php echo $fw_lw_cw;?>
  <td style="color:#ffff00;"><?php echo $f2lw;?>
  <td style="color:#ffff00;"><?php echo $cw34;?>
  <td style="color:#ffff00;"><?php echo $f2lw_34;?>

 <td style="color:#ffff00;"><?php echo $surrcw;?>
  <td style="color:#ffff00;"><?php echo $W_upto_CW;?>
  <td style="color:#ffff00;"><?php echo $W_from_CW;?>
  
  
  

  
 </tr>

</tbody>
</table>
		  
		  </div><!--row-->
		  </div><!--md-12-->

</div><!--container-->
</body>
</html>