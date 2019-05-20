<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Шифр Бэкона</title>
	<style>
    body { 
     font-family: cursive;
    }
	</style> 
</head>
<body>
<form action="" method="post" >
	<p>Введите текст на английском языке для шифрования (не более 27 символов) или дешифрования:</p>
	<input type="text" name="inputstr"/>
	<input type="submit" name="encode" value="Зашифровать"/>
	<input type="submit" name="decode" value="Расшифровать"/>
</form>
</body>
</html>

<?php

$alphabet_bacon = array(
'a' => '11111', 
'b' => '11110', 
'c' => '11101', 
'd' => '11100', 
'e' => '11011',
'f' => '11010',
'g' => '11001',
'h' => '11000',
'i' => '10111',
'j' => '00011',
'k' => '10110',
'l' => '10101',
'm' => '10100',
'n' => '10011',
'o' => '10010',
'p' => '10001',
'q' => '10000',
'r' => '01111',
's' => '01110',
't' => '01101',
'u' => '01100',
'v' => '00010',
'w' => '01011',
'x' => '01010',
'y' => '01001',
'z' => '01000');

if (isset ($_POST['encode'])){
	$salt = "with the lights out it's less dangerous,
	here we are now, entertain us,
	i feel stupid and contagious,
	here we are now, entertain us,
	a mulatto, an albino, a mosquito, my libido";
	$length_salt = strlen($salt);
	$length_salt_simb = preg_match_all('/[a-z]/i',$salt);
	$limit = $length_salt_simb/5;
	$input_str = $_POST['inputstr'];
	if (!empty($input_str)) {
		if (preg_match ('/[a-z]/i', $input_str)){
			$length_inputstr = strlen($input_str);
			if ($length_inputstr > $limit){
				print 'Предупреждение: зашифрованы только первые&nbsp;';
				print $limit;
				print '&nbsp;допустимых символов.';
			}
			for ($i=0; $i<$length_inputstr; $i++) {
				$letter = substr($input_str, $i, 1);
				if (preg_match ('/[a-z]/i', $letter)){
					$search_letter = preg_match ('/[a-z]/i', $letter, $matches);
					$name_letter = mb_strtolower($matches[0]);
					$array1[$i] = $alphabet_bacon[$name_letter];
				}
			}
			$mask = implode($array1);
			$k=0;
			print '<p>Зашифрованный текст:</p><p>';
			for ($j=0; $j<$length_salt; $j++) {
				$encoded_letter = substr($salt, $j, 1);
				if (preg_match('/\pL/i', $encoded_letter)) {
					$bool = substr($mask, $k, 1);
					if ($bool == '1') {
						$encoded_letter_up = mb_strtoupper($encoded_letter);
						print "<font face = 'monospace', size = 3 >";
						print $encoded_letter_up;
						print '</font>';
						$k++;
					}
					else {
					//после конца маски считает символы нулями
						print "<font face = 'serif', size = 4>";
						print $encoded_letter;
						print '</font>';
						$k++;
					}
				}
				else {
					print $encoded_letter;
				}
			}
			print '</p>';
		}
		else{
			print 'Не могу зашифровать';
		}
	}
	else {
		print 'Введено пустое значение';
	}
}

if (isset ($_POST['decode'])){
	$input_str = $_POST['inputstr'];
	$length_inputstr = strlen($input_str);
	if (preg_match ('/[a-z]/i', $input_str)){
		$k = 0;
		for ($i = 0; $i <= $length_inputstr; $i++) {
			$letter = substr($input_str, $i, 1);
			if (preg_match ('/[a-z]/i', $letter)) {
				$up_register = ctype_upper($letter);
				if ($up_register) {
					$cypher[$k] = 1;
					$k++;
				}
				else {
					$cypher[$k] = 0;
					$k++;
				}
			}
		}
		print '<p>Зашифрованный текст:</p><p>';
		print $input_str;
		print '</p>';
		$length_cypher = count($cypher);
		print '<p>Расшифрованный текст:</p><p>';
		for ($c=0; $c <= $length_cypher-5; $c=$c+5) {
			$coded_array = array_slice($cypher, $c, 5);
			$coded_letter = implode($coded_array);
			$new_letter = array_search($coded_letter, $alphabet_bacon);
			print $new_letter;
		}
		print '</p>';
	}
	else {
		print 'Не содержит допустимых символов для расшифровки. Пожалуйста, введите зашифрованный текст на английском языке';
	}
}
?>