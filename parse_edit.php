
	
<?php
include("./functions.php");



if (!empty($_POST)){
	
	
	$strong=$_POST['strong'];
	
	$id=$_POST['id'];
	
	
	$strong=str_replace("H","",$strong);
		$strong=str_replace("h","",$strong);
	//echo $strong."-----".$id;
	
	$strong=$strong*1;
	
	if($strong<1000) {$strong='0'.$strong;}
	
	
	$strong='H'.$strong;
	
	$sql="UPDATE `strong_numbers` SET `numbers` = '{$strong}' WHERE `strong_numbers`.`id` = '{$id}'";
	
	
	 



if (mysqli_query($conn, $sql)) {
    echo "Record edited successfully";

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

	
}


else {

$id=$_GET['id'];
$word=$_GET['word'];









	//$query=mysqli_query($conn,"SELECT * FROM strong_words, strong_numbers WHERE strong_numbers.keyid ='{$verse}' AND strong_words.keyid = strong_numbers.keyid AND strong_words.orderid=strong_numbers.orderid ORDER BY strong_numbers.orderid");

	 

?>	 


<h4><?php echo $word;?></h4>

<form action="./parse_edit.php" method="POST">

    <input name="strong"  placeholder="strongvalue">
	
	 <input name="id" value="<?php echo $id;?>" placeholder="strongvalue">
	 
	 <input type="submit" name="submit" value="Submit">
	 
	 </form>
	 
	 
<?php } ?>