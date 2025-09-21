

<html>
<head>
<title>lets check</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0/dist/js.cookie.min.js" integrity="sha256-pUYbeWfQ0TisH2PabhAZLCzI8qGOJop0mEWjbJBcZLQ=" crossorigin="anonymous"></script>



 <script>  
 $(document).ready(function(){  
 
 
 	$('#versebtn').click(function(e){
e.preventDefault();






$('#pagination_data').html("<h3 style='color:#000000'>Loading</h3>");

book=$("#book").val();




$.ajax({
type: 'POST',
url: './letscheckhandler.php',
data: { book:book } // getting filed value in serialize form
})


.done(function(data){
	
	$("#pagination_data").css("display", "none");
// show the response
$('#pagination_data').html(data);

 $('#pagination_data').fadeIn(2000);
	
	}) 
	}) //end verse btn
	
      load_data();  
      function load_data(page)  
      {  
	  
	  
	
	  book=$("#book").val();
           $.ajax({  
                url:"letscheckhandler.php",  
                method:"POST",  
                data:{page:page,book:book},  
                success:function(data){  
                    	$("#pagination_data").css("display", "none");
// show the response
$('#pagination_data').html(data);

 $('#pagination_data').fadeIn(3000);
                }  
           })  
      }  
      $(document).on('click', '.pagination_link', function(){  
	  
	  

           var page = $(this).attr("id"); 
		   
           load_data(page);  
      });  
 });  
 </script>
</head>
<body>

<div class="col-md-12">



<form method="POST" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>ENTER A BOOK NO</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput"></label>  
  <div class="col-md-4">
  <input id="book" name="book" type="text" placeholder="Book No" class="form-control input-md">

  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="versebtn"  name="versebtn"  class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>


<div id="pagination_data"></div>



</body>
</html>