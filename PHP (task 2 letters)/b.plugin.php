<?php
function b_info(){
    return "Количество cогласных букв в тексте";
}

function b_analysis($text){
	$count = preg_match_all('/[^aeiouyаеёиоуыэюя\PL]/iu', $text);
	//consonants
    return $count;
}
?> 