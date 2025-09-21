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

$verse=$_POST['verse'];
$systems=$_POST['system'];

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

if($verse>999999999999) {die("<script>alert('Number too large')</script>");}

while($verse>31102){
	$verse=$verse-31102;
}

if (isset($ultratable)) {
	$queryid = mysqli_query($conn, "SELECT * FROM `ultracalcs` WHERE `id` = '{$verse}'");
    $row = mysqli_fetch_array( $queryid);
	$ultraresult=$row[$ultratable];
}

$queryid = mysqli_query($conn, "SELECT * FROM `{$bibletable}` WHERE `keyid` = '{$verse}' LIMIT 1");
$row = mysqli_fetch_array( $queryid);

$book=$row['book'];
$chapter=$row['chapter'];
$versenumber=$row['verse'];

$keyvalue=$verse;
setcookie('versepos', $keyvalue,time() + (86400 * 30),"/");

$querynum = mysqli_query($conn, "SELECT * FROM `count` WHERE `verseno` = {$keyvalue}");
$row = mysqli_fetch_array( $querynum);

$no_letters=$row['no_letters'];
$no_words=$row['no_words'];

$query = mysqli_query($conn, "SELECT * FROM strong_words, strong_numbers WHERE strong_numbers.keyid = '{$keyvalue}' AND strong_words.keyid = strong_numbers.keyid  AND strong_words.orderid=strong_numbers.orderid ORDER BY strong_numbers.orderid");

$bookname=getbookname($conn,$book);
$versewords=getversewords($conn,$keyvalue);
?>

<div class="row">

<?php if($_SESSION['db_type'] == 'english') { 
    // Ensure we're using the English database with kjv_ prefix
    $english_bibletable = $bibletable;
    $english_methodtable =  $methodtable;
?>
		  
	<div class="col-md-12">
		<p style="text-align:center; color:#ffffff;font-size: 15px;">Verse# = <?php echo $keyvalue;?>	&nbsp;	&nbsp; Words = <?php echo $no_words;?>	&nbsp;	&nbsp; Letters =  <?php echo $no_letters;?></p>	

		<table  class="table table-striped" style="width: 100%;"> 
			<thead style="background-color: #FFA500;"> 
				<tr>
					<td>#</td>
					<td>Scripture</td>
					<td>Gematria</td>
				</tr>
			</thead>
			<tbody>

			<?php
			$query_english = mysqli_query($conn, "SELECT * FROM `{$english_bibletable}` WHERE `keyid` = '{$keyvalue}' ORDER BY `wordorder` ASC");

			while( $row = mysqli_fetch_array( $query_english)){
				$total=$row['gematriaverse'];
				echo "<tr>";
			?>
				<td style="color:#ffffff;"><?php echo $row['wordorder']; ?></td>
				<td style="color:#00ff00;"><?php echo $row['word']; ?></td>
				<td style="color:#ffff00;"><?php echo $row['gematriaword']; ?></td>
			</tr>
			<?php } ?>
			
			<tr>
				<td></td>    
				<td style="color:#ffffff">Total Value </td>
				<td style="color:#59ccf5"><?php echo $total; ?></td>
			</tr>
			</tbody>
		</table>
	</div><!--md-12-->  

	<?php
	// Add the FLL-CL-FLCL section for English
	$queryid_english = mysqli_query($conn, "SELECT * FROM `{$english_methodtable}` WHERE `verseno` = '{$verse}' LIMIT 1");
	$row = mysqli_fetch_array( $queryid_english);

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
	$f3lw_78 =$row['3 FLW + 7/8 CW'];
	$cl34=$row['3/4_CL'];
	$f2ll_34=$row['2_FLL_+_3/4_CL'];
	$surrcw=$row['W_surr_CW'];
	$W_upto_CW=$row['W_upto_CW'];
	$W_from_CW=$row['W_from_CW'];
	$w2surrcw=$row['2_W_surr_CW'];
	$f3lw=$row['3_FLW'];
	$cw78=$row['7/8_CW'];
	$w3surrcw=$row['3_W_surr_CW'];
	$threefll=$row['3_FLL'];
	$f3ll_78=$row['3_FLL_+_7/8_CL'];
	$cl78=$row['7/8_CL'];
	?>	

	<div class="row">
		<div class="col-md-12">
			
			<!-- Line 1: FLL -- CL -- FLCL -->
			<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;">
				<span style="color:#d1d2d4;">FLL = <?php echo $fll; ?></span>&nbsp;---&nbsp;
				<span style="color:#ec0176;">CL = <?php echo $cl; ?></span>&nbsp;---&nbsp;
				<span style="color:#f78c17;">FLCL = <?php echo $flcl; ?></span>
			</p>

			<!-- Line 2: 2 FLL -- 3/4 CL -- 2 FLL + 3/4 CL -->
			<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;">
				<span style="color:#d1d2d4;">2 FLL = <?php echo $twofll; ?></span>&nbsp;---&nbsp;
				<span style="color:#ec0176;">3/4 CL = <?php echo $cl34; ?></span>&nbsp;---&nbsp;
				<span style="color:#f78c17;">2 FLL + 3/4 CL = <?php echo $f2ll_34; ?></span>
			</p>

			<!-- Line 3: 3 FLL -- 7/8 CL -- 3 FLL + 7/8 CL -->
			<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;">
				<span style="color:#d1d2d4;">3 FLL = <?php echo $threefll; ?></span>&nbsp;---&nbsp;
				<span style="color:#ec0176;">7/8 CL = <?php echo $cl78; ?></span>&nbsp;---&nbsp;
				<span style="color:#f78c17;">3 FLL + 7/8 CL = <?php echo $f3ll_78; ?></span>
			</p>

			<!-- Line 4: FLW -- CW -- FLCW -- W. surr. CW -->
			<?php
			$line4 = [];
			if (!empty($fw_lw)) $line4[] = '<span style="color:#ffffff;">FLW = ' . $fw_lw . '</span>';
			if (!empty($cw)) $line4[] = '<span style="color:#ef3d42;">CW = ' . $cw . '</span>';
			if (!empty($fw_lw_cw)) $line4[] = '<span style="color:#e2d031;">FLCW = ' . $fw_lw_cw . '</span>';
			if (!empty($surrcw)) $line4[] = '<span style="color:#9a73b3;">W. surr. CW = ' . $surrcw . '</span>';
			?>
			<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;"><?php echo implode('&nbsp;---&nbsp;', $line4); ?></p>

			<!-- Line 5: 2 FLW -- 3/4 CW -- 2 FLW + 3/4 CW -- 2 W. surr. CW -->
			<?php
			$line5 = [];
			if (!empty($f2lw)) $line5[] = '<span style="color:#ffffff;">2 FLW = ' . $f2lw . '</span>';
			if (!empty($cw34)) $line5[] = '<span style="color:#ef3d42;">3/4 CW = ' . $cw34 . '</span>';
			if ($no_words > 4 && !empty($f2lw_34)) $line5[] = '<span style="color:#e2d031;">2 FLW + 3/4 CW = ' . $f2lw_34 . '</span>';
			if ($no_words > 4 && !empty($w2surrcw)) $line5[] = '<span style="color:#9a73b3;">2 W. surr. CW = ' . $w2surrcw . '</span>';
			?>
			<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;"><?php echo implode('&nbsp;---&nbsp;', $line5); ?></p>

			<!-- Line 6: 3 FLW -- 7/8 CW -- 3 FLW + 7/8 CW -- 3 W. surr. CW -->
			<?php
			$line6 = [];
			if ($no_words >= 7 && !empty($f3lw)) $line6[] = '<span style="color:#ffffff;">3 FLW = ' . $f3lw . '</span>';
			if ($no_words >= 7 && !empty($cw78)) $line6[] = '<span style="color:#ef3d42;">7/8 CW = ' . $cw78 . '</span>';
			if ($no_words >= 7 && !empty($f3lw_78)) $line6[] = '<span style="color:#e2d031;">3 FLW + 7/8 CW = ' . $f3lw_78 . '</span>';
			if ($no_words >= 7 && !empty($w3surrcw)) $line6[] = '<span style="color:#9a73b3;">3 W. surr. CW = ' . $w3surrcw . '</span>';
			?>
			<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;"><?php echo implode('&nbsp;---&nbsp;', $line6); ?></p>

			<!-- Line 7: W. up to CW -- W. from CW -->
			<?php
			$line7 = [];
			if (!empty($W_upto_CW)) $line7[] = '<span style="color:#ef3d42;">W. up to CW = ' . $W_upto_CW . '</span>';
			if (!empty($W_from_CW)) $line7[] = '<span style="color:#ef3d42;">W. from CW = ' . $W_from_CW . '</span>';
			?>
			<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;"><?php echo implode('&nbsp;---&nbsp;', $line7); ?></p>

			<?php if (isset($ultraresult)) { ?>
			<p style="text-align: center; margin-bottom: 1px;font-size: 15px;"> 
				<span style="color:#afafaf;"> ultra calculation =</span>
				<span style="color:#e2d031; font-size: 15px;"> <?php echo $ultraresult;?></span>
			</p>
			<?php } ?>

		</div>
	</div><!--row-->

	<div class="row">
		<input type="hidden" id="keyid" value="<?php echo $keyvalue;?>"/>
	</div><!--md-12-->

<?php } else { ?>
	<!-- Hebrew/Greek Database Section -->
	<div class="col-md-8">
		<p style="text-align:center; color:#ffffff;"><?php echo $bookname. " ".$chapter.":".$versenumber;?><?php echo $versewords;?></p>
		<table  class="table table-striped" style="width: 100%;"> 
			<thead style="background-color: #FFA500;"> 
				<tr>
					<td>KJV</td>
					<td>Strongs Concordance</td>
					<td>Strongs #</td>
					<td>Gematria</td>
				</tr>
			</thead>
			<tbody>

			<?php
			$k=-1;
			while( $row = mysqli_fetch_array( $query)){
				$k++;	
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
			<?php } ?>
			</tbody>
		</table>
	</div><!--md-6-->
        
	<div class="row">
		<div class="col-md-4">
			<p style="text-align:center; color:#ffffff;font-size: 15px;">Verse# = <?php echo $keyvalue;?>	&nbsp;	&nbsp; Words = <?php echo $no_words;?>	&nbsp;	&nbsp; Letters =  <?php echo $no_letters;?></p>	

			<table  class="table table-striped" style="width: 100%;"> 
				<thead style="background-color: #FFA500;"> 
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
				<?php } ?>
				
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
		$queryid = mysqli_query($conn, "SELECT * FROM `{$methodtable}` WHERE `verseno` = '{$verse}' LIMIT 1");
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
		$f3lw_78 =$row['3 FLW + 7/8 CW'];
		$cl34=$row['3/4_CL'];
		$f2ll_34=$row['2_FLL_+_3/4_CL'];
		$surrcw=$row['W_surr_CW'];
		$W_upto_CW=$row['W_upto_CW'];
		$W_from_CW=$row['W_from_CW'];
		$w2surrcw=$row['2_W_surr_CW'];
		$f3lw=$row['3_FLW'];
		$cw78=$row['7/8_CW'];
		$w3surrcw=$row['3_W_surr_CW'];
		$threefll=$row['3_FLL'];
		$f3ll_78=$row['3_FLL_+_7/8_CL'];
		$cl78=$row['7/8_CL'];
		?>	
		
		<div class="row">
			<div class="col-md-12">
				
				<!-- Line 1: FLL -- CL -- FLCL -->
				<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;">
					<span style="color:#d1d2d4;">FLL = <?php echo $fll; ?></span>&nbsp;---&nbsp;
					<span style="color:#ec0176;">CL = <?php echo $cl; ?></span>&nbsp;---&nbsp;
					<span style="color:#f78c17;">FLCL = <?php echo $flcl; ?></span>
				</p>

				<!-- Line 2: 2 FLL -- 3/4 CL -- 2 FLL + 3/4 CL -->
				<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;">
					<span style="color:#d1d2d4;">2 FLL = <?php echo $twofll; ?></span>&nbsp;---&nbsp;
					<span style="color:#ec0176;">3/4 CL = <?php echo $cl34; ?></span>&nbsp;---&nbsp;
					<span style="color:#f78c17;">2 FLL + 3/4 CL = <?php echo $f2ll_34; ?></span>
				</p>

				<!-- Line 3: 3 FLL -- 7/8 CL -- 3 FLL + 7/8 CL -->
				<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;">
					<span style="color:#d1d2d4;">3 FLL = <?php echo $threefll; ?></span>&nbsp;---&nbsp;
					<span style="color:#ec0176;">7/8 CL = <?php echo $cl78; ?></span>&nbsp;---&nbsp;
					<span style="color:#f78c17;">3 FLL + 7/8 CL = <?php echo $f3ll_78; ?></span>
				</p>

				<!-- Line 4: FLW -- CW -- FLCW -- W. surr. CW -->
				<?php
				$line4 = [];
				if (!empty($fw_lw)) $line4[] = '<span style="color:#ffffff;">FLW = ' . $fw_lw . '</span>';
				if (!empty($cw)) $line4[] = '<span style="color:#ef3d42;">CW = ' . $cw . '</span>';
				if (!empty($fw_lw_cw)) $line4[] = '<span style="color:#e2d031;">FLCW = ' . $fw_lw_cw . '</span>';
				if (!empty($surrcw)) $line4[] = '<span style="color:#9a73b3;">W. surr. CW = ' . $surrcw . '</span>';
				?>
				<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;"><?php echo implode('&nbsp;---&nbsp;', $line4); ?></p>

				<!-- Line 5: 2 FLW -- 3/4 CW -- 2 FLW + 3/4 CW -- 2 W. surr. CW -->
				<?php
				$line5 = [];
				if (!empty($f2lw)) $line5[] = '<span style="color:#ffffff;">2 FLW = ' . $f2lw . '</span>';
				if (!empty($cw34)) $line5[] = '<span style="color:#ef3d42;">3/4 CW = ' . $cw34 . '</span>';
				if ($no_words > 4 && !empty($f2lw_34)) $line5[] = '<span style="color:#e2d031;">2 FLW + 3/4 CW = ' . $f2lw_34 . '</span>';
				if ($no_words > 4 && !empty($w2surrcw)) $line5[] = '<span style="color:#9a73b3;">2 W. surr. CW = ' . $w2surrcw . '</span>';
				?>
				<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;"><?php echo implode('&nbsp;---&nbsp;', $line5); ?></p>

				<!-- Line 6: 3 FLW -- 7/8 CW -- 3 FLW + 7/8 CW -- 3 W. surr. CW -->
				<?php
				$line6 = [];
				if ($no_words >= 7 && !empty($f3lw)) $line6[] = '<span style="color:#ffffff;">3 FLW = ' . $f3lw . '</span>';
				if ($no_words >= 7 && !empty($cw78)) $line6[] = '<span style="color:#ef3d42;">7/8 CW = ' . $cw78 . '</span>';
				if ($no_words >= 7 && !empty($f3lw_78)) $line6[] = '<span style="color:#e2d031;">3 FLW + 7/8 CW = ' . $f3lw_78 . '</span>';
				if ($no_words >= 7 && !empty($w3surrcw)) $line6[] = '<span style="color:#9a73b3;">3 W. surr. CW = ' . $w3surrcw . '</span>';
				?>
				<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;"><?php echo implode('&nbsp;---&nbsp;', $line6); ?></p>

				<!-- Line 7: W. up to CW -- W. from CW -->
				<?php
				$line7 = [];
				if (!empty($W_upto_CW)) $line7[] = '<span style="color:#ef3d42;">W. up to CW = ' . $W_upto_CW . '</span>';
				if (!empty($W_from_CW)) $line7[] = '<span style="color:#ef3d42;">W. from CW = ' . $W_from_CW . '</span>';
				?>
				<p style="text-align: center; margin-bottom: 1px; font-size: 15px; color: #bcbdc0;"><?php echo implode('&nbsp;---&nbsp;', $line7); ?></p>

				<?php if (isset($ultraresult)) { ?>
				<p style="text-align: center; margin-bottom: 1px;font-size: 15px;"> 
					<span style="color:#afafaf;"> ultra calculation =</span>
					<span style="color:#e2d031; font-size: 15px;"> <?php echo $ultraresult;?></span>
				</p>
				<?php } ?>

			</div>
		</div><!--row-->

		<div class="row">
			<input type="hidden" id="keyid" value="<?php echo $keyvalue;?>"/>
		</div><!--md-12-->

	</div><!--row-->
<?php } ?>

</div><!--row-->
</div><!--container-->