<?php


include("./db.php");



function removeAccents($str) {
  $a = array(

';', '·', '’',


'ἁ', 'ἀ',  'ἂ',  'ἃ',  'ἄ',  'ἅ',  'ἆ',  'ἇ',  'ὰ',  'ά',  'ᾶ', 

'ᾀ', 'ᾁ', 'ᾂ', 'ᾃ', 'ᾄ', 'ᾅ', 'ᾆ', 'ᾇ', 'ᾰ', 'ᾱ', 'ᾲ', 'ᾳ', 'ᾴ', 'ᾷ',

'ἐ',  'ἑ',  'ἒ',  'ἓ',  'ἔ',  'ἕ',  'ὲ',  'έ',

 
'ἠ',  'ἡ',  'ἢ',  'ἣ',  'ἤ',  'ἥ',  'ἦ',  'ἧ',  'ὴ',  'ή',  'ῆ',

'ᾐ',   'ᾑ',  'ᾒ',  'ᾓ',  'ᾔ',  'ᾕ',  'ᾖ',  'ᾗ',  'ῂ',  'ῃ', 'ῄ', 'ῇ',

'ἰ',    'ἱ',  'ἲ',  'ἳ',  'ἴ',  'ἵ',  'ἶ',  'ἷ',  'ὶ',  'ί',  'ῐ',  'ῑ',  'ῒ',    'ΐ',  'ῖ',  'ῗ', 'ϊ', 'ΐ',

'ὀ',  'ὁ',  'ὂ',  'ὃ',  'ὄ',  'ὅ',  'ὸ',  'ό',

'ῤ', 'ῥ',

'ὐ', 'ὑ', 'ὒ', 'ὓ', 'ὔ', 'ὕ', 'ὖ', 'ὗ', 'ὺ', 'ύ', 'ῠ', 'ῡ', 'ῢ', 'ΰ', 'ῦ', 
'ῧ',

'ὠ', 'ὡ', 'ὢ', 'ὣ', 'ὤ', 'ὥ', 'ὦ', 'ὧ', 'ὼ', 'ώ', 'ῶ', 

'ῲ', 'ῳ', 'ῴ', 'ῷ', 'ᾧ', 'ᾠ', 'ᾦ'  






  
);
  $b = array(
'', '', '',
'α', 'α', 'α', 'α', 'α', 'α', 'α', 'α', 'α', 'α', 'α',
'ια', 'ια' , 'ια', 'ια', 'ια', 'ια', 'ια', 'ια', 'ια', 'ια', 'ια', 'ια', 'ια', 'ια',

'ε', 'ε' , 'ε', 'ε', 'ε', 'ε', 'ε', 'ε',

'η', 'η' , 'η' , 'η' , 'η' , 'η' , 'η' , 'η' , 'η' , 'η' , 'η', 

'ιη', 'ιη' , 'ιη', 'ιη', 'ιη', 'ιη', 'ιη', 'ιη', 'ιη', 'ιη', 'ιη', 'ιη',

'ι', 'ι' , 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι',

 'ι', 'ι', 'ι', 'ι',

'ο', 'ο', 'ο', 'ο', 'ο', 'ο', 'ο', 'ο',

'ρ', 'ρ',

'υ', 'υ', 'υ','υ','υ','υ','υ','υ','υ','υ','υ','υ','υ','υ','υ','υ',

'ω', 'ω' , 'ω', 'ω', 'ω', 'ω', 'ω', 'ω', 'ω', 'ω', 'ω',

'ιω', 'ιω' , 'ιω', 'ιω', 'ιω', 'ιω', 'ιω'

  
  
  
    );
  return str_replace($a, $b, $str);
}






function displaytable ($conn,$bookno)

{
	
			$bhrequiredquery = mysqli_query($conn, "SELECT * FROM `hebrew` WHERE `biblehub_value` = 0 AND `book` = '{$bookno}' ");
			
						$nonmatchquery = mysqli_query($conn, "SELECT * FROM `hebrew` WHERE value!=biblehub_value AND biblehub_value!=0 AND `book` = '{$bookno}' ");
	
	
	
		$query = mysqli_query($conn, "SELECT * FROM `hebrew` WHERE `book` = '{$bookno}' ORDER BY book AND chapter AND verse");
	
	
	  $rowcount=mysqli_num_rows($query);
	  
	    $nonmatchquery=mysqli_num_rows($nonmatchquery);
	  
	   $bhrequiredquery=mysqli_num_rows($bhrequiredquery);
	  
	  
	  echo "<h3>". $rowcount . " verses in total</h3>";
	  
	  echo "<h3>". $bhrequiredquery . " verses need BibleHub Values</h3>";
	  
	   echo "<h3>". $nonmatchquery . " verses do not match Biblehub values</h3>";
	
	?>
	
<table  class="table table-striped" style="
    width: 100%;
"> 
<thead> 
<tr>
  <td>ID</td>
  <td>Book</td>
  <td>Chapter</td>
  <td>Verse</td>
  <td>Value</td>
  <td>BibleHubvalue</td>
    <td>EDIT</td>

<td>MARK</td>
 
</tr>
</thead>
<tbody>

<?php
	
	
	




while ($row = mysqli_fetch_array($query)) {
	
	if(($row['state']==3)){
		
				echo '<tr style="
    background-color: #d7ff38;">';
		
		
	}
	
	else 
	
	if(($row['value']<>$row['biblehub_value'])&&($row['biblehub_value']<>0)){
		
				echo '<tr style="
    background-color: #efc0c0;">';
		
		
	}
	
	else 
		
	
	{
		
		

	
	echo "<tr>";
		
	}
	
	?>

	

   
    <td><?php echo $row['id']; ?></td>
       <td><?php echo $row['book']; ?></td>
      <td><?php echo $row['chapter']; ?></td>
	   <td><?php echo $row['verse']; ?></td>
      <td><?php echo $row['value']; ?></td>
   <td><?php echo $row['biblehub_value']; ?></td>
	
	
	    <td><a href="./lightbox.php?id=<?php echo $row['id']; ?>">Change</a></td>
		
		
  <td><a href="./marker.php?id=<?php echo $row['id']; ?>">DON'T PULL</a></td>

   </tr>
   

<?php }


?>
</tbody>
</table>


<?php } 


function update($conn,$book,$chapter,$verse,$word,$value,$id)

{
	
//$query = mysqli_query($conn, "UPDATE `hebrew` SET `book` = '{$book}', `chapter` = '{$chapter}', `verse` = '{$verse}', 
//`value` = '{$value}' WHERE `hebrew`.`id` = 1");
			
			
			$query = mysqli_query($conn, "UPDATE `hebrew` SET `book` = '{$book}'
			, `chapter` = '{$chapter}'
			, `verse` = '{$verse}'
			,`value` = '{$value}'
			,`word` = '{$word}'
			WHERE `hebrew`.`id` = '{$id}'");


	mysqli_query($conn, $query);
		
	
}


function outputrows($conn)

{
	
	$count=0;
	
//$query = mysqli_query($conn, "UPDATE `hebrew` SET `book` = '{$book}', `chapter` = '{$chapter}', `verse` = '{$verse}', 
//`value` = '{$value}' WHERE `hebrew`.`id` = 1");
			
			
			$query = mysqli_query($conn, "SELECT * FROM `hebrew`");


	//mysqli_query($conn, $query);
	
	
	while ($row = mysqli_fetch_array($query)) {
		
		$count++;
	
	$id=$row['id'];
	
$sql="UPDATE `hebrew` SET `newid` = '{$count}' WHERE `hebrew`.`id` = '{$id}'";

$query2 = mysqli_query($conn,$sql);
		
	echo $count."</br>";
	
		
	
}

}



function getbookname($conn,$booknumber)

{
	

	
//$query = mysqli_query($conn, "UPDATE `hebrew` SET `book` = '{$book}', `chapter` = '{$chapter}', `verse` = '{$verse}', 
//`value` = '{$value}' WHERE `hebrew`.`id` = 1");
			
			
			$query = mysqli_query($conn, "SELECT * FROM `books` WHERE `no` = '{$booknumber}' ");


	//mysqli_query($conn, $query);
	
	
	$row = mysqli_fetch_array($query);
	
	

		
	
	
	$name=$row['book'];
	



		
	return $name;
	
		
	


}



function getversewords($conn,$verse)

{
	

	
$string="";

$queryone = mysqli_query($conn, "SELECT * FROM `strong_words` WHERE `keyid` = '{$verse}'");


	while ($row = mysqli_fetch_array($queryone)) {
		
		
	if($row['words']!="(untranslated)"){	$string=$string." ".$row['words'];}
		
	}
	
		
	return $string;


}



function changestate($conn,$id,$state)

{
	
//$query = mysqli_query($conn, "UPDATE `hebrew` SET `book` = '{$book}', `chapter` = '{$chapter}', `verse` = '{$verse}', 
//`value` = '{$value}' WHERE `hebrew`.`id` = 1");
			
			

			
				$query = mysqli_query($conn, "UPDATE `hebrew` SET `state` = '{$state}' 
				WHERE `hebrew`.`id` = '{$id}'");


	mysqli_query($conn, $query);
	

		
	
}


function gettranslation($conn,$book,$chapter,$verse,$wordorder)

{
	

	
$string="";

$queryone = mysqli_query($conn, "SELECT * FROM `theholybibletranslated` WHERE `book` = '{$book}' AND `chapter` = '{$chapter}' AND `verse` = '{$verse}' AND `wordorder` = '{$wordorder}'");


	$row = mysqli_fetch_array($queryone);
		
	$translation=$row['translated'];	
		
	return $translation;


}


//UPDATE `hebrew` SET `state` = '1' WHERE `hebrew`.`id` = 1;


//UPDATE `hebrew` SET `book` = '1', `chapter` = '1', `verse` = '1', `value` = '2701', `biblehub_value` = '2701' WHERE `hebrew`.`id` = 1;




function getbookchapterverse($conn,$versenumber)

{
	

	
//$query = mysqli_query($conn, "UPDATE `hebrew` SET `book` = '{$book}', `chapter` = '{$chapter}', `verse` = '{$verse}', 
//`value` = '{$value}' WHERE `hebrew`.`id` = 1");
			
			
			$query = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `keyid` = '{$versenumber}' ");


	//mysqli_query($conn, $query);
	
	
	$row = mysqli_fetch_array($query);
	
	

		
	
	
	$book=$row['book'];
	$chapter=$row['truechapter'];
	$verse=$row['keyid'];
	
	



		
	return array($book,$chapter,$verse);
	
		
	


}







function gettruechapter($conn,$versenumber)

{
	

	
//$query = mysqli_query($conn, "UPDATE `hebrew` SET `book` = '{$book}', `chapter` = '{$chapter}', `verse` = '{$verse}', 
//`value` = '{$value}' WHERE `hebrew`.`id` = 1");
			
			
			$query = mysqli_query($conn, "SELECT * FROM `theholybible` WHERE `keyid` = '{$versenumber}' LIMIT 1 ");


	//mysqli_query($conn, $query);
	
	
	$row = mysqli_fetch_array($query);
	
	

		
	
	

	$chapter=$row['truechapter'];
	
	
	



		
	return $chapter;
	
		
	


}