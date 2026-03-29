

<?php 
 header("Content-Type: text/html;charset=UTF-8");
include("./functions.php");



/*  

$hebrewText ="אבגדהוזחטיכלמנסעפצקרשתךםןףץ";


  $hebrewText ="
 

   ץףןםךתשרקצפעסנמלכיטחזוהדגבא
";

*/

$hebrewText=$_POST["text"];

echo "<p style='font-size: 45px;'>Accented: ".$hebrewText."</br></p>";


$hebrewText = preg_replace('/\p{Mn}/u', '', $hebrewText);


echo "<p style='font-size: 45px;'>Deaccented: ".$hebrewText."</br></p>";

 /*  $hebrewText ="
 כוןלגרקצפעסנמלכ
"; */

//echo $hebrewText;

//echo "<p></p>";

//$text = mb_str_split($hebrewText); //splitting text into symbols







