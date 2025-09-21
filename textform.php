<html>

<head>

<style>
.ELS-container input, .ELS-container input:focus {
    background-color: #140F28;
}



input[type="text"], input[type="search"], input[type="password"], input[type="email"], input[type="url"], input[type="tel"], select, input[type="text"], input[type="search"], input[type="password"], input[type="email"], input[type="url"], input[type="tel"], select, input[type="number"], .input-text.qty, body #ttr_content .cart .ttr_post input.input-text, .input-group  input#search, .form-search #searchbox #search_query_top {
    border-radius: 4px 4px 4px 4px;
    border: solid #CCCCCC;
    border: solid rgba(204,204,204,1);
    border-width: 1px 1px 1px 1px;
    box-shadow: none;
    font-size: 14px;
    font-family: "Times New Roman";
    font-weight: 400;
    font-style: normal;
    color: #555555;
    text-shadow: none;
    text-align: left;
    text-decoration: none;
    background-color: #140F28;
    background-clip: padding-box;
    padding: 6px;
    width: 100%;
    box-sizing: border-box;
	background-color: #140F28;
}


#biblebtn {
    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;
    padding: 5px;
    border: 1px solid white;
}


</style>

<script

  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
  
</script>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>


<script>

  $(document).ready(function(){
	  
	  
	  $('#getverse').submit(function(){
event.preventDefault();
	   
	   
//$('#verse').val('hikh');


var verse=$('#verseinput').val();

//alert(verse);


$.ajax({ url: './fetchtext.php',
         data: {verse: verse},
         type: 'post',
         success: function(data) {
                   
				   $('#versetext').val(data);
				   Cookies.set('verse', data);
                  }
});
	   
	   
	   })
  })
	   
	   
	   </script>
  
  
  </head>
  
  <body>

<form id="getverse" class="form-horizontal" method="POST" action="./fetchtext.php">
<fieldset>

<!-- Form Name -->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="book"></label>  
  <div class="col-md-4">
  <input id="verseinput" name="verseinput" type="text" placeholder="Example '412'" class="form-control input-md">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="book"></label>  
  <div class="col-md-4">
  <input id="versetext" name="versetext" type="text" placeholder="Enter a verse no above to get the Bible Text for that verse" class="form-control input-md" readonly>
    
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="biblebtn" type="submit" class="btn btn-danger">Submit</button>
  </div>
</div>

</fieldset>
</form>

</body>
</html>