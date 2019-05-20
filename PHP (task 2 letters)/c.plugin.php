<?php
function c_info(){
    return "Количество цифр в тексте";
}

function c_analysis($text){
	$count = preg_match_all('/\pN/u', $text);
	//[0-9]
    return $count;
}
?> 