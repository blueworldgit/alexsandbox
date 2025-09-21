<?php



include("./functions.php");

?>




<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0/dist/js.cookie.min.js" integrity="sha256-pUYbeWfQ0TisH2PabhAZLCzI8qGOJop0mEWjbJBcZLQ=" crossorigin="anonymous"></script>
<script>

function loadfirst() {
	
	bookval=1;
chapterval=1;
verseval=1;
	
	$.ajax({
type: 'POST',
url: './bookchapterverse.php',
data: { book: bookval, chapter: chapterval, verse: verseval } // getting filed value in serialize form
})


.done(function(data){
	
	$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);
	
	})
	
	
}
$(document).ready(function(){
	
	Cookies.set('where', '1');
$('#bookchapterverse').submit(function(e){
e.preventDefault();
$('#response').html("<img src='./ajax-loader.gif'>");
bookval=$("#book").val();
chapterval=$("#chapter").val();
verseval=$("#verse").val();
$.ajax({
type: 'POST',
url: './bookchapterverse.php',
data: { book: bookval, chapter: chapterval, verse: verseval } // getting filed value in serialize form
})


.done(function(data){
	
	$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);
	
	})
	})
	
	
	
	$('#previous').click(function(e){
e.preventDefault();
$('#response').html("<img src='./ajax-loader.gif'>");
keyid=Cookies.get('versepos');

$.ajax({
type: 'POST',
url: './bookchapterverseprevious.php',
data: { keyid: keyid } // getting filed value in serialize form
})


.done(function(data){
	
		keyid--;
		//Cookies.set('where', keyid,{ path: '/' });
	
	$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);
	
	})
	})
	
	
	
	$('#next').click(function(e){
e.preventDefault();
$('#response').html("<img src='./ajax-loader.gif'>");
keyid=Cookies.get('versepos');




$.ajax({
type: 'POST',
url: './bookchapterversenext.php',
data: { keyid: keyid } // getting filed value in serialize form
})


.done(function(data){
	
	keyid++;
		//Cookies.set('where', keyid,{ path: '/' });
	
	$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);
	
	})
	})
	
loadfirst();
	})
	
</script>

<style>

body {
  background-color: black;
  padding-top: 25px;
}


#tools .colone {
  border: 1px solid #00ff00;
}


#tools .coltwo {
  border: 1px solid #00ccff;
}

#tools .colthree {
  border: 1px solid #ffff00;
}


#tools .colfour {
  border: 1px solid #fb0b0b;;
}




.table-striped>tbody>tr:nth-child(odd)>td, 
.table-striped>tbody>tr:nth-child(odd)>th {
   background-color: #000000; // Choose your own color here
 }
 
 
 .table-striped>tbody>tr:nth-child(even)>td, 
.table-striped>tbody>tr:nth-child(even)>th {
   background-color: #000000; // Choose your own color here
 }

#response {
	
	padding-top:20px;
	
	
}
</style>



</head>

<body>

<div class="container">

<div class="row">

<div class="col-md-12">



<div id="bookchapterverse">


<form class="form-inline" method="POST" action="./bookchapterverse.php">

  <div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="book" class="form-control" name="book" id="book" placeholder="Book">
  </div>
  
  
  <div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="chapter" class="form-control" name="chapter" id="chapter" placeholder="Chapter">
  </div>
  
  <div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="verse" class="form-control" name="verse" id="verse" placeholder="Verse">
  </div>
  
  <button type="submit" class="btn btn-primary col-md-3" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Submit</button>
</form>
</div>

</div> <!--row-->
</div> <!--md-12-->


<div class="row" style="margin-top: 40px;">

<div class="col-md-12">

  <button id="previous" class="btn btn-primary col-md-6" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;"><span class="glyphicon glyphicon-backward">&nbsp;</span>Previous</button>
	
	
	  <button id="next" class="btn btn-primary col-md-6" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Next &nbsp; <span class="glyphicon glyphicon-forward"></span></button>

</div>
</div>

<div class="row">

<div class="col-md-12">

<div id="response"></div>

</div> <!--row-->
</div> <!--md-12-->
</div>

</body>
</html>