    <div class="row">
		  <div class="col-md-12">
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
  <td>Verse#</td>
  <td>Value</td>
  <td>Link to Verse</td>


 
</tr>
</thead>
<tbody>

<?php

include("./functions.php");
	//$queryid = mysqli_query($conn, "SELECT * FROM `{$bibletable}` WHERE `keyid` = '{$verse}' LIMIT 1");


$system=$_POST['system'];
$ultraversetotal=$_POST['ultraversetotal'];
$firstonly=$_POST['firstonly'];





if($firstonly==="starting") {

$query = mysqli_query($conn, "SELECT * FROM `ultracalcs` WHERE `{$system}` LIKE '{$ultraversetotal}%'"); }

else {$query = mysqli_query($conn, "SELECT * FROM `ultracalcs` WHERE `{$system}` LIKE '%{$ultraversetotal}%'");}










while( $row = mysqli_fetch_array( $query)){
       
        $verseno=$row['verseno'];
		$value=$row[$system];
		
		
		//echo $verseno."</br>";
		
		echo "<tr>";
		
		

?>

  <td style="color:#ffffff;"><?php echo $verseno ?></td>

	    <td style="color:#ffffff;"><?php echo $value ?></td>
		
		    <td style="color:#ffffff;"><a href="./interface.php?verse=<?php echo $verseno; ?>&systems=<?php echo $system; ?>"target="_blank"><?php echo $verseno; ?></a></td>


<?php


}

?>


</tbody>
</table>
</div>
</div>