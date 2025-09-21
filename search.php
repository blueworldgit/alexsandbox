<?php



include("./functions.php");

?>

<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js "></script>
<script>
$(document).ready(function(){
$('#inputform').submit(function(){
event.preventDefault();

$('#response').html("<img src='./15.gif'>");
var language=$('#language').val();
 alert(language);

    //do something special
 
// Call ajax for pass data to other place
$.ajax({
type: 'POST',
url: 'output.php',
data: $(this).serialize() // getting filed value in serialize form
})


.done(function(data){ // if getting done then call.

 /*$('#output').DataTable( {
        "scrollX": true
		//"paging": false,
		//"searching": false
    } );
	*/
	
	 $(document).ready(function() {
 $('#output').DataTable( {
			"scrollX": true,
			"paging": false,
		"searching": false,
		"ordering": false
        } );
    } );

//$('#response').hide();

$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);

})


.fail(function() { // if fail then getting message

// just in case posting your form failed
alert( "Posting failed." );

});

// to prevent refreshing the whole page page
return false;


});
});
</script>,

</head>

<body>


<form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>

<!-- Form Name -->
<legend>Enter a character or word to search for</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="book"></label>  
  <div class="col-md-4">
  <input id="char" name="char" type="text" placeholder="Search Item" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>


<div class="col-md-12">


<?php

if (!empty($_POST)) {
	
$string="לא תחמד אשת רעך ס ולא תתאוה בית רעך שדהו ועבדו ואמתו שורו וחמרו וכל אשר לרעך";

//$string="the dog d ate the cat";
	
$char=$_POST['char'];

$char=trim($char);

$char=" ".$char." ";


$query = mysqli_query($conn, "SELECT * FROM `hebrew` where `book` < 40");



	
	$count=0;
	while ($row = mysqli_fetch_array($query)) {
		
		
		
		//echo "<h2>".$count."</h2>";
		
		
		$string=$row['word'];
		$id=$row['id'];
		$book=$row['book'];
		$chapter=$row['chapter'];
		$verse=$row['verse'];
	
		
		if (strpos($string, $char) !== false) {
	$count++;
	
	echo "<h2>=============================".$count."============================</h2>";
    echo 'Book '.$book."</br>";
	echo 'Chapter '.$chapter."</br>";
    echo 'Verse '.$verse."</br>";
	
	
	echo "<a href='lightbox.php?id=".$verse."'>CLICK LINK</a>";
	
	
		
		echo "</br>";
			echo "</br>";
				echo "</br>";
} 



		
	} // sql while loop



}

?>

</div>

</body>
</html>