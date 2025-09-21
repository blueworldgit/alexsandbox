
<?php



include("./functions.php");
	//$queryid = mysqli_query($conn, "SELECT * FROM `{$bibletable}` WHERE `keyid` = '{$verse}' LIMIT 1");


$systems=$_POST['system'];
$totalmethodoptions=$_POST['totalmethodoptions'];
$methodversetotal=$_POST['methodversetotal'];

//*********************pagination******************
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

//*********************pagination******************

$systemvalues=explode("#",$systems);

$bibletable=$systemvalues[0];
$methodtable=$systemvalues[1];





if(($totalmethodoptions==="no_words") || ($totalmethodoptions==="no_letters") || ($totalmethodoptions==="total_letters_words")){
	
$booksum=0;
$chaptersum=0;
$versesum=0;	

	
	$methodtable="count";
	
	
	$page_query = "SELECT * FROM `{$methodtable}` WHERE `{$totalmethodoptions}` = '{$methodversetotal}' ORDER BY id ASC";  
 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page); 

	$query = mysqli_query($conn, "SELECT * FROM `{$methodtable}` WHERE `{$totalmethodoptions}` = '{$methodversetotal}' ORDER BY id ASC LIMIT $start_from, $record_per_page");


?>

    <div class="row">
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
  <td>Verse#</td>

  <td>Link to Verse</td>


 
</tr>
</thead>
<tbody>

<?php

	$counter=0;
	$newcounter=0;



while( $row = mysqli_fetch_array( $query)){
	
		$counter++;
		$newcounter++;
		
			if($page>1) {$counter=($newcounter+($record_per_page*$page))-500;
		//$counter=$newcounter;
		
		}
       
        $verseno=$row['verseno'];
		
		




	//mysqli_query($conn, $query);
	
	

	
		
		
		//echo $verseno."</br>";
		
		echo "<tr>";
		
		

?>

<td style="color:#ffffff;"><?php echo $counter ?></td>

  <td style="color:#ffffff;"><?php echo $verseno ?></td>

	   
		
		    <td style="color:#ffffff;"><a href="./interface.php?verse=<?php echo $verseno; ?>&systems=<?php echo $verseno; ?>"target="_blank"><?php echo $verseno; ?></a></td>


<?php


}

?>


<thead style="
    background-color: #FFA500;
"> 

<tr>

  <td>No</td>
  <td>Verse#</td>

  <td>Link to Verse</td>


 
</tr>
</thead>

</tbody>
</table>



<?php



 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link_querymethods' style='cursor:pointer; padding:6px; color:#fff; border:1px solid #b11717;' id='".$i."'>".$i."</span>";  
 }  

 echo  $output;
 
}

else {




 $page_query = "SELECT * FROM `{$methodtable}` WHERE `{$totalmethodoptions}` = '{$methodversetotal}' ORDER BY id ASC";  
 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  


	$query = mysqli_query($conn, "SELECT * FROM `{$methodtable}` WHERE `{$totalmethodoptions}` = '{$methodversetotal}' ORDER BY id ASC LIMIT $start_from, $record_per_page");

?>

    <div class="row">
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
  <td>Verse#</td>

  <td>Link to Verse</td>


 
</tr>
</thead>
<tbody>
    


<?php

	$counter=0;
	$newcounter=0;
	$booksum=0;
    $chaptersum=0;
    $versesum=0;


while( $row = mysqli_fetch_array( $query)){
	
		$counter++;
		$newcounter++;
		
			if($page>1) {$counter=($newcounter+($record_per_page*$page))-500;
		//$counter=$newcounter;
		
		}
       
        $verseno=$row['verseno'];
		
		
				$resultarray=getbookchapterverse($conn,$verseno);

$booksum=($resultarray[0]+$booksum)*1;
$chaptersum=($resultarray[1]+$chaptersum)*1;
$versesum=($resultarray[2]+$versesum)*1;
	
		
		
		//echo $verseno."</br>";
		
		echo "<tr>";
		
		

?>

<td style="color:#ffffff;"><?php echo $counter ?></td>

  <td style="color:#ffffff;"><?php echo $verseno ?></td>

	   
		
		    <td style="color:#ffffff;"><a href="./interface.php?verse=<?php echo $verseno; ?>&systems=<?php echo $verseno; ?>"target="_blank"><?php echo $verseno; ?></a></td>


<?php


}

?>




<thead style="
    background-color: #FFA500;
"> 

<tr>

  <td>No</td>
  <td>Verse#</td>

  <td>Link to Verse</td>


 
</tr>
</thead>

</tbody>
</table>

<p style="text-align: center; margin-top: -8px;font-size: 15px; color:#afafaf;">Sum book# = <span style="color:#e2d031;    font-size: 15px;"> <?php echo $booksum;?></span></p>
<p style="text-align: center; margin-top: -8px;font-size: 15px; color:#afafaf;">Sum chapter# = <span style="color:#e2d031;    font-size: 15px;"> <?php echo $chaptersum;?></span></p>
<p style="text-align: center; margin-top: -8px;font-size: 15px; color:#afafaf;">Sum verse# = <span style="color:#e2d031;    font-size: 15px;"> <?php echo $versesum;?></span></p>

<?php





 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link_querymethods' style='cursor:pointer; padding:6px; color:#fff; border:1px solid #b11717;' id='".$i."'>".$i."</span>";  
 }  

 echo  $output;
 
 
} //else for not words or letters or total words and letters
 
 ?>
</div>
</div>