<?php



include("./functions.php");

?>

<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>




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



</style>

</head>

<body>

<div class="container" id="tools">

 <div class="row">
 
 <div class="col-md-12">
 
 
 <form class="form-horizontal colone" method="GET" action="./querybibleorder.php">
<fieldset>

<!-- Form Name -->
<p style="color: #ffcc00;font-family: 'Times New Roman', Signika, Jura;font-size: 18pt;margin-left: 12px;">Search by Biblical Order</p>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="book" style="
    color: #fff;">Book Number</label>  
  <div class="col-md-4">
  <input id="book" name="book" type="text" placeholder="Example 66" class="form-control input-md">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="book" style="
    color: #fff;">Chapter Number</label>  
  <div class="col-md-4">
  <input id="chapter" name="chapter" type="text" placeholder="Example 12" class="form-control input-md">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="book" style="
    color: #fff;">Verse Number</label>  
  <div class="col-md-4">
  <input id="verse" name="verse" type="text" placeholder="Example 24" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-danger">Submit</button>
  </div>
</div>

</fieldset>
</form>
 
 </div> <!--md-12-->
 
 
 </div> <!--row-->

 <div class="row" style="margin-bottom: 150px;">
		  <div class="col-md-6">

<form class="form-horizontal colone" method="GET" action="./queryversetable.php">
<fieldset>

<!-- Form Name -->
<p style="color: #ffcc00;font-family: 'Times New Roman', Signika, Jura;font-size: 18pt;margin-left: 12px;">Search by Verse #</p>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="book"></label>  
  <div class="col-md-4">
  <input id="verse" name="verse" type="text" placeholder="Example 2435" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-danger">Submit</button>
  </div>
</div>

</fieldset>
</form>


</div>

		  <div class="col-md-6">

<form class="form-horizontal coltwo" method="GET" action="./querygemtable.php">
<fieldset>

<!-- Form Name -->
<p style="color: #ffcc00;font-family: 'Times New Roman', Signika, Jura;font-size: 18pt;margin-left: 12px;">Search by Gematria #</p>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="book"></label>  
  <div class="col-md-4">
  <input id="number" name="number" type="text" placeholder="Example 777" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-danger">Submit</button>
  </div>
</div>

</fieldset>
</form>


</div>

</div><!--row-->


 <div class="row">
		  <div class="col-md-6">

<form class="form-horizontal colthree" method="GET" action="./querystrongtable.php">
<fieldset>

<!-- Form Name -->
<p style="color: #ffcc00;font-family: 'Times New Roman', Signika, Jura;font-size: 18pt;margin-left: 12px;">Search by Strongs #</p>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="book"></label>  
  <div class="col-md-4">
  <input id="strong" name="strong" type="text" placeholder="Example H1254" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-danger">Submit</button>
  </div>
</div>

</fieldset>
</form>


</div>

		  <div class="col-md-6">

<form class="form-horizontal colfour" method="GET" action="./querywordtable.php">
<fieldset>

<!-- Form Name -->
<p style="color: #ffcc00;font-family: 'Times New Roman', Signika, Jura;font-size: 18pt;margin-left: 12px;">Search by Word</p>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="book"></label>  
  <div class="col-md-4">
  <input id="word" name="word" type="text" placeholder="Example light" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-danger">Submit</button>
  </div>
</div>

</fieldset>
</form>


</div>

</div><!--row-->

</div> <!--container-->
</body>
</html>