
	
<?php
include("./functions.php");



$verse=$_GET['verse'];



	$queryid = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `keyid` = '{$verse}' LIMIT 1");
	 $row = mysqli_fetch_array( $queryid);
	 
	 $book=$row['book'];
$chapter=$row['chapter'];
$versenumber=$row['verse'];



$bookname=getbookname($conn,$book);
$versewords=getversewords($conn,$verse);








	$query=mysqli_query($conn,"SELECT * FROM strong_words, strong_numbers WHERE strong_numbers.keyid ='{$verse}' AND strong_words.keyid = strong_numbers.keyid AND strong_words.orderid=strong_numbers.orderid ORDER BY strong_numbers.orderid");

	 

?>	 

        <div class="row">
		
		<p style="text-align:center; color:#000000;"><?php echo $bookname. " ".$chapter.":".$versenumber;?><?php echo $versewords;?></p>
		  <div class="col-md-8">
	<p style="text-align:center; color:#ffffff;"><?php //echo $bookname. " ".$chapter.":".$versenumber;?><?//php echo $versewords;?></p>
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead style="
    background-color: #FFA500;
"> 

<tr>
  <td>no</td>
  <td>words</td>
  <td>numbers</td>
  
  <td>Edit</td>

 
</tr>
</thead>
<tbody>




<?php
	
	
	

$k=-1;

		while( $row = mysqli_fetch_array( $query)){
			
		$k++;	
		
		
		
			 $words=$row['words'];
$id=$row['id'];
$numbers=$row['numbers'];
 
	echo "<tr>";
	
	?>

      <td style="color:#000000;"><?php echo $k; ?></td>
     <td style="color:#000000;"><?php echo $row['words']; ?></td>
	   <td style="color:#000000;"><?php echo $row['numbers']; ?></td>
	    <td style="color:#000000;"><a href='parse_edit?id=<?php echo $id; ?>&word=<?php echo $row['words']; ?>'>EDIT</a></td>
		
		
		
		
		   </tr>
   

<?php }


?>


</tbody>
</table>
