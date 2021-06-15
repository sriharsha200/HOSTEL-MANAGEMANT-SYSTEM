<?php
$cletter=false;$sletter=false;$integer=false;$special=false;
$regex="/^[a-z\.\@\#\%\^\&\_\\$\d]+[A-Z][A-Za-z\.\@\#\%\^\&\_\\$\d]+$/";
$regex1="/^[a-z\.\@\#\%\^\&\_\\$\d]+[A-Z]$/";
$regex2="/^[A-Z][A-Za-zz\.\@\#\%\^\&\_\\$\d]+$/";
$string="Sr@#N*F_hh";
if(preg_match($regex,$string) or preg_match($regex1,$string) or preg_match($regex2,$string)){
    $cletter=true;
}
$regex="/^[A-Z\.\@\#\%\^\&\_\\$\d]+[a-z][A-Za-z\.\@\#\%\^\&\_\\$\d]+$/";
$regex1="/^[A-Z\.\@\#\%\^\&\_\\$\d]+[a-z]$/";
$regex2="/^[a-z][A-Za-zz\.\@\#\%\^\&\_\\$\d]+$/";
if(preg_match($regex,$string) or preg_match($regex1,$string) or preg_match($regex2,$string)){
    $sletter=true;
}
$regex="/^[a-zA-Z\.\@\#\%\^\&\_\\$]+[\d][A-Za-z\.\@\#\%\^\&\_\\$\d]+$/";
$regex1="/^[a-zA-Z\.\@\#\%\^\&\_\\$]+[\d]$/";
$regex2="/^[\d][A-Za-zz\.\@\#\%\^\&\_\\$\d]+$/";
if(preg_match($regex,$string) or preg_match($regex1,$string) or preg_match($regex2,$string)){
    $integer=true;
}
$regex="/^[a-zA-Z\d]+[\.\@\#\%\^\&\_\\$][A-Za-z\.\@\#\%\^\&\_\\$\d]+$/";  
$regex1="/^[a-zA-Z\d]+[\.\@\#\%\^\&\_\\$]$/";  
$regex2="/^[\.\@\#\%\^\&\_\\$][A-Za-zz\.\@\#\%\^\&\_\\$\d]+$/";  
if(preg_match($regex,$string) or preg_match($regex1,$string) or preg_match($regex2,$string)){
    $special=true;
}
if(strlen($string)>=8 and strlen($string)<=20){
    if($cletter and $sletter and $integer and $special){
        echo 'Valid';
    }
    else{
        echo 'Not valid password try mixing characters integers and special characters';      
    }
}
else if(strlen($string)<8){
    echo 'password must be atleast 8 characters';
}
else{
    echo 'password should not exceed 20 characters';
}
?>