<?php


include("./db.php");

$id=$_GET['id'];




$query = mysqli_query($conn, "SELECT * FROM `hebrew` WHERE `id` = '{$id}'");

$row = mysqli_fetch_array($query);

$book=$row['book'];

$chapter=$row['chapter'];

$verse=$row['verse'];

$value=$row['value'];

$word=$row['word'];



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
</script>

</head>

<body>

<div class="row">

  <div class="col-md-12">
  
  <h3>MARK THIS VERSE AS AN ERROR IN RICHARDS SO THE TEXT IS NOT PULLED</h3>
  
  </div>
  
  </div>


<form class="form-horizontal" method="POST" action="dontpull.php">
<fieldset>



<!-- Text input-->



<div class="form-group">
  <label class="col-md-4 control-label" for="book">Book</label>  
  <div class="col-md-4">
  <input id="book" name="book" value="<?php echo $book;?>" type="text" placeholder="BOOK" class="form-control input-md" readonly>
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="book">Chapter</label>  
  <div class="col-md-4">
  <input id="chapter" name="chapter" value="<?php echo $chapter;?>" type="text" placeholder="BOOK" class="form-control input-md" readonly>
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="book">Verse</label>  
  <div class="col-md-4">
  <input id="verse" name="verse" value="<?php echo $verse;?>" type="text" placeholder="BOOK" class="form-control input-md" readonly>
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="book">Word</label>  
  <div class="col-md-4">
  <input id="word" name="word" value="<?php echo $word;?>" type="text" placeholder="BOOK" class="form-control input-md" readonly>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="book">Value</label>  
  <div class="col-md-4">
  <input id="value" name="value" value="<?php echo $value;?>" type="text" placeholder="BOOK" class="form-control input-md" readonly>
    
  </div>
</div>


 <input type="hidden" id="id" name="id" value="<?php echo $id;?>">

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
   <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary">Mark</button>
  </div>
</div>

</fieldset>
</form>



</body>
</html>