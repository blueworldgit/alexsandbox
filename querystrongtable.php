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

$strong=$_GET['strong'];




	$query = mysqli_query($conn, "SELECT * FROM `strong_numbers` WHERE `numbers` LIKE '{$strong}'");


	//mysqli_query($conn, $query);
	


		







?>

        <div class="row">
		  <div class="col-md-12">
	
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
	
	
	



		while( $row = mysqli_fetch_array( $query)){
 		$verseno=$row['keyid'];
	    $line=$row['orderid'];
      
		
		$innerquery = mysqli_query($conn, "SELECT * FROM `strong_words` WHERE `keyid` LIKE '{$verseno}' AND `orderid` LIKE '{$line}'  ");
	    $textrow = mysqli_fetch_array( $innerquery);
		 $text=$textrow['words'];
	      $line++;
	echo "<tr>";
		

	
	?>


	

      <td style="color:#ffffff;"><?php echo $text;?></td>
   	
     <td style="color:#ffffff;"><span class="glyphicon glyphicon-zoom-in">&nbsp;</span><a href="./interface.php?verse=<?php echo $verseno; ?>&systems=<?php echo $systems; ?>"target="_blank"><?php echo $verseno; ?></a></td>

     <td style="color:#ffffff;">Word <?php echo $line;?></td>
	
	


   </tr>
   

<?php }


?>
</tbody>
</table>
</div><!--md-6-->

</div><!--container-->
</body>
</html>