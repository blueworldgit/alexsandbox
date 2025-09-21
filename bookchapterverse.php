
<div class="container">

<script>


$(document).ready(function(){
	
	
	$('.fancyframe').fancybox({
 'type':'iframe',
 'width': 600, 
 'height': 300
});
});
</script>	
	
<?php
include("./functions.php");


$book=$_POST['book'];
$verse=$_POST['verse'];
$chapter=$_POST['chapter'];

$systems=$_POST['system'];



if(!is_numeric($book)){
	
	
	$queryid = mysqli_query($conn, "SELECT * FROM `books` WHERE `book` LIKE '{$book}' OR `variation_one` LIKE '{$book}' OR `variation_two` LIKE '{$book}' OR `variation_three` LIKE '{$book}' OR `variation_four` LIKE '{$book}' OR `variation_five` LIKE '{$book}' OR `variation_six` LIKE '{$book}' LIMIT 1");
	 $row = mysqli_fetch_array( $queryid);
 
 $book=$row['no'];
 
 //SELECT * FROM `books` WHERE `book` LIKE 'Psa' OR `variation_one` LIKE 'Psa' OR `variation_two` LIKE 'Psa' OR `variation_three` LIKE 'Psa' OR `variation_four` LIKE 'Psa' OR `variation_five` LIKE 'Psa' OR `variation_six` LIKE 'Psa'
 

}









$systemvalues=explode("#",$systems);

$bibletable=$systemvalues[0];
$methodtable=$systemvalues[1];


if(($bibletable=="theholybibleone") || ($bibletable=="theholybibletwo") || ($bibletable=="theholybiblethree")
	
|| ($bibletable=="theholybiblefour") || ($bibletable=="theholybiblefive") || ($bibletable=="theholybiblesix")) {
	
//do nothing	
	
} else {

if($bibletable=="theholybible") {$ultratable="standard";} else {
	
	$ultratable=$bibletable;
	$ultratable=str_replace("theholybible","",$ultratable);
	
	
	
	
}
}





	$queryid = mysqli_query($conn, "SELECT * FROM `{$bibletable}` WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}' LIMIT 1");
	 $row = mysqli_fetch_array( $queryid);

$keyvalue=$row['keyid'];
setcookie('versepos', $keyvalue,time() + (86400 * 30),"/");


 if (isset($ultratable)) {
		$queryid = mysqli_query($conn, "SELECT * FROM `ultracalcs` WHERE `id` = '{$keyvalue}'");
	    $row = mysqli_fetch_array( $queryid);
		$ultraresult=$row[$ultratable];
		
	 }

//SELECT * FROM strong_words, strong_numbers WHERE strong_words.keyid = strong_numbers.keyid AND strong_numbers.keyid=2 AND strong_words.orderid=strong_numbers.orderid ORDER BY strong_numbers.orderid


//SELECT * FROM strong_words, strong_numbers, strongsconcord WHERE strong_words.keyid = strong_numbers.keyid AND strong_numbers.keyid=1 AND strong_words.orderid=strong_numbers.orderid AND strong_numbers.numbers=strongsconcord.number ORDER BY strong_numbers.orderid

	$querynum = mysqli_query($conn, "SELECT * FROM `count` WHERE `verseno` = {$keyvalue}");
	$row = mysqli_fetch_array( $querynum);
 
$no_letters=$row['no_letters'];
$no_words=$row['no_words'];



	$query = mysqli_query($conn, "SELECT * FROM strong_words, strong_numbers WHERE strong_numbers.keyid = '{$keyvalue}' AND strong_words.keyid = strong_numbers.keyid  AND strong_words.orderid=strong_numbers.orderid ORDER BY strong_numbers.orderid");


	//mysqli_query($conn, $query);
	
$bookname=getbookname($conn,$book);
$versewords=getversewords($conn,$keyvalue)
		







?>


  
        <div class="row">
		  <div class="col-md-8">
	<p style="text-align:center; color:#ffffff;"><?php echo $bookname. " ".$chapter.":".$verse;?><?php echo $versewords;?></p>
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
  
 <td style="color:#00ccff;"><a class="fancyframe" href="./strongslightbox.php?match=<?php echo $number; ?>"><span style='color:#bfe6ef;' class="glyphicon glyphicon-zoom-in">&nbsp;</span></a><a style='color:#bfe6ef;' href="./querystrongtable.php?strong=<?php echo $number; ?>"><?php echo $number; ?></a></td>
	  <td style="color:#ffff00;"><?php echo $concordrow['gematria']; ?></td>

	
	


   </tr>
   

<?php }


?>
</tbody>
</table>
</div><!--md-6-->
        <div class="row">
		  <div class="col-md-4">
		  
		  
		  <p style="text-align:center; color:#ffffff;font-size: 15px;">Verse# = <?php echo $keyvalue;?>	&nbsp;	&nbsp; Words = <?php echo $no_words;?>	&nbsp;	&nbsp; Letters =  <?php echo $no_letters;?></p>	
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>

 <td>#</td>
 
  <td>Scripture</td>
 
  <td>Gematria</td>

 
</tr>
</thead>
<tbody>


<?php
	
	
	
$query = mysqli_query($conn, "SELECT * FROM `{$bibletable}` WHERE `keyid` = '{$keyvalue}' ORDER BY `wordorder` ASC");


		while( $row = mysqli_fetch_array( $query)){
 
$total=$row['gematriaverse'];

	
	echo "<tr>";
		
	
	
	?>

	

   
    <td style="color:#ffffff;"><?php echo $row['wordorder']; ?></td>
     <td style="color:#00ff00;"><?php echo $row['word']; ?></td>

	  <td style="color:#ffff00;"><?php echo $row['gematriaword']; ?></td>

	
	


   </tr>
   

<?php }



?>
<tr>
<td></td>    
<td style="color:#ffffff">Total Value </td>
<td style="color:#59ccf5"><?php echo $total; ?></td>
</tr>
</tbody>
</table>
</div><!--md-4-->

<div class="row">
		  <div class="col-md-12">
	  
		  
		  </div>
		  </div>
		  
		  
		        <div class="row">
		  <div class="col-md-12">
		  
		  

		  
		  </div><!--row-->
		  </div><!--md-12-->
		  
		  
		  <?php

	$queryid = mysqli_query($conn, "SELECT * FROM `{$methodtable}` WHERE `verseno` = '{$keyvalue}' LIMIT 1");
	 $row = mysqli_fetch_array( $queryid);




$fll=$row['F.L.L'];
$twofll=$row['2_F.L.L'];
$cl=$row['C.L'];
$flcl=$row['F.L.C.L'];
$fw=$row['F.W'];
$lw=$row['L.W'];
$fw_lw=$row['FLW'];
$cw=$row['CW'];
$fw_lw_cw=$row['FLCW'];
$f2lw=$row['2_FLW'];
$cw34=$row['3/4_CW'];
$f2lw_34=$row['2_FLW_+_3/4_CW'];
$cl34=$row['3/4_CL'];
$f2ll_34=$row['2_FLL_+_3/4_CL'];
$surrcw=$row['W_surr_CW'];
$W_upto_CW=$row['W_upto_CW'];
$W_from_CW=$row['W_from_CW'];


?>	
		  <div class="row">

<div class="col-md-12">

<p style="text-align: center; margin-bottom: 1px;font-size: 15px; color: #bcbdc0;"> <span style="color:#d1d2d4;    font-size: 15px;">FLL = <?php echo $fll;?></span>&nbsp;---&nbsp;<span style="color:#ec0176;    font-size: 15px;">CL = <?php echo $cl;?></span>&nbsp;---&nbsp;<span style="color:#f78c17;    font-size: 15px;">FLCL = <?php echo $flcl;?> </span></p>


<p style="text-align: center; margin-bottom: 1px;font-size: 15px; color: #bcbdc0;"> <span style="color:#d1d2d4;    font-size: 15px;">2 FLL = <?php echo $twofll;?></span>&nbsp;---&nbsp;<span style="color:#ec0176;    font-size: 15px;">3/4 CL = <?php echo $cl34;?></span>&nbsp;---&nbsp;<span style="color:#f78c17;    font-size: 15px;">2 FLL + 3/4 CL = <?php echo $f2ll_34;?> </span></p>

<p style="text-align: center; margin-bottom: 1px;font-size: 15px; color: #bcbdc0;"> <span style="color:#ffffff;    font-size: 15px;">FLW = <?php echo $fw_lw;?></span>&nbsp;---&nbsp;<span style="color:#ef3d42;    font-size: 15px;">CW = <?php echo $cw;?></span>&nbsp;---&nbsp;<span style="color:#e2d031;    font-size: 15px;">FLCW = <?php echo $fw_lw_cw;?></span>&nbsp;---&nbsp;<span style="color:#9a73b3;    font-size: 15px;">W. surr. CW = <?php echo $surrcw;?></span> </p>

<p style="text-align: center; margin-bottom: 1px;font-size: 15px; color: #bcbdc0;"> <span style="color:#ffffff;    font-size: 15px;">2 FLW = <?php echo $f2lw;?></span>&nbsp;---&nbsp;<span style="color:#ef3d42;    font-size: 15px;">3/4 CW = <?php echo $cw34;?></span>&nbsp;---&nbsp;<span style="color:#e2d031;    font-size: 15px;    "><?php if ($no_words>4) { echo "2 FLW + 3/4 CW = $f2lw_34";} ?></span> </p>

<p style="text-align: center; margin-bottom: 1px;font-size: 15px; color: #bcbdc0;"> <span style="color:#ef3d42;    font-size: 15px;">W. up to CW = <?php echo $W_upto_CW;?></span>&nbsp;---&nbsp;<span style="color:#ef3d42;    font-size: 15px;">W. from CW = <?php echo $W_from_CW;?></span></p>

 <?php  if (isset($ultraresult)) { ?>
<p style="text-align: center; margin-bottom: 1px;font-size: 15px;"> <span style="color:#afafaf;"> ultra calculation =</span><span style="color:#e2d031;    font-size: 15px;"> <?php echo $ultraresult;?></span></p>


 <?php } ?>


</div>
  </div><!--row-->

<div class="row">


  
  <input type="hidden" id="keyid" value="<?php echo $keyvalue;?>"/>
		  </div><!--md-12-->


