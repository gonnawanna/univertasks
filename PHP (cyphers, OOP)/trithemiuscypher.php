<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Шифр Тритемиуса</title>
</head>
<body>
<form method="post">
	<p>Ключ А:</p>
	<input type="text" name="inputa"/>
	<p>Ключ B:</p>
	<input type="text" name="inputb"/>
	<p>Введите текст:</p>
	<input type="text" name="inputtext"/>
	<p><input type="submit" name="encode" value="зашифровать"/>
	<input type="submit" name="decode" value="расшифровать"/></p>
</form>
</body>
</html>

<?php

class Shifr {
	
	private $en_alph = array(
	'a' => 1,
	'b' => 2, 
	'c' => 3, 
	'd' => 4, 
	'e' => 5,
	'f' => 6,
	'g' => 7,
	'h' => 8,
	'i' => 9,
	'j' => 10,
	'k' => 11,
	'l' => 12,
	'm' => 13,
	'n' => 14,
	'o' => 15,
	'p' => 16,
	'q' => 17,
	'r' => 18,
	's' => 19,
	't' => 20,
	'u' => 21,
	'v' => 22,
	'w' => 23,
	'x' => 24,
	'y' => 25,
	'z' => 26,
	'_' => 27);
	
	private $text1;
	private $text2;
	private $keyA;
	private $keyB;
	
	public function set_text1($input) {
		$this->text1 = $input;
	}
	
	public function set_text2($input) {
		$this->text2 = $input;
	}
	
	public function set_keyA($input) {
		$this->keyA = $input;
	}
	
	public function set_keyB($input) {
		$this->keyB = $input;
	}
	
	public function get_text1() {
		return $this->text1;
	}
	
	public function get_text2() {
		return $this->text2;
	}
	
	public function get_keyA() {
		return $this->keyA;
	}
	
	public function get_keyB() {
		return $this->keyB;
	}
	
	public function print_text1() {
		print '<p>Исходный текст:</p>';
		print $this->text1;
	}
	
	public function print_text2() {
		print '<p>Зашифрованный текст:</p>';
		print $this->text2;
	}
	
	public function encode ($a,$b,$text) {
		$length = strlen($text);
		$result ='';
		for ($i = 0; $i < $length; $i++) {
			$letter = substr ($text, $i, 1);
			if (preg_match ('/[a-z_]/i', $letter)) {
				$n = 27;
				$p = $i+1;
				$k = $a*pow($p,2)+$b;
				$m = $this->en_alph[$letter];
				$l = ($m+$k)%$n;
				$result .= array_search($l, $this->en_alph);
			}
		}
		return $result;
	}
	
	public function decode ($a,$b,$text) {
		$length = strlen($text);
		$result ='';
		for ($i = 0; $i < $length; $i++) {
			$letter = substr ($text, $i, 1);
			if (preg_match ('/[a-z_]/i', $letter)) {
				$n = 27;
				$p = $i+1;
				$k = $a*pow($p,2)+$b;
				$l = $this->en_alph[$letter];
				$m = ($l-$k)%$n;
				if ($k>$l) {
					$result .= array_search($m+$n, $this->en_alph);
				}
				else {
					$result .= array_search($m, $this->en_alph);
				}
			}
		}
		return $result;
	}
}

if (isset ($_POST['encode'])){
	$object1 = new Shifr();
	$object1->set_keyA($_POST['inputa']);
	$object1->set_keyB($_POST['inputb']);
	$object1->set_text1($_POST['inputtext']);
	$a = $object1->get_keyA();
	$b = $object1->get_keyB();
	$t = $object1->get_text1();
	$r = $object1->encode($a,$b,$t);
	$object1->set_text2($r);
	$object1->print_text1();
	$object1->print_text2();
}

if (isset ($_POST['decode'])){
	$object2 = new Shifr();
	$object2->set_keyA($_POST['inputa']);
	$object2->set_keyB($_POST['inputb']);
	$object2->set_text2($_POST['inputtext']);
	$a = $object2->get_keyA();
	$b = $object2->get_keyB();
	$t = $object2->get_text2();
	$r = $object2->decode($a,$b,$t);
	$object2->set_text1($r);
	$object2->print_text2();
	$object2->print_text1();
}
?>