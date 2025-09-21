
<?php
 
 header("Content-Type: text/html;charset=UTF-8");
 include("./functionstwo.php");
 
 error_reporting(0);
function _uniord($c) {
    if (ord($c{0}) >=0 && ord($c{0}) <= 127)
        return ord($c{0});
    if (ord($c{0}) >= 192 && ord($c{0}) <= 223)
        return (ord($c{0})-192)*64 + (ord($c{1})-128);
    if (ord($c{0}) >= 224 && ord($c{0}) <= 239)
        return (ord($c{0})-224)*4096 + (ord($c{1})-128)*64 + (ord($c{2})-128);
    if (ord($c{0}) >= 240 && ord($c{0}) <= 247)
        return (ord($c{0})-240)*262144 + (ord($c{1})-128)*4096 + (ord($c{2})-128)*64 + (ord($c{3})-128);
    if (ord($c{0}) >= 248 && ord($c{0}) <= 251)
        return (ord($c{0})-248)*16777216 + (ord($c{1})-128)*262144 + (ord($c{2})-128)*4096 + (ord($c{3})-128)*64 + (ord($c{4})-128);
    if (ord($c{0}) >= 252 && ord($c{0}) <= 253)
        return (ord($c{0})-252)*1073741824 + (ord($c{1})-128)*16777216 + (ord($c{2})-128)*262144 + (ord($c{3})-128)*4096 + (ord($c{4})-128)*64 + (ord($c{5})-128);
    if (ord($c{0}) >= 254 && ord($c{0}) <= 255)    //  error
        return FALSE;
    return 0;
}

function mb_str_split($string) {
    $strlen = mb_strlen($string);
    while ($strlen) {
        $array[] = mb_substr($string,-1,1,"UTF-8");
        $string = mb_substr($string,0,$strlen-1,"UTF-8");
        $strlen = mb_strlen($string);

////////print_r ($array);
    }
    return $array;
}


function mb_strrev($str){
    $r = '';
    for ($i = mb_strlen($str); $i>=0; $i--) {
        $r .= mb_substr($str, $i, 1);
    }
    return $r;
}


$greektext=$_POST["text"];

echo "<p style='font-size: 45px;'>Accented: ".$greektext."</br></p>";





$greektext = preg_replace('/[0-9]+/', '', $greektext);





$greektext=str_replace(".","","$greektext");
$greektext=str_replace(",","","$greektext");
 $greektext= mb_strtolower($greektext, 'UTF-8');
$greektext=removeAccents($greektext);
 
echo "<p style='font-size: 45px;'>Deaccented: ".$greektext."</br></p>";

