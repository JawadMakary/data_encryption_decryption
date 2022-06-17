<?php
// post method
function filterStringPost($str){
    // trim spaces and accept special chars
    $str=filter_input(INPUT_POST,$str);
    $str=trim($str," ");
    $str=htmlspecialchars($str);
    return $str;


}
// get method
function filterStringGet($str){
    $str=filter_input(INPUT_GET,$str);
    $str=trim($str," ");
    $str=htmlspecialchars($str);
    return $str;


}




?>