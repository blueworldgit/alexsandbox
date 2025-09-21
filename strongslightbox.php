<?php


include("./functions.php");

$match=$_GET['match'];

$query = mysqli_query($conn, "SELECT * FROM `strongsconcord` WHERE `number`='{$match}' LIMIT 1");

	$row = mysqli_fetch_array( $query);
	
	
	$lemma=$row['lemma'];
	$xlit=$row['xlit'];
	$pronounce=$row['pronounce'];
	$description=$row['description'];
	
	
	

?>


<html>


<head>

<style>

body {
  background-color: #f8f5de;
  background-image: linear-gradient(to right, rgba(255,210,0,0.4), rgba(200, 160, 0, 0.1) 11%, rgba(0,0,0,0) 35%, rgba(200, 160, 0, 0.1) 65%);
  box-shadow: inset 0 0 75px rgba(255,210,0,0.3), inset 0 0 20px rgba(255,210,0,0.4), inset 0 0 30px rgba(220,120,0,0.8);
  color: #000000;
  
  width: calc(8.5in - 15em);
  letter-spacing: 0.05em;
  line-height: 1.8;
  padding: 7px;
}

.caps {
  color: rgba(0,0,0,0.7);
  float:left;
  font-size: 7em;
  line-height: 60px;
  padding-right: 12px;
  position:relative;
  top:8px;
}

</style>


	</head>
	
	<body>
	


  	<?php echo $description;?>





	

	
	
	

	<!-- 
	<table  class="table table-striped" style="
    width: 100%;
">


<thead> 
<tr>
  <td>Text</td>
  <td>Xlit</td>
  <td>Pronounce</td>
  <td>Description</td>


</tr>
</thead>
<tbody>


<tr>
  <td><?php //echo $lemma;?></td>
  <td><?php //echo $xlit;?></td>
  <td><?php //echo $pronounce;?></td>
  <td><?php //echo $description;?></td>


</tr>

</tbody>

</table>
-->
	
	</body>
	
	</html>
	