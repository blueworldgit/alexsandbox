<?php  
 
include("./db/db.php");


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
'ῧ', 'ϋ',

'ὠ', 'ὡ', 'ὢ', 'ὣ', 'ὤ', 'ὥ', 'ὦ', 'ὧ', 'ὼ', 'ώ', 'ῶ', 

'ῲ', 'ῳ', 'ῴ', 'ῷ', 'ᾧ', 'ᾠ', 'ᾦ'  






  
);
  $b = array(
'', '', '',
'α', 'α', 'α', 'α', 'α', 'α', 'α', 'α', 'α', 'α', 'α',
'αι', 'αι' , 'αι', 'αι', 'αι', 'αι', 'αι', 'αι', 'αι', 'αι', 'αι', 'αι', 'αι', 'αι',

'ε', 'ε' , 'ε', 'ε', 'ε', 'ε', 'ε', 'ε',

'η', 'η' , 'η' , 'η' , 'η' , 'η' , 'η' , 'η' , 'η' , 'η' , 'η', 

'ηι', 'ηι' , 'ηι', 'ηι', 'ηι', 'ηι', 'ηι', 'ηι', 'ηι', 'ηι', 'ηι', 'ηι',

'ι', 'ι' , 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι', 'ι',

 'ι', 'ι', 'ι', 'ι',

'ο', 'ο', 'ο', 'ο', 'ο', 'ο', 'ο', 'ο',

'ρ', 'ρ',

'υ', 'υ', 'υ','υ','υ','υ','υ','υ','υ','υ','υ','υ','υ','υ','υ','υ', 'υ',

'ω', 'ω' , 'ω', 'ω', 'ω', 'ω', 'ω', 'ω', 'ω', 'ω', 'ω',

'ωι', 'ωι' , 'ωι', 'ωι', 'ωι', 'ωι', 'ωι'

  
  
  
    );
  return str_replace($a, $b, $str);
}

function writeEnglish($conn,$english,$standard,$ordinal,$reduced,$fullstandard,$fullordinal,
$fullreduced,$reversestandard,$reverseordinal,$reversereduced) {
	
	$sql="INSERT INTO `english` (`id`, `circuit`, `standard`, `ordinal`, `reduced`, `fullstandard`, `fullordinal`, `fullreduced`, `reversestandard`, `reverseordinal`, `reversereduced`) 
VALUES (NULL, '{$english}', '{$standard}', '{$ordinal}', '{$reduced}', '{$fullstandard}', '{$fullordinal}', '{$fullreduced}', '{$reversestandard}', '{$reverseordinal}', '{$reversereduced}');";
	
	if (mysqli_query($conn, $sql)) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}


function writeHebrew($conn,$hebrew,$standard,$ordinal,$reduced,$fullstandard,$fullordinal,
$fullreduced,$reversestandard,$reverseordinal,$reversereduced) {
	
	$sql="INSERT INTO `hebrew` (`id`, `circuit`, `standard`, `ordinal`, `reduced`, `fullstandard`, `fullordinal`, `fullreduced`, `reversestandard`, `reverseordinal`, `reversereduced`) 
VALUES (NULL, '{$hebrew}', '{$standard}', '{$ordinal}', '{$reduced}', '{$fullstandard}', '{$fullordinal}', '{$fullreduced}', '{$reversestandard}', '{$reverseordinal}', '{$reversereduced}');";
	
	if (mysqli_query($conn, $sql)) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}


function writeGreek($conn,$greek,$standard,$ordinal,$reduced,$fullstandard,$fullordinal,
$fullreduced,$reversestandard,$reverseordinal,$reversereduced) {
	
	$sql="INSERT INTO `greek` (`id`, `circuit`, `standard`, `ordinal`, `reduced`, `fullstandard`, `fullordinal`, `fullreduced`, `reversestandard`, `reverseordinal`, `reversereduced`) 
VALUES (NULL, '{$greek}', '{$standard}', '{$ordinal}', '{$reduced}', '{$fullstandard}', '{$fullordinal}', '{$fullreduced}', '{$reversestandard}', '{$reverseordinal}', '{$reversereduced}');";
	
	if (mysqli_query($conn, $sql)) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}

?>