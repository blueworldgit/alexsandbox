<html>

<head>

<style>


.row{

    padding-bottom: 15px;
	
}	
	</style>
	
	
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	
	<script>
	
$(document).ready(function(){
	
	
	$('#getverses').click(function(e){
e.preventDefault();

$('#response').html("<h3>Please Wait</h3>");




book=$("#book").val();

$.ajax({
type: 'POST',
url: './querydifferencetablealexversion.php',
data: { book:book } // getting filed value in serialize form
})


.done(function(data){
	

$('#response').html(data);


	
	}) 
	}) //end of strongs
	


$('body').on('click', '.copy', function (){
       id=event.target.id;
       verse="text" + "-" + id;
	   providedtext=$('.' + verse).val();
	   
	  

$.ajax({
type: 'POST',
url: './copy.php',
data: { providedtext:providedtext,id:id} // getting filed value in serialize form
})


.done(function(data){
	

alert("verse copied");


	
	}) 
	
	
    });
	

$('body').on('click', '.delete', function (){
       id=event.target.id;
	 
	   
	   
	   


$.ajax({
type: 'POST',
url: './delete.php',
data: { id:id } // getting filed value in serialize form
})


.done(function(data){
	





alert("verse deleted");
	
	}) 
	
	
	
    });
	
});
	
	</script>
	
</head>	


<body>

<div class="container">

<div class="row">

<div class="col-md-12">

<h1>Please enter a Book from the list below
<h4>All books complete and uploaded, if it returns blank means no errors in that book</h4>


<form class="form-inlines" method="POST">

  <div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="book" class="form-control" name="book" id="book" placeholder="Book (Name OR Number)">
  </div>
  
  

  
  <button type="submit" id="getverses" class="btn btn-primary col-md-3" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Submit</button>
</form>

</div>

<div class="row">

<div class="col-md-12">

<div id="response"></div>

</div>
</div>



























	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</div>
	
	</div>
	
	
	
	</div>
	
	</body>
	
	
	</html>