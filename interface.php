<?php

include("./functions.php");

if( isset($_GET['verse']) )
{
	
	$versevalue=$_GET['verse'];
    $system="theholybible#methods_standard";
}

else{
	
$versevalue=1;
$system="theholybible#methods_standard";	
	
}
?>




<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-170115400-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-170115400-1');
</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0/dist/js.cookie.min.js" integrity="sha256-pUYbeWfQ0TisH2PabhAZLCzI8qGOJop0mEWjbJBcZLQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

function loadfirst() {


//$("div.systemoptions select").val('<?php echo $system;?>').change();	

verseval=<?php echo $versevalue;?>;
system='<?php echo $system;?>';
	
	$.ajax({
type: 'POST',
url: './verse.php',
data: { verse: verseval, system:system } // getting filed value in serialize form
})


.done(function(data){
	
	$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);
	
	})
	
	
}
$(document).ready(function(){
	
	
	  $('#options_radio_box').change(function(){
		  
		  
		  selected_value = $("input[name='radios']:checked").val();
            
			if(selected_value==1) {
				$('#two').show();
		$('#one').hide();
		$('#three').hide();
		
			}
			
			
				if(selected_value==2) {
	
		
		
			$('#one').show();
		$('#two').hide();
		$('#three').hide();
		
			}
			
			
				if(selected_value==3) {
			$('#three').show();
		$('#two').hide();
		$('#one').hide();
		
			}
		
		
        });
	
	
	$('.fancyframe').fancybox({
 'type':'iframe',
 'width': 600, //or whatever you want
 'height': 300
});
	
	Cookies.set('where', '1');
$('#bcv').click(function(e){
e.preventDefault();

$('#response').html("<img src='./ajax-loader.gif'>");
bookval=$("#book").val();
chapterval=$("#chapter").val();
verseval=$("#verse").val();
system=$("#system").val();
$.ajax({
type: 'POST',
url: './bookchapterverse.php',
data: { book: bookval, chapter: chapterval, verse: verseval, system:system } // getting filed value in serialize form
})


.done(function(data){
	
	$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);
	
	})
	})
	
	
	$('#strongbtn').click(function(e){
e.preventDefault();




$('#responsetwo').html("<img src='./ajax-loader.gif'><h3 style='color:#FFA500'>Please wait this can take up to a minute when there are more than 150 results</h3>");

strong=$("#strong").val();

$.ajax({
type: 'POST',
url: './querystrong.php',
data: { strong:strong } // getting filed value in serialize form
})


.done(function(data){
	
	$("#responsetwo").css("display", "none");
// show the response
$('#responsetwo').html(data);

 $('#responsetwo').fadeIn(2000);
	
	}) 
	}) //end of strongs
	
	
	
		$('#wordbtn').click(function(e){
e.preventDefault();

$('#responsetwo').html("<img src='./ajax-loader.gif'><h3 style='color:#FFA500'></h3>");

$('#responsetwo').html("<img src='./ajax-loader.gif'><h3 style='color:#FFA500'></h3>");

load_data_queryword()

	}) //end of word query
	
	
function load_data_queryword(page) {

$('#responsetwo').html("<img src='./ajax-loader.gif'><h3 style='color:#FFA500'></h3>");

word=$("#word").val();
language=$("#language").val();
wordpattern=$('#wordpattern').is(":checked");

if(wordpattern) {wordpattern="fullword";} else {wordpattern="pattern";}


$.ajax({
type: 'POST',
url: './querywordtable.php',
data: {page:page,wordpattern:wordpattern,language:language, word:word } // getting filed value in serialize form
})


.done(function(data){
	

// show the response
$('#responsetwo').html(data);


	
	}) 
}
	
	    $(document).on('click', '.pagination_link_queryword', function(){  
           var page = $(this).attr("id");

	   
		   
           load_data_queryword(page); 
		   
      });  
	
	
		//$('#gematriatotalbtn').click(function(e){
			//e.preventDefault();
			
			
				
		$('#gematriatotalbtn').click(function(e){
e.preventDefault();

$('#responsetwo').html("<img src='./ajax-loader.gif'><h3 style='color:#FFA500'></h3>");

$('#responsetwo').html("<img src='./ajax-loader.gif'><h3 style='color:#FFA500'></h3>");

load_data_querygem()

	}) //end of word query
			
			function load_data_querygem(page) {





$('#responsetwo').html("<img src='./ajax-loader.gif'><h3 style='color:#FFA500'>Please wait this can take up to a minute when there are more than 50 results</h3>");

versetotal=$("#versetotal").val();
system=$("#system").val();
duplicateword=$("#duplicateword").is(":checked");


if(duplicateword) {duplicateword="remove";} else {duplicateword="allow";}

//system=$("#strong").val();




$.ajax({
type: 'POST',
url: './querygemtable.php',
data: { versetotal:versetotal,system:system,duplicateword:duplicateword,page:page } // getting filed value in serialize form
})


.done(function(data){
	
	$("#responsetwo").css("display", "none");
// show the response
$('#responsetwo').html(data);

 $('#responsetwo').fadeIn(2000);
	
	}) 
	} //end of gematria total search
	
	
	
	   $(document).on('click', '.pagination_link_querygem', function(){  
           var page = $(this).attr("id");

	   
		   
           load_data_querygem(page); 
		   
      });  
	
	
	
			$('#ultrasearchbtn').click(function(e){
e.preventDefault();




$('#responsetwo').html("<img src='./ajax-loader.gif'><h3 style='color:#FFA500'>Please wait this can take up to a minute when there are more than 50 results</h3>");

ultraversetotal=$("#ultraversetotal").val();
system=$("#ultrasystemoptions").val();
firstonly=$("#firstonly").is(":checked");


if(firstonly) {firstonly="starting";} else {firstonly="anywhere";}




$.ajax({
type: 'POST',
url: './ultrabackend.php',
data: { ultraversetotal:ultraversetotal,system:system,firstonly:firstonly  } // getting filed value in serialize form
})


.done(function(data){
	
	$("#responsetwo").css("display", "none");
// show the response
$('#responsetwo').html(data);

 $('#responsetwo').fadeIn(2000);
	
	}) 
	}) //end of ultra search
	
	
			$('#methodtotalbtn').click(function(e){
e.preventDefault();
$('#responsetwo').html();
load_data_querymethods()
})



function load_data_querymethods(page) {

methodversetotal=$("#methodversetotal").val();
system=$("#methodsystemoptions").val();
totalmethodoptions=$("#totalmethodoptions").val();
//system=$("#strong").val();




$.ajax({
type: 'POST',
url: './methodsbackend.php',
data: {page:page, methodversetotal:methodversetotal,system:system,totalmethodoptions:totalmethodoptions } // getting filed value in serialize form
})


.done(function(data){
	

$('#responsetwo').html(data);


	
	}) 
	
}

    $(document).on('click', '.pagination_link_querymethods', function(){  
           var page = $(this).attr("id");

	   
		   
           load_data_querymethods(page); 
		   
      });  
	 //end of method  search
	
	$('#rotator').click(function(e){
e.preventDefault();


$('#response').html("<img src='./ajax-loader.gif'>");

verse=$("#verseno").val();
system=$("#system").val();
$.ajax({
type: 'POST',
url: './verse.php',
data: { verse: verse, system:system } // getting filed value in serialize form
})


.done(function(data){
	
	$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);
	
	})
	})
	
	// Language switch button handler - same pattern as verse button
	$('#language_switch').click(function(e){
		e.preventDefault();
		
		$('#response').html("<img src='./ajax-loader.gif'>");
		
		// Get current verse position to maintain it after language switch
		keyid = Cookies.get('versepos');
		system = $("#system").val();
		
		$.ajax({
			type: 'POST',
			url: './switch_language.php',
			data: { keyid: keyid, system: system } // pass current verse and system
		})
		.done(function(data){
			$("#response").css("display", "none");
			// show the response
			$('#response').html(data);
			$('#response').fadeIn(2000);
		})
	})
	
	$("#system").change(function(){



$('#response').html("<img src='./ajax-loader.gif'>");
keyid=Cookies.get('versepos');
system=$("#system").val();
db_type='<?php echo $_SESSION['db_type']; ?>';

$.ajax({
type: 'POST',
url: './systemswitch.php',
data: { keyid:keyid, system:system, db_type:db_type } // getting filed value in serialize form
})


.done(function(data){
	
		keyid--;
		//Cookies.set('where', keyid,{ path: '/' });
	
	$("#response").css("display", "none");
// show the response
$('#response').html(data);

 $('#response').fadeIn(2000);
	
	})
	
	
});
	
	$('#previous').click(function(e){
e.preventDefault();
$('#response').html("<img src='./ajax-loader.gif'>");
keyid=Cookies.get('versepos');
system=$("#system").val();
db_type='<?php echo $_SESSION['db_type']; ?>';

console.log('PREVIOUS BUTTON DEBUG:');
console.log('keyid:', keyid);
console.log('system:', system);
console.log('db_type:', db_type);
console.log('Session db_type from PHP:', '<?php echo $_SESSION['db_type']; ?>');

$.ajax({
type: 'POST',
url: './bookchapterverseprevious.php',
data: { keyid: keyid,system:system,db_type:db_type } // getting filed value in serialize form
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
system=$("#system").val();
db_type='<?php echo $_SESSION['db_type']; ?>';

console.log('NEXT BUTTON DEBUG:');
console.log('keyid:', keyid);
console.log('system:', system);
console.log('db_type:', db_type);
console.log('Session db_type from PHP:', '<?php echo $_SESSION['db_type']; ?>');

$.ajax({
type: 'POST',
url: './bookchapterversenext.php',
data: { keyid: keyid,system:system,db_type:db_type } // getting filed value in serialize form
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
  font-family: new roman !important;
  font-size: 17px;
}


#tools .colone {
  border: 1px solid #00ff00;
}


#tools .coltwo {
  border: 1px solid #73ffff;
}

#tools .colthree {
  border: 1px solid #ffff00;
}


#tools .colfour {
  border: 1px solid #ff193d;;
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

.radio-inline {
	
	color: #ffffff !important;
	
	
}


a {
    color: #bfe6ef !important;
    text-decoration: none;
}
</style>



</head>

<body>

<div class="container">

<div class="row">

<div class="col-md-12">

<p style="
   text-align: center;
    font-size: 16px;
    color: #ffa500;
    margin-bottom: 0px;
"> Change gematria system </p>

 <div class="form-group">

  <div class="col-md-12" style="
    margin-bottom: 20px;
    margin-top: 15px;
">
      


<div class="systemoptions">
    
<?php if($_SESSION['db_type'] == 'english') { ?>
    <select id="system" name="system" class="form-control">
        <option value="theholybible#methods_standard">standard</option>
        <option value="theholybibleordinal#methods_ordinal">ordinal</option>
        <option value="theholybiblereduced#methods_reduced">reduced</option>
  
        <option value="theholybiblereversedstandard#methods_reversedstandard">reverse standard</option>
        <option value="theholybiblereversedordinal#methods_reversedordinal">reverse ordinal</option>
        <option value="theholybiblereversedreduced#methods_reversedreduced">reverse reduced</option>
        <option value="theholybibleone#methods_one">ord + std</option>
        <option value="theholybibletwo#methods_two">red + ord + std</option>

        <option value="theholybiblefive#methods_five">rev ord + rev std</option>
        <option value="theholybiblesix#methods_six">rev red + rev ord + rev std</option>
    </select>
<?php } else { ?>
    <select id="system" name="system" class="form-control">
        <option value="theholybible#methods_standard">standard</option>
        <option value="theholybibleordinal#methods_ordinal">ordinal</option>
        <option value="theholybiblereduced#methods_reduced">reduced</option>
        <option value="theholybiblefullstandard#methods_fullstandard">Full standard</option>
        <option value="theholybiblefullordinal#methods_fullordinal">Full ordinal</option>
        <option value="theholybiblefullreduced#methods_fullreduced">Full reduced</option>
        <option value="theholybiblereversedstandard#methods_reversedstandard">reverse standard</option>
        <option value="theholybiblereversedordinal#methods_reversedordinal">reverse ordinal</option>
        <option value="theholybiblereversedreduced#methods_reversedreduced">reverse reduced</option>
        <option value="theholybibleone#methods_one">ord + std</option>
        <option value="theholybibletwo#methods_two">red + ord + std</option>
        <option value="theholybiblethree#methods_three">Full ord + Full std</option>
        <option value="theholybiblefour#methods_four">Full red + Full ord + Full std</option>
        <option value="theholybiblefive#methods_five">rev ord + rev std</option>
        <option value="theholybiblesix#methods_six">rev red + rev ord + rev std</option>
    </select>
<?php } ?>



  </div>
  </div>
</div>

</div>

</div>

<div class="row">

<div class="col-md-12" style="margin-bottom:20px;">

<p style="
   text-align: center;
    font-size: 16px;
    color: #ffa500;
    margin-bottom: 0px;
">Search by book name/number, chapter number & verse number</p>

<div id="bookchapterverse">


<form class="form-inline" method="POST" action="./bookchapterverse.php">

  <div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="book" class="form-control" name="book" id="book" placeholder="Book (Name OR Number)">
  </div>
  
  
  <div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="chapter" class="form-control" name="chapter" id="chapter" placeholder="Chapter">
  </div>
  
  <div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="verse" class="form-control" name="verse" id="verse" placeholder="Verse">
  </div>
  
  <button type="submit" id="bcv" class="btn btn-primary col-md-3" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Submit</button>
</form>
</div>

</div> <!--row-->
</div> <!--md-12-->


<div class="row">

<div class="col-md-12">

<p style="
   text-align: center;
    font-size: 16px;
    color: #ffa500;
   
"> Search by verse order </p>


<div id="bookchapterverse">


<form class="form-inline" method="POST" name="verserotator" id="verserotator" action="./verse.php">

  <div class="form-group  col-md-6">
    <label for="inputPassword2" class="sr-only"></label>
    <input type="verseno" style="width: 100%;" class="form-control" name="verseno" id="verseno" placeholder="Verse#">
  </div>
  
  
 
  
 
  
  <button name="rotator" id="rotator" class="btn btn-primary col-md-6" style="    background-color: #3f111c;
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


<div class="row">

<div class="col-md-12">

<center>

<form id="options_radio_box">
<div class="form-group">
  <label class="col-md-12 control-label" for="radios"></label>
  <div class="col-md-12"> 
    <label class="radio-inline" for="radios-0">
      <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
     Search Gematria
    </label> 
    <label class="radio-inline" for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="2">
         Search Methods 
    </label> 
    <label class="radio-inline" for="radios-2">
      <input type="radio" name="radios" id="radios-2" value="3">
     Search Ultra Calculation
    </label> 
   
  </div>
</div>

</form>

</center>
</div>
</div>


<div id="three" style="display:none;">

<div class="row">

<div class="col-md-12">

<p style="
   text-align: center;
    font-size: 16px;
    color: #ffa500;
    margin-bottom: 0px;
	margin-top:15px;
"> Search Ultra Calculation </p>


<div id="bookchapterverse">


<form class="form-inlines" method="POST" name="verserotator" id="verserotator" action="./querygemtable.php">

	  <div class="form-group col-md-12">
  <label class="col-md-12 control-label" for="checkboxes"></label>
  <div class="col-md-12">
  <div class="checkbox">
  <label for="checkboxes-0" style="   color: #ffa500;
    font-size: 16px;
    margin: bottom:5px;
    margin-top: -15px;
    margin-bottom: -15px;">
      <input type="checkbox" name="firstonly" id="firstonly" checked="checked"  >
     Return results only when the starting digits match the search criteria</br>
	 Uncheck this box if you want results matched at any part of the ultracalculation total
    </label>
	</div>

  </div>
</div>


<div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only"></label>
    <input type="verseno" style="width: 100%;" class="form-control" name="ultraversetotal" id="ultraversetotal" placeholder="Example 777">
  </div>
  
  
  
    <div class="form-group  col-md-3">
   <div class="ultraoptions">
 <select id="ultrasystemoptions" name="system" class="form-control">
      <option value="standard">standard</option>
      <option value="ordinal">ordinal</option>
	  <option value="reduced">reduced</option>
	   <option value="fullstandard">Full standard</option>
      <option value="fullordinal">Full ordinal</option>
	  <option value="fullreduced">Full reduced</option>
	   <option value="reversedstandard">reverse standard</option>
      <option value="reversedordinal">reverse ordinal</option>
	  <option value="reversedreduced">reverse reduced</option>

    </select>

  </div>
  </div>
  
 
  
  <button name="ultrasearchbtn" id="ultrasearchbtn" class="btn btn-primary col-md-6" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Submit</button>
</form>
</div>

</div> <!--row-->
</div> <!--md-12//ultrasearch-->
</div> <!--three-->

<div id="one" style="display:none;">
<div class="row">

<div class="col-md-12">

<p style="
   text-align: center;
    font-size: 16px;
    color: #ffa500;
    margin-bottom: 0px;
	margin-top:15px;
"> Search Methods </p>


<div id="bookchapterverse">


<form class="form-inlines" method="POST" name="verserotator" id="verserotator" action="./querygemtable.php">

<div class="form-group  col-md-2">
    <label for="inputPassword2" class="sr-only"></label>
    <input type="verseno" style="width: 100%;" class="form-control" name="versetotal" id="methodversetotal" placeholder="Example 777">
  </div>
  
  
  
    <div class="form-group  col-md-2">
   <div class="systemoptions">
 <select id="methodsystemoptions" name="system" class="form-control">
      <option value="theholybible#methods_standard">standard</option>
      <option value="theholybibleordinal#methods_ordinal">ordinal</option>
	  <option value="theholybiblereduced#methods_reduced">reduced</option>
	  <option value="theholybiblefullstandard#methods_fullstandard">Full standard</option>
      <option value="theholybiblefullordinal#methods_fullordinal">Full ordinal</option>
	  <option value="theholybiblefullreduced#methods_fullreduced">Full reduced</option>
	   <option value="theholybiblereversedstandard#methods_reversedstandard">reverse standard</option>
      <option value="theholybiblereversedordinal#methods_reversedordinal">reverse ordinal</option>
	  <option value="theholybiblereversedreduced#methods_reversedreduced">reverse reduced</option>
	  <option value="theholybibleone#methods_one">ord + std </option>
		  <option value="theholybibletwo#methods_two">red + ord + std</option>
		    <option value="theholybiblethree#methods_three">Full ord + Full std</option>
			  <option value="theholybiblefour#methods_four">Full red + Full ord + Full std</option>
			    <option value="theholybiblefive#methods_five">rev ord + rev std</option>
				  <option value="theholybiblesix#methods_six">rev red + rev ord + rev std</option>

	

    </select>

  </div>
  </div>
  
  
      <div class="form-group  col-md-2">
   <div class="ultrasystemoptions">
 <select id="totalmethodoptions" name="system" class="form-control">
      <option value="no_words"><span id="green">No.W</span></option>
	  <option value="no_letters">No.L</option>
	  <option value="total_letters_words">No.W + No.L</option>
      <option value="F.L.L">FLL</option>
      <option value="C.L">CL</option>
	  <option value="F.L.C.L">FLCL</option>
	   <option value="2_F.L.L">2 FLL</option>
      <option value="3/4_CL">3/4 CL </option>
	  <option value="2_FLL_+_3/4_CL"> 2 FLL + 3/4 CL </option>
	   <option value="FLW">FLW</option>
      <option value="CW">CW</option>
	  <option value="FLCW">FLCW </option>
	  	   <option value="W_surr_CW">W. surr. CW</option>
      <option value="2_FLW">2 FLW </option>
	  <option value="3/4_CW"> 3/4 CW  </option>
	  <option value="2_FLW_+_3/4_CW">2 FLW + 3/4 CW  </option>

      <option value="W_upto_CW">W. up to CW</option>
	  <option value="W_from_CW">W. from CW </option>
	

    </select>

  </div>
  </div>
  
 
  
  <button name="ultrasearchbtn" id="methodtotalbtn" class="btn btn-primary col-md-6" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Submit</button>
</form>
</div>

</div> <!--row-->
</div> <!--md-12//methods-->
</div>  <!--three-->

<div id="two" >

<div class="row">

<div class="col-md-12">

<p style="
   text-align: center;
    font-size: 16px;
    color: #ffa500;
    margin-bottom: 0px;
	margin-top:15px;
"> Search Gematria </p>


<div id="bookchapterverse">


<form class="form-inline" method="POST" name="verserotator" id="verserotator" action="./querygemtable.php">



  <div class="form-group  col-md-6">
    <label for="inputPassword2" class="sr-only"></label>
    <input type="verseno" style="width: 100%;" class="form-control" name="versetotal" id="versetotal" placeholder="Example 777">
  </div>
  
  
 
  
 
  
  <button name="gematriatotalbtn" id="gematriatotalbtn" class="btn btn-primary col-md-6" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Submit</button>
	
	


	  <div class="form-group col-md-12">
  <label class="col-md-12 control-label" for="checkboxes"></label>
  <div class="col-md-12">
  <div class="checkbox">
  <label for="checkboxes-0" style="   color: #ffa500;
    font-size: 16px;
    margin: bottom:5px;
    margin-top: 15px;
    margin-bottom: -8px;">
      <input type="checkbox" name="duplicateword" id="duplicateword" checked="checked"  >
     Remove duplicates from search result
    </label>
	</div>

  </div>
</div>

</form>
</div>

</div> <!--row-->
</div> <!--md-12-->
</div>


<div class="row">

<div class="col-md-12">

<p style="
   text-align: center;
    font-size: 16px;
    color: #ffa500;
    margin-bottom: 0px;
	margin-top:15px;
"> Search Strong's number </p>


<div id="bookchapterverse">


<form class="form-inline" method="POST" name="strongsearch" id="strongsearch" action="./strongsearch.php">

  <div class="form-group  col-md-6">
    <label for="inputPassword2" class="sr-only"></label>
    <input type="verseno" style="width: 100%;" class="form-control" name="strong" id="strong" placeholder="Example H2906">
  </div>
  
  
 
  
 
  
  <button name="strongbtn" id="strongbtn" class="btn btn-primary col-md-6" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Submit</button>
</form>
</div>

</div> <!--row-->
</div> <!--md-12-->



<div class="row">

<div class="col-md-12" style="padding-bottom: 50px;">
    
     

<p style="
  text-align: center;
    font-size: 16px;
    color: #ffa500;
    margin-bottom: 0px;
	margin-top:15px;
	
"> Find words or phrases in English, Hebrew or Greek </p>


<div id="bookchapterverse">


<form class="form-inlines" method="POST" name="verserotator" id="verserotator" action="./querywordtable.php">



  
  
  <div class="form-group  col-md-3">
    <label for="inputPassword2" class="sr-only"></label>
    <input type="verseno" style="width: 100%;" class="form-control" name="word" id="word" placeholder="Example Truth">
  </div>
  
  
 
 <div class="form-group  col-md-3">
    <div class="systemoptions">
 <select id="language" name="language" class="form-control">
      <option value="english">English</option>
      <option value="hebrew">Hebrew (O.T)</option>
	  <option value="greek">Greek (N.T)</option>

    </select>

  </div>
  </div>
  
  
    <div class="form-group  col-md-6"> 
  <button name="wordbtn" id="wordbtn" class="btn btn-primary col-md-12" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;">Submit</button>
	</div>
  
  <div class="form-group col-md-12">
  <label class="col-md-12 control-label" for="checkboxes"></label>
  <div class="col-md-12">
  <div class="checkbox">
  <label for="checkboxes-0" style="color: #ffa500;margin-top: -15px;font-size: 16px;">
      <input type="checkbox" name="wordpattern" id="wordpattern" checked="checked"  >
     Find whole words only
    </label>
	</div>

  </div>
</div>
  
  
 

</form>
</div>

</div> <!--row-->
</div> <!--md-12-->



<div class="row">

<div class="col-md-12">

<div id="responsetwo"  style="margin-top: -60px;"></div>

</div> <!--row-->
</div> <!--md-12-->

<div class="row">

<div class="col-md-12"">


<!-- <div class="current-db">
        Current Database: <?php //echo get_db_display_name(); ?>
    </div> -->
    
   
     
   
	<button name="language_switch" id="language_switch" class="btn btn-primary col-md-6" style="    background-color: #3f111c;
    color: #dedede;
    border-width: 1px;
    border-color: #ffffff;     width: 100%;
    margin-bottom: 12px;" fdprocessedid="5tcvor">Switch to <?php echo ($_SESSION['db_type'] == 'english') ? 'Hebrew/Greek' : 'English (KJV)'; ?> Database</button>
	
</div>

</div>
</div>

</body>
</html>