<?php
function a_info(){
    return "Количество гласных букв в тексте";
}

function a_analysis($text){
	$line = '/[aeiouyаеёиоуыэюя]/iu';
	$count = preg_match_all($line, $text);
	//vowels
    return $count;
}
?> 